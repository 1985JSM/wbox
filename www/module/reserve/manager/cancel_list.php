<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
//$content_size = 'full';

/* init Class */
$oReserve = new ReserveManager();
$oReserve->set('list_mode', 'cancel');
$oReserve->set('order_direct', 'desc');

include_once(_MODULE_PATH_.'/reserve/manager/list.inc.php');
?>