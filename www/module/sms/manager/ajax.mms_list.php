<?
if(!defined('_INPLUS_')) { exit; }

$oSms = new SmsManager();
$flag_use_header = false;
$flag_use_footer = false;
$uid = $_GET['uid'];
$list = dbSelect("tbl_file","*","where pr_uid='$uid' and pr_module = 'sms' ","order by reg_time desc","limit 3");
?>

<ul class="file_list">
	<?php
	for($i=0;$i<sizeof($list);$i++){
	?>
	<li><?=$list[$i]['file_name']?> <button class="delete"><i class="xi-close-square xi-x"></i></button>
	</li>
	<?}?>
</ul>