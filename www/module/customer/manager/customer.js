$(document).ready(function() {

	
});

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
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

/* 선불제등록 */
function changeAdvanceId(obj) {
	var ad_id = $(obj).val();
	var ad_info = ad_list[ad_id];

	var f = document.advance_purchase_form;
	f.ad_pc_type.value = ad_info.ad_type;
	f.ad_pc_name.value = ad_info.ad_name;	
	f.ad_pc_price.value = setComma(ad_info.ad_price);
	f.ad_pc_money.value = setComma(ad_info.ad_money);
	f.ad_pc_quantity.value = setComma(ad_info.ad_quantity);
	f.ad_pc_expire.value = ad_info.ad_expire;

	var ad_type = f.ad_pc_type.value
	$("#write_tbody").attr("class", "ad_type_" + ad_type);

}

function submitAdvancePurchaseForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	//return true;

	ajaxSubmit(f, function(result) {

		closeLayerPopup();
	});

	return false;
}

function submitAdvanceChargeForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	if(!f.ad_pc_price.value || f.ad_pc_price.value < 1) {
		alert("결제금액을 입력하세요.");
		f.ad_pc_price.focus();
		return false;
	}

	if(f.ad_pc_type.value == "M" && (!f.ad_pc_money.value || f.ad_pc_money.value < 1)) {
		alert("충전금액을 입력하세요.");
		f.ad_pc_money.focus();
		return false;
	}

	if(f.ad_pc_type.value == "Q" && (!f.ad_pc_quantity.value || f.ad_pc_quantity.value < 1)) {
		alert("충전횟수 입력하세요.");
		f.ad_pc_quantity.focus();
		return false;
	}

	ajaxSubmit(f, function(result) {

		closeLayerPopup();
	});

	return false;

}