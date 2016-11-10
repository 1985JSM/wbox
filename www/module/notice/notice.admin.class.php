<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/notice/notice.class.php');

Class NoticeAdmin extends Notice
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

		$db_where .= " and bo_publish = 'A' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	
	
	
}
?>
