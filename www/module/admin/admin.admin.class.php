<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/admin/admin.class.php');

Class AdminAdmin extends Admin
{	
	/* init */
	public function init() {

		// 권한검사
		if(!checkAdminAuth('admin')) {
			alert('권한이 없습니다.', '/admin');
			exit;
		}

		parent::init();
	}
	
	
}
?>
