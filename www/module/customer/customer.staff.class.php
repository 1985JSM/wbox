<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/customer/customer.class.php');

Class CustomerStaff extends Customer
{	
	/* init */
	public function init() {	

		//$this->set('cnt_rows', 5);

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

	/* insert */
	public function insertDataFromReserve($data) {

		global $member;
		
		$sh_code = $member['sh_code'];
		$us_name = $data['us_name'];
		$us_hp = $data['us_hp'];	
		$us_hp = str_replace('-', '', $us_hp);
		$us_hp = str_replace('.', '', $us_hp);
		$us_hp = str_replace(' ', '', $us_hp);

		if(!$us_name || !$us_hp) {
			return null;
		}
		
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$cs_id = $data['cs_id'];
		if($cs_id) {
			$cs_data = dbOnce($data_table, "*", "where $pk = '$cs_id'", "");
			if(!$cs_data['mb_id']) {
				$arr = array(
					'cs_name'	=> $us_name,
					'cs_hp'		=> $us_hp
				);
				dbUpdateByArray($data_table, $arr, "where $pk = '$cs_id'");
			}
		}
		else {
			$data = dbOnce($data_table, "cs_id", "where sh_code = '$sh_code' and cs_name = '$us_name' and cs_hp = '$us_hp'", "order by cs_id desc");
			$cs_id = $data['cs_id'];
			
			if(!$cs_id) {
				// 회원정보
				$arr = array(
					'sh_code'	=> $sh_code,
					'st_id'		=> $data['st_id'],
					'cs_level'	=> '3',
					'cs_name'	=> $us_name,
					'cs_hp'		=> $us_hp
				);

				$arr = parent::convertInsert($arr);
				
				dbInsertByArray($this->get('data_table'), $arr);

				$data = dbOnce($data_table, "cs_id", "where sh_code = '$sh_code' and cs_name = '$us_name' and cs_hp = '$us_hp'", "order by cs_id desc");
				$cs_id = $data['cs_id'];
			}		
		}

		return $cs_id;
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
		if(!$data['sh_code'] || $member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");		
		if(!$data['sh_code'] || $member['sh_code'] == $data['sh_code']) { return true; }

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
