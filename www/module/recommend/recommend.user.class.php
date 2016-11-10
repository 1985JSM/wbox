<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/recommend/recommend.class.php');

Class RecommendUser extends Recommend
{	
	/* init */
	public function init() {

		parent::init();
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$db_where .= " and rc_display = 'Y' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
