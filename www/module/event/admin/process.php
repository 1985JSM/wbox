<?
if(!defined('_INPLUS_')) { exit; } 

$oEvent = new EventAdmin();
$oEvent->init();

if($mode == 'insert') {
	$result = $oEvent->insertData();
}
else if($mode == 'update') {
	$result = $oEvent->updateData();
}
else if($mode == 'delete') {
	$result = $oEvent->deleteData();
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
