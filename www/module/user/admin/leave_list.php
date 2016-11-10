<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
$layout_size = 'normal';

/* init Class */
$oUser = new UserAdmin();
$oUser->set('list_mode', 'leave');

include_once(_MODULE_PATH_.'/user/admin/list.inc.php');
?>


