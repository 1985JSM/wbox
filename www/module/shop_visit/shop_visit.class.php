<?
if(!defined('_INPLUS_')) { exit; } 

Class ShopVisit extends StdController
{	
	/* init */
	public function init() {

		// module info
		$this->set('module',		'shop_visit');
		$this->set('module_name',	'가맹점방문로그');		

		// context
		$this->set('data_table',	'tbl_shop_visit');

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

	/* count today */
	public function countRows($sch_date, $sh_code = '') {

		$data_table = $this->get('data_table');
		$db_where = "where left(reg_time, 10) = '$sch_date' ";
		if($sh_code) {
			$db_where .= " and sh_code = '$sh_code' ";
		}
		$cnt = dbCount($data_table, $db_where);

		return $cnt;
	}

}
?>
