<?
if(!defined('_INPLUS_')) { exit; } 

$oBlog = new BlogAdmin();
$oBlog->init();

if($mode == 'insert') {
	$result = $oBlog->insertData();
}
else if($mode == 'update') {
	$result = $oBlog->updateData();
}
else if($mode == 'delete') {
	$result = $oBlog->deleteData();
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
