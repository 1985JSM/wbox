<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oShop = new ShopAdmin();
$oShop->init();

$oShop->downloadFile($file_id);
?>
