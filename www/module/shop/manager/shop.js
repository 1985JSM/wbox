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

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	if(!validateForm(f)) {
		return false;
	}
	
	// 첨부파일
	var obj_file = $("input[name='wr_file[]']", f);
	var obj_del = $("input[name='del_file[]']", f);
	for(var i = 0 ; i < obj_file.length ; i++) {
		if (obj_file.eq(i).hasClass("required")) {
			if ((obj_file.eq(i).val() == "") && (obj_del.eq(i).attr("checked") == "checked")) {
				alert("대표 이미지는 필수입니다.");
				return false;
			}
		}

		if(obj_file.eq(i).val() && i < obj_del.length) {
			obj_del.eq(i).attr("checked", true);
		}
	}

	// 위/경도
	var new_addr = f.sh_sido.value + " " + f.sh_sigungu.value + " " + f.sh_dong.value + " " + f.sh_addr2.value;
	if(new_addr != pre_addr) {
		f.sh_lat.value = "";
		f.sh_lng.value = "";
	}

	return true;	
}

// 시/군/구 변경
function changeSigungu(sh_sido) {

	sh_sido = encodeURIComponent(sh_sido);

	$.ajax({
		url : "./process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_sigungu&sh_sido=" + sh_sido,
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
	//alert(sh_sido);
	//location.href = "./process.html?flag_json=1&mode=select_sigungu&sh_sido=" + sh_sido;
}

// 읍/면/동 변경
function changeDong(sh_sido, sh_sigungu) {

	sh_sido = encodeURIComponent(sh_sido);
	sh_sigungu = encodeURIComponent(sh_sigungu);

	$.ajax({
		url : "./process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_dong&sh_sido=" + sh_sido + "&sh_sigungu=" + sh_sigungu,
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

