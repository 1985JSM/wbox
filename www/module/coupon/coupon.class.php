<?
if(!defined('_INPLUS_')) { exit; } 

Class Coupon extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'coupon');
		$this->set('module_name',	'쿠폰');		

		// context
		$this->set('data_table', 'tbl_coupon');
		$this->set('pk', 'cp_id');

		$this->set('coupon_use_table', 'tbl_coupon_use');
		$this->set('cp_us_pk', 'cp_us_id');

		$this->set('search_field', 'sh_code,cp_publish,cp_type,cp_limit,cp_display');
		$this->set('sch_type_arr', array(
			'cp_name'	=> '쿠폰명'
		));
	
		/**
		* code array
		*/
		$this->set('cp_publish_arr', array(
			'A'	=> '최고관리자',
			'M'	=> '가맹점관리자'
		));

		$this->set('cp_type_arr', array(
			'C'	=> '쿠폰',
			'E'	=> '이벤트',
			'F'	=> '무료',
			'P'	=> '1+1',
			'S'	=> '할인'
		));

		$this->set('cp_sale_type_arr', array(
			'W'	=> '원',
			'P'	=> '%'
		));

		$this->set('cp_limit_arr', array(
			'Y'	=> '1인 1회',
			'N'	=> '반복사용'
		));

		$this->set('cp_display_arr', array(
			'Y'	=> '노출',
			'N'	=> '미노출'
		));

		// level
		/*
		$this->set('cp_level_arr', array(
			'3'		=> '일반',
			'5'		=> '브론즈',
			'6'		=> '실버',
			'7'		=> '골드',
			'9'		=> 'VIP'
		));
		*/

		// user
		if(!isset($oUser)) {
			include_once(_MODULE_PATH_.'/user/user.class.php');
			$oUser = new User();
			$oUser->init();
		}
		$this->set('mb_level_arr', $oUser->get('mb_level_arr'));

		// customer
		if(!isset($oCustomer)) {
			include_once(_MODULE_PATH_.'/customer/customer.class.php');
			$oCustomer = new Customer();
			$oCustomer->init();
		}
		$this->set('cs_level_arr', $oCustomer->get('cs_level_arr'));
	
		parent::init();
	}	

	/* validate */
	protected function validateValues($arr)	{
		
		// 기본 유효성 검사
		$result = parent::validateValues($arr);
		
		return $result;
	}

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'cp_name,cp_type,cp_sale_type,cp_sale_price,cp_guide1,cp_guide2,cp_guide3,cp_quantity,cp_limit,cp_display');
		$this->set('required_field', 'cp_publish,cp_name,cp_type');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// 쿠폰유형
		if($arr['cp_type'] != 'S') {
			$arr['cp_sale_price'] = '';
			$arr['cp_sale_type'] = '';
		}

		// 가격 (del comma)
		$arr['cp_sale_price'] = str_replace(',', '', $arr['cp_sale_price']);
		$arr['cp_quantity'] = str_replace(',', '', $arr['cp_quantity']);

		// 사용등급
		$cp_level_arr = $_POST['cp_levels'];
		if(sizeof($cp_level_arr) > 0) {
			$cp_levels = implode('|', $cp_level_arr);
		}
		else {
			$cp_levels = '';
		}
		$arr['cp_levels'] = $cp_levels;

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',cp_name,cp_type,cp_sale_type,cp_sale_price,cp_guide1,cp_guide2,cp_guide3,cp_quantity,cp_limit,cp_display');
		$this->set('required_field', $pk.',cp_publish,cp_name,cp_type');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// 쿠폰유형
		if($arr['cp_type'] != 'S') {
			$arr['cp_sale_price'] = '';
			$arr['cp_sale_type'] = '';
		}

		// 가격 (del comma)
		$arr['cp_sale_price'] = str_replace(',', '', $arr['cp_sale_price']);
		$arr['cp_quantity'] = str_replace(',', '', $arr['cp_quantity']);

		// 사용등급
		$cp_level_arr = $_POST['cp_levels'];
		if(sizeof($cp_level_arr) > 0) {
			$cp_levels = implode('|', $cp_level_arr);
		}
		else {
			$cp_levels = '';
		}
		$arr['cp_levels'] = $cp_levels;

		return $arr;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$list_mode = $this->get('list_mode');
		if($list_mode == 'admin') {
			global $member;
			$db_where .= " and cp_publish = 'A' and cp_levels like '%".$member['mb_level']."%' ";
		}
		else if($list_mode == 'shop') {
			$db_where .= " and cp_publish = 'M' ";
		}

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$coupon_use_table = $this->get('coupon_use_table');
		$cp_us_pk = $this->get('cp_us_pk');

		$select_table = "$data_table a";
		$select_field = "a.*";
		$select_field.= ", (select count(".$cp_us_pk.") from $coupon_use_table where a.$pk = $pk) as cnt_use ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// cp_publish
		$cp_publish_arr = $this->get('cp_publish_arr');
		$data['txt_cp_publish'] = $cp_publish_arr[$data['cp_publish']];

		// cp_type
		$cp_type_arr = $this->get('cp_type_arr');
		$data['txt_cp_type'] = $cp_type_arr[$data['cp_type']];

		// cp_sale_type
		$cp_sale_type_arr = $this->get('cp_sale_type_arr');
		$data['txt_cp_sale_type'] = $cp_sale_type_arr[$data['cp_sale_type']];

		if($data['cp_type'] == 'S') {
			$data['txt_cp_img'] = number_format($data['cp_sale_price']).$data['txt_cp_sale_type'];
		}
		else {
			$data['txt_cp_img'] = $data['txt_cp_type'];
		}

		// cp_quantity
		if($data['cp_quantity']) {
			$data['txt_cp_quantity'] = number_format($data['cp_quantity']);
		}
		else {
			$data['txt_cp_quantity'] = '무제한';
		}

		// cp_limit
		$cp_limit_arr = $this->get('cp_limit_arr');
		$data['txt_cp_limit'] = $cp_limit_arr[$data['cp_limit']];

		// cp_display
		$cp_display_arr = $this->get('cp_display_arr');
		$data['txt_cp_display'] = $cp_display_arr[$data['cp_display']];

		// cp_levels
		$mb_level_arr = $this->get('mb_level_arr');
		$cs_level_arr = $this->get('cs_level_arr');
		$cp_level_arr = explode('|', $data['cp_levels']);
		unset($txt_cp_level_arr);
		for($i = 0 ; $i < sizeof($cp_level_arr) ; $i++) {
			if($data['cp_publish'] == 'A') {
				$txt_cp_level_arr[$i] = $mb_level_arr[$cp_level_arr[$i]];
			}
			else {
				$txt_cp_level_arr[$i] = $cs_level_arr[$cp_level_arr[$i]];
			}
		}
		$data['txt_cp_level_arr'] = $txt_cp_level_arr;
		if(sizeof($txt_cp_level_arr) > 0) {
			$data['txt_cp_levels'] = implode(',', $txt_cp_level_arr);
		}

		return $data;
	}	

	/* select coupon code array */
	public function selectCouponCodeArray($sh_code) {

		$list = dbSelect($this->get('data_table'), "cp_id, cp_name", "where sh_code = '$sh_code'", "order by cp_name asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['cp_id'];
			$val = $list[$i]['cp_name'];
			$arr[$key] = $val;
		}

		return $arr;
	}

	/* select coupon By shop code */
	public function selectCouponByShopCode($sh_code) {

		$list = dbSelect($this->get('data_table'), "cp_id, cp_name, cp_type", "where sh_code = '$sh_code'", "order by cp_name asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['sv_id'];
			$val = array(
				'cp_id'	=> $list[$i]['cp_id'],
				'cp_name'	=> $list[$i]['cp_name'],
				'cp_type'	=> $list[$i]['cp_type']
			);
			$arr[$key] = $val;
		}

		return $arr;
	}

	/* count admin coupon */
	public function countCouponByMemberLevel($mb_level) {

		$data_table = $this->get('data_table');
		$pk =$this->get('pk');

		$cnt = dbCount($data_table, "where cp_publish = 'A' and cp_levels like '%".$mb_level."%'");

		return $cnt;

		/*
		$this->set('coupon_use_table', 'tbl_coupon_use');
		$this->set('cp_us_pk', 'cp_us_id');
		*/

	}

	/* 쿠폰 사용 여부 체크 */
	public function checkFlagUse($data, $mb_id) {
		if($data['cp_limit'] != 'Y') {
			// 반복사용 가능
			return true;
		}
		else {
			// 반복사용 불가
			$pk = $this->get('pk');
			$coupon_use_table = $this->get('coupon_use_table');

			$cp_id = $data[$pk];
			$cnt = dbCount($coupon_use_table, "where $pk = '$cp_id' and reg_id = '$mb_id'");
			if(!$cnt) {
				return true;
			}
		}

		return false;
	}	

	/* 쿠폰 사용하기 */
	public function useCoupon($uid, $mb_id) {

		$data_table = $this->get('data_table');
		$pk =$this->get('pk');

		$coupon_use_table = $this->get('coupon_use_table');

		$arr = array(
			$pk	=> $uid
		);
		$arr = parent::convertInsert($arr);

		dbInsertByArray($coupon_use_table, $arr);

		$this->result['code'] = 'ok';

		return $this->result;
	}
}
?>