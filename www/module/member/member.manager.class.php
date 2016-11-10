<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/member/member.class.php');

Class MemberManager extends Member
{		
	/* init */
	public function init() {

		global $oManager;
		if(!isset($oManager)) {
			include_once(_MODULE_PATH_.'/manager/manager.class.php');
			$oManager = new Manager();			
			$oManager->init();
		}
		$this->set('data_table',	$oManager->get('data_table'));
		$this->set('pk',			$oManager->get('pk'));
		$this->set('mb_level_arr',	$oManager->get('mb_level'));

		parent::init();
	}	

	/* insert */
	public function insertData() {

		$sh_code = $_POST['sh_code'];

		// 가맹점 신청정보가 존재하는지 검사
		global $oApplication;
		if(!isset($oApplication)) {
			include_once(_MODULE_PATH_.'/application/application.class.php');
			$oApplication = new Application();			
			$oApplication->init();
		}
		$result = $oApplication->validateApplication($sh_code);
		if($result['code'] != 'ok') {
			$this->result['msg'] = "진행중인 신청건이 아닙니다.\\n\\n관리자에게 문의해주세요.";
			return $this->result;
		}

		// 가맹점 등록
		global $oShop;
		if(!isset($oShop)) {
			include_once(_MODULE_PATH_.'/shop/shop.class.php');
			$oShop = new Shop();			
			$oShop->init();
		}
		$result = $oShop->insertData();
	
		if(strpos($result['url'], $sh_code) > -1) {

		}
		else {
			$this->result['msg'] = "가맹점 등록에 오류가 발생하였습니다.\\n\\n잠시 후 다시 시도해주세요.";
			return $this->result;
		}

		// 관리자계정 등록
		global $oManager;
		if(!isset($oManager)) {
			include_once(_MODULE_PATH_.'/manager/manager.class.php');
			$oManager = new Manager();			
			$oManager->init();
		}
		$_POST['mb_hp'] = $_POST['sh_tel'];
		$result = $oManager->insertData();

		// 가맹점 신청정보 삭제
		unset($del_arr);		
		dbDelete($oApplication->get('data_table'), "where sh_code = '$sh_code'");

		// 로그인		
		global $layout;
		$reg_time = date("Y-m-d H:i:s");
		$login_ip = $_SERVER['REMOTE_ADDR'];
		$mb_id = $_POST['mb_id'];
		//dbUpdate($this->get('data_table'), "login_time = '$reg_time', login_ip = '$login_ip'", "where mb_id = '$mb_id'");				
		//setSessionValue('ss_'.$layout.'_mb_id', $mb_id);	

		// 가맹점 등록자 수정
		$sho_data_table = $oShop->get('data_table');
		dbUpdate($sho_data_table, "reg_id = '$mb_id'", "where sh_code = '$sh_code'");

		// 이메일 발송
		if(!isset($oMailing)) {
			include_once(_MODULE_PATH_.'/mailing/mailing.class.php');
			$oMailing = new Mailing();
			$oMailing->init();
		}
		$data = $oManager->selectDetail($mb_id);
		$oMailing->sendMail('shop_join_result', $data);


		$result['url'] = '/web'.$layout.'/member/join_result.html';

		return $result;
	}	

	/* detail */
	public function selectDetail($uid) {

		global $oManager;
		return $oManager->selectDetail($uid);
	}

	/* update password */
	public function updatePassword() {

		global $member;

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$uid = $member[$pk];

		$mb_pass = $_POST['mb_pass'];
		$new_pass = $_POST['new_pass'];
		$new_pass2 = $_POST['new_pass2'];

		if(!$mb_pass || !$new_pass || !$new_pass2 || $new_pass != $new_pass2) {
			$this->result['msg'] = '비정상적인 접근입니다.';
			return $this->result;
		}

		$mb_pass = dbPassword($mb_pass);
		$new_pass = dbPassword($new_pass);

		$chk = dbCount($data_table, "where $pk = '$uid' and mb_pass = '$mb_pass'");
		if(!$chk) {
			$this->result['msg'] = '현재 비밀번호가 정확하지 않습니다.';
			return $this->result;
		}

		if($mb_pass == $new_pass) {
			$this->result['msg'] = '신규 비밀번호는 현재 비밀번호와 다르게 입력해야 합니다.';
			return $this->result;
		}

		dbUpdate($data_table, "mb_pass = '$new_pass'", "where $pk = '$uid' and mb_pass = '$mb_pass'");

		$this->result['code'] = 'update_ok';
		$this->result['url'] = './modify_password.html';

		return $this->result;
	}

	/* check sales password */
	public function checkSalesPassword() {
		global $member;

		$login_id = $member['mb_id'];
		$sales_pw = dbPassword($_POST['sales_pw']);

		$chk = dbCount($this->get('data_table'), "where mb_id = '$login_id' and sales_pw = '$sales_pw'");
		if($chk > 0) {
			$this->result['code'] = 'ok';
			$this->result['url'] = urldecode($_POST['return_url']);

			setCookieValue('ck_sales_password_'.$login_id, 1, 1 * 60 * 60);
		}
		else {
			$this->result['msg'] = '비밀번호가 정확하지 않습니다.';
		}

		return $this->result;
	}

	/* check sales password cookie */
	public function checkSalesPasswordCookie($return_url) {

		// 매출 패스워드를 설정했는지부터 검사
		global $member;
		if(!$member['sales_pw']) {
			alert('매출확인 비밀번호를 설정해주세요.', '../member/sales_auth.html');
		}

		// 비밀번호 검사		
		$chk_pass_cookie = getCookieValue('ck_sales_password_'.$member['mb_id']);
		if(!$chk_pass_cookie) {
			movePage('../member/sales_password.html?return_url='.urlencode($return_url));
		}
	}

	/* update slaes password */
	public function updateSalesPassword() {
		$login_pw = $_POST['login_pw'];
		$sales_pw = $_POST['sales_pw'];
		$sales_pw2 = $_POST['sales_pw2'];

		if(!$login_pw || !$sales_pw || !$sales_pw2) {
			$this->result['msg'] = '비정상적인 접근입니다.';
			return $this->result;
		}

		if($sales_pw != $sales_pw2) {
			$this->result['msg'] = '매출확인 비밀번호가 정확하지 않습니다.';
			return $this->result;
		}

		global $member;

		$login_pw = dbPassword($login_pw);
		if($member['mb_pass'] != $login_pw) {
			$this->result['msg'] = '로그인 비밀번호가 정확하지 않습니다.';
			return $this->result;
		}

		$mb_id = $member['mb_id'];
		$sales_pw = dbPassword($sales_pw);
		dbUpdate($this->get('data_table'), "sales_pw = '$sales_pw'", "where mb_id = '$mb_id'");

		$this->result['code'] = 'update_ok';
		$this->result['url'] = './sales_auth.html';

		return $this->result;
	}
}
?>
