<?
if(!defined('_INPLUS_')) { exit; } 

Class Visual extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'visual');
		$this->set('module_name',	'메인비주얼');		

		// context
		$this->set('data_table', 'tbl_visual');
		$this->set('pk', 'vs_id');

		$this->set('search_field', 'vs_display');
		$this->set('sch_type_arr', array(
			'vs_subject'	=> '제목'
		));

		$this->set('order_field', 'vs_order');
		$this->set('order_direct', 'asc');

		$this->set('max_file', 1);
		$this->set('cnt_rows', 9999);

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 640);
		$this->set('thumb_height', 400);
	
		/**
		* code array
		*/
		$this->set('vs_display_arr', array(
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
		$this->set('insert_field', 'vs_subject,vs_display,sh_code');
		$this->set('required_field', 'vs_subject,vs_display');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		$max_order = dbOnce($this->get('data_table'), "max(vs_order) as vs_order", "", "");
		$arr['vs_order'] = $max_order['vs_order'] + 1;
		
		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',vs_subject,vs_display,sh_code');
		$this->set('required_field', $pk.',vs_subject,vs_display');		
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

		$select_table = "$data_table a ";
		$select_table.= "left outer join tbl_shop b on a.sh_code = b.sh_code ";

		$select_field = "a.*";
		$select_field.= ", b.sh_name";		

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// vs_display
		$vs_display_arr = $this->get('vs_display_arr');
		$data['txt_vs_display'] = $vs_display_arr[$data['vs_display']];

		return $data;
	}	

	/* change order */
	public function changeOrder($uid, $direction) {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$data = dbOnce($data_table, "*", "where $pk = '$uid'", "");
		$vs_order = $data['vs_order'];
		if($direction == 'up') {
			// 위로
			$target = dbOnce($data_table, "*", "where vs_order < '$vs_order'", "order by vs_order desc");
			$target_uid = $target[$pk];
			$target_order = $target['vs_order'] + 1;
			$vs_order = $vs_order - 1;
		}
		else if($direction == 'down') {
			// 아래로
			$target = dbOnce($data_table, "*", "where vs_order > '$vs_order'", "order by vs_order asc");
			$target_uid = $target[$pk];
			$target_order = $target['vs_order'] - 1;
			$vs_order = $vs_order + 1;
		}

		dbUpdate($data_table, "vs_order = '$vs_order'", "where $pk = '$uid'");
		dbUpdate($data_table, "vs_order = '$target_order'", "where $pk = '$target_uid'");

		$this->result['code'] = 'ok';

		return $this->result;
	}

}
?>