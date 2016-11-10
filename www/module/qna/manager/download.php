<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oQna = new QnaManager();
$oQna->init();

$oQna->downloadFile($file_id);
?>
