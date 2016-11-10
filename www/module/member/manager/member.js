/* 아이디 검사 */
function checkMemberId() {
	var mb_id = $("#mb_id").val();
	var flag = false;
		
	$.ajax({
		url : "/webmanager/member/process.html",
		type : "post",
		dataType : "json",
		data : {
			"mode"	: "check_member_id",
			"mb_id"	: mb_id
		},
		cache: false,
		async: false,
		success : function(result)
		{	
			if(result.code == "ok") {
				$("input[name=chk_mb_id]").val("1");
				$("#state_mb_id").html("사용가능");
				flag = true;
			}
			else {
				$("input[name=chk_mb_id]").val("0");
				$("#state_mb_id").html("사용불가");
				alert(result.msg);
			}
		},
		error : function(e)
		{			
			alert(msg_arr["ajax_error"]);
		}
	});

	return flag;
}

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	// 비밀번호 검사
	if(f.mb_pass.value != f.mb_pass2.value) {
		alert("비밀번호가 정확하지 않습니다.");
		f.mb_pass2.focus();
		return false;
	}

	// 아이디 검사
	return checkMemberId(f.mb_id.value);
}

/* 로그인폼 검증 */
function submitLoginForm(f) {
	return validateForm(f);
}

// 시/군/구 변경
function changeSigungu(sh_sido) {

	sh_sido = encodeURIComponent(sh_sido);

	$.ajax({
		url : "/webuser/application/process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_sigungu&ap_sido=" + sh_sido,
		cache: false,
		async: false,
		success : function(result) {	
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				$("#sh_sigungu").html(result.content).trigger("change");				
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

// 읍/면/동 변경
function changeDong(sh_sido, sh_sigungu) {

	sh_sido = encodeURIComponent(sh_sido);
	sh_sigungu = encodeURIComponent(sh_sigungu);

	$.ajax({
		url : "/webuser/application/process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_dong&ap_sido=" + sh_sido + "&ap_sigungu=" + sh_sigungu,
		cache: false,
		async: false,
		success : function(result) {	
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				$("#sh_dong").html(result.content).trigger("change");				
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

/* 정산 패스워드폼 유효성 검사 */
function submitSalesAuthForm(f) {
	if(!validateForm(f)) {
		return false;
	}

	if(f.sales_pw.value != f.sales_pw2.value) {
		alert("매출확인 비밀번호가 일치하지 않습니다.");
		f.sales_pw2.focus();
		return false;
	}

	return true;

}

/* 패스워드 변경폼 유효성 검사 */
function submitUpdatePasswordForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	if(f.mb_pass.value == f.new_pass.value) {
		alert("신규 비밀번호는 현재 비밀번호와 다르게 설정해야 합니다.");
		f.new_pass.focus;
		return false;
	}

	if(f.new_pass.value != f.new_pass2.value) {
		alert("비밀번호가 일치하지 않습니다.");
		f.new_pass2.focus();
		return false;
	}

	return true;
}