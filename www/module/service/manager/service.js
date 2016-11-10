$(document).ready(function() {

	
});

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}

	// 가격
	if(delComma(f.sv_normal_price.value) * 1 < delComma(f.sv_sale_price.value) * 1) {
		alert("할인가가 일반가보다 큽니다.");
		f.sv_sale_price.focus();
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

/* 순서 변경 */
function changeOrder(direction, obj) {

	var obj_li = $("li.list_li");
	var cnt_li = obj_li.length;
	var idx = obj_li.index($(obj).parent("div").parent("li"));

	if(direction == "up" && idx == 0) {
		alert("첫번째 서비스입니다.\n\n더이상 순서를 올릴 수 없습니다.");
		return false;
	}
	else if(direction == "down" && idx == cnt_li - 1) {
		alert("마지막 서비스입니다.\n\n더이상 순서를 내릴 수 없습니다.");
		return false;
	}

	var sv_id = $(obj).parent("div").find("input[name=sv_id]").val();


	$.ajax({
		url : "./process.html",
		type : "post",
		dataType : "json",
		data : "flag_json=1&mode=change_order&direction=" + direction + "&sv_id=" + sv_id,
		cache: false,
		async: false,
		success : function(result) {
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				if(direction == "up") {
					// 위로
					obj_li.eq(idx).after(obj_li.eq(idx-1));
				}
				else if(direction == "down") {
					// 아래로
					obj_li.eq(idx).before(obj_li.eq(idx * 1 + 1));
				}
			}
		},
		error : function(e)	{
			alert(msg_arr["ajax_error"]);
		}
	});

}