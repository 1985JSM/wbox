<?
if(!defined('_INPLUS_')) { exit; } 

$oMember = new MemberAdmin();
$oMember->init();

if($mode == 'login') {
	$result = $oMember->login();
	if($result['code'] == 'login_ok') {
		movePage($result['url']);
		exit;
	}
}
if($mode == 'logout') {
	$result = $oMember->logout();
}
else if($mode == 'check_member_id') {
	$result = $oMember->checkMemberId($mb_id);	
	echo json_encode($result);
	exit;
}
else if($mode == 'update_password') {
	$result = $oMember->updatePassword();
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
