<?
if(!defined('_INPLUS_')) { exit; } 

Class Application extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'application');
		$this->set('module_name',	'가맹점신청');		

		// context
		$this->set('data_table', 'tbl_application');
		$this->set('pk', 'ap_code');
		$this->set('search_field', 'ap_state');
		$this->set('sch_type_arr', array(
			'ap_name'		=> '신청자',
			'ap_shop_name'		=> '업체명',
			'sh_addr'		=> '주소',
			'ap_email'		=> '이메일',
			'ap_tel'		=> '연락처',
		));

		// 기간검색
		$this->set('sch_date_type_arr', array(
			'reg_time'		=> '신청일',		
		));

		// 출력옵션
		$this->set('order_direct_arr', array(
			'asc'	=> '신청일순',
			'desc'	=> '신청일역순'
		));
		
		/**
		* code array
		*/
		$this->set('ap_state_arr', array(
			'W'	=> '보류',
			'R'	=> '접수',
			'P'	=> '진행'			
		));
	
		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'ap_name,ap_shop_name,ap_sido,ap_sigungu,ap_dong,ap_email,ap_tel,ap_memo');
		$this->set('required_field', $pk.',ap_name,ap_shop_name,ap_sido,ap_sigungu,ap_dong,ap_email,ap_tel');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		$arr['ap_code'] = makeTimecode();
		$arr['ap_state'] = 'R';

		return $arr;
	}

	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',ap_name,ap_shop_name,ap_sido,ap_sigungu,ap_dong,ap_email,ap_tel,ap_memo');
		$this->set('required_field', $pk.',ap_name,ap_shop_name,ap_sido,ap_sigungu,ap_dong,ap_email,ap_tel');		
		$this->set('return_url', './write.html');
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
		
	/* list */	
	protected function initSelect() {
		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', '*');
	}

	/* detail */
	protected function convertDetail($data) {

		$data = parent::convertDetail($data);

		// state
		$arr = $this->get('ap_state_arr');
		$data['txt_ap_state'] = $arr[$data['ap_state']];
		
		if($data['ap_state'] == 'R') { $data['state_class'] = 'success'; }
		else if($data['ap_state'] == 'P') { $data['state_class'] = 'success'; }
		else if($data['ap_state'] == 'W') { $data['state_class'] = 'success'; }

		// 주소
		unset($arr);
		if($data['ap_sido']) { $arr[] = $data['ap_sido']; }
		if($data['ap_sigungu']) { $arr[] = $data['ap_sigungu']; }
		if($data['ap_dong']) { $arr[] = $data['ap_dong']; }

		if(sizeof($arr) > 0) {
			$data['txt_addr'] = implode(' ', $arr);
		}

		return $data;
	}	

	public function selectDetailByApCode($ap_code) {

		$this->initSelect();
		$select_table = $this->get('select_table');
		$select_field = $this->get('select_field');

		$data = dbOnce($select_table, $select_field, "where ap_code = '$ap_code'", "");
		$data = $this->convertDetail($data);

		return $data;
	}

	/* select sigungu */
	public function selectApSigungu($ap_sido) {

		$list = selectSigungu($ap_sido);
		$content = '<option value="">시/군/구</option>';
		foreach($list as $sigungu_name) {
			$content .= '<option value="'.$sigungu_name.'">'.$sigungu_name.'</option>';
		}

		$this->result['content'] = $content;
		
		return $this->result;
	}

	/* select dong */
	public function selectApDong($ap_sido, $ap_sigungu) {

		$list = selectDong($ap_sido, $ap_sigungu);
		$content = '<option value="">읍/면/동</option>';
		foreach($list as $dong_name) {
			$content .= '<option value="'.$dong_name.'">'.$dong_name.'</option>';
		}

		$this->result['content'] = $content;
		
		return $this->result;
	}

	/* validate application */
	public function validateApplication($ap_code) {

		$data_table = $this->get('data_table');
		$chk = dbCount($this->get('data_table'), "where ap_code = '$ap_code' and ap_state = 'P'");
		if($chk) {
			$this->result['code'] = 'ok';
		}

		return $this->result;
	}
}
?>