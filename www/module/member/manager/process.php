<?
if(!defined('_INPLUS_')) { exit; } 

$oMember = new MemberManager();
$oMember->init();

if($mode == 'login') {
	$result = $oMember->login();
	if($result['code'] == 'login_ok') {
		movePage($result['url']);
		exit;
	}
}
else if($mode == 'logout') {
	$result = $oMember->logout();
}
else if($mode == 'check_member_id') {
	$result = $oMember->checkMemberId($mb_id);	
	echo json_encode($result);
	exit;
}
else if($mode == 'insert') {
	$result = $oMember->insertData();
}
else if($mode == 'update_password') {
	$result = $oMember->updatePassword();
}
else if($mode == 'check_sales_password') {
	// 정산 비밀번호 확인
	$result = $oMember->checkSalesPassword();	
	if($result['code'] == 'ok') {
		movePage($result['url']);
		exit;
	}
}
else if($mode == 'update_sales_pw') {
	$result = $oMember->updateSalesPassword();
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
