<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/notice/notice.class.php');

Class NoticeAdmin extends Notice
{	
	/* init */
	public function init() {

		// 권한검사
		if(!checkAdminAuth('admin')) {
			alert('권한이 없습니다.', '/webadmin');
			exit;
		}

		parent::init();
	}

	
	
	
}
?>
