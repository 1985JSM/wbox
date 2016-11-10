<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/notice/notice.class.php');

Class NoticeManager extends Notice
{	
	/* init */
	public function init() {

		parent::init();

		// bo_publish
		$this->set('bo_publish_arr', array(
			'A'	=> '예약박스 to 가맹점',
			'M'	=> '가맹점 to 사용자',
		));
	}

	/* insert */
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		global $member;
		$sh_code = $member['sh_code'];

		$sh_data = dbOnce("tbl_shop", "sh_name", "where sh_code = '$sh_code'", "");
		$sh_name = $sh_data['sh_name'];

		$arr['sh_code'] = $sh_code;
		$arr['bo_name'] = $sh_name;
		$arr['bo_publish'] = 'M';
		$arr['bo_display'] = 'U';
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		global $member;
		$sh_code = $member['sh_code'];

		$sh_data = dbOnce("tbl_shop", "sh_name", "where sh_code = '$sh_code'", "");
		$sh_name = $sh_data['sh_name'];

		$arr['sh_code'] = $sh_code;
		$arr['bo_name'] = $sh_name;
		$arr['bo_publish'] = 'M';
		$arr['bo_display'] = 'U';
	
		return $arr;
	}

	/* auth */
	protected function checkReadAuth($uid) {

		// 본인이 관리하는 가맹점인지		
		global $member;

		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "bo_display, sh_code", "where $pk = '$uid'", "");		
		if($data['bo_display'] == 'M' || $member['sh_code'] == $data['sh_code']) { 
			return true; 
		}

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		// 본인이 관리하는 가맹점인지		
		global $member;

		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "bo_display, sh_code", "where $pk = '$uid'", "");		
		if($data['bo_display'] == 'M' || $member['sh_code'] == $data['sh_code']) { 
			return true; 
		}

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		global $member;
		$sh_code = $member['sh_code'];
		$db_where.= " and (bo_display = 'M' || sh_code = '$sh_code') ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	
	
	
}
?>
