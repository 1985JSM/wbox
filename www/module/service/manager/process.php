<?
if(!defined('_INPLUS_')) { exit; } 

$oService = new ServiceManager();
$oService->init();

if($mode == 'insert') {
	$result = $oService->insertData();
}
else if($mode == 'update') {
	$result = $oService->updateData();
}
else if($mode == 'delete') {
	$data_table = $oService->get('data_table');
	$pk = $oService->get('pk');
	$uid = $oService->get('uid');
	$tmp = $data = dbOnce($data_table, "sh_code", "where $pk = '$uid'", "");

	$result = $oService->deleteData();
	$oService->sortOrder($tmp['sh_code']);
}
else if($mode == 'change_order') {
	$uid = $oService->get('uid');
	$result = $oService->changeOrder($uid, $direction);

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
