<?
if(!defined('_INPLUS_')) { exit; } 

Class Shop extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'shop');
		$this->set('module_name',	'가맹점');		

		// context
		$this->set('data_table', 'tbl_shop');
		$this->set('pk', 'sh_code');

		$this->set('like_table', 'tbl_shop_like');
		$this->set('like_pk', 'sh_lk_id');

		$this->set('cnt_rows', 10);

		// service
		global $oService;
		if(!isset($oService)) {
			include_once(_MODULE_PATH_.'/service/service.class.php');
			$oService = new Service();
			$oService->init();
		}
		$this->set('service_table', $oService->get('data_table'));
		$this->set('service_pk', $oService->get('pk'));

		// staff
		global $oStaff;
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$this->set('staff_table', $oStaff->get('data_table'));
		$this->set('staff_pk', $oStaff->get('pk'));
		
		// favorite
		global $oFavorite;
		if(!isset($oFavorite)) {
			include_once(_MODULE_PATH_.'/favorite/favorite.class.php');
			$oFavorite = new Favorite();
			$oFavorite->init();
		}
		$this->set('favorite_table', $oFavorite->get('data_table'));
		$this->set('favorite_pk', $oFavorite->get('pk'));

		// reserve
		if(!isset($oReserve)) {
			include_once(_MODULE_PATH_.'/reserve/reserve.class.php');
			$oReserve = new Reserve();
			$oReserve->init();
		}
		$this->set('reserve_table', $oReserve->get('data_table'));
		$this->set('reserve_pk', $oReserve->get('pk'));
		
		// search
		$this->set('group_field', 'a.'.$this->get('pk'));
		//$this->set('order_field', 'a.sh_name');
		//$this->set('order_direct', 'asc');

		$this->set('order_field', 'a.sh_code');
		$this->set('order_direct', 'desc');

		$this->set('search_field', 'sh_sido,sh_sigungu,sh_dong,sh_state');
		$this->set('sch_type_arr', array(
			'sh_name'		=> '상호',
			'sh_sido'		=> '지역'
		));

		// keyword
		$this->set('keyword_element', 'mark');

		// 첨부파일
		$this->set('max_file', 5);

		// 기간검색
		$this->set('sch_date_type_arr', array(
			'reg_time'		=> '신청일',		
		));

		// order_field_arr
		$this->set('order_field_arr', array(
			'a.sh_code'		=> '최신순',
			'cnt_reserve'	=> '예약순',
			'cnt_favorite'	=> '즐겨찾기순',
			'cnt_like'		=> '좋아요순'
		));

		// 출력옵션
		$this->set('order_direct_arr', array(
			'asc'	=> '신청일순',
			'desc'	=> '신청일역순'
		));
		
		/**
		* code array
		*/
		$this->set('sh_state_arr', array(
			'Y'	=> '활성화',
			'N'	=> '비활성화',
		));

		$this->set('sh_modify_minute_arr', array(
			'1'		=> '1분',
			'10'	=> '10분',
			'30'	=> '30분',
			'60'	=> '1시간',
			'120'	=> '2시간',
			'9999'	=> '당일',
		));

		$this->set('like_type_arr', array(
			'1'	=> '좋아요',
			'2'	=> '멋져요',
			'3'	=> '친절해',
			'4'	=> '슬퍼요',
			'5'	=> '힘내요',
		));
	
		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'sh_code,sh_name,sh_sido,sh_sigungu,sh_dong,sh_addr2,sh_lat,sh_lng,sh_tel,open_time,close_time,sh_holiday,sh_memo,sh_state');
		$this->set('required_field', $pk.',sh_name,sh_sido,sh_sigungu,sh_dong,sh_addr2,sh_lat,sh_lng,sh_tel,sh_state');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		// 상점코드
		if(!$arr['sh_code']) {
			$arr['sh_code'] = makeTimecode();
		}

		// 위/경도
		if(!$arr['sh_lat'] || !$arr['sh_lng']) {
			$geocode = getGeocodeFromAddr($arr['sh_sido'].$arr['sh_sigungu'].$arr['sh_dong'].$arr['sh_addr2']);
			$arr['sh_lat'] = $geocode['lat'];
			$arr['sh_lng'] = $geocode['lng'];
		}

		// 상태
		$arr['sh_state'] = 'Y';

		return $arr;
	}

	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',sh_code,sh_name,sh_sido,sh_sigungu,sh_dong,sh_addr2,sh_lat,sh_lng,sh_tel,open_time,close_time,sh_holiday,sh_memo,sh_state,sh_modify_minute');
		$this->set('required_field', $pk.',sh_name,sh_sido,sh_sigungu,sh_dong,sh_addr2,sh_lat,sh_lng,sh_tel,sh_state,sh_modify_minute');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		// 위/경도
		if($arr['sh_lat'] < 100 || $arr['sh_lng'] < 30) {
			$geocode = getGeocodeFromAddr($arr['sh_sido'].$arr['sh_sigungu'].$arr['sh_dong'].$arr['sh_addr2']);
			$arr['sh_lat'] = $geocode['lat'];
			$arr['sh_lng'] = $geocode['lng'];
		}

		return $arr;
	}

	public function updateState() {
		$pk = $this->get('pk');

		// 권한 체크
		$uid = ($_POST[$pk]) ? $_POST[$pk] : $_GET[$pk];
		if(!$this->checkDeleteAuth($uid)) { alert('권한이 없습니다.'); }

		$ap_state = ($_GET['ap_state']) ? $_GET['ap_state'] : $_POST['ap_state'];
		$arr = array(
			'ap_state'	=> $ap_state
		);

		dbUpdateByArray($this->get('data_table'), $arr, "where $pk = '$uid'");
		if($ap_state == 'P') {
			if(!isset($oMailing)) {
				include_once(_MODULE_PATH_.'/mailing/mailing.class.php');
				$oMailing = new Mailing();
				$oMailing->init();
			}
			$data = $this->selectDetail($uid);
			$oMailing->sendMail('application', $data);
		}

		$this->result = array(
			'code'	=> 'update_ok',
			'url'	=> './write.html?'.$pk.'='.$uid
		);

		return $this->result;
	}

	/* search */
	protected function makeDbWhere() {
		
		$db_where = parent::makeDbWhere();

		global $member;
		$mb_id = $member['mb_id'];
		$pk = $this->get('pk');

		$list_mode = $this->get('list_mode');
		if($list_mode == 'recommend') {
			
			$sh_code_arr = $this->get('sh_code_arr');
			if(sizeof($sh_code_arr) > 0) {
				$db_in = implode("','", $sh_code_arr);
				$db_where .= " and $pk in ('$db_in') ";
			}
			else {
				$db_where .= " and $pk = 'no' ";
			}
		}
		else if($list_mode == 'visit') {

			$ck_visit_shop = getCookieValue('ck_visit_shop');
			if($ck_visit_shop) {
				$ck_visit_shop = json_decode($ck_visit_shop, 1);
			}

			unset($arr);
			for($i = 0 ; $i < sizeof($ck_visit_shop) ; $i++) {
				if($ck_visit_shop[$i]) {
					$arr[] = $ck_visit_shop[$i];
				}
			}

			if(sizeof($arr) > 0) {
				$db_in = implode("','", $arr);				
			}
			else {
				$db_in = 'none';
			}

			$db_where .= " and a.$pk in ('$db_in') ";
		}
		else if($list_mode == 'favorite') {
			
			$favorite_table = $this->get('favorite_table');
			$list = dbSelect($favorite_table, "distinct($pk) as $pk", "where reg_id = '$mb_id'", "", "");
			unset($arr);
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$arr[] = $list[$i][$pk];
			}

			if(sizeof($arr) > 0) {
				$db_in = implode("','", $arr);
			}
			else {
				$db_in = 'none';
			}
			$db_where .= " and a.$pk in ('$db_in') ";
		}
		else if($list_mode == 'reserve') {

			$reserve_table = $this->get('reserve_table');
			$list = dbSelect($reserve_table, "distinct($pk) as $pk", "where rs_type = 'U' and reg_id = '$mb_id'", "", "");
			unset($arr);
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$arr[] = $list[$i][$pk];
			}

			if(sizeof($arr) > 0) {
				$db_in = implode("','", $arr);
			}
			else {
				$db_in = 'none';
			}
			$db_where .= " and a.$pk in ('$db_in') ";
		}
		else {
			$sch_type = ($_POST['sch_type']) ? $_POST['sch_type'] : $_GET['sch_type'];
			if($sch_type == 'sh_sido' || $sch_type == 'a.sh_sido' || $sch_type == 'all') {
				$sch_keyword = ($_POST['sch_keyword']) ? $_POST['sch_keyword'] : $_GET['sch_keyword'];
				$db_where .= " or a.sh_sigungu like '%".$sch_keyword."%' or a.sh_dong like '%".$sch_keyword."%' ";

			}
		}		

		$this->set('db_where', $db_where);

		return $db_where;		
	}
		
	/* list */	
	/*
	protected function getOrderField() {	

		$order_field = "match_score desc, cnt_reserve desc, cnt_like desc, a.reg_time";

		return $order_field;
	}
	*/

	protected function initSelect() {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$service_table = $this->get('service_table');
		$staff_table = $this->get('staff_table');
		$reserve_table = $this->get('reserve_table');
		$like_table = $this->get('like_table');		
		$favorite_table = $this->get('favorite_table');

		$sch_type = ($_POST['sch_type']) ? $_POST['sch_type'] : $_GET['sch_type'];
		$sch_keyword = ($_POST['sch_keyword']) ? $_POST['sch_keyword'] : $_GET['sch_keyword'];

		$select_table = "$data_table a ";

		$select_field = "a.*";
		$select_field.= ", (select count($pk) from $service_table where a.$pk = $pk) as cnt_service ";
		$select_field.= ", (select count($pk) from $staff_table where a.$pk = $pk) as cnt_staff ";

		$select_field.= ", (select count($pk) from $reserve_table where a.$pk = $pk and rs_state not in ('B', 'C')) as cnt_reserve ";
		$select_field.= ", (select count($pk) from $like_table where a.$pk = $pk) as cnt_like ";
		$select_field.= ", (select count($pk) from $favorite_table where a.$pk = $pk) as cnt_favorite ";		

		if($sch_type == 'all' && $sch_keyword) {
			$select_field.= ", (case (locate('".$sch_keyword."', a.sh_name)) when '0' then '0' else 10 end) + (case (locate('".$sch_keyword."', concat(a.sh_sido, ' ', a.sh_sigungu, ' ', a.sh_dong))) when '0' then '0' else 1 end) as match_score ";
		}
		else {
			$select_field.= ", 0 as match_score ";
		}


		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}

	protected function convertList($list) {

		$list = parent::convertList($list);

		for($i = 0 ; $i < sizeof($list[$i]) ; $i++) {
			$list[$i]['kwd_sh_addr'] = $list[$i]['kwd_sh_sido'].' '.$list[$i]['kwd_sh_sigungu'].' '.$list[$i]['kwd_sh_dong'];
		}

		return $list;
	}

	/* detail */
	protected function convertDetail($data) {

		$data = parent::convertDetail($data);

		// 주소
		$data['txt_addr'] = $data['sh_sido'].' '.$data['sh_sigungu'].' '.$data['sh_dong'].' '.$data['sh_addr2'];
		
		// 영업시간
		$data['txt_work_time'] = $data['open_time'].' ~ '.$data['close_time'];

		// 예약변경(취소)
		if($data['sh_modify_minute'] == '1') {
			$data['txt_modify_time'] = '예약시간';
		}
		else if($data['sh_modify_minute'] == '9999') {
			$data['txt_modify_time'] = '예약당일';
		}
		else if($data['sh_modify_minute'] >= 60) {
			$data['txt_modify_time'] = floor($data['sh_modify_minute']) / 60;
			$data['txt_modify_time'].= '시간';
			$modify_m = $data['sh_modify_minute'] % 60;
			if($modify_m) {
				$data['txt_modify_time'] .= ' '.$modify_m.'분';
			}
		}
		else {
			$data['txt_modify_time'] = $data['sh_modify_minute'].'분';
		}
		/*
		$sh_modify_minute_arr = $this->get('sh_modify_minute_arr');
		$data['txt_sh_modify_minute'] = $sh_modify_minute_arr[$data['sh_modify_minute']];
		*/

		// 이미지
		unset($main_img);
		unset($sub_img);
		$file_list = $data['file_list'];

		$sub_seq = 0;
		for($i = 0 ; $i < sizeof($file_list) ; $i++) {
			if($file_list[$i]['file_type'] == 'main') {
				$main_img = $file_list[$i];
				$main_img['thumb'] = $this->getThumbnailFromFile($main_img);
			}
			else if($file_list[$i]['file_type'] == 'sub') {
				$sub_img[$sub_seq] = $file_list[$i];
				$sub_img[$sub_seq]['thumb'] = $this->getThumbnailFromFile($sub_img[$sub_seq]);

				$sub_seq += 1;
			}
		}
		$data['main_img'] = $main_img;
		$data['sub_img'] = $sub_img;

		// 전송용 정보 (공유하기)
		$send_info = '['._HOMEPAGE_TITLE_.']';
		$send_info.= "\n";
		$send_info.= $data['sh_name'];
		$send_info.= "\n";
		$send_info.= $data['sh_tel'];
		$send_info.= "\n";
		$send_info.= $data['sh_sido'].' '.$data['sh_sigungu'].' '.$data['sh_dong'].' '.$data['sh_addr2'];
		$send_info.= "\n";
		$send_info.= 'http://'._HOMEPAGE_DOMAIN_.'/shop/'.$data['sh_code'];
		$data['send_info'] = urlencode($send_info);
		
		return $data;
	}	

	/* select sigungu */
	public function selectShopSigungu($sh_sido) {
		$list = selectSigungu($sh_sido);
		$content = '<option value="">시/구/군</option>';
		foreach($list as $sigungu_name) {
			$content .= '<option value="'.$sigungu_name.'">'.$sigungu_name.'</option>';
		}
		$this->result['content'] = $content;
		
		return $this->result;
	}

	/* select dong */
	public function selectShopDong($sh_sido, $sh_sigungu) {

		$list = selectDong($sh_sido, $sh_sigungu);
		$content = '<option value="">읍/면/동</option>';
		foreach($list as $dong_name) {
			$content .= '<option value="'.$dong_name.'">'.$dong_name.'</option>';
		}

		$this->result['content'] = $content;
		
		return $this->result;
	}

	/* count by sigungu */
	public function countBySingungu($sh_sido) {

		// 조건
		$db_where = "where sh_sido = '$sh_sido'";

		// 전체보기
		$total_cnt = dbCount($this->get('data_table'), $db_where);
		$arr = array(
			'전체보기'	=> $total_cnt
		);

		// 시군구 배열
		$sigungu_arr = selectSigungu($sh_sido);
		foreach($sigungu_arr as $key) {
			$arr[$key] = 0;
		}

		// 시군구별 카운트
		$list = dbSelect($this->get('data_table'), "sh_sigungu, count(sh_sigungu) as cnt", $db_where, "group by sh_sigungu order by sh_sido asc", "");
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['sh_sigungu'];
			$arr[$key] = $list[$i]['cnt'];
		}

		return $arr;
	}

	/* count like */
	public function countLike($uid, $like_type = '') {

		$like_table = $this->get('like_table');
		$pk = $this->get('pk');

		$db_where = "where $pk = '$uid' ";
		if($like_type) {
			$db_where .= " and like_type = '$like_type' ";
		}

		$cnt = dbCount($like_table, $db_where);

		return $cnt;
	}
}
?>