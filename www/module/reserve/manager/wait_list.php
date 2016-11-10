<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
//$content_size = 'full';

/* init Class */
$oReserve = new ReserveManager();
$oReserve->set('list_mode', 'wait');
$oReserve->set('order_direct', 'asc');

include_once(_MODULE_PATH_.'/reserve/manager/list.inc.php');
?>