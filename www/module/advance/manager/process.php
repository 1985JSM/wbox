<?
if(!defined('_INPLUS_')) { exit; } 

$oAdvance = new AdvanceManager();
$oAdvance->init();

if($mode == 'insert') {
	$result = $oAdvance->insertData();
}
else if($mode == 'update') {
	$result = $oAdvance->updateData();
}
else if($mode == 'delete') {
	$result = $oAdvance->deleteData();
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
