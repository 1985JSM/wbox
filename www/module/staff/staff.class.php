<?
if(!defined('_INPLUS_')) { exit; } 

Class Staff extends StdController
{	
	/* init */
	public function init() {

		// module info
		$this->set('module',		'staff');
		$this->set('module_name',	'운영자');		

		// context
		$this->set('data_table',	'tbl_staff');
		$this->set('pk',			'mb_id');	
		$this->set('group_field', $this->get('pk'));

		$this->set('like_table',	'tbl_staff_like');
		$this->set('like_pk',		'st_lk_id');

		// shop
		global $oShop;
		if(!isset($oShop)) {
			include_once(_MODULE_PATH_.'/shop/shop.class.php');
			$oShop = new Shop();
			$oShop->init();
		}
		$this->set('shop_table', $oShop->get('data_table'));
		$this->set('shop_pk', $oShop->get('pk'));		

		// service
		global $oService;
		if(!isset($oService)) {
			include_once(_MODULE_PATH_.'/service/service.class.php');
			$oService = new Service();
			$oService->init();
		}
		$this->set('service_table', $oService->get('data_table'));
		$this->set('service_pk', $oService->get('pk'));

		// file
		$this->set('max_file',		1);

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 180);
		$this->set('thumb_height', 180);
		//$this->set('no_image', '/img/mobile/common/img_noimg_640x360.gif');
		//$this->set('is_crop', true);

		$this->set('order_field', 'st_order');
		$this->set('order_direct', 'asc');

		// keyword
		$this->set('keyword_element', 'mark');

		// search
		$this->set('search_field', 'a.mb_level,a.sh_code');
		$this->set('sch_type_arr', array(
			'a.mb_id'		=> '아이디',
			'a.mb_name'	=> '이름'
		));

		$this->set('sch_date_type_arr', array(
			'reg_time'	=> '등록일자',
			'upt_time'	=> '수정일자'
		));

		$this->set('order_field_arr', array(
			'mb_id'			=> '아이디',
			'mb_name'		=> '이름',
			'login_time'	=> '최종접속일',
			'reg_time'		=> '등록일'
		));
		
		/**
		* code array
		*/

		// level
		$this->set('mb_level_arr', array(
			//'1'		=> '탈퇴',
			//'2'		=> '미승인',
			//'5'		=> '내부직원',
			'7'		=> '담당자'
			//'9'		=> '최고관리자'
			//'10'	=> '개발관리자'
		));

		parent::init();
	}

	/* validate */
	protected function validateValues($arr)	{
		global $oMember;
		$pk = $this->get('pk');

		// 기본 유효성 검사
		$result = parent::validateValues($arr);
		
		// 아이디 검사
		if(!isset($oMember)) {
			include_once(_MODULE_PATH_.'/member/member.staff.class.php');
			$oMember = new MemberStaff();
			$oMember->init();
		}

		$result = $oMember->checkMemberId($arr['mb_id']);
		if(!$arr[$pk] && $result['code'] != 'ok') {		
			return $result;
		}

		return $result;
	}

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'sh_code,mb_id,mb_pass,mb_level,gr_code,mb_name,mb_nick,mb_position,mb_email,mb_hp,s_work,e_work,s_break,e_break,mb_pr,flag_no_login');
		$this->set('required_field', 'sh_code,mb_id,mb_pass,mb_level,mb_name,mb_nick,mb_email,mb_hp,s_work,e_work,s_break,e_break');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// password
		$arr['mb_pass'] = dbPassword($arr['mb_pass']);		

		// sv_code
		$arr['sv_code'] = '';
		if(sizeof($_POST['sv_code']) > 0) {
			$arr['sv_code'] = implode('|', $_POST['sv_code']);
		}		

		// holiday
		$s_hl_date = $_POST['s_hl_date'];
		$s_hl_time = $_POST['s_hl_time'];
		$e_hl_date = $_POST['e_hl_date'];
		$e_hl_time = $_POST['e_hl_time'];
		$hl_all_time = $_POST['hl_all_time'];
		$hl_memo = $_POST['hl_memo'];

		unset($holidays);
		for($i = 0 ; $i < sizeof($s_hl_date) ; $i++) {
			$holidays[$i] = $s_hl_date[$i].'|'.$s_hl_time[$i].'|'.$e_hl_date[$i].'|'.$e_hl_time[$i].'|'.$hl_all_time[$i].'|'.$hl_memo[$i];
		}

		if(sizeof($holidays) > 0) {
			$arr['holidays'] = implode("\n", $holidays);
		}

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',sh_code,mb_level,gr_code,mb_name,mb_nick,mb_position,mb_email,mb_hp,s_work,e_work,s_break,e_break,mb_pr,flag_no_login');
		$this->set('required_field', $pk.',sh_code,mb_level,mb_name,mb_nick,mb_email,mb_hp,s_work,e_work,s_break,e_break');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// password
		if($_POST['mb_pass']) {
			$arr['mb_pass'] = dbPassword($_POST['mb_pass']);	
		}

		// sv_code
		$arr['sv_code'] = '';
		if(sizeof($_POST['sv_code']) > 0) {
			$arr['sv_code'] = implode('|', $_POST['sv_code']);
		}		

		// holiday
		$s_hl_date = $_POST['s_hl_date'];
		$s_hl_time = $_POST['s_hl_time'];
		$e_hl_date = $_POST['e_hl_date'];
		$e_hl_time = $_POST['e_hl_time'];
		$hl_all_time = $_POST['hl_all_time'];
		$hl_memo = $_POST['hl_memo'];

		unset($holidays);
		for($i = 0 ; $i < sizeof($s_hl_date) ; $i++) {
			$holidays[$i] = $s_hl_date[$i].'|'.$s_hl_time[$i].'|'.$e_hl_date[$i].'|'.$e_hl_time[$i].'|'.$hl_all_time[$i].'|'.$hl_memo[$i];
		}

		if(sizeof($holidays) > 0) {
			$arr['holidays'] = implode("\n", $holidays);
		}

		return $arr;
	}	

	/* update profile */
	public function updateProfile($mb_id, $arr) {

		$arr['upt_id'] = $mb_id;
		$arr['upt_time'] = time('Y-m-d H:i:s');

		dbUpdateByArray($this->get('data_table'), $arr, "where mb_id = '$mb_id'");
		$this->result['code'] = 'update_ok';

		return $this->result;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();
		$db_where.= " and mb_level >= '5' ";

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$shop_table = $this->get('shop_table');
		$shop_pk = $this->get('shop_pk');

		$service_table = $this->get('service_table');
		$service_pk = $this->get('service_pk');

		$like_table = $this->get('like_table');
		$like_pk = $this->get('like_pk');

		$select_table = "$data_table a ";
		$select_table.= "left outer join $shop_table b on a.".$shop_pk." = b.".$shop_pk." ";
		$select_table.= "left outer join $service_table c on b.".$shop_pk." = c.".$shop_pk." ";

		$select_field = "a.*";
		$select_field.= ", b.sh_name ";
		$select_field.= ", count(c.".$shop_pk.") as cnt_service ";
		$select_field.= ", (select count($like_pk) from $like_table where a.mb_id = st_id) as cnt_like ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// 권한등급
		$arr = $this->get('mb_level_arr');
		$data['txt_mb_level'] = $arr[$data['mb_level']];

		// 직책
		$data['txt_staff'] = $data['mb_name'];
		if($data['mb_position']) {
			$data['txt_staff'] .= ' '.$data['mb_position'];
		}

		// 매장 정보
		$flag_link_shop = $this->get('flag_link_shop');
		if($flag_link_shop) {
			global $oShop;
			$data['shop_info'] = $oShop->selectDetail($data['sh_code']);
		}

		// 서비스 목록
		global $oService;
		$data['txt_sv_code'] = $oService->getServiceNameByCode($data['sv_code']);

		// 휴무일정
		if($data['holidays']) {
			unset($holiday_list);
			$holidays = explode("\n", $data['holidays']);
			for($i = 0 ; $i < sizeof($holidays) ; $i++) {
				$arr = explode('|', $holidays[$i]);

				$holiday_list[$i] = array(
					's_hl_date'	=> $arr[0],
					's_hl_time'	=> $arr[1],
					'e_hl_date'	=> $arr[2],
					'e_hl_time'	=> $arr[3],
					'hl_all_time'	=> $arr[4],
					'hl_memo'	=> $arr[5]
				);
			}

			$data['holiday_list'] = $holiday_list;
		}

		return $data;
	}	

	/* change order */
	public function changeOrder($uid, $direction) {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$data = dbOnce($data_table, "*", "where $pk = '$uid'", "");
		$sh_code = $data['sh_code'];
		$st_order = $data['st_order'];
		if($direction == 'up') {
			// 위로
			$target = dbOnce($data_table, "*", "where sh_code = '$sh_code' and st_order < '$st_order'", "order by st_order desc");			
		}
		else if($direction == 'down') {
			// 아래로
			$target = dbOnce($data_table, "*", "where sh_code = '$sh_code' and st_order > '$st_order'", "order by st_order asc");
		}
		$target_uid = $target[$pk];
		$target_order = $data['st_order'];//$target['st_order'] + 1;
		$st_order = $target['st_order'];//st_order - 1;

		dbUpdate($data_table, "st_order = '$st_order'", "where $pk = '$uid'");
		dbUpdate($data_table, "st_order = '$target_order'", "where $pk = '$target_uid'");

		$list = dbSelect($data_table, "$pk", "where sh_code = '$sh_code'", "order by st_order asc", "");
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$st_order = $i + 1;
			$uid = $list[$i][$pk];
			dbUpdate($data_table, "st_order = '$st_order'", "where $pk = '$uid'");
		}

		$this->result['code'] = 'ok';

		return $this->result;
	}

	/* select staff by shop code */
	public function selectStaffByShopCode($sh_code, $sv_id_arr = '') {
		$list = dbSelect($this->get('data_table'), "mb_id, mb_name, mb_position, sv_code", "where sh_code = '$sh_code' and mb_level >= '5'", "order by st_order asc", "");

		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {

			if(is_array($sv_id_arr)) {

				$sv_id_arr = array_unique($sv_id_arr);	// 중복 제거
				$sv_id_arr = array_filter($sv_id_arr);	// 빈값 제거
				$sv_id_arr = array_values($sv_id_arr);	// 재정렬

				$flag_no_match = false;
				for($j = 0 ; $j < sizeof($sv_id_arr) ; $j++) {
					$sv_code = $list[$i]['sv_code'];
					$sv_id = $sv_id_arr[$j];

					if(!$sv_id) {
						continue;
					}

					if(strpos('|'.$sv_code.'|', '|'.$sv_id.'|') > -1) {

					}
					else {
						$flag_no_match = true;
						break;
					}
				}

				if($flag_no_match) {
					continue;
				}
			}			

			$key = $list[$i]['mb_id'];			
			$val = $list[$i]['mb_name'];
			if($list[$i]['mb_position']) { $val .= ' '.$list[$i]['mb_position']; }

			$arr[$key] = $val;
		}

		return $arr;
	}

	public function selectStaffCodeTotal($sv_id = '') {
		$list = dbSelect($this->get('data_table'), "mb_id, mb_name, mb_position, sv_code", "where  mb_level >= '5'", "order by st_order asc", "");

		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {

			if($sv_id != '') {
				$sv_code = $list[$i]['sv_code'];
				if(strpos('|'.$sv_code.'|', '|'.$sv_id.'|') > -1) {

				}
				else {
					continue;
				}
			}

			$key = $list[$i]['mb_id'];			
			$val = $list[$i]['mb_name'];
			if($list[$i]['mb_position']) { $val .= ' '.$list[$i]['mb_position']; }

			$arr[$key] = $val;
		}

		return $arr;
	}
}
?>
