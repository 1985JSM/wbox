<?
if(!defined('_INPLUS_')) { exit; } 

Class User extends StdController
{	
	/* init */
	public function init() {

		// module info
		$this->set('module',		'user');
		$this->set('module_name',	'사용자');		

		// context
		$this->set('data_table',	'tbl_user');
		$this->set('pk', 'mb_id');
		$this->set('max_file',		1);

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 180);
		$this->set('thumb_height', 180);
		$this->set('no_image', '/img/mobile/common/s_logo2.png');
		

		$this->set('default_point', 100);
		
		/**
		* code array
		*/

		// level
		$this->set('mb_level_arr', array(
			'1'		=> '탈퇴',
			'2'		=> '미승인',
			'3'		=> '레벨1',
			'5'		=> '레벨2',
			'6'		=> '레벨3',
			'7'		=> '레벨4',
			'9'		=> '레벨5'
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
			include_once(_MODULE_PATH_.'/member/member.user.class.php');
			$oMember = new MemberUser();
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
		$this->set('insert_field', 'mb_id,mb_pass,mb_level,mb_name,mb_nick,mb_email,mb_hp_comp,mb_hp,mb_area,mb_birth,mb_birth_type,mb_gender,mb_pr,mb_push_os,mb_push_id,flag_use_push,mb_memo,flag_no_login');
		$this->set('required_field', 'mb_id,mb_pass,mb_level,mb_name,mb_nick,mb_email,mb_hp_comp,mb_hp,mb_area,mb_birth,mb_birth_type,mb_gender');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// password
		$arr['mb_pass'] = dbPassword($arr['mb_pass']);		

		// point
		if(!$arr['mb_point']) {
			$arr['mb_point'] = $this->get('default_point');
		}

		return $arr;
	}

	protected function postInsert($arr)	{
		$arr = parent::postInsert($arr);
		
		// 첨부파일
		$pk = $this->get('pk');		
		$this->uploadFiles($arr[$pk]);
				
		return $arr;
	}

	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',mb_name,mb_hp,mb_level,flag_no_login');
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

	protected function postUpdate($arr) {
		$arr = parent::postUpdate($arr);

		// 기존파일 삭제
		$del_file = $_POST['del_file'];
		for($i = 0 ; $i < sizeof($del_file); $i++) {
			$this->deleteFile($del_file[$i]);
		}

		// 첨부파일
		$pk = $this->get('pk');		
		$this->uploadFiles($arr[$pk]);

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
		//$db_where.= " and mb_level >= '3' ";

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

		// 지역
		global $area_arr;
		$data['txt_mb_area'] = $area_arr[$data['mb_area']];

		// 생일
		$arr = explode('-', $data['mb_birth']);
		$data['txt_mb_birth'] = $arr[0].'년 '.$arr[1].'월 '.$arr[2].'일';

		global $birth_type_arr;
		$data['txt_mb_birth_type'] = $birth_type_arr[$data['mb_birth_type']];
		$data['txt_mb_birth_type2'] = cutString($data['txt_mb_birth_type'], 1, '');

		// 성별
		global $gender_arr;
		$data['txt_mb_gender'] = $gender_arr[$data['mb_gender']];
		$data['txt_mb_gender2'] = cutString($data['txt_mb_gender'], 1, '');

		// 탈퇴
		$data['lv_date'] = str_replace('-', '.', substr($data['lv_time'], 0, 10));
		if($data['lv_date'] == '0000.00.00') { $data['lv_date'] = '-'; }

		return $data;
	}	

	/* get user photo */
	public function getUserPhoto($uid) {

		$data = $this->selectDetail($uid);
		$user_photo = $data['thumb'];

		return $user_photo;
	}
}
?>
