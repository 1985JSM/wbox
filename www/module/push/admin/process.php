<?
if(!defined('_INPLUS_')) { exit; } 

$oPush = new PushAdmin();
$oPush->init();

if($mode == 'update_config') {
	$result = $oPush->updateConfig();
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
