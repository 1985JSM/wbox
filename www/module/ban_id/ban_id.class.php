<?
if(!defined('_INPLUS_')) { exit; } 

Class BanId extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'ban_id');
		$this->set('module_name',	'금지아이디');		

		// context
		$this->set('data_table',	'tbl_ban_id');
		$this->set('pk',			'ban_column');

		$this->set('search_field', 'ban_column');
		$this->set('sch_type_arr', array(
			'ban_ids'	=> '금지아이디'
		));
	
		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'ban_column,ban_ids');
		$this->set('required_field', 'ban_column');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',ban_column,ban_ids');
		$this->set('required_field', $pk.',ban_column');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		$arr['ban_ids'] = str_replace(' ', '', $arr['ban_ids']);

		return $arr;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$this->set('db_where', $db_where);

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
	
		return $data;
	}
}
?>