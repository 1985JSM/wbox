$(document).ready(function() {

	/* 정렬 기준 */
	$("#sch_order_field").on("change", function() {
		var f = document.search_form;
		f.sch_order_field.value = $(this).val();
		if(f.onsubmit()) {
			f.submit();
		}
	});

	/* 출력 개수 */
	$("#sch_cnt_rows").on("change", function() {
		var f = document.search_form;
		f.sch_cnt_rows.value = $(this).val();
		if(f.onsubmit()) {
			f.submit();
		}
	});
});

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