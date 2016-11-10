<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/staff/staff.class.php');

Class StaffManager extends Staff
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
		$sh_code = $member['sh_code'];
		$arr['sh_code'] = $sh_code;

		// flag_use_push
		$arr['flag_use_push'] = 'Y';

		// st_order
		$max_order = dbOnce($this->get('data_table'), "max(st_order) as st_order", "where sh_code = '$sh_code'", "");
		$arr['st_order'] = $max_order['st_order'] + 1;

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
		$db_where = $this->getDefaultWhere();

		global $member;
		$sh_code = $member['sh_code'];
		$db_where.= " and a.sh_code = '$sh_code' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
