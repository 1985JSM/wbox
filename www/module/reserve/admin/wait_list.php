<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
$layout_size = 'normal';


/* init Class */
$oReserve = new ReserveAdmin();
$oReserve->set('list_mode', 'wait');
$oReserve->set('order_direct', 'asc');

include_once(_MODULE_PATH_.'/reserve/admin/list.inc.php');
?>