<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/portfolio/portfolio.class.php');

Class PortfolioAdmin extends Portfolio
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

		// staff
		global $oStaff;
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$st_data = $oStaff->selectDetail($arr['st_id']);
		$arr['pf_name'] = $st_data['txt_staff'];

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

	/* detail */
	protected function convertDetail($data)	{		

		$data = parent::convertDetail($data);

		// shop
		$sh_code = $data['sh_code'];
		$sh_data = dbOnce($this->get('shop_table'), "sh_name", "where sh_code = '$sh_code'", "");
		$data['sh_name'] = $sh_data['sh_name'];
		
		return $data;
	}	
}
?>
