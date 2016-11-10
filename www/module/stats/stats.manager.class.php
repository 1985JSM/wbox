<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/stats/stats.class.php');

Class StatsManager extends Stats
{	
	/* init */
	public function init() {

		parent::init();

		$this->set('reserve_std_arr', array(
			'month'		=> '월별',
			'day'		=> '일별',
			'age'		=> '연령별',
			'gender'	=> '성별'
		));
	}

	/* 사용자 예약 통계 */
	protected function makeDbWhere() {

		$db_where = parent::makeDbWhere();

		global $member;
		$sh_code = $member['sh_code'];

		$db_where .= " and a.sh_code = '$sh_code' ";

		$this->set('db_where', $db_where);

		return $db_where;
	}
	
	
}
?>
