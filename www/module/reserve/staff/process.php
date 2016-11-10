<?
if(!defined('_INPLUS_')) { exit; } 

$oReserve = new ReserveStaff();
$oReserve->init();

if($mode == 'insert') {
	$result = $oReserve->insertData();
	$result['code'] = 'ok';
	echo json_encode($result);
	exit;
}
else if($mode == 'update') {
	$result = $oReserve->updateData();
	$result['code'] = 'ok';
	$result['url'] = str_replace('result.html', 'view.html', $result['url']);

	$pk = $oReserve->get('pk');
	$uid = $oReserve->get('uid');
	$result[$pk] = $uid;

	ob_start();
	$post_data = $oReserve->selectDetail($uid);
	include_once(_MODULE_PATH_.'/reserve/staff/ajax.list.php');
	$result['list_item'] = ob_get_contents();
	ob_end_clean();

	echo json_encode($result);
	exit;
}
else if($mode == 'delete') {
	$result = $oReserve->deleteData();
}
else if($mode == 'update_state') {
	$result = $oReserve->updateState();
	$result['code'] = 'ok';
	$result['rs_state'] = $rs_state;

	$pk = $oReserve->get('pk');
	$uid = $oReserve->get('uid');
	$result[$pk] = $uid;

	$rs_state_arr = $oReserve->get('rs_state_arr');
	$result['txt_rs_state'] = $rs_state_arr[$rs_state];

	echo json_encode($result);
	exit;
}
else if($mode == 'update_memo') {
	$result = $oReserve->updateMemo();

	$pk = $oReserve->get('pk');
	$uid = $oReserve->get('uid');
	$result[$pk] = $uid;

	echo json_encode($result);
	exit;
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
