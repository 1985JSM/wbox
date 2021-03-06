<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/advance_purchase/advance_purchase.class.php');

Class AdvancePurchaseStaff extends AdvancePurchase
{	
	/* init */
	public function init() {	

		parent::init();
	}

	/* auth */
	protected function checkReadAuth($uid) {

		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");		
		if($member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");		
		if($member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		//$db_where = $this->getDefaultWhere();
		$db_where = parent::makeDbWhere();
				
		global $member;
		$sh_code = $member['sh_code'];
		$db_where.= " and sh_code = '$sh_code' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}	

	
}
?>
