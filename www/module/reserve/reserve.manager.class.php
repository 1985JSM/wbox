<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/reserve/reserve.class.php');

Class ReserveManager extends Reserve
{	
	/* init */
	public function init() {

		parent::init();
	}	

	/* insert */
	protected function convertInsert($arr) {

		global $member;

		$arar['sh_code'] = $member['sh_code'];

		$arr = parent::convertInsert($arr);

		// 예약 유형
		$arr['rs_type'] = 'M';

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

		// 결제 정보
		$arr['rs_pay_memo'] = $_POST['rs_pay_memo'];

		$arr['pm_sale_price']= str_replace(',', '', $_POST['pm_sale_price']);

		$arr['cp_id'] = $_POST['cp_id'];
		$arr['pm_coupon_price'] = str_replace(',', '', $_POST['pm_coupon_price']);

		$arr['ad_pc_id'] = $_POST['ad_pc_id'];
		$arr['pm_advance_price'] = str_replace(',', '', $_POST['pm_advance_price']);

		$arr['pm_card_price'] = str_replace(',', '', $_POST['pm_card_price']);
		$arr['pm_cash_price'] = str_replace(',', '', $_POST['pm_cash_price']);

		return $arr;
	}

	protected function postInsert($arr) {

		$arr = parent::postInsert($arr);

		if(!isset($oCustomer)) {
			include_once(_MODULE_PATH_.'/customer/customer.manager.class.php');
			$oCustomer = new CustomerManager();
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
	protected function convertUpdate($arr) {

		global $member;

		$arar['sh_code'] = $member['sh_code'];

		$arr = parent::convertUpdate($arr);

		// 예약 유형
		$arr['rs_type'] = 'M';

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
			include_once(_MODULE_PATH_.'/customer/customer.manager.class.php');
			$oCustomer = new CustomerManager();
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

		// 본인이 관리하는 매장인지
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");		
		if($member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		// 본인이 관리하는 매장인지
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");		
		if($member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		// 본인 예약건만
		global $member;
		$sh_code = $member['sh_code'];
		$db_where.= " and sh_code = '$sh_code' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* update cash price */
	public function updateCashPrice() {

		global $member;
		
		$rs_id_arr = $_POST['rs_id'];
		$pm_cash_price_arr = $_POST['pm_cash_price'];
		$pk = $this->get('pk');
		$data_table = $this->get('data_table');
		for($i = 0 ; $i < sizeof($rs_id_arr) ; $i++) {
			$uid = $rs_id_arr[$i];
			$arr = array(
				'pm_cash_price'	=> str_replace(',', '', $pm_cash_price_arr[$i]),
				'upt_id'		=> $member['mb_id'],
				'upt_time'		=> date('Y-m-d H:i:s')
			);

			dbUpdateByArray($data_table, $arr, "where $pk = '$uid'");
		}

		$page = $this->get('page');
		$query_string = $this->get('query_string');
		if($query_string) { $query_string = '&'.$query_string; }

		$this->result['code'] = 'update_ok';		
		$this->result['url'] = './sales_list.html?page='.$page.$query_string;

		return $this->result;
	}
}
?>
