<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oVisual = new VisualAdmin();
$oVisual->init();

$oVisual->downloadFile($file_id);
?>
