<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/shop/shop.class.php');

Class ShopManager extends Shop
{	
	/* init */
	public function init() {		

		parent::init();
	}

	/* update */
	protected function initUpdate()	{
		parent::initUpdate();
		$update_field = $this->get('update_field');
		$update_field = str_replace(',sh_state', '', $update_field);
		$this->set('update_field', $update_field);

		$required_field = $this->get('required_field');
		$required_field = str_replace(',sh_state', ',open_time,close_time,sh_holiday', $required_field);
		$this->set('required_field', $required_field);
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
}
?>
