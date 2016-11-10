<?
if(!defined('_INPLUS_')) { exit; } 

$oNotice = new NoticeManager();
$oNotice->init();

if($mode == 'insert') {
	$result = $oNotice->insertData();
}
else if($mode == 'update') {
	$result = $oNotice->updateData();
}
else if($mode == 'delete') {
	$result = $oNotice->deleteData();
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
