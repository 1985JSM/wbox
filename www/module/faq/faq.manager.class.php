<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/faq/faq.class.php');

Class FaqManager extends Faq
{	
	/* init */
	public function init() {

		parent::init();

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

		$db_where.= " and bo_display = 'M' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	
	
	
}
?>
