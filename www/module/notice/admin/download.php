<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oNotice = new NoticeAdmin();
$oNotice->init();

$oNotice->downloadFile($file_id);
?>
