<?
if(!defined('_INPLUS_')) { exit; } 

Class Admin extends StdController
{	
	/* init */
	public function init() {

		// module info
		$this->set('module',		'admin');
		$this->set('module_name',	'운영자');		

		// context
		$this->set('data_table',	'tbl_admin');
		$this->set('pk',			'mb_id');
		//$this->set('max_file',		1);

		// search
		$this->set('search_field', 'mb_level');
		$this->set('sch_type_arr', array(
			'mb_id'		=> '아이디',
			'mb_name'	=> '이름'
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

		// listing
		/*
		$this->set('cnt_rows', 1);
		$this->set('cnt_page', 2);	
		*/
		
		/**
		* code array
		*/

		// level
		$this->set('mb_level_arr', array(
			//'1'		=> '탈퇴',
			//'2'		=> '미승인',
			'5'		=> '내부직원',
			'7'		=> '중간관리자',
			'9'		=> '최고관리자'
			//'10'	=> '개발관리자'
		));

		// auth list
		$this->set('mb_auth_arr', array(
			'admin'		=> '운영자관리',
			'shop'		=> '가맹점관리',
			'member'	=> '회원관리',
			'contents'	=> '콘텐츠관리',
			'balance'	=> '정산관리'
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
			include_once(_MODULE_PATH_.'/member/member.admin.class.php');
			$oMember = new MemberAdmin();
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
		$this->set('insert_field', 'mb_id,mb_pass,mb_name,mb_email,mb_hp,mb_level,flag_no_login,auth_ip');
		$this->set('required_field', 'mb_id,mb_pass,mb_name,mb_level');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// password
		$arr['mb_pass'] = dbPassword($arr['mb_pass']);		

		// auth list
		$arr['auth_code'] = '';
		if(sizeof($_POST['auth_code']) > 0) {
			$arr['auth_code'] = implode('|', $_POST['auth_code']);
		}		

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',mb_name,mb_email,mb_hp,mb_level,flag_no_login,auth_ip');
		$this->set('required_field', $pk.',mb_name,mb_level');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// password
		if($_POST['mb_pass']) {
			$arr['mb_pass'] = dbPassword($_POST['mb_pass']);	
		}

		return $arr;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();
		$db_where.= " and mb_level >= '5' and mb_level <= '9' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{
		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', '*');
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// 권한등급
		$arr = $this->get('mb_level_arr');
		$data['txt_mb_level'] = $arr[$data['mb_level']];

		return $data;
	}	

}
?>
