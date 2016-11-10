<?
if(!defined('_INPLUS_')) { exit; } 

$oMember = new MemberUser();
$oMember->init();

if($mode == 'login') {
	// 로그인
	$result = $oMember->login();
	if($result['code'] == 'login_ok') { 
		callNative('storeMemberId/'.$result['mb_id'], $result['url']);
		exit;
	}
}
else if($mode == 'login_from_app') {
	// 앱을 통한 자동 로그인
	$result = $oMember->loginFromApp();
	movePage($result['url']);
	exit;
}
else if($mode == 'logout') {
	// 로그아웃
	$result = $oMember->logout();
	callNative('storeMemberId/'.$result['mb_id'], $result['url']);
	exit;
}
else if($mode == 'check_member_email') {
	// 이메일 중복 검사
	$result = $oMember->checkMemberEmail($mb_email);	
	echo json_encode($result);
	exit;
}
else if($mode == 'check_member_nick') {
	// 닉네임 중복 검사
	$result = $oMember->checkMemberNick($mb_nick);	
	echo json_encode($result);
	exit;
}
else if($mode == 'check_password') {
	// 비밀번호 확인 (from 개인정보 수정 진입시)
	$result = $oMember->checkPassword($mb_email);	
	if($result['code'] == 'ok') {
		movePage($result['url']);
		exit;
	}
}
else if($mode == 'update_reg_id') {
	// device > push_id 수정
	$result = $oMember->updateRegId();
	echo json_encode($result);
	exit;
}
else if($mode == 'insert') {
	// 회원 등록
	$result = $oMember->insertData();
	movePage($result['url']);
	exit;
}
else if($mode == 'update_email') {
	// 이메일 수정
	$result = $oMember->updateEmail();
	movePage($result['url']);
	exit;
}
else if($mode == 'update_password') {
	// 비밀번호 변경
	$result = $oMember->updatePassword();
	movePage($result['url']);
	exit;
}
else if($mode == 'update_default') {
	// 기본정보 수정
	$result = $oMember->updateDefault();
	movePage($result['url']);
	exit;
}
else if($mode == 'update_hp') {
	// 휴대폰 수정
	$result = $oMember->updateHp();
	movePage($result['url']);
	exit;
}
else if($mode == 'update_nick') {
	// 닉네임 수정
	$result = $oMember->updateNick();
	movePage($result['url']);
	exit;
}
else if($mode == 'update_pr') {
	// 한줄소개 수정
	$result = $oMember->updatePr();
	movePage($result['url']);
	exit;
}
else if($mode == 'update_flag_use_push') {
	// 푸시 사용 수정
	$result = $oMember->updateFlagUsePush();
	echo json_encode($result);
	exit;
}
else if($mode == 'leave') {
	// 회원탈퇴
	$result = $oMember->leaveMember();
}
else if($mode == 'upload_photo') {
	// 프로필 사진 업로드
	$uid = $_POST['uid'];
	$result = $oMember->uploadPhoto($uid);
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
