<?
if(!defined('_INPLUS_')) { exit; } 

$AdvancePurchase = new AdvancePurchaseManager();
$AdvancePurchase->init();

if($mode == 'insert') {
	$result = $AdvancePurchase->insertData();
	include_once(_MODULE_PATH_.'/advance_purchase/manager/ajax.list.php');

	$result['url'] = '';
	$result['msg'] = '';
}
else if($mode == 'update') {
	$result = $AdvancePurchase->updateData();
	include_once(_MODULE_PATH_.'/advance_purchase/manager/ajax.list.php');

	$result['url'] = '';
	$result['msg'] = '';
}
else if($mode == 'charge') {
	$result = $AdvancePurchase->chargeData();
	include_once(_MODULE_PATH_.'/advance_purchase/manager/ajax.list.php');

	$result['url'] = '';
	$result['msg'] = '';
}
else if($mode == 'delete') {
	$result = $AdvancePurchase->deleteData();

	include_once(_MODULE_PATH_.'/advance_purchase/manager/ajax.list.php');

	$result['url'] = '';
	$result['msg'] = '';
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
