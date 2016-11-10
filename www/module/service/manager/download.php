<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oService = new ServiceManager();
$oService->init();

$oService->downloadFile($file_id);
?>
