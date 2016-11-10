<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oAdmin = new AdminAdmin();
$oAdmin->init();

$oAdmin->downloadFile($file_id);
?>
