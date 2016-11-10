<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oAlliance = new AllianceAdmin();
$oAlliance->init();

$oAlliance->downloadFile($file_id);
?>
