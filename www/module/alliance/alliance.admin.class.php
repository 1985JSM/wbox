<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/alliance/alliance.class.php');

Class AllianceAdmin extends Alliance
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

		$arr['bo_name'] = _HOMEPAGE_TITLE_;
		$arr['bo_publish'] = 'A';
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

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

	
	
	
}
?>
