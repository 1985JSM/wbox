$(document).ready(function() {

	
});

// 이메일 체크
function checkMemberEmail() {
	var mb_email = $("#mb_email").val();
	var df_email = document.write_form.df_email.value;
	var flag = false;		

	$.ajax({
		url : "/webstaff/member/process.html",
		type : "post",
		dataType : "json",
		data : {
			"mode"		: "check_member_email",
			"mb_email"	: mb_email,
			"df_email"	: df_email
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

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}

	// 서비스
	if($("input.sv_code", f).filter(":checked").length == 0) {
		alert("서비스를 1개 이상 선택하세요.");
		return false;
	}

	if(f.mode.value == "insert") {	

		// 이메일
		if(!checkMemberEmail()) {
			return false;
		}

		// 비밀번호 검사
		if(f.mb_pass.value != f.mb_pass2.value) {
			alert("비밀번호가 정확하지 않습니다.");
			f.mb_pass2.focus();
			return false;
		}

		return true;
	}		
	else {
		// 이메일
		if(f.df_email.value != f.mb_email.value && !checkMemberEmail()) {
			return false;
		}

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

/* 휴무 일정 추가 */
function addHoliday() {

	var obj_holiday = $("#holiday_list");
	var idx = $("input.hl_memo", obj_holiday).length;

	$.ajax({
		url : "./ajax_holiday_list.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=add&idx=" + idx,
		cache: false,
		async: false,
		success : function(result) {				
			if(idx == 0) {
				obj_holiday.html("");
			}
			obj_holiday.append(result.content);
			initContent($("tr", obj_holiday).eq(-1));
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

/* 휴무 일정 삭제 */
function delHoliday(obj) {
	$(obj).parent("td").parent("tr").remove();
}

/* 종일 */
function toggleHolidayTime(obj) {

	var obj_chk = $(obj);
	var obj_par = obj_chk.parent("label").parent("td");
	if(obj_chk.is(":checked")) {
		obj_par.find("div.selector").addClass("disabled");
		$("select.s_hl_time", obj_par).find("option").not(":eq(0)").removeAttr("selected").attr("disabled", true).end().eq(0).attr("selected", true).parent("select").trigger("change");
		$("select.e_hl_time", obj_par).find("option").not(":eq(-1)").removeAttr("selected").attr("disabled", true).end().eq(-1).attr("selected", true).parent("select").trigger("change");
		obj_par.find("input.hl_all_time").val("1").attr("value", "1");
	}
	else {
		obj_par.find("div.selector").removeClass("disabled");
		obj_par.find("input.hl_all_time").val("").attr("value", "");
	}
}

function initHolidayAllTime() {

	var obj_chk = $("input.hl_chk_all").filter(":checked");
	for(var i = 0 ; i < obj_chk.length ; i++) {
		var obj_par = obj_chk.parent("label").parent("td");
		obj_par.find("div.selector").addClass("disabled");
		$("select.s_hl_time", obj_par).find("option").not(":eq(0)").removeAttr("selected").attr("disabled", true).end().eq(0).attr("selected", true).parent("select").trigger("change");
		$("select.e_hl_time", obj_par).find("option").not(":eq(-1)").removeAttr("selected").attr("disabled", true).end().eq(-1).attr("selected", true).parent("select").trigger("change");
		obj_par.find("input.hl_all_time").val("1").attr("value", "1");
	}
}