$(document).ready(function() {

	
});

/* 검색폼 유효성 검사 */
function submitSearchForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	return true;
}

/* 패스워드 변경폼 유효성 검사 */
function submitPasswordForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	if(f.mb_pass.value != f.mb_pass2.value) {
		alert("비밀번호가 정확하지 않습니다.");
		f.mb_pass2.focus();
		return false;
	}

	return true;
}