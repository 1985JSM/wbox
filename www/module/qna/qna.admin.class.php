<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/qna/qna.class.php');

Class QnaAdmin extends Qna
{	
	/* init */
	public function init() {

		// 권한검사
		if(!checkAdminAuth('boards')) {
			alert('권한이 없습니다.', '/webadmin');
			exit;
		}

		parent::init();
	}

	/* insert */
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		//global $member;
		//$arr['bo_name'] = $member['mb_name'];
		$arr['bo_name'] = _HOMEPAGE_TITLE_;
		$arr['bo_publish'] = 'A';
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		//global $member;
		//$arr['bo_name'] = $member['mb_name'];
		$arr['bo_name'] = _HOMEPAGE_TITLE_;
		$arr['bo_publish'] = 'A';
	
		return $arr;
	}

	/* auth */
	protected function checkReadAuth($uid) {

		return true;
	}

	protected function checkDeleteAuth($uid) {
		
		return true;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$db_where .= " and bo_display = 'A' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* answer */
	protected function convertAnswer($arr) {

		$arr = parent::convertAnswer($arr);

		$arr['ans_name'] = _HOMEPAGE_TITLE_;

		return $arr;
	}

	public function updateAnswer() {

		$this->result = parent::updateAnswer();

		// push 전송
		include_once(_MODULE_PATH_.'/push/push.class.php');
		$oPush = new Push();
		$oPush->init();

		$data_table = $this->get('data_table');
		$uid = $this->get('uid');
		$data = $this->selectDetail($uid);

		$oPush->sendPush('reply_to_user', $data);

		return $this->result;
	}

	
	
	
}
?>
