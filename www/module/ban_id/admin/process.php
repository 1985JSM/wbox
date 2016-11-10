<?
if(!defined('_INPLUS_')) { exit; } 

$oBanId = new BanIdAdmin();
$oBanId->init();

if($mode == 'insert') {
	$result = $oBanId->insertData();
}
else if($mode == 'update') {
	$result = $oBanId->updateData();
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
