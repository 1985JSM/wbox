<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/reserve/reserve.class.php');

Class ReserveStaff extends Reserve
{	
	/* init */
	public function init() {

		//$this->set('cnt_rows', 1);

		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		parent::initInsert();
		$this->set('return_url', '../reserve/result.html');
	}
	
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		// sh code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		// 담당자 정보
		$arr['st_id'] = $member['mb_id'];

		// 예약 유형
		$arr['rs_type'] = 'S';

		// 예약 상태
		$arr['rs_state'] = 'W';

		// 고객 정보
		$arr['cs_id'] = $_POST['cs_id'];
		$arr['us_id'] = $_POST['us_id'];
		$arr['us_name'] = $_POST['us_name'];
		$arr['us_hp'] = $_POST['us_hp'];
		$arr['us_hp'] = str_replace('-', '', $arr['us_hp']);
		$arr['us_hp'] = str_replace('.', '', $arr['us_hp']);
		$arr['us_hp'] = str_replace(' ', '', $arr['us_hp']);

		// 예약 메모
		$arr['rs_user_memo'] = $_POST['rs_user_memo'];

		return $arr;
	}

	protected function postInsert($arr) {

		$arr = parent::postInsert($arr);

		if(!isset($oCustomer)) {
			include_once(_MODULE_PATH_.'/customer/customer.staff.class.php');
			$oCustomer = new CustomerStaff();
			$oCustomer->init();
		}		
		$cs_id = $oCustomer->insertDataFromReserve($arr);

		if($cs_id) {
			$data_table = $this->get('data_table');
			$pk = $this->get('pk');
			$uid = $arr[$pk];

			dbUpdate($data_table, "cs_id = '$cs_id'", "where $pk = '$uid'");
		}

		return $arr;
	}

	/* update */
	protected function initUpdate()	{
		parent::initUpdate();
		$this->set('return_url', '../reserve/result.html');
	}

	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		// sh code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		// 담당자 정보
		$arr['st_id'] = $member['mb_id'];

		// 예약 유형
		$arr['rs_type'] = 'S';

		// 예약 상태
		$arr['rs_state'] = $_POST['rs_state'];

		// 고객 정보
		$arr['cs_id'] = $_POST['cs_id'];
		$arr['us_id'] = $_POST['us_id'];
		$arr['us_name'] = $_POST['us_name'];
		$arr['us_hp'] = $_POST['us_hp'];
		$arr['us_hp'] = str_replace('-', '', $arr['us_hp']);
		$arr['us_hp'] = str_replace('.', '', $arr['us_hp']);
		$arr['us_hp'] = str_replace(' ', '', $arr['us_hp']);

		// 예약 메모
		$arr['rs_user_memo'] = $_POST['rs_user_memo'];

		return $arr;
	}

	protected function postUpdate($arr) {

		$arr = parent::postUpdate($arr);

		if(!isset($oCustomer)) {
			include_once(_MODULE_PATH_.'/customer/customer.staff.class.php');
			$oCustomer = new CustomerStaff();
			$oCustomer->init();
		}		
		$cs_id = $oCustomer->insertDataFromReserve($arr);

		if($cs_id) {
			$data_table = $this->get('data_table');
			$pk = $this->get('pk');
			$uid = $arr[$pk];

			dbUpdate($data_table, "cs_id = '$cs_id'", "where $pk = '$uid'");
		}

		return $arr;
	}

	/* auth */
	protected function checkReadAuth($uid) {

		// 본인이 담당하는 예약건인지	
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "st_id", "where $pk = '$uid'", "");		
		if($member['mb_id'] == $data['st_id']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		// 본인이 담당하는 예약건인지	
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "st_id", "where $pk = '$uid'", "");		
		if($member['mb_id'] == $data['st_id']) { return true; }

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		// 본인 예약건만
		global $member;
		$mb_id = $member['mb_id'];
		$db_where.= " and st_id = '$mb_id' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
