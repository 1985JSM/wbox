<?
if(!defined('_INPLUS_')) { exit; } 

$oService = new ServiceAdmin();
$oService->init();

if($mode == 'insert') {
	$result = $oService->insertData();
}
else if($mode == 'update') {
	$result = $oService->updateData();
}
else if($mode == 'delete') {
	$result = $oService->deleteData();
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
