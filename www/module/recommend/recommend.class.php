<?
if(!defined('_INPLUS_')) { exit; } 

Class Recommend extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'recommend');
		$this->set('module_name',	'추천샵');		

		// context
		$this->set('data_table', 'tbl_recommend');
		$this->set('pk', 'rc_id');

		$this->set('rc_shop_table', 'tbl_recommend_shop');
		$this->set('rc_sh_pk'	, 'rc_sh_id');

		$this->set('search_field', 'rc_display');
		$this->set('sch_type_arr', array(
			'rc_subject'	=> '제목'
		));

		$this->set('order_field', 'rc_order');
		$this->set('order_direct', 'asc');

		$this->set('max_file', 1);
		$this->set('cnt_rows', 9999);

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 640);
		$this->set('thumb_height', 290);
	
		/**
		* code array
		*/
		$this->set('rc_display_arr', array(
			'Y'	=> '사용',
			'N'	=> '미사용'
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
		$this->set('insert_field', 'rc_subject,rc_subject2,rc_display');
		$this->set('required_field', 'rc_subject,rc_display');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		$max_order = dbOnce($this->get('data_table'), "max(rc_order) as rc_order", "", "");
		$arr['rc_order'] = $max_order['rc_order'] + 1;
		
		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',rc_subject,rc_subject2,rc_display');
		$this->set('required_field', $pk.',rc_subject,rc_display');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		return $arr;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$rc_shop_table = $this->get('rc_shop_table');
		$rc_sh_pk = $this->get('rc_sh_pk');

		$select_table = "$data_table a";
		$select_field = "a.*";
		$select_field.= ", (select count($rc_sh_pk) from $rc_shop_table where a.$pk = $pk) as cnt_shop ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// rc_display
		$rc_display_arr = $this->get('rc_display_arr');
		$data['txt_rc_display'] = $rc_display_arr[$data['rc_display']];

		return $data;
	}	

	/* delete */
	protected function dbDelete($uid) {

		$pk = $this->get('pk');
		$rc_shop_table = $this->get('rc_shop_table');

		dbDelete($rc_shop_table, "where $pk = '$uid'");

		parent::dbDelete($uid);
	}

	/* change order */
	public function changeOrder($uid, $direction) {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$data = dbOnce($data_table, "*", "where $pk = '$uid'", "");
		$rc_order = $data['rc_order'];
		if($direction == 'up') {
			// 위로
			$target = dbOnce($data_table, "*", "where rc_order < '$rc_order'", "order by rc_order desc");
			$target_uid = $target[$pk];
			$target_order = $target['rc_order'] + 1;
			$rc_order = $rc_order - 1;
		}
		else if($direction == 'down') {
			// 아래로
			$target = dbOnce($data_table, "*", "where rc_order > '$rc_order'", "order by rc_order asc");
			$target_uid = $target[$pk];
			$target_order = $target['rc_order'] - 1;
			$rc_order = $rc_order + 1;
		}

		dbUpdate($data_table, "rc_order = '$rc_order'", "where $pk = '$uid'");
		dbUpdate($data_table, "rc_order = '$target_order'", "where $pk = '$target_uid'");

		$this->result['code'] = 'ok';

		return $this->result;
	}

	/* add shop */
	public function addShop($uid, $sh_code) {

		$pk = $this->get('pk');
		$rc_shop_table = $this->get('rc_shop_table');

		$cnt = dbCount($rc_shop_table, "where $pk = '$uid' and sh_code = '$sh_code'");
		if(!$cnt) {
			$arr = array(
				$pk			=> $uid,
				'sh_code'	=> $sh_code
			);
			$arr = parent::convertInsert($arr);

			dbInsertByArray($rc_shop_table, $arr);
		}


		$this->result['code'] = 'ok';

		return $this->result;
	}

	/* delete shop */
	public function deleteShop($uid, $sh_code) {

		$pk = $this->get('pk');
		$rc_shop_table = $this->get('rc_shop_table');

		dbDelete($rc_shop_table, "where $pk = '$uid' and sh_code = '$sh_code'");

		$this->result['code'] = 'ok';

		return $this->result;
	}

	/* select shop code array */
	public function selectShopCodeArray($uid) {

		$pk = $this->get('pk');
		$rc_shop_table = $this->get('rc_shop_table');

		$list = dbSelect($rc_shop_table, "sh_code", "where $pk = '$uid' ", "", "", 0);
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$arr[$i] = $list[$i]['sh_code'];
		}

		return $arr;
	}
}
?>