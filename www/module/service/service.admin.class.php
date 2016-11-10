<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/service/service.class.php');

Class ServiceAdmin extends Service
{	
	/* init */
	public function init() {

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 100);
		$this->set('thumb_height', 100);

		parent::init();
	}

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		return $arr;
	}	
}
?>
