<?
if(!defined('_INPLUS_')) { exit; } 

$oConfig = new ConfigFront();
$oConfig->init();

if($mode == 'get_dong') {
	// GPS를 통해서 동정보 구하기
	$result = $oConfig->getDongByGps($_GET['lat'], $_GET['lng']);	
	echo json_encode($result);
	exit;
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
