<?
if(!defined('_INPLUS_')) { exit; } 

Class Favorite extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'favorite');
		$this->set('module_name',	'나의매장');		

		// context
		$this->set('data_table', 'tbl_favorite');
		$this->set('pk', 'fv_id');
		$this->set('search_field', 'sh_code');
		
		$this->set('max_file', 1);
	
		/**
		* code array
		*/
		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'sh_code');
		$this->set('required_field', 'sh_code');		
		$this->set('return_url', './list.html');
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',sh_code');
		$this->set('required_field', $pk.',sh_code');		
		$this->set('return_url', './write.html');
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

	/* check favorite by shop code */
	public function checkFavoriteByShopCode($sh_code) {

		$data_table = $this->get('data_table');

		global $member;
		$mb_id = $member['mb_id'];

		$chk = dbCount($data_table, "where reg_id = '$mb_id' and sh_code = '$sh_code'");

		return $chk;
	}

	/* count by shop code */
	public function countByShopCode($sh_code) {

		$data_table =$this->get('data_table');
		$cnt = dbCount($data_table, "where sh_code = '$sh_code' ");

		return $cnt;
	}

	public function countTotal() {

		$data_table =$this->get('data_table');
		$cnt = dbCount($data_table, "");

		return $cnt;
	}
}
?>