<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oStaff = new StaffManager();
$oStaff->init();

$oStaff->downloadFile($file_id);
?>
