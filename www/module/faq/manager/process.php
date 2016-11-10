<?
if(!defined('_INPLUS_')) { exit; } 

$oFaq = new FaqManager();
$oFaq->init();

if($mode == 'insert') {
	$result = $oFaq->insertData();
}
else if($mode == 'update') {
	$result = $oFaq->updateData();
}
else if($mode == 'delete') {
	$result = $oFaq->deleteData();
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
