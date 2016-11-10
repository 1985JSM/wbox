<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/member/member.class.php');

Class MemberAdmin extends Member
{	
	/* init */
	public function init() {

		global $oAdmin;

		if(!isset($oAdmin)) {
			include_once(_MODULE_PATH_.'/admin/admin.class.php');
			$oAdmin = new Admin();
			$oAdmin->init();
		}

		// context
		$this->set('data_table',	$oAdmin->get('data_table'));
		$this->set('pk',			$oAdmin->get('pk'));
		$this->set('mb_level_arr',	$oAdmin->get('mb_level'));

		parent::init();
	}	

	/* login */
	public function login() {

		$result = parent::login();

		if($result['code'] == 'login_ok') {
			// 접속 로그 기록
			global $oVisit;
			if(!isset($oVisit)) {
				include_once(_MODULE_PATH_.'/visit/visit.admin.class.php');
				$oVisit = new VisitAdmin();
				$oVisit->init();
			}
			$oVisit->insertData();
		}

		return $result;
	}

	/* detail */
	public function selectDetail($uid) {

		global $oAdmin;
		return $oAdmin->selectDetail($uid);
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
}
?>
