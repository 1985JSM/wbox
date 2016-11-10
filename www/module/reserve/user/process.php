<?
if(!defined('_INPLUS_')) { exit; } 

$oReserve = new ReserveUser();
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
	$result['url'] .= '&sch_date='.$sch_date;
	echo json_encode($result);
	exit;
}
else if($mode == 'delete') {
	$result = $oReserve->deleteData();
}
else if($mode == 'update_state') {
	$result = $oReserve->updateState();
	$result['url'] = '../reserve/list.html?sch_date='.$sch_date;
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
