<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oPortfolio = new PortfolioManager();
$oPortfolio->init();

$oPortfolio->downloadFile($file_id);
?>
