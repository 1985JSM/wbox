<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/blog/blog.class.php');

Class BlogManager extends Blog
{	
	/* init */
	public function init() {

		parent::init();
	}

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		$arr['bl_type'] = 'M';

		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		$arr['bl_type'] = 'M';

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
		$db_where.= " and sh_code = '$sh_code' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
