<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();
$time_arr = $oReserve->selectTimaTable($sch_date, $st_id, $sv_id);
foreach($time_arr as $key => $val) { ?>
<li>
	<? if(!$val) { ?><button type="button" onclick="chooseDateTime('<?=$sch_date?>', '<?=$key?>')"><?=$key?></button><? }
	else { ?><span><?=$key?></span><? } ?>
</li>
<? } ?>