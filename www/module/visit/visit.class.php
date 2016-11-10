<?
if(!defined('_INPLUS_')) { exit; } 

Class Visit extends StdController
{	
	/* init */
	public function init() {

		// module info
		$this->set('module',		'visit');
		$this->set('module_name',	'접속로그');		

		// context
		$this->set('data_table',	'tbl_visit_log');
		$this->set('search_field',	'vi_type');

		//$this->set('cnt_rows', 2);
		
		parent::init();
	}


	/* insert */
	public function insertData() {

		$arr = array(
			'vi_type'		=> $this->get('vi_type'),
			'login_ip'	=> $_SERVER['REMOTE_ADDR'],
			'mb_id'			=> $_POST['login_id'],
			'vi_time'		=> date('Y-m-d H:i:s')
		);

		dbInsertByArray($this->get('data_table'), $arr);
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();
//		$db_where.= " and 

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{
		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', '*');
	}	

}
?>
