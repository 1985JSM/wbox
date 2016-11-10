$(document).ready(function() {

	
});

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}

	// 할인금액
	if(f.cp_type.value == "S" && !f.cp_sale_price.value) {
		alert("할인금액(율)을 입력하세요.");
		f.cp_sale_price.focus();
		return false;
	}

	// 사용등급
	if(!$("input.cp_levels").filter(":checked").length) {
		alert("사용등급을 최소 1개 이상 선택하세요.");
		return false;
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