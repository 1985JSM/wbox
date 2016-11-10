<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/customer/customer.class.php');

Class CustomerUser extends Customer
{	
	/* init */
	public function init() {	

		parent::init();
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();
		
		$this->set('db_where', $db_where);

		return $db_where;		
	}	

	/* insert */
	public function insertDataFromReserve($data) {

		global $member;

		$data_table = $this->get('data_table');
		$sh_code = $data['sh_code'];
		$mb_id = $member['mb_id'];
		$us_name = $data['us_name'];
		$us_hp = $data['us_hp'];

		if(!$us_name || !$us_hp) {
			return null;
		}

		//$db_where = "where sh_code = '$sh_code' and mb_id = '$mb_id'";
		$db_where = "where sh_code = '$sh_code' and cs_name = '$us_name' and cs_hp = '$us_hp'";

		// insert or update array
		$arr = array(
			'sh_code'	=> $data['sh_code'],
			'mb_id'		=> $mb_id
		);

		// 회원정보
		$key_arr = explode(',', 'mb_name,mb_nick,mb_email,mb_hp,mb_area,mb_birth,mb_birth_type,mb_gender');
		for($i = 0 ; $i < sizeof($key_arr) ; $i++) {
			$key = $key_arr[$i];
			$key2 = str_replace('mb_', 'cs_', $key);
			$arr[$key2] = $member[$key];
		}

		// 존재하는지 확인
		$cnt = dbCount($data_table, $db_where);
		if($cnt == 0) {		

			$arr['cs_level'] = '3';
			$arr['st_id'] = $data['st_id'];

			$arr = parent::convertInsert($arr);

			dbInsertByArray($this->get('data_table'), $arr);
		}
		else {
			// 존재한다면 mb_id 업데이트
			$arr = parent::convertUpdate($arr);

			dbUpdateByArray($data_table, $arr, $db_where);
		}

		$data = dbOnce($data_table, "cs_id", $db_where, "");
		$cs_id = $data['cs_id'];

		return $cs_id;
	}
}
?>
