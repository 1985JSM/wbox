<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/member/member.class.php');

Class MemberStaff extends Member
{		
	/* init */
	public function init() {

		global $oStaff;

		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$this->set('data_table',	$oStaff->get('data_table'));
		$this->set('pk',			$oStaff->get('pk'));
		$this->set('mb_level_arr',	$oStaff->get('mb_level'));		

		// thumbnail
		$this->set('flag_use_thumb', $oStaff->get('flag_use_thumb'));
		$this->set('thumb_width', $oStaff->get('thumb_width'));
		$this->set('thumb_height', $oStaff->get('thumb_height'));
		$this->set('no_image', $oStaff->get('no_image'));

		parent::init();
	}	

	/* login */
	public function login() {

		global $layout;

		$login_email = $_POST['login_email'];
		$login_pass = dbPassword($_POST['login_pass']);
		
		$db_where = "where mb_email = '$login_email'";
		$data = dbOnce($this->get('data_table'), "*", $db_where, "");

		$result = $this->checkLogin($data['mb_id'], $login_pass, $data);
		if($result['code'] == 'login_ok') {

			// 로그인 처리
			$reg_time = date("Y-m-d H:i:s");
			$login_ip = $_SERVER['REMOTE_ADDR'];
			$arr = array(
				'login_time'	=> $reg_time,
				'login_ip'		=> $login_ip
			);

			$mb_push_os = $_POST['mb_push_os'];
			if($mb_push_os) {
				$arr['mb_push_os'] = $mb_push_os;
			}

			$mb_push_id = $_POST['mb_push_id'];
			if($mb_push_id) {
				$arr['mb_push_id'] = $mb_push_id;
			}

			dbUpdateByArray($this->get('data_table'), $arr, $db_where);
		
			$result['mb_id'] = $data['mb_id'];			
			$result['url'] = '/web'.$layout.'/page/main.html';
			setSessionValue('ss_'.$layout.'_mb_id', $data['mb_id']);	
		}

		return $result;
	}

	/* login from app */
	public function loginFromApp() {

		global $layout, $is_staff;

		$login_id = $_GET['login_id'];
		$login_hp = $_GET['login_hp'];

		$login_hp = str_replace('+', '', $login_hp);
		$login_hp = trim($login_hp);
		if(substr($login_hp, 0, 3) == '821') {
			$login_hp = '01'.substr($login_hp, 3, strlen($login_hp) - 3);
		}

		$mb_push_id = $_GET['mb_push_id'];

		if(!$is_staff && $login_id) { // && $login_hp

			$db_where = "where mb_id = '$login_id'";// and mb_hp = '$login_hp'";
			$data = dbOnce($this->get('data_table'), "*", $db_where, "");

			$mb_pass = $data['mb_pass'];
			if ($data['mb_push_os'] == 'android' && $data['mb_hp'] == $login_hp) {
				$data['mb_pass'] = $mb_pass;
			} else if ($data['mb_push_os'] == 'I' && $data['mb_push_id'] == $mb_push_id) {
				$data['mb_pass'] = $mb_pass;
			}

			$result = $this->checkLogin($login_id, $data['mb_pass'], $data);
			if($result['code'] == 'login_ok') {

				// 로그인 처리
				$reg_time = date("Y-m-d H:i:s");
				$login_ip = $_SERVER['REMOTE_ADDR'];
				$arr = array(
					'login_time'	=> $reg_time,
					'login_ip'		=> $login_ip
				);

				$mb_push_os = $_GET['mb_push_os'];
				if($mb_push_os) {
					$arr['mb_push_os'] = $mb_push_os;
				}

				$mb_push_id = $_GET['mb_push_id'];
				if($mb_push_id) {
					$arr['mb_push_id'] = $mb_push_id;
				}

				dbUpdateByArray($this->get('data_table'), $arr, $db_where);

				setSessionValue('ss_'.$layout.'_mb_id', $data['mb_id']);	
			}
		}

		$return_url = urldecode($_GET['return_url']);
		if($return_url) { $result['url'] = $return_url; }
		else { $result['url'] = '/web'.$layout.'/page/main.html?flag_first=1'; }

		return $result;
	}

	/* check member email */
	public function checkMemberEmail($mb_email, $df_email = '') {	

		$result = array(
			'code'	=> 'ok',
			'msg'	=> '사용할 수 있는 이메일입니다.'
		);

		// 이미 사용중인지 검사
		if(!$df_email) {
			global $member;
			$df_email = $member['mb_email'];
		}

		if($df_email && $df_email == $mb_email) {
			return $result;
		}

		if(!$mb_email) {
			$result['code'] = 'error1';
			$result['msg'] = '이메일을 입력하세요.'; 
		}
		else if(!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $mb_email)) {
			$result['code'] = 'error2';
			$result['msg'] = '이메일 주소 형식에 맞지 않습니다.'; 
		}
		else {
			$id_chk = dbCount($this->get('data_table'), "where mb_email = '$mb_email'");
			if($id_chk > 0) {
				$result['code'] = 'error3';
				$result['msg'] = '이미 사용중인 이메일입니다.'; 
			}
		}

		return $result;
	}

	/* check member nick */
	public function checkMemberNick($mb_nick, $df_nick = '') {	

		$result = array(
			'code'	=> 'ok',
			'msg'	=> '사용할 수 있는 닉네임입니다.'
		);

		// 이미 사용중인지 검사
		if(!$df_nick) {
			global $member;
			$df_nick = $member['mb_nick'];
		}

		if($df_nick && $df_nick == $mb_nick) {
			return $result;
		}

		$arr_str = preg_split("//u", $mb_nick, -1, PREG_SPLIT_NO_EMPTY);
	    $str_len = count($arr_str);

		if(!$mb_nick) {
			$result['code'] = 'error1';
			$result['msg'] = '닉네임을 입력하세요.'; 
		}
		else if($str_len > 10) {
			$result['code'] = 'error2';
			$result['msg'] = '닉네임은 10자 이내로 입력하세요.'; 
		}
		else {
			$id_chk = dbCount($this->get('data_table'), "where mb_nick = '$mb_nick'");
			if($id_chk > 0) {
				$result['code'] = 'error3';
				$result['msg'] = '이미 사용중인 닉네임입니다.'; 
			}
		}

		return $result;
	}

	/* detail */
	public function selectDetail($uid) {

		global $oStaff;
		return $oStaff->selectDetail($uid);
	}
	
	/* update email */
	public function updateEmail() {

		global $oStaff, $member;

		$mb_id = $member['mb_id'];
		$mb_email = $_POST['mb_email'];
		$arr = array(
			'mb_email'	=> $mb_email
		);

		$result = $oStaff->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update password */
	public function updatePassword() {

		global $oStaff, $member;

		$mb_id = $member['mb_id'];
		$mb_pass = $_POST['mb_pass'];
		$arr = array(
			'mb_pass'	=> dbPassword($mb_pass)
		);

		$result = $oStaff->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update default */
	public function updateDefault() {

		global $oStaff, $member;

		$mb_id = $member['mb_id'];
		$mb_name = $_POST['mb_name'];
		$mb_position = $_POST['mb_position'];

		$arr = array(
			'mb_name'	=> $mb_name,
			'mb_position'	=> $mb_position
		);

		$result = $oStaff->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update email */
	public function updateHp() {

		global $oStaff, $member;

		$mb_id = $member['mb_id'];
		$mb_hp = $_POST['mb_hp'];
		$arr = array(
			'mb_hp'	=> $mb_hp
		);

		$result = $oStaff->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update nick */
	public function updateNick() {

		global $oStaff, $member;

		$mb_id = $member['mb_id'];
		$mb_nick = $_POST['mb_nick'];
		$arr = array(
			'mb_nick'	=> $mb_nick
		);

		$result = $oStaff->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update pr */
	public function updatePr() {

		global $oStaff, $member;

		$mb_id = $member['mb_id'];
		$mb_pr = $_POST['mb_pr'];
		$arr = array(
			'mb_pr'	=> $mb_pr
		);

		$result = $oStaff->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update setting */
	public function updateSetting() {

		global $oStaff, $member;

		$mb_id = $member['mb_id'];
		$s_work = $_POST['s_work'];
		$e_work = $_POST['e_work'];
		$s_break = $_POST['s_break'];
		$e_break = $_POST['e_break'];
		$arr = array(
			's_work'	=> $s_work,
			'e_work'	=> $e_work,
			's_break'	=> $s_break,
			'e_break'	=> $e_break
		);

		$result = $oStaff->updateProfile($mb_id, $arr);
		$result['url'] = './setting.html';

		return $result;
	}

	/* update pr */
	public function updateFlagUsePush() {

		global $oStaff, $member;

		$mb_id = $member['mb_id'];
		$flag_use_push = $_POST['flag_use_push'];
		$arr = array(
			'flag_use_push'	=> $flag_use_push
		);

		$result = $oStaff->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* find password by email */
	public function findPasswordByEmail($find_email) {

		if(!$find_email) {
			$this->result['msg'] = '이메일을 정확하게 입력하세요.';
			return $this->result;
		}

		$data = dbOnce($this->get('data_table'), "mb_id, mb_name, mb_email", "where mb_email = '$find_email'", "");
		$mb_id = $data['mb_id'];
		if(!$mb_id) {
			$this->result['msg'] = '등록되지 않은 이메일입니다.';
			return $this->result;
		}

		$new_pass = makeRandChar(8);
		$arr = array(
			'mb_pass'	=> dbPassword($new_pass)
		);
		global $oStaff;		
		$result = $oStaff->updateProfile($mb_id, $arr);

		// 발송
		global $oMailing;
		if(!isset($oMailing)) {
			include_once(_MODULE_PATH_.'/mailing/mailing.class.php');
			$oMailing = new Mailing();
			$oMailing->init();
		}
		$oMailing->sendMail('find_pass', array(
			'mb_email'	=> $data['mb_email'], 
			'mb_name'	=> $data['mb_name'],
			'mb_id'		=> $data['mb_id'],
			'new_pass' => $new_pass
			)
		);

		$result['code'] = 'ok';
		$result['msg'] = '임시 비밀번호가 발송되었습니다.';

		return $result;
	}

	/* upload photo 
	public function uploadPhoto() {

		global $member;
		/*
		$uid = $member['mb_id'];

		// 파일 정보 세팅
		$file_name = $_POST['file_name'];
		$file_content = $_POST['file_content'];
		$file_content = base64_decode($file_content);

		// DB 정보 세팅
		$file_table = $this->get('file_table');
		$module = 'staff';

		// 기존 파일 삭제
		$dir_path = $this->getUploadDirectory($module, $uid);
		deleteAll($dir_path);

		// 디렉토리까지 삭제했으므로 디렉토리 재생성
		makeDirectory($dir_path);

		// 파일 저장
		$file_path = $dir_path.'/'.$file_name;
		file_put_contents($file_path, $file_content);
		$file_size = filesize($file_path);

		// 기존 파일 정보 DB 삭제
		dbDelete($file_table, "where pr_module = '$module' and pr_uid = '$uid'");

		// 파일 정보 DB 등록
		$file_arr = array(
			'pr_module'	=> $module,
			'pr_uid'	=> $uid,
			'file_type'	=> '',
			'file_path'	=> $file_path,
			'file_name'	=> $file_name,
			'file_size'	=> $file_size,
			'file_hit'	=> 0,
			'reg_id'	=> $uid,
			'reg_time'	=> date('Y-m-d H:i:s')
		);
		dbInsertByArray($this->get('file_table'), $file_arr);
		

		$this->result['code'] = 'ok';
		//$this->result['url'] = './profile.html';

		return $this->result;
		
	}
	*/

	/* upload file from app */
	public function uploadFileFromApp() {
		global $oStaff;

		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		
		$uid = $_POST['uid'];
		$this->set('module','staff');
		$this->set('max_file','1');
		$result = $this->uploadFiles($uid);

		return $result;
	}

	/* upload from app */
	public function uploadPhoto($uid){

		global $member;

		$pk = $this->get('pk');

		// DB 정보 세팅
		$file_table = $this->get('file_table');
		$module = 'staff';

		// 저장 경로
		$dir_path = $this->getUploadDirectory($module, $uid);
		if($_POST['file_id']){
			$file_id = $_POST['file_id'];

			if($file_id){
				$file_num = $file_id;
				$del_file_list = dbSelect("tbl_file","file_id","where file_id not in ('$file_num') and pr_uid = '$uid' and pr_module = '$module' ","","");
				for($i = 0 ; $i < count($del_file_list) ; $i++) {
					$this->deleteFile($del_file_list[$i]['file_id']);
				}			
			}

		}		
	}

	protected function uploadFiles($pr_uid) {
		$this->set('module','staff');
		parent::uploadFiles($pr_uid);
		$file_pk = 'file_id';
		$module = $this->get('module');
		$ord_field = 'reg_time';
		if($module){
			$db_where = " where pr_uid = '$pr_uid' and pr_module = '$module' ";
		}
		$data = dbOnce($this->get('file_table'), "file_id", $db_where, "order by $ord_field desc");		

		if($data){
			$result['code'] = 'success';
			$result['uid'] = $data[$file_pk];	
		}
		
		return $result;	
	}
}
?>
