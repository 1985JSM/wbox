<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/stats/stats.class.php');

Class StatsAdmin extends Stats
{	
	/* init */
	public function init() {

		// 권한검사
		if(!checkAdminAuth('stats')) {
			alert('권한이 없습니다.', '/webadmin');
			exit;
		}

		parent::init();
	}
	
	
}
?>
