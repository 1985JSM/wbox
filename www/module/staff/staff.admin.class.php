<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/staff/staff.class.php');

Class StaffAdmin extends Staff
{	
	/* init */
	public function init() {

		// listing
		$this->set('cnt_rows', 9);

		parent::init();

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 100);
		$this->set('thumb_height', 100);
	}

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// mb_id
		$arr['mb_id'] = makeTimecode();

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		// flag_use_push
		$arr['flag_use_push'] = 'Y';

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
