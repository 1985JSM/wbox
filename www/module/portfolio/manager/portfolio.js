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
		if(!$("input[name='wr_file[]']", f).eq(0).val()) {
			alert("파일을 선택하세요.");
			return false;
		}
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

/* 댓글 입력 폼 유효성 검사 */
function submitWriteCommentForm(f) {
	if(!validateForm(f)) {
		return false;
	}

	return true;
}