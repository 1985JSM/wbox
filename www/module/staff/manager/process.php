<?
if(!defined('_INPLUS_')) { exit; } 

$oStaff = new StaffManager();
$oStaff->init();

if($_SERVER['REMOTE_ADDR'] == '211.35.19.138') {
//	print_r($_POST['s_hl_time']); exit;

}

if($mode == 'insert') {
	$result = $oStaff->insertData();
}
else if($mode == 'update') {
	$result = $oStaff->updateData();
}
else if($mode == 'delete') {
	$result = $oStaff->deleteData();
}
else if($mode == 'change_order') {
	$uid = $oStaff->get('uid');
	$result = $oStaff->changeOrder($uid, $direction);

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
