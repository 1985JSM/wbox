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
		url : "/webstaff/member/process.html",
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