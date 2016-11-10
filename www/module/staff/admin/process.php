<?
if(!defined('_INPLUS_')) { exit; } 

$oStaff = new StaffAdmin();
$oStaff->init();

if($mode == 'insert') {
	$result = $oStaff->insertData();
}
else if($mode == 'update') {
	$result = $oStaff->updateData();
}
else if($mode == 'delete') {
	$result = $oStaff->deleteData();
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
