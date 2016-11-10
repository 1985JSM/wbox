<?
if(!defined('_INPLUS_')) { exit; } 

$oUser = new UserAdmin();
$oUser->init();

if($mode == 'insert') {
	$result = $oUser->insertData();
}
else if($mode == 'update') {
	$result = $oUser->updateData();
}
else if($mode == 'delete') {
	$result = $oUser->deleteData();
	$result['url'] = str_replace('list.html', 'leave_list.html', $result['url']);
}
else if($mode == 'cancel_leave') {
	$result = $oUser->cancelLeaveMember();
	$result['url'] = str_replace('list.html', 'leave_list.html', $result['url']);
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
