$(document).ready(function() {

	
});

function submitSearchPortfolioForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	if(f.sch_keyword.value.length < 2) {
		alert("검색어는 2글자 이상 입력해주세요.");
		f.sch_keyword.focus();
		return false;
	}

	return true;
}