<?
if(!defined('_INPLUS_')) { exit; } 

$oManager = new ManagerAdmin();
$oManager->init();

if($mode == 'update_password') {
	$result = $oManager->updatePassword();	
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
