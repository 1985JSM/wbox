<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveManager();
$oReserve->init();
$time_arr = $oReserve->selectTimeTable($sch_date, $sh_code, $st_id, $sv_ids, true);

foreach($time_arr as $key => $val) { ?>
<li>
	<? if(!$val) { ?><button type="button" onclick="chooseDateTime('<?=$sch_date?>', '<?=$key?>')"><?=$key?></button><? }
	else { ?><span><?=$key?></span><? } ?>
</li>
<? } ?>