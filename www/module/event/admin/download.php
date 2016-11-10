<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oEvent = new EventAdmin();
$oEvent->init();

$oEvent->downloadFile($file_id);
?>
