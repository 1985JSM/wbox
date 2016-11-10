<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/blog/blog.class.php');

Class BlogFront extends Blog
{	
	/* init */
	public function init() {

		parent::init();
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$db_where .= " and bl_display = 'Y' and bl_type = 'A' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
