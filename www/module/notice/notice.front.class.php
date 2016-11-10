<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/notice/notice.class.php');

Class NoticeFront extends Notice
{	
	/* init */
	public function init() {

		parent::init();

		$this->set('cnt_rows', 5);
	}

	/* auth */
	protected function checkReadAuth($uid) {

		return true;
	}

	protected function checkDeleteAuth($uid) {
		
		return false;		
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$db_where .= " and bo_publish = 'A' and bo_display = 'B' ";
		
		$this->set('db_where', $db_where);

		return $db_where;		
	}

	
	
	
}
?>
