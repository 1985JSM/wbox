<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oFaq = new FaqManager();
$oFaq->init();

$oFaq->downloadFile($file_id);
?>
