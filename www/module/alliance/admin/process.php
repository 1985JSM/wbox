<?
if(!defined('_INPLUS_')) { exit; } 

$oAlliance = new AllianceAdmin();
$oAlliance->init();

if($mode == 'insert') {
	$result = $oAlliance->insertData();
}
else if($mode == 'update') {
	$result = $oAlliance->updateData();
}
else if($mode == 'delete') {
	$result = $oAlliance->deleteData();
}
else if($mode == 'update_answer') {
	$result = $oAlliance->updateAnswer();
}
else if($mode == 'delete_answer') {
	$result = $oAlliance->deleteAnswer();
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
