<?
if(!defined('_INPLUS_')) { exit; } 

$oQna = new QnaUser();
$oQna->init();

if($mode == 'insert') {
	$result = $oQna->insertData();
}
else if($mode == 'update') {
	$result = $oQna->updateData();
}
else if($mode == 'delete') {
	$result = $oQna->deleteData();
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
