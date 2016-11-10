<?
if(!defined('_INPLUS_')) { exit; } 

$oApplication = new ApplicationAdmin();
$oApplication->init();

if($mode == 'insert') {
	$result = $oApplication->insertData();
}
else if($mode == 'update') {
	$result = $oApplication->updateData();
}
else if($mode == 'update_state') {
	$result = $oApplication->updateState();
}
else if($mode == 'delete') {
	$result = $oApplication->deleteData();
}
else if($mode == 'select_sigungu') {
	// 시/군/구
	$ap_sido = urldecode($ap_sido);
	$result = $oApplication->selectApSigungu($ap_sido);	
	echo $result['content'];
}
else if($mode == 'select_dong') {
	// 읍/면/동
	$ap_sido = urldecode($ap_sido);
	$ap_sigungu = urldecode($ap_sigungu);
	$result = $oApplication->selectApDong($ap_sido, $ap_sigungu);	
	echo $result['content'];
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
