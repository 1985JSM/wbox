<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/event/event.class.php');

Class EventAdmin extends Event
{	
	/* init */
	public function init() {

		// 권한검사
		if(!checkAdminAuth('boards')) {
			alert('권한이 없습니다.', '/webadmin');
			exit;
		}

		$this->set('thumb_width', 240);
		$this->set('thumb_height', 64);

		parent::init();
	}

	/* insert */
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		//global $member;
		//$arr['bo_name'] = $member['mb_name'];
		$arr['bo_name'] = _HOMEPAGE_TITLE_;
		$arr['bo_publish'] = 'A';
		$arr['bo_display'] = 'U';
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		//global $member;
		//$arr['bo_name'] = $member['mb_name'];
		$arr['bo_name'] = _HOMEPAGE_TITLE_;
		$arr['bo_publish'] = 'A';
		$arr['bo_display'] = 'U';
	
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
