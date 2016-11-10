// 입력 폼 검증
function submitWriteForm(f) {
	return validateForm(f);
}

// 시/군/구 변경
function changeSigungu(ap_sido) {

	ap_sido = encodeURIComponent(ap_sido);

	$.ajax({
		url : "./process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_sigungu&ap_sido=" + ap_sido,
		cache: false,
		async: false,
		success : function(result) {	
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				$("#ap_sigungu").html(result.content);				
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

// 읍/면/동 변경
function changeDong(ap_sido, ap_sigungu) {

	ap_sido = encodeURIComponent(ap_sido);
	ap_sigungu = encodeURIComponent(ap_sigungu);

	$.ajax({
		url : "./process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_dong&ap_sido=" + ap_sido + "&ap_sigungu=" + ap_sigungu,
		cache: false,
		async: false,
		success : function(result) {	
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				$("#ap_dong").html(result.content);				
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}