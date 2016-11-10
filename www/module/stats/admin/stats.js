$(document).ready(function() {

	
});

/* 검색폼 유효성 검사 */
function submitSearchForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	return true;
}

// 시/군/구 변경
function changeSigungu(sch_sido) {

	sch_sido = encodeURIComponent(sch_sido);

	$.ajax({
		url : "./process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_sigungu&sch_sido=" + sch_sido,
		cache: false,
		async: false,
		success : function(result) {				
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				$("#sch_sigungu").html(result.content).trigger("change");				
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}
