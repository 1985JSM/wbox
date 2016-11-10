<?
if(!defined('_INPLUS_')) { exit; } 

$oAdmin = new AdminAdmin();
$oAdmin->init();

if($mode == 'insert') {
	$result = $oAdmin->insertData();
}
else if($mode == 'update') {
	$result = $oAdmin->updateData();
}
else if($mode == 'delete') {
	$result = $oAdmin->deleteData();
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
