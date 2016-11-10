<?
if(!defined('_INPLUS_')) { exit; } 

Class AdvancePurchase extends StdController
{	
	/* init */
	public function init() {

		// module info
		$this->set('module',		'advance_purchase');
		$this->set('module_name',	'선불제구매');		

		// context
		$this->set('data_table',	'tbl_advance_purchase');
		$this->set('pk', 'ad_pc_id');

		// reserve
		$this->set('reserve_table', 'tbl_reserve');
		$this->set('rs_pk', 'rs_id');

		// search
		$this->set('search_field', 'cs_id');
		$this->set('sch_type_arr', array(
			'ad_name'	=> '선불제명'
		));
	
		/**
		* code array
		*/
		$this->set('ad_pc_method_arr', array(
			'C'	=> '카드',
			'S'	=> '현금'
		));

		parent::init();
	}
	
	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'sh_code,ad_id,cs_id,ad_pc_type,ad_pc_name,ad_pc_method,ad_pc_price,ad_pc_money,ad_pc_quantity,ad_pc_start,ad_pc_expire');
		$this->set('required_field', 'sh_code,ad_id,cs_id');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// 유형
		if($arr['ad_pc_type'] == 'M') {
			$arr['ad_pc_quantity'] = '';
		}
		else if($arr['ad_pc_type'] == 'Q') {
			$arr['ad_pc_money'] = '';
		}
		else if($arr['ad_pc_type'] == 'P') {
			$arr['ad_pc_money'] = '';
			$arr['ad_pc_quantity'] = '';			
		}

		// 가격 (del comma)
		$arr['ad_pc_price'] = str_replace(',', '', $arr['ad_pc_price']);
		$arr['ad_pc_money'] = str_replace(',', '', $arr['ad_pc_money']);
		$arr['ad_pc_quantity'] = str_replace(',', '', $arr['ad_pc_quantity']);

		return $arr;
	}

	public function postInsert($arr) {
		$result = parent::postInsert($arr);

		include_once(_MODULE_PATH_.'/sms/sms.class.php');
		$oSms = new Sms(2);
		$oSms->enrollSms('purchaseAdvanceDefault', $result);

		return $result;
	}

	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		//$this->set('update_field', $pk.',sh_code,ad_id,cs_id,ad_pc_type,ad_pc_name,ad_pc_method,ad_pc_price,ad_pc_money,ad_pc_quantity,ad_pc_start,ad_pc_expire');
		$this->set('update_field', $pk.',ad_pc_type,ad_pc_method,ad_pc_money,ad_pc_quantity,ad_pc_start,ad_pc_expire');
		$this->set('required_field', $pk.',ad_pc_type,ad_pc_method');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// 유형
		if($arr['ad_pc_type'] == 'M') {
			$arr['ad_pc_quantity'] = '';
		}
		else if($arr['ad_pc_type'] == 'Q') {
			$arr['ad_pc_money'] = '';
		}
		else if($arr['ad_pc_type'] == 'P') {
			$arr['ad_pc_money'] = '';
			$arr['ad_pc_quantity'] = '';			
		}

		// 가격 (del comma)
		$arr['ad_pc_money'] = str_replace(',', '', $arr['ad_pc_money']);
		$arr['ad_pc_quantity'] = str_replace(',', '', $arr['ad_pc_quantity']);

		return $arr;
	}


	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();
/*
		$list_mode = $this->get('list_mode');
		if($list_mode == 'customer') {
			global $cs_id;
			$db_where = "WHERE cs_id = '$cs_id'";
		}
*/
		$db_where.= " and pr_id = '0' ";
		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$reserve_table = $this->get('reserve_table');
		$rs_pk = $this->get('rs_pk');

		$select_table = "$data_table a";
		$select_field = "*";
		$select_field.= ", (select count($rs_pk) from $reserve_table where $pk = a.$pk and rs_state = 'E') as cnt_reserve ";
		$select_field.= ", (select sum(pm_advance_price) from $reserve_table where $pk = a.$pk and rs_state = 'E') as sum_reserve ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// txt_ad_pc_name
		$data['txt_ad_pc_name'] = $data['ad_pc_name'];
		if($data['cnt_charge'] > 0) {
			$data['txt_ad_pc_name'] .= ' (충전 '.number_format($data['cnt_charge']).'회)'; 
		}

		// ad_pc_method
		$ad_pc_method_arr = $this->get('ad_pc_method_arr');
		$data['txt_ad_pc_method'] = $ad_pc_method_arr[$data['ad_pc_method']];

		// ad_type : M
		if($data['ad_pc_type'] == 'M') {
			$data['remain_money'] = $data['ad_pc_money'] - $data['sum_reserve'];
		}
		else if($data['ad_pc_type'] == 'Q') {
			$data['remain_quantity'] = $data['ad_pc_quantity'] - $data['cnt_reserve'];
		}

		// txt_ad_pc_period
		$data['txt_ad_pc_period'] = str_replace('-', '.', $data['ad_pc_start']).' ~ '.str_replace('-', '.', $data['ad_pc_expire']);		

		
		return $data;
	}		

	/* select advance purchase code array */
	public function selectAdvancePurchaseCodeArray($cs_id) {

		$list = dbSelect($this->get('data_table'), "ad_pc_id, ad_pc_name", "where cs_id = '$cs_id' and pr_id = '0'", "order by ad_pc_name asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['ad_pc_id'];
			$val = $list[$i]['ad_pc_name'];
			$arr[$key] = $val;
		}

		return $arr;
	}

	/* select advance purchase By customer id */
	public function selectAdvancePurchaseByCustomerId($cs_id) {

		$list = dbSelect($this->get('data_table'), "ad_pc_id, ad_pc_name, ad_id", "where cs_id = '$cs_id' and pr_id = '0'", "order by cp_name asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['sv_id'];
			$val = array(
				'ad_pc_id'	=> $list[$i]['ad_pc_id'],
				'ad_pc_name'	=> $list[$i]['ad_pc_name'],
				'ad_id'	=> $list[$i]['ad_id']
			);
			$arr[$key] = $val;
		}

		return $arr;
	}

	/* 선불제 구매 사용 집계 */
	public function selectSalesAdvance($sh_code, $s_date, $e_date) {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$db_where = "where sh_code = '$sh_code' ";
		if($s_date) {
			$db_where .= " and reg_time >= '$s_date 00:00:00' ";
		}

		if($e_date) {
			$db_where .= " and reg_time <= '$e_date 23:59:59' ";
		}

		// cnt_total
		$cnt_total = dbCount($data_table, $db_where);

		// price
		$data = dbOnce($data_table, "sum(ad_pc_price) as total_price", $db_where." and ad_pc_method = 'C'", "");
		$card_price = $data['total_price'];

		$data = dbOnce($data_table, "sum(ad_pc_price) as total_price", $db_where." and ad_pc_method = 'S'", "");
		$cash_price = $data['total_price'];

		$data = dbOnce($data_table, "sum(ad_pc_price) as total_price", $db_where, "");
		$total_price = $data['total_price'];

		$sales = array(
			'cnt_total'		=> $cnt_total,			
			'card_price'	=> $card_price,
			'cash_price'	=> $cash_price,
			'total_price'	=> $total_price
		);

		return $sales;
	}

	/* charge data */
	public function chargeData() {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$uid = $this->get('uid');

		// 충전금액 입력
		$ad_pc_method	= $_POST['ad_pc_method'];
		$ad_pc_price	= str_replace(',', '', $_POST['ad_pc_price']);
		$ad_pc_money	= str_replace(',', '', $_POST['ad_pc_money']);
		$ad_pc_quantity	= str_replace(',', '', $_POST['ad_pc_quantity']);
		$ad_pc_expire	= $_POST['ad_pc_expire'];

		$data = dbOnce($this->get('data_table'), "*", "where $pk = '$uid'", "");
		$arr = array(
			'sh_code'		=> $data['sh_code'],
			'ad_id'			=> $data['ad_id'],
			'cs_id'			=> $data['cs_id'],
			'ad_pc_type'	=> $data['ad_pc_type'],
			'ad_pc_name'	=> $data['ad_pc_name'].' 충전 ('.number_format($ad_pc_price).'원)',
			'ad_pc_method'	=> $ad_pc_method,
			'ad_pc_price'	=> $ad_pc_price,
			'ad_pc_money'	=> $ad_pc_money,
			'ad_pc_quantity'	=> $ad_pc_quantity,
			'ad_pc_start'	=> $data['ad_pc_start'],
			'ad_pc_expire'	=> $ad_pc_expire,
			'pr_id'			=> $uid
		);
		$arr = parent::convertInsert($arr);
		dbInsertByArray($data_table, $arr);

		// 충전금액 반영
		$cnt_charge = dbCount($data_table, "where pr_id = '$uid'");

		$arr = array(
			'ad_pc_expire'	=> $ad_pc_expire,
			'cnt_charge'	=> $cnt_charge
		);

		if($data['ad_pc_type'] == 'M') {
			$arr['ad_pc_money'] = $data['ad_pc_money'] + $ad_pc_money;
		}
		else if($data['ad_pc_type'] == 'Q') {
			$arr['ad_pc_quantity'] = $data['ad_pc_quantity'] + $ad_pc_quantity;
		}

		$arr = parent::convertUpdate($arr);

		dbUpdateByArray($data_table, $arr, "where $pk = '$uid'");


		include_once(_MODULE_PATH_.'/sms/sms.class.php');
		$oSms = new Sms(2);

		// 더 상세한 정보를 가져옵니다
		$get_some_data = dbOnce($data_table, 'cs_id, sh_code', "WHERE {$pk}='{$uid}'", '');
		$arr['cs_id'] = $get_some_data['cs_id'];
		$arr['sh_code'] = $get_some_data['sh_code'];
		$arr['ad_pc_id'] = $uid;
		$oSms->enrollSms('purchaseAdvanceDefault', $arr);

	}

	protected function dbDelete($uid) {

		$data_table = $this->get('data_table');
		dbDelete($data_table, "where pr_id = '$uid'");

		parent::dbDelete($uid);
	}
}
?>
