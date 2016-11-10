<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/reserve/reserve.class.php');

Class ReserveUser extends Reserve
{	
	/* init */
	public function init() {

		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		parent::initInsert();
		$this->set('return_url', '../reserve/result.html');
	}
	
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		// 사용자 정보
		global $member;
		$arr['us_id'] = $member['mb_id'];
		$arr['us_name'] = $member['mb_name'];
		$arr['us_hp'] = $member['mb_hp'];

		// 예약 유형
		$arr['rs_type'] = 'U';

		// 예약 상태
		$arr['rs_state'] = 'W';

		// 예약 메모
		$arr['rs_user_memo'] = $_POST['rs_user_memo'];
		

		return $arr;
	}

	protected function postInsert($arr) {

		$arr = parent::postInsert($arr);

		if(!isset($oCustomer)) {
			include_once(_MODULE_PATH_.'/customer/customer.user.class.php');
			$oCustomer = new CustomerUser();
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

		// 예약 상태
		$arr['rs_state'] = 'W';

		// 예약 메모
		$arr['rs_user_memo'] = $_POST['rs_user_memo'];

		return $arr;
	}

	/* auth */
	protected function checkReadAuth($uid) {

		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "us_id", "where $pk = '$uid'", "");		
		if($member['mb_id'] == $data['us_id']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "us_id", "where $pk = '$uid'", "");		
		if($member['mb_id'] == $data['us_id']) { return true; }

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		// 본인 예약건만
		global $member;
		$mb_id = $member['mb_id'];
		//$db_where.= " and reg_id = '$mb_id' ";
		$db_where.= " and us_id = '$mb_id' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
