<?
if(!defined('_INPLUS_')) { exit; } 

Class Service extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'service');
		$this->set('module_name',	'서비스');		

		// context
		$this->set('data_table', 'tbl_service');
		$this->set('pk', 'sv_id');
		$this->set('search_field', 'sh_state,sh_code');
		$this->set('sch_type_arr', array(
			'sh_name'		=> '상호'
		));
		$this->set('max_file', 1);

		$this->set('order_field', 'sv_order,sv_sale_price');
		$this->set('order_direct', 'asc');

		/**
		* code array
		*/
		$this->set('sv_time_arr', array(
			'30'	=> '30분',
			'60'	=> '60분',
			'90'	=> '90분',
			'120'	=> '120분',
			'150'	=> '150분',
			'180'	=> '180분'
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
		$this->set('insert_field', 'sh_code,sv_name,sv_time,sv_normal_price,sv_sale_price,sv_content');
		$this->set('required_field', 'sh_code,sv_name,sv_time,sv_normal_price,sv_sale_price,sv_content');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// 가격 (del comma)
		$arr['sv_normal_price'] = str_replace(',', '', $arr['sv_normal_price']);
		$arr['sv_sale_price'] = str_replace(',', '', $arr['sv_sale_price']);

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',sh_code,sv_name,sv_time,sv_normal_price,sv_sale_price,sv_content');
		$this->set('required_field', $pk.',sh_code,sv_name,sv_time,sv_normal_price,sv_sale_price,sv_content');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// 가격 (del comma)
		$arr['sv_normal_price'] = str_replace(',', '', $arr['sv_normal_price']);
		$arr['sv_sale_price'] = str_replace(',', '', $arr['sv_sale_price']);

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

		// sv_time
		$arr = $this->get('sv_time_arr');
		$data['txt_sv_time'] = $arr[$data['sv_time']];

		return $data;
	}	

	/* select service code array */
	public function selectServiceCodeArray($sh_code) {

		$list = dbSelect($this->get('data_table'), "sv_id, sv_name", "where sh_code = '$sh_code'", "order by sv_name asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['sv_id'];
			$val = $list[$i]['sv_name'];
			$arr[$key] = $val;
		}

		return $arr;
	}

    /* change order */
    public function changeOrder($uid, $direction) {

        $data_table = $this->get('data_table');
        $pk = $this->get('pk');

        $data = dbOnce($data_table, "*", "where $pk = '$uid'", "");
        $sh_code = $data['sh_code'];
        $sv_order = $data['sv_order'];
        if($direction == 'up') {
            // 위로
            $target = dbOnce($data_table, "*", "where sh_code = '$sh_code' and sv_order < '$sv_order'", "order by sv_order desc");
            $target_uid = $target[$pk];
            $target_order = $target['sv_order'] + 1;
            $sv_order = $sv_order - 1;
        }
        else if($direction == 'down') {
            // 아래로
            $target = dbOnce($data_table, "*", "where sh_code = '$sh_code' and sv_order > '$sv_order'", "order by sv_order asc");
            $target_uid = $target[$pk];
            $target_order = $target['sv_order'] - 1;
            $sv_order = $sv_order + 1;
        }

        dbUpdate($data_table, "sv_order = '$sv_order'", "where $pk = '$uid'");
        dbUpdate($data_table, "sv_order = '$target_order'", "where $pk = '$target_uid'");

	    $this->sortOrder($sh_code);
	    /* sortOrder가 잘 작동하면 삭제할 부분들
	    $list = dbSelect($data_table, "$pk", "where sh_code = '$sh_code'", "order by sv_order asc", "");
	    for($i = 0 ; $i < sizeof($list) ; $i++) {
		    $st_order = $i + 1;
		    $uid = $list[$i][$pk];
		    dbUpdate($data_table, "st_order = '$st_order'", "where $pk = '$uid'");
	    }*/

        $this->result['code'] = 'ok';

        return $this->result;
    }

    /* 서비스를 정렬할 때 사용합니다. */
    public function sortOrder($sh_code) {
	    $data_table = $this->get('data_table');
	    $pk = $this->get('pk');

	    $list = dbSelect($data_table, "$pk", "where sh_code = '$sh_code'", "order by sv_order asc", "");
	    for($i = 0 ; $i <= sizeof($list) ; $i++) {
		    $sv_order = $i + 1;
		    $uid = $list[$i][$pk];
		    dbUpdate($data_table, "sv_order = '$sv_order'", "where $pk = '$uid'");
	    }
    }

	/* select service By shop code */
	public function selectServiceByShopCode($sh_code) {

		$list = dbSelect($this->get('data_table'), "sv_id, sv_name, sv_time, sv_normal_price, sv_sale_price", "where sh_code = '$sh_code'", "order by sv_order asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['sv_id'];
			$val = array(
				'sv_name'	=> $list[$i]['sv_name'],
				'sv_time'	=> $list[$i]['sv_time'],
				'sv_normal_price'	=> $list[$i]['sv_normal_price'],
				'sv_sale_price'	=> $list[$i]['sv_sale_price']
			);
			$arr[$key] = $val;
		}

		return $arr;
	}

	/* select service By staff id */
	public function selectServiceByStaffId($st_id) {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		global $oStaff;
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$staff_data = $oStaff->selectDetail($st_id);
		$sv_code = $staff_data['sv_code'];
		$sv_code = str_replace('|', "','", $sv_code);

		$list = dbSelect($this->get('data_table'), "sv_id, sv_name, sv_time, sv_normal_price, sv_sale_price", "where $pk in ('$sv_code')", "order by sv_order asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['sv_id'];
			$val = array(
				'sv_name'	=> $list[$i]['sv_name'],
				'sv_time'	=> $list[$i]['sv_time'],
				'sv_normal_price'	=> $list[$i]['sv_normal_price'],
				'sv_sale_price'	=> $list[$i]['sv_sale_price']
			);
			$arr[$key] = $val;
		}

		return $arr;
	}

	/* get service name by code */
	public function getServiceNameByCode($sv_code) {

		$pk = $this->get('pk');

		$sv_code = str_replace('|', "','", $sv_code);
		$list = dbSelect($this->get('data_table'), "sv_name", "where $pk in ('$sv_code')", "order by sv_name asc", "");
		unset($arr);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$arr[] = $list[$i]['sv_name'];
		}

		if(sizeof($arr) > 0) {
			$sv_names = implode(',', $arr);
		}

		return $sv_names;
	}

	

}
?>