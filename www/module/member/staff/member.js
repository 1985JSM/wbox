/**
* login
*/
// 로그인 폼 초기화
function initLogin(push_os, push_id, mb_hp) {
	var f = document.login_form;

	f.mb_push_os.value = push_os;
	f.mb_push_id.value = push_id;
	//f.mb_hp.value = mb_hp;
}

// 로그인 폼 검증
function submitLoginForm(f) {
	return validateForm(f);
}

// 이메일 체크
function checkMemberEmail() {
	var mb_email = $("#mb_email").val();
	var flag = false;		

	$.ajax({
		url : "./process.html",
		type : "post",
		dataType : "json",
		data : {
			"mode"		: "check_member_email",
			"mb_email"	: mb_email
		},
		cache: false,
		async: false,
		success : function(result) {	

			var txt_msg = result.msg;
			txt_msg = $("#state_mb_email").text(txt_msg);

			if(result.code == "ok") {
				$("input[name=chk_mb_email]").val("1");
				flag = true;
			} else {
				$("input[name=chk_mb_email]").val("0");
			}
		},
		error : function(e) {			
			alert(msg_arr["ajax_error"]);
		}
	});

	return flag;
}

// 닉네임 체크
function checkMemberNick() {
	var mb_nick = $("#mb_nick").val();
	var flag = false;		

	$.ajax({
		url : "./process.html",
		type : "post",
		dataType : "json",
		data : {
			"mode"		: "check_member_nick",
			"mb_nick"	: mb_nick
		},
		cache: false,
		async: false,
		success : function(result) {	

			var txt_msg = result.msg;
			txt_msg = $("#state_mb_nick").text(txt_msg);

			if(result.code == "ok") {
				$("input[name=chk_mb_nick]").val("1");
				flag = true;
			} else {
				$("input[name=chk_mb_nick]").val("0");
			}
		},
		error : function(e) {			
			alert(msg_arr["ajax_error"]);
		}
	});

	return flag;
}

// 휴대폰 번호 검증
function validateHp() {
	if(!$("#mb_hp_comp").val()) {
		alert("통신사를 입력하세요.");
		$("#mb_hp_comp").focus();
		return false;
	}

	var mb_hp = $("#mb_hp").val();
	if(!mb_hp || mb_hp.length < 10) {			
		alert("휴대폰번호를 입력하세요.");
		$("#mb_hp").focus();
		return false;
	}

	// 이미 검증했는지 검사
	if($("#flag_validate_auth_no").val() == "Y") {
		alert("이미 인증이 완료되었습니다.");
		return false;
	}

	return true;
}

// 인증번호 발송
function sendAuthNo(obj) {

	// 휴대폰 번호 검증
	if(!validateHp()) {
		return false;		
	}

	var arr = $(obj).attr("href").split("?");
	var href = arr[0];
	$(obj).prop("href", href + "?mb_hp=" + $("#mb_hp").val());
	$("#flag_send_auth_no").val("Y");
	getContentsbyAjax(obj);
}

// 인증번호 검증
function validateAuthNo(obj) {

	// 휴대폰 번호 검증
	if(!validateHp()) {
		return false;		
	}

	// 발송했는지 검사
	if($("#flag_send_auth_no").val() != "Y") {
		alert("인증번호를 발송하세요.");
		$("#btn_send_auth_no").focus();
		return false;
	}

	// 인증번호 검증
	var auth_no = $("#auth_no").val();
	if(!auth_no || auth_no.length < 6) {
		alert("인증번호를 정확하게 입력하세요.");
		$("#auth_no").focus();
		return false;
	}

	var arr = $(obj).attr("href").split("?");
	var href = arr[0];
	$(obj).prop("href", href + "?mb_hp=" + $("#mb_hp").val() + "&auth_no=" + auth_no);
	getContentsbyAjax(obj);
}

// 전체동의
function toggleCheckAgree() {
	var obj_chk = $("input.chk_agree");

	if(obj_chk.filter(":checked").length == 5) {
		obj_chk.removeProp("checked");
	} else {
		obj_chk.prop("checked", true);
	}
}

// 약관 자세히보기
function toggleAgreeDetail(obj) {
	var obj_par = $(obj).parent();
	if(obj_par.hasClass("on")) {
		obj_par.removeClass("on");
	} else {
		obj_par.addClass("on");
	}
}

// 인증창 닫기
function closeAuthLayer() {
	closeLayerPopup();
	//$("#auth_no").focus();
}

// 입력폼 검증
function submitWriteForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}

	// 이메일
	if(!submitEmailForm(f)) {
		return false;
	}

	// 비밀번호
	if(!submitPasswordForm(f)) {
		return false;
	}

	// 인증번호
	if(!submitHpForm(f)) {
		return false;
	}

	// 닉네임
	if(!submitNickForm(f)) {
		return false;
	}

	return true;
}

/**
* modify
*/
// 비밀번호 체크 폼 검증
function submitCheckPasswordForm(f) {
	return validateForm(f);
}

// 이메일 변경
function changeModifyEmail(mode) {
	if(mode == "update") {
		$("div.mod_mail01").hide();
		$("div.mod_mail02").show();	
	}
	else if(mode == "view") {
		$("div.mod_mail01").show();
		$("div.mod_mail02").hide();
	}
}

// 이메일 수정 폼 검증
function submitEmailForm(f) {
	if(!checkMemberEmail()) {
		alert("이메일을 정확하게 입력하세요.");
		$("#mb_email").focus();
		return false;
	}

	return true;
}

// 비밀번호 수정 폼 검증
function submitPasswordForm(f) {

	if(!f.mb_pass.value || f.mb_pass.value.length < 6 || f.mb_pass.value.length > 20) {
		alert("비밀번호를 정확하게 입력하세요.");
		f.mb_pass.focus();
		return false;
	}

	if(f.mb_pass.value != f.mb_pass2.value) {
		alert("비밀번호가 동일하지 않습니다.");
		f.mb_pass.focus();
		return false;
	}

	return true;
}

// 기본정보 수정 폼 검증
function submitDefaultForm(f) {
	return validateForm(f);
}

// 휴대폰 변경
function changeModifyHp(mode) {
	if(mode == "update") {
		$("div.mod_tel01").hide();
		$("div.mod_tel02").show();	
	}
	else if(mode == "view") {
		$("div.mod_tel01").show();
		$("div.mod_tel02").hide();
	}
}

// 휴대폰 수정 폼 검증
function submitHpForm(f) {
	if(f.flag_validate_auth_no.value != "Y") {
		alert("인증번호가 정확하지 않습니다.");
		f.mb_hp.focus();
		return false;
	}

	return true;
}

// 닉네임 수정 폼 검증
function submitNickForm(f) {
	if(!checkMemberNick()) {
		alert("닉네임을 정확하게 입력하세요.");
		$("#mb_nick").focus();
		return false;
	}

	return true;
}

// 근무시간 수정 폼 검증
function submitSettingForm(f) {
	return validateForm(f);
}
