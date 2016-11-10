<?
if(!defined('_INPLUS_')) { exit; } 

Class Reserve extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'reserve');
		$this->set('module_name',	'예약');		

		// context
		$this->set('data_table', 'tbl_reserve');
		$this->set('pk', 'rs_id');
		//$this->set('order_field', 'rs_date');
		$this->set('order_field', 'concat(rs_date, rs_time)');

		// shop
		$this->set('shop_table', 'tbl_shop');
		$this->set('sh_pk', 'sh_code');

		// staff
		$this->set('staff_table', 'tbl_staff');
		$this->set('st_pk', 'mb_id');

		// service
		$this->set('service_table', 'tbl_service');
		$this->set('sv_pk', 'sv_id');
		
		// config
		$sh_list = dbSelect($this->get('shop_table'), "sh_code, sh_modify_minute", "", "", "");
		unset($modify_minute_arr);
		for($i = 0 ; $i < sizeof($sh_list) ; $i++) {
			$key = $sh_list[$i]['sh_code'];
			$val = $sh_list[$i]['sh_modify_minute'];
			$modify_minute_arr[$key] = $val;
		}
		$this->set('modify_minute_arr', $modify_minute_arr);
		$this->set('approach_hour', 2);
		$this->set('posible_day', 30);

		//$this->set('cnt_rows', 10);

		// search
		$this->set('search_field', 'sh_code,st_id,mb_id,cs_id,sv_id,rs_date,rs_state');
		$this->set('sch_type_arr', array(
			'us_name'	=> '예약자명',
			'us_hp'	=> '예약자휴대폰'
		));
	
		/**
		* code array
		*/
		$this->set('rs_state_arr', array(
			'W'	=> '신청중',
			'A'	=> '담당자승인',
			'P'	=> '진행중',
			'E'	=> '완료',
			'C'	=> '정상취소',
			'B'	=> '비정상취소'
		));

		$this->set('rs_cs_type', array(
			'U'	=> '예약고객',
			'S'	=> '일반고객',
			'M'	=> '일반고객'
		));

		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'sh_code,st_id,rs_date,rs_time');
		$this->set('required_field', 'sh_code,st_id,sv_ids,rs_date,rs_time,rs_state');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		// 가맹점명
		$shop_table = $this->get('shop_table');
		$sh_pk = $this->get('sh_pk');
		$sh_code = $arr[$sh_pk];
		$sh_data = dbOnce($shop_table, "sh_name", "where $sh_pk = '$sh_code'", "");
		$arr['sh_name'] = $sh_data['sh_name'];

		// 스태프명
		$staff_table = $this->get('staff_table');
		$st_pk = $this->get('st_pk');
		$st_id = $arr['st_id'];
		$st_data = dbOnce($staff_table, "mb_name, mb_position", "where $st_pk = '$st_id'", "", 0);
		$arr['st_name'] = $st_data['mb_name'];
		if($st_data['mb_position']) {
			$arr['st_name'] .= ' '.$st_data['mb_position'];
		}

		// 서비스명, 서비스시간, 가격
		$service_table = $this->get('service_table');
		$sv_pk = $this->get('sv_pk');

		$sv_id = $_POST['sv_id'];
		$sv_id_arr = $sv_id;
		if(is_array($sv_id_arr)) {
			$sv_id_arr = array_unique($sv_id_arr);	// 중복 제거
			$sv_id_arr = array_filter($sv_id_arr);	// 빈값 제거
			$sv_id_arr = array_values($sv_id_arr);	// 재정렬
		}

		if(sizeof($sv_id_arr) > 1) {
			$db_in = implode("','", $sv_id_arr);
		}
		else {
			$db_in = $sv_id_arr[0];
		}

		$sv_list = dbSelect($service_table, "$sv_pk, sv_name, sv_time, sv_sale_price", "where $sv_pk in ('$db_in')", "order by sv_time desc", "", 0);

		unset($sv_data);
		$sv_time = 0;
		$sv_price = 0;
		for($i = 0 ; $i < sizeof($sv_list) ; $i++) {
			$sv_data[$sv_pk][$i] = $sv_list[$i][$sv_pk];
			$sv_data['sv_name'][$i] = $sv_list[$i]['sv_name'];
			$sv_time += $sv_list[$i]['sv_time'];
			$sv_price += $sv_list[$i]['sv_sale_price'];
		}

		if(sizeof($sv_data[$sv_pk]) > 1) {
			$arr['sv_ids'] = implode('|', $sv_data[$sv_pk]);
			$arr['sv_names'] = implode('|', $sv_data['sv_name']);
		}
		else {
			$arr['sv_ids'] = $sv_data[$sv_pk][0];
			$arr['sv_names'] = $sv_data['sv_name'][0];
		}
		$arr['sv_time'] = $sv_time;
		$arr['sv_price'] = $sv_price;

		//print_R($arr); exit;

		return $arr;
	}

	protected function postInsert($arr) {

		$arr = parent::postInsert($arr);

		// push 전송
		include_once(_MODULE_PATH_.'/push/push.class.php');
		$oPush = new Push();
		$oPush->init();
		
		$data = $arr;
		$pk = $this->get('pk');
		$data['pk'] = $pk;

		/*
		global $layout;
		$ps_cf_code = 'reserve_to_';
		if($layout == 'user') {		
			$ps_cf_code .= 'staff';
		}
		else {
			$ps_cf_code .= 'user';
		}
		*/
		$ps_cf_code = 'reserve_to_staff';
		$oPush->sendPush($ps_cf_code, $data);

		include_once(_MODULE_PATH_.'/sms/sms.class.php');
		$oSms = new Sms(2);
		$oSms->enrollReportSms($ps_cf_code, $data);

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',sh_code,st_id,rs_date,rs_time');
		$this->set('required_field', $pk.',sh_code,st_id,sv_ids,rs_date,rs_time,rs_state');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		// 가맹점명
		$shop_table = $this->get('shop_table');
		$sh_pk = $this->get('sh_pk');
		$sh_code = $arr[$sh_pk];
		$sh_data = dbOnce($shop_table, "sh_name", "where $sh_pk = '$sh_code'", "");
		$arr['sh_name'] = $sh_data['sh_name'];

		// 스태프명
		$staff_table = $this->get('staff_table');
		$st_pk = $this->get('st_pk');
		$st_id = $arr['st_id'];
		$st_data = dbOnce($staff_table, "mb_name, mb_position", "where $st_pk = '$st_id'", "", 0);
		$arr['st_name'] = $st_data['mb_name'];
		if($st_data['mb_position']) {
			$arr['st_name'] .= ' '.$st_data['mb_position'];
		}

		// 서비스명, 서비스시간, 가격
		$service_table = $this->get('service_table');
		$sv_pk = $this->get('sv_pk');

		$sv_id = $_POST['sv_id'];
		$sv_id_arr = $sv_id;
		if(is_array($sv_id_arr)) {
			$sv_id_arr = array_unique($sv_id_arr);	// 중복 제거
			$sv_id_arr = array_filter($sv_id_arr);	// 빈값 제거
			$sv_id_arr = array_values($sv_id_arr);	// 재정렬
		}

		if(sizeof($sv_id_arr) > 1) {
			$db_in = implode("','", $sv_id_arr);
		}
		else {
			$db_in = $sv_id_arr[0];
		}

		$sv_list = dbSelect($service_table, "$sv_pk, sv_name, sv_time, sv_sale_price", "where $sv_pk in ('$db_in')", "order by sv_time desc", "", 0);

		unset($sv_data);
		$sv_time = 0;
		$sv_price = 0;
		for($i = 0 ; $i < sizeof($sv_list) ; $i++) {
			$sv_data[$sv_pk][$i] = $sv_list[$i][$sv_pk];
			$sv_data['sv_name'][$i] = $sv_list[$i]['sv_name'];
			$sv_time += $sv_list[$i]['sv_time'];
			$sv_price += $sv_list[$i]['sv_sale_price'];
		}

		if(sizeof($sv_data[$sv_pk]) > 1) {
			$arr['sv_ids'] = implode('|', $sv_data[$sv_pk]);
			$arr['sv_names'] = implode('|', $sv_data['sv_name']);
		}
		else {
			$arr['sv_ids'] = $sv_data[$sv_pk][0];
			$arr['sv_names'] = $sv_data['sv_name'][0];
		}
		$arr['sv_time'] = $sv_time;
		$arr['sv_price'] = $sv_price;

		//print_R($arr); exit;

		return $arr;
	}

	protected function postUpdate($arr) {

		$arr = parent::postUpdate($arr);

		// push 전송
		include_once(_MODULE_PATH_.'/push/push.class.php');
		$oPush = new Push();
		$oPush->init();

		// SMS 설정
		include_once(_MODULE_PATH_.'/sms/sms.class.php');
		$oSms = new Sms();

		$pk = $this->get('pk');
		$data = $this->selectDetail($arr[$pk]);
		$data['pk'] = $pk;

		global $layout, $mode;
		$push_type = 'modify_to_';
		if($mode == 'update_state') {
			if($data['rs_state'] == 'A') {
				$push_type = 'accept_to_';
			}
			else if($data['rs_state'] == 'P') {
				$push_type = 'progress_to_';
			}
			else if($data['rs_state'] == 'E') {
				$push_type = 'finish_to_';
				$oSms->enrollSms('completeReservationDefault', $data);

				$cnt_list = dbOnce($this->get('data_table'), 'count(*)', "WHERE cs_id='{$data['cs_id']}' AND rs_state='{$data['rs_state']}'", '');

				// 고객 처음 예약 완료시
				if ($cnt_list['count(*)'] == 1) {
					$oSms->enrollSms('firstCompleteReservation', $data);
				}

				else if ($cnt_list['count(*)'] > 1) {
					$oSms->enrollSms('completeReservation', $data);
				}

				// 선불제 사용
				if ($data['ad_pc_id'] > 0) {
					$oSms->enrollSms('useAdvanceDefault', $data);
				}
			}
			else if($data['rs_state'] == 'C') {
				$push_type = 'cancel_to_';
			}
			else if($data['rs_state'] == 'B') {
				$push_type = 'auto_to_';
			}
		}

		if($layout == 'user') {
			$push_type .= 'staff';
		}
		else {
			$push_type .= 'user';
		}
		$oPush->sendPush($push_type, $data);
		$oSms->enrollReportSms($push_type, $data);

		return $arr;
	}

	/* list */
	protected function initSelect()	{

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$select_table = "$data_table ";
		$select_field = "*";
		$select_field.= ", (CAST(sv_price AS SIGNED) - CAST(pm_sale_price AS SIGNED) - CAST(pm_coupon_price AS SIGNED) - CAST(pm_advance_price AS SIGNED)) as real_price ";
		$select_field.= ", (pm_card_price + pm_cash_price) as total_price ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);

		/*
		// 비정상취소 처리
		$now_time = date('Y-m-d H:i:s');
		dbUpdate($this->get('data_table'), "rs_state = 'B'", "where rs_state = 'W' and concat(rs_date, ' ', rs_time) <= '$now_time' ");
		*/
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// 상태
		$arr = $this->get('rs_state_arr');
		$now_time = time();
		$rs_date = $data['rs_date'];
		$rs_time = strtotime($rs_date.' '.$data['rs_time'].':00');
		$data['txt_rs_state'] = $arr[$data['rs_state']];

		// 서비스
		$data['sv_id_arr'] = explode('|', $data['sv_ids']);
		$data['sv_name_list'] = explode('|', $data['sv_names']);
		
		$data['txt_sv_names'] = $data['sv_name_list'][0];
		$cnt_etc_service = sizeof($data['sv_name_list']) - 1;
		if($cnt_etc_service > 0) {
			$data['txt_sv_names'] .= ' 외 '.$cnt_etc_service.'건';
		}

		// datetime
		$data['txt_rs_datetime'] = beautifyDateTime($rs_time, true);

		// 시간 계산				
		$gap_time = $rs_time - $now_time;
		
		// 임박 여부
		if($data['rs_state'] == 'W' || $data['rs_state'] == 'A' || $data['rs_state'] == 'P') {
			$approach_hour = $this->get('approach_hour');
			if($gap_time > 0 && $gap_time < $approach_hour * 3600) {			
				$data['flag_approach'] = true;
			}
		}
		
		// 변경가능 여부
		$sh_code = $data['sh_code'];
		$modify_minute_arr = $this->get('modify_minute_arr');
		$modify_minute = $modify_minute_arr[$sh_code];
		if($data['rs_state'] == 'W' || $data['rs_state'] == 'A' || $data['rs_state'] == 'P') {
			$now_date = date('Y-m-d');
			if($modify_minute == '9999' && $now_date < $rs_date) {
				$data['flag_modify'] = true;
			}
			else if($gap_time > $modify_minute * 60) {
				$data['flag_modify'] = true;					
			}
		}

		if($modify_minute == '1') {
			$data['txt_modify_time'] = '예약시간';
		}
		else if($modify_minute == '9999') {
			$data['txt_modify_time'] = '예약당일';
		}
		else if($modify_minute >= 60) {
			$data['txt_modify_time'] = floor($modify_minute) / 60;
			$data['txt_modify_time'].= '시간';
			$modify_m = $modify_minute % 60;
			if($modify_m) {
				$data['txt_modify_time'] .= ' '.$modify_m.'분';
			}
		}
		else {
			$data['txt_modify_time'] = $modify_minute.'분';
		}

		// 승인가능 여부
		if($data['rs_state'] == 'W') {
			$data['flag_accept'] = true;
		}
		
		// 진행가능 여부
		if($data['rs_state'] == 'A') {
			$data['flag_process'] = true;			
		}

		// 승인시간
		if($data['ac_time'] && $data['ac_time'] != '0000-00-00 00:00:00') {
			$data['txt_ac_datetime'] = beautifyDateTime($data['ac_time']);			
		}

		// 진행시간
		if($data['cf_time'] && $data['cf_time'] != '0000-00-00 00:00:00') {
			$data['txt_cf_datetime'] = beautifyDateTime($data['cf_time']);			
		}

		// 취소시간
		if($data['cc_time'] && $data['cc_time'] != '0000-00-00 00:00:00') {
			$data['txt_cc_datetime'] = beautifyDateTime($data['cc_time']);
		}

		// 남은 시간
		$remain_arr = getRemainTime($rs_time);
		if($remain_arr['p']) {
			$remain_arr = '-';
		}
		else {
			$data['txt_remain_time'] = str_pad($remain_arr['h'], 2, 0, str_pad_left).':'.str_pad($remain_arr['m'], 2, 0, str_pad_left);
			if($remain_arr['d']) {
				$data['txt_remain_time'] = $remain_arr['d'].'일 '.$data['txt_remain_time'];
			}
		}

		// 결제
		if($data['pm_card_price']) { $data['flag_use_card'] = '1'; }
		if($data['pm_cash_price']) { $data['flag_use_cash'] = '1'; }
		if($data['pm_sale_price']) { $data['flag_use_sale'] = '1'; }
		if($data['cp_id']) { $data['flag_use_coupon'] = '1'; }
		if($data['ad_pc_id']) { $data['flag_use_advance'] = '1'; }		

		//$data['real_price'] = $data['sv_price'] - $data['pm_sale_price'] - $data['pm_coupon_price'] - $data['pm_advance_price'];
		//$data['total_price'] = $data['pm_card_price'] + $data['pm_cash_price'];

		// 예약유형
		$rs_type_arr = $this->get('rs_type_arr');
		$data['txt_rs_type'] = $rs_type_arr[$data['rs_type']];
		
		return $data;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();		

		// rs_date
		$db_where = str_replace(' 00:00:00', '', $db_where);
		$db_where = str_replace(' 23:59:59', '', $db_where);

		// list mode
		$list_mode = $this->get('list_mode');
		$now_time = date('Y-m-d H:i');
		if($list_mode == 'wait') {
			$db_where .= " and rs_state in ('W', 'A', 'P') ";
		}
		else if($list_mode == 'end') {
			$db_where .= " and rs_state in ('E', 'C', 'B') ";
		}
		else if($list_mode == 'finish') {
			$db_where .= " and rs_state in ('E') ";
		}
		else if($list_mode == 'cancel') {
			$db_where .= " and rs_state in ('C', 'B') ";
		}
		else if($list_mode == 'normal') {
			$db_where .= " and rs_state in ('W', 'A', 'P', 'E') ";
		}
		else if($list_mode == 'sales') {
			$db_where .= " and (((pm_card_price + pm_cash_price) > 0) OR (pm_sale_price + pm_coupon_price + pm_advance_price) > 0) ";
		}
		else if($list_mode == 'customer') {
			global $cs_id;
			// 이거 왜 추가한지 알아내자..
			//$db_where = "WHERE cs_id = '$cs_id'";
		}

		// rs_month
		$rs_month = $this->get('rs_month');
		if($rs_month) {
			$db_where .= " and left(rs_date, 7) = '$rs_month' ";
		}

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* count by user id */
	public function countByUserId($mb_id, $rs_state = 'W,A,P,E') {

		$data_table =$this->get('data_table');

		$state_arr = explode(',', $rs_state);
		$db_in = implode("','", $state_arr);

		$cnt = dbCount($data_table, "where rs_type = 'U' and reg_id = '$mb_id' and rs_state in('$db_in') ");

		return $cnt;
	}

	/* count by shop code */
	public function countByShopCode($sh_code, $rs_state = 'W,A,P,E') {

		$data_table =$this->get('data_table');
		
		$state_arr = explode(',', $rs_state);
		$db_in = implode("','", $state_arr);

		$cnt = dbCount($data_table, "where sh_code = '$sh_code' and rs_state in('$db_in') ");

		return $cnt;
	}

	public function countTotalShopCode($rs_state = 'W,A,P,E') {

		$data_table =$this->get('data_table');

		$state_arr = explode(',', $rs_state);
		$db_in = implode("','", $state_arr);

		$cnt = dbCount($data_table, "where rs_state in('$db_in') ");

		return $cnt;
	}

	/* count by staff id */
	public function countByStaffId($mb_id, $rs_state = 'W,A,P,E') {

		$data_table =$this->get('data_table');

		$state_arr = explode(',', $rs_state);
		$db_in = implode("','", $state_arr);

		$cnt = dbCount($data_table, "where st_id = '$mb_id' and rs_state in('$db_in') ");

		return $cnt;
	}

	/* count by customer id */
	public function countByCustomerId($cs_id, $rs_state = 'W,A,P,E', $pay_type = '') {

		$data_table =$this->get('data_table');

		$state_arr = explode(',', $rs_state);
		$db_in = implode("','", $state_arr);

		$db_where = "where cs_id = '$cs_id' and rs_state in('$db_in') ";
		if($pay_type == 'card') {
			$db_where .= " and pm_card_price > 0 ";
		}
		else if($pay_type == 'cash') {
			$db_where .= " and pm_cash_price > 0 ";
		}
		else if($pay_type == 'sale') {
			$db_where .= " and pm_sale_price > 0 ";
		}
		else if($pay_type == 'coupon') {
			$db_where .= " and cp_id > 0 ";
		}
		else if($pay_type == 'advance') {
			$db_where .= " and ad_pc_id > 0 ";
		}

		$cnt = dbCount($data_table, $db_where);

		return $cnt;
	}

	/* sum by customer id */
	public function sumByCustomerId($cs_id, $rs_state = 'W,A,P,E', $pay_type = 'card') {

		$data_table =$this->get('data_table');

		$state_arr = explode(',', $rs_state);
		$db_in = implode("','", $state_arr);

		$db_where = "where cs_id = '$cs_id' and rs_state in('$db_in') ";
		if($pay_type == 'card') {
			$sum_field = 'pm_card_price';
			$db_where .= " and pm_card_price > 0 ";			
		}
		else if($pay_type == 'cash') {
			$sum_field = 'pm_cash_price';
			$db_where .= " and pm_cash_price > 0 ";
		}
		else if($pay_type == 'sale') {
			$sum_field = 'pm_sale_price';
			$db_where .= " and pm_sale_price > 0 ";
		}
		else if($pay_type == 'coupon') {
			$sum_field = 'pm_coupon_price';
			$db_where .= " and cp_id > 0 ";
		}
		else if($pay_type == 'advance') {
			$sum_field = 'pm_advance_price';
			$db_where .= " and ad_pc_id > 0 ";
		}

		$data = dbOnce($data_table, "sum(".$sum_field.") as sum", $db_where, "");

		return $data['sum'];
	}

	/* select time table */
	function selectTimeTable($sch_date, $sh_code, $st_id, $sv_ids, $flag_all_time = false) {

		// shop
		$shop_table = $this->get('shop_table');
		$sh_pk = $this->get('sh_pk');
		$sh_data = dbOnce($shop_table, "open_time, close_time", "where $sh_pk = '$sh_code'", "");
		if($sh_data['open_time'] > $sh_data['close_time']) {
			$tmp_time = $sh_data['open_time'];
			$sh_data['open_time'] = $sh_data['close_time'];
			$sh_data['close_time'] = $tmp_time;
		}

		// staff
		global $oStaff;
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$st_data = $oStaff->selectDetail($st_id);

		/*
		if(!$st_data['s_work']) { $st_data['s_work'] = $sh_data['open_time']; }
		if(!$st_data['e_work']) { $st_data['e_work'] = $sh_data['close_time']; }
		if($st_data['s_work'] > $st_data['e_work']) {
			$tmp_time = $st_data['s_work'];
			$st_data['s_work'] = $st_data['e_work'];
			$st_data['e_work'] = $tmp_time;
		}
		*/

		/*
		if(!$st_data['s_break']) { $st_data['s_break'] = '00:00'; }
		if(!$st_data['e_break']) { $st_data['s_break'] = '00:00'; }
		if($st_data['s_break'] > $st_data['e_break']) {
			$tmp_time = $st_data['s_break'];
			$st_data['s_break'] = $st_data['e_break'];
			$st_data['e_break'] = $tmp_time;
		}
		*/

		// service
		global $oService;
		if(!isset($oService)) {
			include_once(_MODULE_PATH_.'/service/service.class.php');
			$oService = new Service();
			$oService->init();
		}
		$sv_list = $oService->selectServiceByShopCode($sh_code);

		// now
		$now_date = date('Y-m-d');
		$now_hour = date('H:i');

		// 예약 가능한 최대 기간 여부
		$posible_day = $this->get('posible_day');
		$chk_pos = strtotime($sch_date) - time();
		if($chk_pos > $posible_day * 24 * 3600) {
			$flag_no_all = true;
		}

		unset($time_arr);
		// work
		$work_arr = getTimeTableArray($st_data['s_work'], $st_data['e_work']);

		if(sizeof($work_arr) > 0) {
			$last_seq = sizeof($work_arr) -1;
			$seq = 0;
			//$flag_all_time = true;
			foreach($work_arr as $key) {	
				if($flag_no_all && !$flag_all_time) { $time_arr[$key] = 1; }
				else if($now_date > $sch_date && !$flag_all_time) { $time_arr[$key] = 1; }
				else if($now_date == $sch_date && $now_hour > $key && !$flag_all_time) { $time_arr[$key] = 1; }
				else if($seq == $last_seq) { $time_arr[$key] = 1; }
				else { $time_arr[$key] = ''; }
				$seq++;
			}
		}

		// break
		$break_arr = getTimeTableArray($st_data['s_break'], $st_data['e_break']);
		if(sizeof($break_arr) > 0) {
			$last_seq = sizeof($break_arr) -1;
			$seq = 0;
			foreach($break_arr as $key) {
				if($seq < $last_seq) { $time_arr[$key] = 1; }
				$seq++;
			}
		}

		//print_r($work_arr);
		//print_R($break_arr);

		// holiday
		$h_list = $st_data['holiday_list'];
		for($i = 0; $i < sizeof($h_list) ; $i++) {

			// 종일
			if($h_list[$i]['hl_all_time']) {
				$h_list[$i]['s_hl_time'] = '00:00';
				$h_list[$i]['e_hl_time'] = '24:00';
				// 영업시간이 다음날 새벽까지 일 때
				// 다음달, 다음해로 넘어가는 것 php에서 자동으로 계산됨
				if ($st_data['s_work'] > $st_data['e_work']) {
					$h_list[$i]['s_hl_time'] = $st_data['s_work'];

					$h_list_tmp = explode('-', $h_list[$i]['e_hl_date']);
					$h_list[$i]['e_hl_date'] = $h_list_tmp[0] . '-' . $h_list_tmp[1] . '-' . ($h_list_tmp[2] + 1);
					$h_list[$i]['e_hl_time'] = $st_data['e_work'];
				}
			}

			// start
			$arr = explode('-', $h_list[$i]['s_hl_date']);
			$s_year = $arr[0];
			$s_month = $arr[1];
			$s_day = $arr[2];

			$arr = explode(':', $h_list[$i]['s_hl_time']);
			$s_hour = $arr[0];
			$s_minute = $arr[1];

			$s_time = mktime($s_hour, $s_minute, 0, $s_month, $s_day, $s_year);

			// end
			$arr = explode('-', $h_list[$i]['e_hl_date']);
			$e_year = $arr[0];
			$e_month = $arr[1];
			$e_day = $arr[2];

			$arr = explode(':', $h_list[$i]['e_hl_time']);
			$e_hour = $arr[0];
			$e_minute = $arr[1];

			$e_time = mktime($e_hour, $e_minute, 0, $e_month, $e_day, $e_year);

			while($s_time < $e_time) {
				$h_date = date('Y-m-d', $s_time);
				$h_hour = date('H:i', $s_time);
				if($h_date == $sch_date && in_array($h_hour, $work_arr)) {
					$time_arr[$h_hour] = 1;
				}			

				$s_time += 30 * 60;
			}
		}

		// reserve
		// rs_id
		$pk = $this->get('pk');
		$uid = $this->get('uid');
		$data_table = $this->get('data_table');

		$db_where = "where st_id = '$st_id' and rs_date = '$sch_date' and rs_state in ('W', 'A', 'P', 'E') ";
		if($uid) {
			$db_where .= " and $pk != '$uid' ";
		}
		$rs_list = dbSelect($data_table, "rs_time, sv_time", $db_where, "order by rs_time asc", "");

		for($i = 0 ; $i < sizeof($rs_list) ; $i++) {

			$arr = explode(':', $rs_list[$i]['rs_time']);
			$rs_time = $arr[0] * 60 + $arr[1];

			$e_idx = $rs_list[$i]['sv_time'] / 30;
			for($j = 0 ; $j < $e_idx ; $j++) {

				$rs_hour = floor($rs_time / 60);
				if($rs_hour < 10) { $rs_hour = '0'.$rs_hour; }
				
				$rs_minute = $rs_time % 60;
				if($rs_minute < 10) { $rs_minute = '0'.$rs_minute; }

				$key = $rs_hour.':'.$rs_minute;
				$time_arr[$key] = 1;

				$rs_time += 30;
			}
		}

		// service
		$sv_id_arr = explode(',', $sv_ids);
		if(is_array($sv_id_arr)) {
			$sv_id_arr = array_unique($sv_id_arr);	// 중복 제거
			$sv_id_arr = array_filter($sv_id_arr);	// 빈값 제거
			$sv_id_arr = array_values($sv_id_arr);	// 재정렬
		}

		$sv_time = 0;
		for($i = 0 ; $i < sizeof($sv_id_arr) ; $i++) {
			$key = $sv_id_arr[$i];
	//		echo "key : $key \n";
			$sv_time += $sv_list[$sv_id_arr[$i]]['sv_time'];
		}
	//	echo "sv_time : $sv_time"; exit;
		$time_cell = floor($sv_time / 30);

		unset($ps_arr);
		foreach($time_arr as $key => $val) {

			$ps_arr[$key] = 0;
			foreach($time_arr as $key2 => $val2) {
				if($key > $key2) { continue; }
				if($val2) { break; }
				$ps_arr[$key] ++;
			}
		}

		foreach($ps_arr as $key => $val) {
			if($val < $time_cell) {
				$time_arr[$key] = 1;
			}
		}

		// 마지막 타임은 퇴근시간이라 제거한다.
		array_pop($time_arr);

		//print_R($time_arr);

		return $time_arr;
	}

	/* select calendar */
	public function selectCalendarByUserId($sch_date, $mb_id, $flag_normal = true) {
		$cal_arr = makeCalendarArray($sch_date, $flag_normal);
		$rs_state_arr = $this->get('rs_state_arr');
		for($i = 0 ; $i < sizeof($cal_arr['date']) ; $i++) {
			for($j = 0 ; $j < sizeof($cal_arr['date'][$i]) ; $j++) {
				$rs_date = $cal_arr['date'][$i][$j]['date'];
				foreach($rs_state_arr as $rs_state => $txt_rs_state) {
					$cal_arr['date'][$i][$j]['cnt'][$rs_state] = dbCount($this->get('data_table'), "where rs_date = '".$rs_date."' and rs_state in ('".$rs_state."') and reg_id = '$mb_id'");
				};

				$cal_arr['date'][$i][$j]['cnt']['wait'] = $cal_arr['date'][$i][$j]['cnt']['W'] + $cal_arr['date'][$i][$j]['cnt']['A'] + $cal_arr['date'][$i][$j]['cnt']['P'];
				$cal_arr['date'][$i][$j]['cnt']['end'] = $cal_arr['date'][$i][$j]['cnt']['E'] + $cal_arr['date'][$i][$j]['cnt']['C'] + $cal_arr['date'][$i][$j]['cnt']['B'];
				$cal_arr['date'][$i][$j]['cnt']['normal'] = $cal_arr['date'][$i][$j]['cnt']['wait'] + $cal_arr['date'][$i][$j]['cnt']['E'];
				$cal_arr['date'][$i][$j]['cnt']['cancel'] = $cal_arr['date'][$i][$j]['cnt']['C'] + $cal_arr['date'][$i][$j]['cnt']['B'];
				$cal_arr['date'][$i][$j]['cnt']['total'] = $cal_arr['date'][$i][$j]['cnt']['wait'] + $cal_arr['date'][$i][$j]['cnt']['end'];
			}
		}

		return $cal_arr;
	}

	/* 가맹점별 월간 예약건수 조회 */
	public function countMonthlyByShopCode($sch_date, $sh_code, $st_id = '', $flag_normal = true) {		

		// 달력형 배열 생성
		$cal_arr = makeCalendarArray($sch_date, $flag_normal);
		$now_date = date('Y-m-d');

		// 담당자 정보 조회
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
			$oStaff = new StaffManager();
			$oStaff->init();
		}
		$st_id_arr = $oStaff->selectStaffByShopCode($sh_code);

		// 특정 담당자만 조회하기 원하는 경우
		if($st_id) {			
			$st_name = $st_id_arr[$st_id];
			$st_id_arr = array(
				$st_id	=> $st_name
			);
		}

		if(sizeof($st_id_arr) > 0) {
			// 각 날짜별, 담당자의 예약건수 조회
			$rs_state_arr = $this->get('rs_state_arr');

			// 1주씩 반복
			for($i = 0 ; $i < sizeof($cal_arr['date']) ; $i++) {
				// 1일씩 반복
				for($j = 0 ; $j < sizeof($cal_arr['date'][$i]) ; $j++) {

					// 이번달이 아니면 continue
					if($cal_arr['date'][$i][$j]['class'] == 'none') { continue; }

					// 조회 날짜
					$rs_date = $cal_arr['date'][$i][$j]['date'];

					// 담당자별 반복
					foreach($st_id_arr as $st_id => $st_name) {

						// 담당자 이름
						$cal_arr['date'][$i][$j]['cnt'][$st_id]['name'] = $st_name;

						if($cal_arr['date'][$i][$j]['date'] <= $now_date) { 
							// 오늘 이전 날짜
							$cal_arr['date'][$i][$j]['prev'] = true;	
						}

						$cal_arr['date'][$i][$j]['cnt'][$st_id]['normal'] = dbCount($this->get('data_table'), "where rs_date = '".$rs_date."' and rs_state in ('W', 'A', 'P', 'E') and st_id = '".$st_id."'");
						$cal_arr['date'][$i][$j]['cnt'][$st_id]['total'] = dbCount($this->get('data_table'), "where rs_date = '".$rs_date."' and st_id = '".$st_id."'");

					};
				}
			}
		}

		return $cal_arr;
	}

	/* 담당자별 주간 예약내역 조회 */
	public function selectWeeklyByStaffId($sch_date, $st_id, $flag_normal = true) {

		// 주간 배열 생성
		$cal_arr = makeWeekArray($sch_date, $flag_normal);		

		// 담당자 정보 조회
		include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
		$oStaff = new StaffManager();
		$oStaff->init();
		$st_data = $oStaff->selectDetail($st_id);

		// 타임테이블 생성
		$time_arr = getTimeTableArray($st_data['s_work'], $st_data['e_work']);

		// 예약목록 조회		
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');				
		for($i = 0 ; $i < sizeof($cal_arr['date']) ; $i++) {
			$sch_rs_date = $cal_arr['date'][$i]['date'];
			$rs_list = dbSelect($data_table, $pk.", rs_date, rs_time, sv_names, us_name, us_hp, sv_time, rs_state", "where st_id = '$st_id' and rs_date = '$sch_rs_date' and rs_state in ('W', 'A', 'P', 'E')", "order by rs_time asc", "");

			unset($time_arr2);
			foreach($time_arr as $key => $val) {
				// 24:00는 제거해버린다
				if ($key == '24:00') {
					unset($time_arr[$key]);
					continue;
				}
				$chk_time = strtotime($sch_rs_date.' '.$key);
				$time_arr2[$key] = array(
					'txt_time' => date('A H:i', $chk_time)					
				);
			}

			for($j = 0 ; $j < sizeof($rs_list) ; $j++) {
				$rs_time = $rs_list[$j]['rs_time'];
				$txt_time = $time_arr2[$rs_time]['txt_time'];
				$time_arr2[$rs_time] = array(
					'txt_time'	=> $txt_time,
					'rs_id'		=> $rs_list[$j][$pk],
					'us_name'	=> $rs_list[$j]['us_name'],
					'rs_state'	=> $rs_list[$j]['rs_state'],
					'cnt_cell'	=> round($rs_list[$j]['sv_time'] / 30)
				);
			}

			$cal_arr['date'][$i]['time'] = $time_arr2;
		}

		return $cal_arr;
	}

	/* 가맹점별 일간 예약내역 조회 */
	public function selectDailyByShopCode($sch_date, $sh_code, $flag_normal = true) {

		// 일간 배열 생성
		$chk_time = strtotime($sch_date);
		$prev_date = date('Y-m-d', $chk_time - 24 * 3600);
		$next_date = date('Y-m-d', $chk_time + 24 * 3600);
		$cal_arr = array(
			'title'		=> date('Y년 m월 d일', $chk_time),
			'prev_date'	=> $prev_date,
			'next_date'	=> $next_date
		);

		// 담당자 정보 조회
		include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
		$oStaff = new StaffManager();
		$oStaff->init();
		$st_id_arr = $oStaff->selectStaffByShopCode($sh_code);

		unset($db_in_arr);
		$cnt_staff = sizeof($st_id_arr);
		if(!$cnt_staff) {
			return;
		}

		if($cnt_staff < 4) { $cnt_staff = 4; }
		else if($cnt_staff > 10) { $cnt_staff = 10; }
		$cal_arr['cnt_staff'] = $cnt_staff;

		$seq = 0;
		foreach($st_id_arr as $st_id => $st_name) {

			$cal_arr['staff'][$seq] = array(
				'st_id'		=> $st_id,
				'st_name'	=> $st_name
			);

			$db_in_arr[$seq] = $st_id;

			$seq++;
		}

		for($i = $seq ; $i < 7 ; $i++) {
			$cal_arr['staff'][$i] = array(
				'st_id'		=> '',
				'st_name'	=> '&nbsp',
				'class'		=> 'disabled'
			);
		}

		$db_in = implode("','", $db_in_arr);

		// 타임테이블 생성
		$staff_table = $this->get('staff_table');
		$st_pk = $this->get('st_pk');
		$wk_data = dbOnce($staff_table, "min(s_work) as s_work", "where $st_pk in ('$db_in')", "");
		$s_work = $wk_data['s_work'];

		$wk_data = dbOnce($staff_table, "max(e_work) as e_work", "where $st_pk in ('$db_in')", "");
		$e_work = $wk_data['e_work'];

		$time_arr = getTimeTableArray($s_work, $e_work);			

		// 예약목록 조회
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');				
		for($i = 0 ; $i < sizeof($cal_arr['staff']) ; $i++) {
			$st_id = $cal_arr['staff'][$i]['st_id'];
			$rs_list = dbSelect($data_table, $pk.", rs_date, rs_time, sv_names, us_name, us_hp, sv_time, rs_state", "where st_id = '$st_id' and rs_date = '$sch_date' and rs_state in ('W', 'A', 'P', 'E')", "order by rs_time asc", "", 0);
			//print_r($rs_list);

			unset($time_arr2);
			foreach($time_arr as $key => $val) {
				$chk_time = strtotime($rs_date.' '.$key);
				$time_arr2[$key] = array(
					'txt_time' => date('A H:i', $chk_time)					
				);
			}	
			
			for($j = 0 ; $j < sizeof($rs_list) ; $j++) {
				$rs_time = $rs_list[$j]['rs_time'];
				$txt_time = $time_arr2[$rs_time]['txt_time'];
				$time_arr2[$rs_time] = array(
					'txt_time'	=> $txt_time,
					'rs_id'		=> $rs_list[$j][$pk],
					'us_name'	=> $rs_list[$j]['us_name'],
					'rs_state'	=> $rs_list[$j]['rs_state'],
					'cnt_cell'	=> round($rs_list[$j]['sv_time'] / 30)
				);
			}
			
			$cal_arr['staff'][$i]['time'] = $time_arr2;
		}	

		return $cal_arr;
	}

	/*
	public function selectCalendarByShopCode($sch_date, $sh_code, $flag_normal = true) {
		$cal_arr = makeCalendarArray($sch_date, $flag_normal);
		$rs_state_arr = $this->get('rs_state_arr');
		for($i = 0 ; $i < sizeof($cal_arr['date']) ; $i++) {
			for($j = 0 ; $j < sizeof($cal_arr['date'][$i]) ; $j++) {
				$rs_date = $cal_arr['date'][$i][$j]['date'];
				foreach($rs_state_arr as $rs_state => $txt_rs_state) {
					$cal_arr['date'][$i][$j]['cnt'][$rs_state] = dbCount($this->get('data_table'), "where rs_date = '".$rs_date."' and rs_state in ('".$rs_state."') and sh_code = '$sh_code'");
				};

				$cal_arr['date'][$i][$j]['cnt']['wait'] = $cal_arr['date'][$i][$j]['cnt']['W'] + $cal_arr['date'][$i][$j]['cnt']['A'] + $cal_arr['date'][$i][$j]['cnt']['P'];
				$cal_arr['date'][$i][$j]['cnt']['end'] = $cal_arr['date'][$i][$j]['cnt']['E'] + $cal_arr['date'][$i][$j]['cnt']['C'] + $cal_arr['date'][$i][$j]['cnt']['B'];
				$cal_arr['date'][$i][$j]['cnt']['normal'] = $cal_arr['date'][$i][$j]['cnt']['wait'] + $cal_arr['date'][$i][$j]['cnt']['E'];
				$cal_arr['date'][$i][$j]['cnt']['cancel'] = $cal_arr['date'][$i][$j]['cnt']['C'] + $cal_arr['date'][$i][$j]['cnt']['B'];
				$cal_arr['date'][$i][$j]['cnt']['total'] = $cal_arr['date'][$i][$j]['cnt']['wait'] + $cal_arr['date'][$i][$j]['cnt']['end'];
			}
		}

		return $cal_arr;
	}

	public function selectCalendarByStaffId($sch_date, $st_id, $flag_normal = true) {
		$cal_arr = makeCalendarArray($sch_date, $flag_normal);
		$rs_state_arr = $this->get('rs_state_arr');
		for($i = 0 ; $i < sizeof($cal_arr['date']) ; $i++) {
			for($j = 0 ; $j < sizeof($cal_arr['date'][$i]) ; $j++) {
				$rs_date = $cal_arr['date'][$i][$j]['date'];
				foreach($rs_state_arr as $rs_state => $txt_rs_state) {
					$cal_arr['date'][$i][$j]['cnt'][$rs_state] = dbCount($this->get('data_table'), "where rs_date = '".$rs_date."' and rs_state in ('".$rs_state."') and st_id = '$st_id'");
				};

				$cal_arr['date'][$i][$j]['cnt']['wait'] = $cal_arr['date'][$i][$j]['cnt']['W'] + $cal_arr['date'][$i][$j]['cnt']['A'] + $cal_arr['date'][$i][$j]['cnt']['P'];
				$cal_arr['date'][$i][$j]['cnt']['end'] = $cal_arr['date'][$i][$j]['cnt']['E'] + $cal_arr['date'][$i][$j]['cnt']['C'] + $cal_arr['date'][$i][$j]['cnt']['B'];
				$cal_arr['date'][$i][$j]['cnt']['normal'] = $cal_arr['date'][$i][$j]['cnt']['wait'] + $cal_arr['date'][$i][$j]['cnt']['E'];
				$cal_arr['date'][$i][$j]['cnt']['cancel'] = $cal_arr['date'][$i][$j]['cnt']['C'] + $cal_arr['date'][$i][$j]['cnt']['B'];
				$cal_arr['date'][$i][$j]['cnt']['total'] = $cal_arr['date'][$i][$j]['cnt']['wait'] + $cal_arr['date'][$i][$j]['cnt']['end'];
			}
		}

		return $cal_arr;
	}
	*/

	/* select time table */
	public function selectTimeTableByStaffId($sch_date, $st_id) {

		// staff
		global $oStaff;
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$st_data = $oStaff->selectDetail($st_id);

		// now
		$now_date = date('Y-m-d');
		$now_hour = date('H:i');

		unset($time_arr);

		// work
		$work_arr = getTimeTableArray($st_data['s_work'], $st_data['e_work']);
		$last_seq = sizeof($work_arr) -1;
		$seq = 0;
		foreach($work_arr as $key) {			
			if($seq == $last_seq) { 
				$time_arr[$key]['flag'] = 1;
				$time_arr[$key]['title'] = '근무종료';
				$time_arr[$key]['msg'] = '[근무시간] '.$st_data['s_work'].' ~ '.$st_data['e_work'].'|[휴식시간] '.$st_data['s_break'].' ~ '.$st_data['e_break']; 
			}
			else { $time_arr[$key] = ''; }
			$seq++;
		}

		// break
		$break_arr = getTimeTableArray($st_data['s_break'], $st_data['e_break']);
		$last_seq = sizeof($break_arr) -1;
		$seq = 0;
		if (count($break_arr) > 0) {
			foreach($break_arr as $key) {
				if($seq < $last_seq) {
					$time_arr[$key]['flag'] = 2;
					$time_arr[$key]['title'] = '휴식시간';
					$time_arr[$key]['msg'] = '[근무시간] '.$st_data['s_work'].' ~ '.$st_data['e_work'].'|[휴식시간] '.$st_data['s_break'].' ~ '.$st_data['e_break'];
				}
				$seq++;
			}
		}

		// holiday
		$h_list = $st_data['holiday_list'];
		for($i = 0; $i < sizeof($h_list) ; $i++) {

			// 종일
			if($h_list[$i]['hl_all_time']) {
				$h_list[$i]['s_hl_time'] = '00:00';
				$h_list[$i]['e_hl_time'] = '24:00';
			}

			// start
			$arr = explode('-', $h_list[$i]['s_hl_date']);
			$s_year = $arr[0];
			$s_month = $arr[1];
			$s_day = $arr[2];

			$arr = explode(':', $h_list[$i]['s_hl_time']);
			$s_hour = $arr[0];
			$s_minute = $arr[1];

			$s_time = mktime($s_hour, $s_minute, 0, $s_month, $s_day, $s_year);

			// end
			$arr = explode('-', $h_list[$i]['e_hl_date']);
			$e_year = $arr[0];
			$e_month = $arr[1];
			$e_day = $arr[2];

			$arr = explode(':', $h_list[$i]['e_hl_time']);
			$e_hour = $arr[0];
			$e_minute = $arr[1];

			$e_time = mktime($e_hour, $e_minute, 0, $e_month, $e_day, $e_year);

			while($s_time < $e_time) {
				$h_date = date('Y-m-d', $s_time);
				$h_hour = date('H:i', $s_time);				
				if($h_date == $sch_date && in_array($h_hour, $work_arr)) {
					$time_arr[$h_hour]['flag'] = 3;
					$time_arr[$h_hour]['title'] = '휴무일정';
					$time_arr[$h_hour]['msg'] = $h_list[$i]['hl_memo'].'|'.$h_list[$i]['s_hl_date'];
					if($h_list[$i]['hl_all_time']) {
						$time_arr[$h_hour]['msg'] .= ' ~ '.$h_list[$i]['e_hl_date'];
					}
					else {
						$time_arr[$h_hour]['msg'] .= ' '.$h_list[$i]['s_hl_time'].' ~ '.$h_list[$i]['e_hl_date'].' '.$h_list[$i]['e_hl_time'];
					}
				}			

				$s_time += 30 * 60;
			}
		}
		
		// reserve
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$rs_list = dbSelect($data_table, $pk.", rs_date, rs_time, sv_names, us_name, us_hp, sv_time", "where st_id = '$st_id' and rs_date = '$sch_date' and rs_state in ('W', 'A', 'P', 'E')", "order by rs_time asc", "");
		for($i = 0 ; $i < sizeof($rs_list) ; $i++) {

			$arr = explode(':', $rs_list[$i]['rs_time']);
			$rs_time = $arr[0] * 60 + $arr[1];

			$e_idx = $rs_list[$i]['sv_time'] / 30;
			for($j = 0 ; $j < $e_idx ; $j++) {

				$rs_hour = floor($rs_time / 60);
				if($rs_hour < 10) { $rs_hour = '0'.$rs_hour; }
				
				$rs_minute = $rs_time % 60;
				if($rs_minute < 10) { $rs_minute = '0'.$rs_minute; }

				$key = $rs_hour.':'.$rs_minute;

				$time_arr[$key]['flag'] = 4;
				$time_arr[$key][$pk] = $rs_list[$i][$pk];

				$sv_arr = explode('|', $rs_list[$i]['sv_names']);
				$cnt_etc_service = sizeof($sv_arr) - 1;
				$time_arr[$key]['msg'] = $rs_list[$i]['us_name'].' ('.$rs_list[$i]['us_hp'].')|'.$sv_arr[0];				
				if($cnt_etc_service > 0) {
					$time_arr[$key]['msg'] .= ' 외 '.$cnt_etc_service.'건';
				}
				$time_arr[$key]['msg'] .= '|'.$rs_list[$i]['rs_date'].' '.$rs_list[$i]['rs_time'];
				/*				
				$time_arr[$key]['title'] = '예약접수';;				
				$time_arr[$key]['msg'] = $rs_list[$i]['us_name'].' ('.$rs_list[$i]['us_hp'].')|'.$rs_list[$i]['sv_names'].'|'.$rs_list[$i]['rs_date'].' '.$rs_list[$i]['rs_time'];
				*/

				$rs_time += 30;
			}
		}

		return $time_arr;
	}

	/* update state */
	public function updateState() {

		$this->initUpdate();

		$pk = $this->get('pk');
		$uid = $this->get('uid');
		$rs_state = ($_POST['rs_state']) ? $_POST['rs_state'] : $_GET['rs_state'];

		if(!$this->checkDeleteAuth($uid)) { alert('권한이 없습니다.'); }

		$arr = $this->convertUpdate($arr);
		$arr = array(
			'rs_state'	=> $rs_state
		);

		$now_time = date('Y-m-d H:i:s');
		if($rs_state == 'A') {
			$arr['ac_time'] = $now_time;
			$arr['cf_time'] = '';
			$arr['cc_time'] = '';
		}
		else if($rs_state == 'P') {
			$arr['cf_time'] = $now_time;
			$arr['cc_time'] = '';
		}
		else if($rs_state == 'C' || $rs_state == 'B') {
			$arr['ac_time'] = '';
			$arr['cf_time'] = '';
			$arr['cc_time'] = $now_time;
		}

		dbUpdateByArray($this->get('data_table'), $arr, "where $pk = '".$uid."'");

		$this->result['code'] = 'update_ok';

		$p_arr = $arr;
		$p_arr['pk'] = $pk;
		$p_arr[$pk] = $uid;
		$this->postUpdate($p_arr);	

		return $this->result;
	}

	/* update payment */
	public function updatePayment() {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$uid = $this->get('uid');

		/*

		// 갱신 자료 초기화
		$arr = array(
			'rs_pay_memo'		=> $_POST['rs_pay_memo'],
			'pm_sale_price'		=> '0',
			'pm_coupon_price'	=> '0',
			'pm_advance_price'	=> '0',
			'pm_card_price'		=> '0',
			'pm_cash_price'		=> '0',
			'cp_id'				=> '',
			'ad_pc_id'			=> ''
		);

		// 일반할인
		if($_POST['flag_use_sale']) {
			$arr['pm_sale_price'] = str_replace(',', '', $_POST['pm_sale_price']);
		}

		// 쿠폰사용
		if($_POST['flag_use_coupon'] && $_POST['cp_id']) {
			$arr['cp_id'] = $_POST['cp_id'];
			$arr['pm_coupon_price'] = str_replace(',', '', $_POST['pm_coupon_price']);
		}

		// 선불제사용
		if($_POST['flag_use_advance'] && $_POST['ad_pc_id']) {
			$arr['ad_pc_id'] = $_POST['ad_pc_id'];
			$arr['pm_advance_price'] = str_replace(',', '', $_POST['pm_advance_price']);
		}

		// 카드결제
		if($_POST['flag_use_card']) {
			$arr['pm_card_price'] = str_replace(',', '', $_POST['pm_card_price']);
		}

		// 현금결제
		if($_POST['flag_use_cash']) {
			$arr['pm_cash_price'] = str_replace(',', '', $_POST['pm_cash_price']);
		}
		*/

		$arr = array(
			'rs_pay_memo'		=> $_POST['rs_pay_memo'],

			'pm_sale_price'		=> str_replace(',', '', $_POST['pm_sale_price']),

			'cp_id'				=> $_POST['cp_id'],
			'pm_coupon_price'	=> str_replace(',', '', $_POST['pm_coupon_price']),

			'ad_pc_id'			=> $_POST['ad_pc_id'],
			'pm_advance_price'	=> str_replace(',', '', $_POST['pm_advance_price']),

			'pm_card_price'		=> str_replace(',', '', $_POST['pm_card_price']),
			'pm_cash_price'		=> str_replace(',', '', $_POST['pm_cash_price'])
			
			
		);

		$arr = parent::convertUpdate($arr);
		dbUpdateByArray($data_table, $arr, "where $pk = '$uid'");

		$this->result['code'] = 'ok';

		return $this->result;
	}

	/* update memo */
	public function updateMemo() {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$uid = $this->get('uid');

		// 갱신 자료 초기화
		$arr = array(
			'rs_pay_memo'		=> $_POST['rs_pay_memo'],
		);

		$arr = parent::convertUpdate($arr);
		dbUpdateByArray($data_table, $arr, "where $pk = '$uid'");

		$this->result['code'] = 'ok';

		if($arr['rs_pay_memo']) {
			$this->result['rs_pay_memo'] = true;
		}

		return $this->result;
	}

	/* 상점별 매출액 계산 */
	public function selectSalesReserve($sh_code, $rs_type = '', $s_date= '', $e_date= '', $st_id = '') {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		//$db_where = "where sh_code = '$sh_code' and (pm_card_price + pm_cash_price) > 10 ";
		$this->selectList();
		$db_where = $this->get('db_where');
		if ($rs_type == 'TOTAL') {
			$result = array();

			$data = dbOnce($data_table, "SUM(pm_sale_price), COUNT(IF(pm_sale_price > 0, 1, NULL)), SUM(pm_coupon_price), COUNT(IF(pm_coupon_price > 0, 1, NULL)), SUM(pm_advance_price), COUNT(IF(pm_advance_price > 0, 1, NULL))", $db_where, "");
			//$data = dbOnce($data_table, "SUM(pm_sale_price), COUNT(IF(pm_sale_price > 0, 1, NULL)), SUM(pm_coupon_price), COUNT(IF(pm_coupon_price > 0, 1, NULL)), SUM(pm_advance_price), COUNT(IF(pm_advance_price > 0, 1, NULL))", $db_where, "");

			if (count($data) > 0) {
				$result['sum_total_normal_discount'] = $data['SUM(pm_sale_price)'];
				$result['sum_total_coupon_discount'] = $data['SUM(pm_coupon_price)'];
				$result['sum_total_advance'] = $data['SUM(pm_advance_price)'];

				$result['cnt_normal_discount'] = $data['COUNT(IF(pm_sale_price > 0, 1, NULL))'];
				$result['cnt_coupon_discount'] = $data['COUNT(IF(pm_coupon_price > 0, 1, NULL))'];
				$result['cnt_advance'] = $data['COUNT(IF(pm_advance_price > 0, 1, NULL))'];
			}
			return $result;
		} else if ($rs_type == 'U' || $rs_type == 'S' || $rs_type == 'M') {
			$result = array();
			$db_where .= ' and rs_type="' . $rs_type . '"';
			$data = dbOnce($data_table, "sum(sv_price) as service_price, sum(pm_sale_price + pm_coupon_price + pm_advance_price) as sale_price, sum(pm_card_price) as card_price, sum(pm_cash_price) as cash_price",$db_where, '');

			// cnt_total
			$cnt_total = dbCount($data_table, $db_where . ' and (pm_card_price <> 0 or pm_cash_price <> 0)');
			$result = array(
				'cnt_total'		=> $cnt_total,
				'service_price'	=> $data['service_price'],
				'sale_price'	=> $data['sale_price'],
				'card_price'	=> $data['card_price'],
				'cash_price'	=> $data['cash_price'],
				'total_price'	=> $data['card_price'] + $data['cash_price']
			);

			return $result;
		}
		/*
		// 선불제 등록에 대한 계산

			$db_where = "where sh_code = '$sh_code' and (pm_card_price + pm_cash_price) > 10 ";
			if($rs_type) {
				$db_where .= " and rs_type = '$rs_type' ";
			}

			if($s_date) {
				$db_where .= " and rs_date >= '$s_date' ";
			}

			if($e_date) {
				$db_where .= " and rs_date <= '$e_date' ";
			}

			if($st_id) {
				$db_where .= " and st_id = '$st_id' ";
			}
			// price
			$data = dbOnce($data_table, "sum(sv_price) as service_price, sum(pm_sale_price + pm_coupon_price + pm_advance_price) as sale_price, sum(pm_card_price) as card_price, sum(pm_cash_price) as cash_price", $db_where, "");

			$sales = array(
				'cnt_total'		=> $cnt_total,
				'service_price'	=> $data['service_price'],
				'sale_price'	=> $data['sale_price'],
				'card_price'	=> $data['card_price'],
				'cash_price'	=> $data['cash_price'],
				'total_price'	=> $data['card_price'] + $data['cash_price']
			);
			return $sales;
		*/
	}


}
?>