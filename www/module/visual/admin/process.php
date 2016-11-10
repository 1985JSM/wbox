<?
if(!defined('_INPLUS_')) { exit; } 

$oVisual = new VisualAdmin();
$oVisual->init();

if($mode == 'insert') {
	$result = $oVisual->insertData();
}
else if($mode == 'update') {
	$result = $oVisual->updateData();
}
else if($mode == 'delete') {
	$result = $oVisual->deleteData();
}
else if($mode == 'change_order') {
	$uid = $oVisual->get('uid');
	$result = $oVisual->changeOrder($uid, $direction);

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
