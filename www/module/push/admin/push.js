$(document).ready(function() {

	
});

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	if(!validateForm(f)) {
		return false;
	}
	
	return true;
}
