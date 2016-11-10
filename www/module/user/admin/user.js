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

/* 선택 삭제 */
function deleteLeaveMember() {

	var f = document.list_form;
	if(!$("input[name='del_uid[]']", f).filter(":checked").length) {
		alert("삭제할 고객을 선택하세요.");
		return false;
	}

	f.mode.value = "delete";
	f.submit();
}

/* 선택 삭제 */
function cancelLaeveMember() {

	var f = document.list_form;
	if(!$("input[name='del_uid[]']", f).filter(":checked").length) {
		alert("탈퇴 취소할 고객을 선택하세요.");
		return false;
	}

	f.mode.value = "cancel_leave";
	f.submit();
}