<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/member/member.class.php');

Class MemberUser extends Member
{		
	/* init */
	public function init() {

		global $oUser;

		if(!isset($oUser)) {
			include_once(_MODULE_PATH_.'/user/user.class.php');
			$oUser = new User();
			$oUser->init();
		}
		$this->set('data_table',	$oUser->get('data_table'));
		$this->set('pk',			$oUser->get('pk'));
		$this->set('mb_level_arr',	$oUser->get('mb_level'));		

		// thumbnail
		$this->set('flag_use_thumb', $oUser->get('flag_use_thumb'));
		$this->set('thumb_width', $oUser->get('thumb_width'));
		$this->set('thumb_height', $oUser->get('thumb_height'));
		$this->set('no_image', $oUser->get('no_image'));

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

		global $layout, $is_user;

		$login_id = $_GET['login_id'];
		$login_hp = $_GET['login_hp'];

		$login_hp = str_replace('+', '', $login_hp);
		$login_hp = trim($login_hp);
		if(substr($login_hp, 0, 3) == '821') {
			$login_hp = '01'.substr($login_hp, 3, strlen($login_hp) - 3);
		}

		/*
		setSessionValue('ss_user_mb_id', '');	
		$is_user = false;
		$log_file = _LOG_PATH_.'/test.txt';
		$content = '';
		if(file_exists($log_file)) {
			$content .= file_get_contents($log_file);
		}
		$content.= '['.$time.']['.$ip.']['.$mb_id.']'."	is_user : $is_user	/	login_id : $login_id	/	login_hp : $login_hp	\n";
		file_put_contents($log_file, $content);
		*/

		$mb_push_id = $_GET['mb_push_id'];

		if(!$is_staff && $login_id) {
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
		else { 
			$result['url'] = '/web'.$layout.'/page/main.html?flag_first=1'; 
			$cnt_run = $_GET['cnt_run'];
			$result['url'] .= '&cnt_run='.$cnt_run;			
		}	

		return $result;
	}

	/* check member email */
	public function checkMemberEmail($mb_email) {	

		$result = array(
			'code'	=> 'ok',
			'msg'	=> '사용할 수 있는 이메일입니다.'
		);

		// 이미 사용중인지 검사
		global $member;
		if($member['mb_email'] && $member['mb_email'] == $mb_email) {
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
	public function checkMemberNick($mb_nick) {	

		$result = array(
			'code'	=> 'ok',
			'msg'	=> '사용할 수 있는 닉네임입니다.'
		);

		// 이미 사용중인지 검사
		global $member;
		if($member['mb_nick'] && $member['mb_nick'] == $mb_nick) {
			return $result;
		}

		$arr_str = preg_split("//u", $mb_nick, -1, PREG_SPLIT_NO_EMPTY);
	    $str_len = count($arr_str);

		if(!$mb_nick) {
			$result['code'] = 'error1';
			$result['msg'] = '닉네임을 입력하세요.'; 
		}
		else if(preg_match("/[^0-9a-zA-Z가-힝]+/i", $mb_nick)) {
			$result['code'] = 'error2';
			$result['msg'] = '닉네임은 한글, 영문자, 숫자만 입력하세요.'; 
		}
		else if($str_len > 10) {
			$result['code'] = 'error3';
			$result['msg'] = '닉네임은 10자 이내로 입력하세요.'; 
		}
		else {
			$id_chk = dbCount($this->get('data_table'), "where mb_nick = '$mb_nick'");
			if($id_chk > 0) {
				$result['code'] = 'error4';
				$result['msg'] = '이미 사용중인 닉네임입니다.'; 
			}
			else {				
				// 금지 닉네임인지 검사
				include_once(_MODULE_PATH_.'/ban_id/ban_id.class.php');
				$oBanId = new BanId();
				$oBanId->init();
				$ban_data = $oBanId->selectDetail('user_nick');
				$ban_ids_arr = explode(',', $ban_data['ban_ids']);
				for($i = 0 ; $i < sizeof($ban_ids_arr) ; $i++) {
					if(!$ban_ids_arr[$i]) { continue; }
					if(strpos(strtolower($mb_nick), $ban_ids_arr[$i]) > -1) {
						$result['code'] = 'error5';
						$result['msg'] = '사용 금지된 단어가 포함되어 있습니다.';
						break;
					}
				}
			}
		}

		return $result;
	}

	/* detail */
	public function selectDetail($uid) {

		global $oUser;
		return $oUser->selectDetail($uid);
	}

	/* insert */
	public function insertData() {
		global $oUser, $layout;

		// 회원가입
		$mb_id = $_POST['mb_id'] = makeTimecode();
		$mb_level = $_POST['mb_level'] = 3;
		$flag_use_push = $_POST['flag_use_push'] = 'Y';
		$result = $oUser->insertData();

		// 로그인
		$reg_time = date("Y-m-d H:i:s");
		$login_ip = $_SERVER['REMOTE_ADDR'];
		dbUpdate($this->get('data_table'), "login_time = '$reg_time', login_ip = '$login_ip'", "where mb_id = '$mb_id'");
				
		setSessionValue('ss_'.$layout.'_mb_id', $mb_id);	
		$result['url'] = '/web'.$layout.'/page/main.html';

		return $result;
	}

	/* update email */
	public function updateEmail() {

		global $oUser, $member;

		$mb_id = $member['mb_id'];
		$mb_email = $_POST['mb_email'];
		$arr = array(
			'mb_email'	=> $mb_email
		);

		$result = $oUser->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update password */
	public function updatePassword() {

		global $oUser, $member;

		$mb_id = $member['mb_id'];
		$mb_pass = $_POST['mb_pass'];
		$arr = array(
			'mb_pass'	=> dbPassword($mb_pass)
		);

		$result = $oUser->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update default */
	public function updateDefault() {

		global $oUser, $member;

		$mb_id = $member['mb_id'];
		$mb_name = $_POST['mb_name'];
		$mb_area = $_POST['mb_area'];
		$mb_birth = $_POST['mb_birth'];
		$mb_birth_type = $_POST['mb_birth_type'];
		$mb_gender = $_POST['mb_gender'];

		$arr = array(
			'mb_name'	=> $mb_name,
			'mb_area'	=> $mb_area,
			'mb_birth'	=> $mb_birth,
			'mb_birth_type'	=> $mb_birth_type,
			'mb_gender'	=> $mb_gender
		);

		$result = $oUser->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update email */
	public function updateHp() {

		global $oUser, $member;

		$mb_id = $member['mb_id'];
		$mb_hp = $_POST['mb_hp'];
		$arr = array(
			'mb_hp'	=> $mb_hp
		);

		$result = $oUser->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update nick */
	public function updateNick() {

		global $oUser, $member;

		$mb_id = $member['mb_id'];
		$mb_nick = $_POST['mb_nick'];
		$arr = array(
			'mb_nick'	=> $mb_nick
		);

		$result = $oUser->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update pr */
	public function updatePr() {

		global $oUser, $member;

		$mb_id = $member['mb_id'];
		$mb_pr = $_POST['mb_pr'];
		$arr = array(
			'mb_pr'	=> $mb_pr
		);

		$result = $oUser->updateProfile($mb_id, $arr);
		$result['url'] = './profile.html';

		return $result;
	}

	/* update pr */
	public function updateFlagUsePush() {

		global $oUser, $member;

		$mb_id = $member['mb_id'];
		$flag_use_push = $_POST['flag_use_push'];
		$arr = array(
			'flag_use_push'	=> $flag_use_push
		);

		$result = $oUser->updateProfile($mb_id, $arr);
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
		global $oUser;
		$result = $oUser->updateProfile($mb_id, $arr);

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

	/* upload file from app 
	public function uploadFileFromApp($uid) {
		global $oUser;

		// 디렉토리
		setCookieValue('ck_mb_id', $uid);
		$dir_path = $this->getUploadDirectory('user', $uid);
		deleteAll($dir_path);

		$oUser->uploadFiles($uid);
	}
	*/

	/* upload file from app */
	public function uploadFileFromApp() {
		global $oUser;

		if(!isset($oUser)) {
			include_once(_MODULE_PATH_.'/user/user.class.php');
			$oUser = new User();
			$oUser->init();
		}
		
		$uid = $_POST['uid'];
		$this->set('module','user');
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
		$module = 'user';

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
		$this->set('module','user');
		parent::uploadFiles($pr_uid);
		$file_pk = 'file_id';
		$module = $this->get('module');
		$ord_field = 'reg_time';
		if($module){
			$db_where = " where pr_uid = '$pr_uid' and pr_module = '$module' ";
		}
		$data = dbOnce("tbl_file", "file_id", $db_where, "order by $ord_field desc");		

		if($data){
			$result['code'] = 'success';
			$result['uid'] = $data[$file_pk];	
		}
		
		return $result;	
	}

	/* leave member */
	public function leaveMember() {

		global $member;
		$mb_id = $member['mb_id'];
		$mb_pass = $_POST['mb_pass'];
		$mb_pass = dbPassword($mb_pass);

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$cnt = dbCount($data_table, "where mb_id = '$mb_id' and mb_pass = '$mb_pass'");

		if(!$cnt) {
			$this->result['url'] = './leave.html';
			$this->result['msg'] = '비밀번호가 정확하지 않습니다.';

			return $this->result;
		}

		$arr = array(
			'mb_level'	=> '1',
			'lv_time'	=> date('Y-m-d H:i:s'),
			'lv_memo'	=> $_POST['lv_memo']
		);

		dbUpdateByArray($data_table, $arr, "where $pk = '$mb_id'");

		session_unset();
		session_destroy();

		deleteCookieValue('ck_stay_id');

		

		$this->result['msg'] = '';
		$this->result['code'] = '';
		$this->result['url'] = './leave_result.html';

		return $this->result;


	}
}
?>
