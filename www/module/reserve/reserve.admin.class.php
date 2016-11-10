<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/reserve/reserve.class.php');

Class ReserveAdmin extends Reserve
{	
	/* init */
	public function init() {


		parent::init();

		// search
		$this->set('sch_type_arr', array(
			'us_name'	=> '예약자명',
			'st_name'	=> '담당자명',
			'sh_name'	=> '가맹점명'
		));
	}	



	/* insert */
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		// rs type
		$arr['rs_type'] = 'S';

		// rs state
		$arr['rs_state'] = 'W';

		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		// rs type
		//$arr['rs_type'] = 'R';

		// rs state
		$arr['rs_state'] = 'W';

		return $arr;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		// 사용자 예약건만
		$db_where.= " and rs_type = 'U' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
