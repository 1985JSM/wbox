<?
if(!defined('_INPLUS_')) { exit; } 

Class Advance extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'advance');
		$this->set('module_name',	'선불제');		

		// context
		$this->set('data_table', 'tbl_advance');
		$this->set('pk', 'ad_id');
		$this->set('search_field', 'sh_code');
		$this->set('sch_type_arr', array(
			'ad_name'		=> '선불제명'
		));
	
		/**
		* code array
		*/
		$this->set('ad_type_arr', array(
			'M'	=> '정액권',
			'Q'	=> '이용권',
			'P'	=> '정기권'
		));

		$this->set('ad_month_arr', array(
			'1'		=> '1개월',
			'2'		=> '2개월',
			'3'		=> '3개월',
			'4'		=> '4개월',
			'5'		=> '5개월',
			'6'		=> '6개월',
			'7'		=> '7개월',
			'8'		=> '8개월',
			'9'		=> '9개월',
			'10'	=> '10개월',
			'11'	=> '11개월',
			'12'	=> '12개월',
			'99'	=> '기타'
		));
	
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
		$this->set('insert_field', 'ad_type,ad_name,ad_price,ad_money,ad_quantity,ad_month,ad_content');
		$this->set('required_field', 'sh_code,ad_type,ad_name,ad_price');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// 유형
		if($arr['ad_type'] == 'M') {
			$arr['ad_quantity'] = '';
			$arr['ad_month'] = '';
		}
		else if($arr['ad_type'] == 'Q') {
			$arr['ad_money'] = '';
			$arr['ad_month'] = '';
		}
		else if($arr['ad_type'] == 'P') {
			$arr['ad_money'] = '';
			$arr['ad_quantity'] = '';			
		}

		// 가격 (del comma)
		$arr['ad_price'] = str_replace(',', '', $arr['ad_price']);
		$arr['ad_money'] = str_replace(',', '', $arr['ad_money']);
		$arr['ad_quantity'] = str_replace(',', '', $arr['ad_quantity']);

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',ad_type,ad_name,ad_price,ad_money,ad_quantity,ad_month,ad_content');
		$this->set('required_field', $pk.',sh_code,ad_type,ad_name,ad_price');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// 유형
		if($arr['ad_type'] == 'M') {
			$arr['ad_quantity'] = '';
			$arr['ad_month'] = '';
		}
		else if($arr['ad_type'] == 'Q') {
			$arr['ad_money'] = '';
			$arr['ad_month'] = '';
		}
		else if($arr['ad_type'] == 'P') {
			$arr['ad_money'] = '';
			$arr['ad_quantity'] = '';			
		}

		// 가격 (del comma)
		$arr['ad_price'] = str_replace(',', '', $arr['ad_price']);
		$arr['ad_money'] = str_replace(',', '', $arr['ad_money']);
		$arr['ad_quantity'] = str_replace(',', '', $arr['ad_quantity']);

		return $arr;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{
		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', '*');
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// ad_type
		$ad_type_arr = $this->get('ad_type_arr');
		$data['txt_ad_type'] = $ad_type_arr[$data['ad_type']];

		// ad_month
		$ad_month_arr = $this->get('ad_month_arr');
		$data['txt_ad_month'] = $ad_month_arr[$data['ad_month']];

		if($data['ad_type'] == 'M') {
			$data['txt_ad_option'] = $data['txt_ad_type'].' ('.number_format($data['ad_money']).'원)';
		}
		else if($data['ad_type'] == 'Q') {
			$data['txt_ad_option'] = $data['txt_ad_type'].' ('.number_format($data['ad_quantity']).'회)';
		}
		else if($data['ad_type'] == 'P') {
			$data['txt_ad_option'] = $data['txt_ad_type'].' ('.$data['txt_ad_month'].')';
		}

		

		return $data;
	}	

	/* select advance code array */
	public function selectAdvanceCodeArray($sh_code) {

		$list = dbSelect($this->get('data_table'), "ad_id, ad_name", "where sh_code = '$sh_code'", "order by ad_name asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['ad_id'];
			$val = $list[$i]['ad_name'];
			$arr[$key] = $val;
		}

		return $arr;
	}

	/* select advance By shop code */
	public function selectAdvanceByShopCode($sh_code) {

		$list = dbSelect($this->get('data_table'), "ad_id, ad_name, ad_type, ad_price, ad_money, ad_quantity, ad_month", "where sh_code = '$sh_code'", "order by ad_name asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['ad_id'];

			$ad_start = date('Y-m-d');
			$ext_month = 3;
			if($list[$i]['ad_type'] == 'P' && $list[$i]['ad_month'] != '99') {
				$ext_month = $list[$i]['ad_month'];
			}
			$ad_expire = date('Y-m-d', strtotime('+'.$ext_month.' month'));

			$val = array(
				'ad_name'		=> $list[$i]['ad_name'],
				'ad_type'		=> $list[$i]['ad_type'],
				'ad_price'		=> $list[$i]['ad_price'],
				'ad_money'		=> $list[$i]['ad_money'],
				'ad_quantity'	=> $list[$i]['ad_quantity'],
				'ad_month'		=> $list[$i]['ad_month'],
				'ad_start'		=> $ad_start,
				'ad_expire'		=> $ad_expire
			);
			$arr[$key] = $val;
		}

		return $arr;
	}
}
?>