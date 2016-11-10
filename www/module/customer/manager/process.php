<?
if(!defined('_INPLUS_')) { exit; } 

$oCustomer = new CustomerManager();
$oCustomer->init();

if($mode == 'insert') {
	$result = $oCustomer->insertData();
}
else if($mode == 'update') {
	$result = $oCustomer->updateData();
}
else if($mode == 'delete') {
	$result = $oCustomer->deleteData();
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
