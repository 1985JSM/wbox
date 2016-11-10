$(document).ready(function() {

	
});

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}

	// 등록/수정
	if(f.mode.value == "insert") {	

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
	}
	
	return true;	
}

/* 검색폼 유효성 검사 */
function submitSearchForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	return true;
}

/* 순서 변경 */
function changeOrder(direction, obj) {
	
	var obj_tr = $("tr.list_tr");
	var cnt_tr = obj_tr.length;
	var idx = obj_tr.index($(obj).parent("td").parent("tr"));

	if(direction == "up" && idx == 0) {
		alert("첫번째 추천샵입니다.\n\n더이상 순서를 올릴 수 없습니다.");
		return false;
	}
	else if(direction == "down" && idx == cnt_tr - 1) {
		alert("마지막 추천샵입니다.\n\n더이상 순서를 내릴 수 없습니다.");
		return false;
	}

	var rc_id = $(obj).parent("td").find("input[name=rc_id]").val();
	
	$.ajax({
		url : "./process.html",
		type : "post",
		dataType : "json",
		data : "flag_json=1&mode=change_order&direction=" + direction + "&rc_id=" + rc_id,
		cache: false,
		async: false,
		success : function(result) {		
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {				
				if(direction == "up") {
					// 위로
					obj_tr.eq(idx).after(obj_tr.eq(idx-1));
				}
				else if(direction == "down") {
					// 아래로
					obj_tr.eq(idx).before(obj_tr.eq(idx * 1 + 1));
				}				
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

/* 가맹점 검색 */
function submitSearchShopForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	ajaxSubmit(f, function(result) {

	});

	return false;

}