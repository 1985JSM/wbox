<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/visit/visit.class.php');

Class VisitAdmin extends Visit
{	
	/* init */
	public function init() {

		// context
		$this->set('vi_type', 'admin');

		parent::init();
	}	
}
?>
