<?
if(!defined('_INPLUS_')) { exit; } 

$oCoupon = new CouponAdmin();
$oCoupon->init();

if($mode == 'insert') {
	$result = $oCoupon->insertData();
}
else if($mode == 'update') {
	$result = $oCoupon->updateData();
}
else if($mode == 'delete') {
	$result = $oCoupon->deleteData();
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
