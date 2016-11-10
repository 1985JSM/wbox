<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/notice/notice.class.php');

Class NoticeUser extends Notice
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

		$list_mode = $this->get('list_mode');
		if($list_mode == 'admin') {
			$db_where .= " and bo_publish = 'A' and bo_display = 'U' ";
		}
		else if($list_mode == 'shop') {
			$db_where .= " and bo_publish = 'M' ";
		}

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	
	
	
}
?>
