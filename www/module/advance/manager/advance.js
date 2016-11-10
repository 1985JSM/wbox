$(document).ready(function() {

	
});

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}

	if(!f.ad_price.value || f.ad_price.value < 1) {
		alert("선불제가격을 입력하세요.");
		f.ad_price.focus();
		return false;
	}

	var ad_type = f.ad_type.value;
	if(ad_type == "M" && (!f.ad_money.value || f.ad_money.value < 1)) {
		alert("정액요금을 입력하세요.");
		f.ad_money.focus();
		return false;		
	}
	else if(ad_type == "Q" && (!f.ad_quantity.value || f.ad_quantity.value < 1)) {
		alert("이용횟수를 입력하세요.");
		f.ad_quantity.focus();
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