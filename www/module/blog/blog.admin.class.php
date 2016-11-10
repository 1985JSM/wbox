<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/blog/blog.class.php');

Class BlogAdmin extends Blog
{	
	/* init */
	public function init() {

		parent::init();
	}

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		$arr['bl_type'] = 'A';

		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		$arr['bl_type'] = 'A';

		return $arr;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();

		$db_where.= " and bl_type = 'A' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
