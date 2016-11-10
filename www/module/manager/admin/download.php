<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oManager = new ManagerAdmin();
$oManager->init();

$oManager->downloadFile($file_id);
?>
