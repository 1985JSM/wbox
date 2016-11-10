/* 동 검색 유효성 검사 */
function submitSearchDongForm(f) {
	if(!validateForm(f)) {
		return false;
	}

	if(f.sch_dong.value.length < 2) {
		alert("동이름은 2글자 이상 입력해주세요.");
		f.sch_dong.focus();
		return false;
	}

	ajaxSubmit(f);

	return false;
}

/* 알림 설정 */
function togglePushSwitch(obj) {
	var obj_switch = $("div.flipswitch", obj);
	var flag_use_push = "";
	if(obj_switch.hasClass("on")) {
		obj_switch.removeClass("on");
		flag_use_push = "N";
	}
	else {
		obj_switch.addClass("on");
		flag_use_push = "Y";
	}

	$.ajax({
		url : "/webuser/member/process.html",
		type : "post",
		dataType : "json",
		data : "flag_json=1&mode=update_flag_use_push&flag_use_push=" + flag_use_push,
		cache: false,
		async: false,
		success : function(result) {				
			callNative("storeFlagUsePush/" + flag_use_push);
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		},
		complete : function() {		
			$("#loader").hide();
			
		}
	});
}

/* GPS 환경 설정 */
function openGpsConfig() {
	callNative("moveConfigGps");
}