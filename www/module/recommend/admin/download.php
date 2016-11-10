<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oRecommend = new RecommendAdmin();
$oRecommend->init();

$oRecommend->downloadFile($file_id);
?>
