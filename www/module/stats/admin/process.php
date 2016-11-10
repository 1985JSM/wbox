<?
if(!defined('_INPLUS_')) { exit; } 

$oStats = new StatsAdmin();
$oStats->init();

if($mode == 'select_sigungu') {
	// 시/군/구
	$sch_sido = urldecode($sch_sido);
	$result = $oStats->selectShopSigungu($sch_sido);	
	echo $result['content'];
}


if($result['url']) {
	if($result['msg']) { alert($result['msg'], $result['url']); }
	else if($result['code']) { alertCode($result['code'], $result['url']); }
	else { movePage($result['url']); }
	exit;
}

if($result['msg']) {
	alert($result['msg']);
	exit;
}
?>
