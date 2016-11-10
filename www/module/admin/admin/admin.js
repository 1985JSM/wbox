$(document).ready(function() {

	
});

/* 아이디 검사 */
function checkMemberId() {
	var mb_id = $("#mb_id").val();
	var flag = false;
		
	$.ajax({
		url : "/webadmin/member/process.html",
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

/* 권한 변경 */
function changeMbAuthList(obj) {
	var mb_level = $(obj).val();
	var obj_auth = $("input.auth_code");

	if(mb_level == "9") {
		obj_auth.attr("checked", true);
	}
	else if(mb_level == "7") {
		obj_auth.not(":eq(0)").attr("checked", true).end().eq(0).removeAttr("checked");
	}
	else if(mb_level == "5") {
		obj_auth.not(":eq(0)").not(":eq(4)").attr("checked", true).end().end().eq(0).removeAttr("checked").end().eq(4).removeAttr("checked");
	}

}

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	if(!validateForm(f)) {
		return false;
	}
	
	if(f.mode.value == "insert") {	

		// 비밀번호 검사
		if(f.mb_pass.value != f.mb_pass2.value) {
			alert("비밀번호가 정확하지 않습니다.");
			f.mb_pass2.focus();
			return false;
		}

		// 아이디 검사
		return checkMemberId(f.mb_id.value);
	}		
	else {
		// 첨부파일
		var obj_file = $("input[name='wr_file[]']", f);
		var obj_del = $("input[name='del_file[]']", f);
		for(var i = 0 ; i < obj_file.length ; i++) {
			if(obj_file.eq(i).val() && i < obj_del.length) {
				obj_del.eq(i).attr("checked", true);
			}
		}

		return true;
	}

	return false;	
}

/* 검색폼 유효성 검사 */
function submitSearchForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	return true;
}

/* 리스트폼 유효성 검사 */
function submitListForm(f) {

	if(!$("input.list_check", f).filter(":checked").length) {
		alert("삭제할 데이터를 1건 이상 선택하세요.");
		return false;
	}

	if(!confirm("삭제 후 복구가 불가능합니다.\n\n정말 삭제하시겠습니까?")) {
		return false;
	}

	return true;
}