<?
if(!defined('_INPLUS_')) { exit; } 

Class Member extends StdController
{	
	/* init */
	public function init() {

		// module info
		$this->set('module',		'member');
		$this->set('module_name',	'멤버십');	

		// context
		$this->set('reserve_mb_id', 'root,admin,manager,sysop');
		$this->set('auth_no_table', 'tbl_auth_no');


		/*
		if(!$mb_level_arr) { $this->set('mb_level_arr', array(
				'1'		=> '비회원',
				'3'		=> '회원',			// user
				'5'		=> '가맹점담당자',	// staff
				'6'		=> '가맹점관리자'	// manager
			));
		}
		*/

		parent::init();
	}	

	/* get login member */
	public function getLoginMember() {

		global $layout;

		if(defined('_FLAG_OTHER_SESSION_') && _FLAG_OTHER_SESSION_) {				
			$mb_id = getSessionValue('ss_'.$layout.'_mb_id');
		}
		else { $mb_id = getSessionValue('ss_mb_id'); }

		unset($member);
		if($mb_id) {
			$member = $this->selectDetail($mb_id);
		}
		else { $member['mb_level'] = 1; }

		return $member;
	}

	/* login */
	protected function checkLogin($login_id, $login_pass, $data) {
		$result = array(
			'code'	=> 'error'
		);

		if(!$data['mb_id'] || $data['mb_pass'] != $login_pass) {			
			$result['url'] = './login.html?return_url='.$return_url;
			$result['msg'] = "존재하지 않는 정보입니다.\\n\\n아이디 또는 비밀번호를 확인하세요."; 
		}
		else if($data['mb_level'] == '1') {
			$result['url'] = './login.html?return_url='.$return_url;
			$result['msg'] = "탈퇴한 계정입니다.\\n\\n탈퇴일시 : ".$data['lv_time']; 
		}
		else if($data['mb_level'] == '2') {
			$result['url'] = './login.html?return_url='.$return_url;
			$result['msg'] = "승인처리가 완료되지 않은 계정입니다.\\n\\n승인처리가 늦어질 경우 관리자에게 문의하세요."; 
		}
		else if($data['flag_no_login'] == 'Y') {
			$result['url'] = './login.html?return_url='.$return_url;
			$result['msg'] = "로그인이 차단된 계정입니다.\\n\\n관리자에게 문의하세요."; 
		}
		else if($data['auth_ip'] && strlen(strpos($data['auth_ip'], $_SERVER['REMOTE_ADDR'])) == 0) {
			$result['url'] = './login.html?return_url='.$return_url;
			$result['msg'] = "로그인이 허용되지 않은 아이피입니다.\\n\\n관리자에게 문의하세요."; 
		}
		else if($data['mb_id'] && $data['mb_pass'] == $login_pass) {
			$result['code'] = 'login_ok';
			$result['url'] = _BASE_URI_;
		}

		return $result;
	}

	public function login() {

		global $layout;

		$login_id = $_POST['login_id'];
		$login_pass = dbPassword($_POST['login_pass']);
		$return_url = $_POST['return_url'];
		$login_ip = $_SERVER['REMOTE_ADDR'];

		$db_where = "where mb_id = '$login_id'";
		$data = dbOnce($this->get('data_table'), "*", $db_where, "");

		$result = $this->checkLogin($login_id, $login_pass, $data);
		if($result['code'] == 'login_ok') {

			// 로그인 처리
			$reg_time = date("Y-m-d H:i:s");
			dbUpdate($this->get('data_table'), "login_time = '$reg_time', login_ip = '$login_ip'", "where mb_id = '$login_id'");
			
			if($return_url) { $result['url'] .= $return_url; }
			else { $result['url'] .= '/web'.$layout; }

			if(defined('_FLAG_OTHER_SESSION_') && _FLAG_OTHER_SESSION_) {
				setSessionValue('ss_'.$layout.'_mb_id', $data['mb_id']);	
			} 
			else {
				setSessionValue('ss_mb_id', $data['mb_id']);	
			}

			// 로그인상태 유지
			if($_POST['flag_stay_login']) {
				setCookieValue('ck_stay_id', $login_id, 86400 * 14);
			}
		}

		return $result;
	}

	/* logout */
	public function logout() {

		session_unset();
		session_destroy();

		// 로그아웃 처리
		global $member;
		$mb_id = $member['mb_id'];
		$reg_time = date("Y-m-d H:i:s");
		dbUpdate($this->get('data_table'), "logout_time = '$reg_time'", "where mb_id = '$mb_id'");

		$return_url = $_GET['return_url'];
		if(!$return_url) { 
			global $layout;
			$return_url = '/web'.$layout.'/page/main.html'; 
		}

		$this->result = array(
			'url'	=> $return_url
		);

		// 쿠키 삭제
		deleteCookieValue('ck_stay_id');
		deleteCookieValue('ck_password_'.$mb_id);
		deleteCookieValue('ck_sales_password_'.$mb_id);

		return $this->result;
	}

	/* check member id */
	public function checkMemberId($mb_id) {	

		$result = array(
			'code'	=> 'ok',
			'msg'	=> '사용할 수 있는 아이디입니다.'
		);

		if(!$mb_id) {
			$result['code'] = 'error1';
			$result['msg'] = '아이디를 입력하세요.'; 
		}
		else if(preg_match("/[^0-9a-z_]+/i", $mb_id)) {
			$result['code'] = 'error2';
			$result['msg'] = '아이디는 영문자, 숫자, _만 입력하세요.'; 
		}
		else if(strlen($mb_id) < 4) {
			$result['code'] = 'error3';
			$result['msg'] = '아이디는 최소 4글자 이상 입력하세요.'; 
		}
		else if(strpos($this->get('reserve_mb_id'), strtolower($mb_id)) > -1) {
			$result['code'] = 'error4';
			$result['msg'] = '예약된 단어로 아이디로 사용할 수 없습니다.';
		}
		else {
			$id_chk = dbCount($this->get('data_table'), "where mb_id = '$mb_id'");
			if($id_chk > 0) {
				$result['code'] = 'error5';
				$result['msg'] = '이미 사용중인 아이디입니다.'; 
			}
		}

		return $result;
	}

	/* update reg id */
	public function updateRegId() {

		$mb_hp = $_POST['mb_hp'];
		$mb_push_os = $_POST['mb_push_os'];
		$mb_push_id = $_POST['mb_push_id'];

		$arr = array(
			'mb_push_os'	=> $mb_push_os,
			'mb_push_id'	=> $mb_push_id
		);

		if($mb_hp) {
			dbUpdateByArray($this->get('data_table'), $arr, "where replace(mb_hp, '-', '') = '$mb_hp'");
		}

		$result = array(
			'code'	=> 'OK'
		);

		return $result;
	}

	/* send auth no */
	public function sendAuthNo($auth_type, $auth_to)	{

		// 동일한 번호로 가입한적 있는지 검사
		$chk = dbCount($this->get('data_table'), "where mb_hp = '$auth_to'");
		if($chk > 0) {
			$this->result['code'] = 'duplication';
			$this->result['msg'] = '인증번호 발송에 실패하였습니다.';
			return $this->result;
		}

		$auth_no = makeRandNo(6);
		$reg_ip = $_SERVER['REMOTE_ADDR'];
		$reg_time = date('Y-m-d H:i:s');

		// 1시간 이전 인증번호 삭제
		$pre_time = date('Y-m-d H:i:s', time() - 3600);
		dbDelete($this->get('auth_no_table'), "where reg_time < '$pre_time'");

		// 동일한 아이피로 최근 5분 이내에 10건 이상 발송했다면 취소시키기
		$pre_time = date('Y-m-d H:i:s', time() - 5 * 60);
		$chk = dbCount($this->get('auth_no_table'), "where (reg_ip = '$reg_ip' or auth_to = '$auth_to') and reg_time > '$pre_time'");
		if($chk > 10) {
			$this->result['msg'] = '인증번호 발송에 실패하였습니다.';
			return $this->result;
		}

		$arr = array(
			'auth_type'		=> $auth_type,
			'auth_no'		=> $auth_no,
			'auth_to'		=> $auth_to,
			'auth_state'	=> 'N',
			'reg_ip'		=> $reg_ip,
			'reg_time'		=> $reg_time
		);

		dbInsertByArray($this->get('auth_no_table'), $arr);
		$this->result['code'] = 'ok';
		$this->result['msg'] = '인증번호가 발송되었습니다.';

		if($auth_type == 'H') {
			global $oSmsLegacy;
			if(!isset($oSmsLegacy)) {
				include_once(_MODULE_PATH_.'/sms/sms.legacy.class.php');
				$oSmsLegacy = new SmsLegacy();
			}
			
			$oSmsLegacy->sendSms('auth_no', array('mb_hp' => $auth_to, 'auth_no' => $auth_no));
		}
		else if($auth_type == 'E') {
			global $oMailing;
			if(!isset($oMailing)) {
				include_once(_MODULE_PATH_.'/mailing/mailing.class.php');
				$oMailing = new Mailing();
			}
			$oMailing->sendMail('auth_no', array('mb_email' => $auth_to, 'auth_no' => $auth_no));
		}

		return $this->result;
	}

	/* validate auth no */
	public function validateAuthNo($auth_type, $auth_to, $auth_no) {
		// 5분 이내에 생성된 인증번호에 대해서만 검사
		$pre_time = date("Y-m-d H:i:s", time() - 5 * 60);
		$db_where = "where auth_type = '$auth_type' and auth_to = '$auth_to' and auth_no = '$auth_no' and auth_state = 'N' and reg_time > '$pre_time'";

		$chk = dbCount($this->get('auth_no_table'), $db_where);
		if($chk > 0) {
			dbUpdate($this->get('auth_no_table'), "auth_state = 'Y'", $db_where);
			$this->result['code'] = 'ok';
			$this->result['msg'] = '인증이 완료되었습니다.';	
		}
		else {
			$this->result['msg'] = '인증에 실패하였습니다.';
		}		
		
		return $this->result;
	}

	/* check password */
	public function checkPassword() {
		global $member;

		$login_id = $member['mb_id'];
		$login_pass = dbPassword($_POST['login_pass']);

		$chk = dbCount($this->get('data_table'), "where mb_id = '$login_id' and mb_pass = '$login_pass'");
		if($chk > 0) {
			$this->result['code'] = 'ok';
			$this->result['url'] = urldecode($_POST['return_url']);

			setCookieValue('ck_password_'.$login_id, 1, 10 * 60);
		}
		else {
			$this->result['msg'] = '비밀번호가 정확하지 않습니다.';
		}

		return $this->result;
	}

	/* check password cookie */
	public function checkPasswordCookie($return_url) {

		// 비밀번호 검사
		global $member;
		$chk_pass_cookie = getCookieValue('ck_password_'.$member['mb_id']);
		if(!$chk_pass_cookie) {
			movePage('./password.html?return_url='.urlencode($return_url));
		}
	}
}
?>
