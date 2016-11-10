<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/ban_id/ban_id.class.php');

Class BanIdAdmin extends BanId
{	
	/* init */
	public function init() {

		parent::init();
	}
	
	/* update */
	protected function initUpdate()	{
		parent::initUpdate();	
		$this->set('return_url', './user_nick.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		return $arr;
	}	
}
?>
