/* main section : S */
function initMainSection() {

	main_section = $("div.main_section");
	var sum_height = main_section.eq(0).offset().top * 1;
	main_section_arr[0] = sum_height;
	for(var i = 0 ; i < main_section.length ; i++) {
		var idx = i * 1 + 1;
		sum_height += main_section.eq(i).height() * 1;
		main_section_arr[idx] = sum_height;
	}	

	setMainSectionNo();
}

function setMainSectionNo() {

	var sc_top = $(document).scrollTop() * 1;

	main_section_edge = false;
	for(var i = 0 ; i < main_section_arr.length ; i++) {
		var idx = i * 1 + 1;

		if(sc_top == main_section_arr[idx]) {
			main_section_edge = true;
		}

		if(sc_top < main_section_arr[idx]) {
			main_section_idx = i;
			break;
		}
	}

	var main_section_no = main_section_idx * 1 + 1;
	var main_section_cnt = main_section.length;
	//$("#txt_main_section").text(main_section_no + " / " + main_section_cnt);
}

function moveMainSection(mode) {

	var new_idx = main_section_idx;
	if(mode == "next") {
		new_idx = new_idx * 1 + 1;
	}
	else if(mode == "prev" && main_section_edge) {
		new_idx = new_idx * 1 - 1;
	}

	if(new_idx >= 0 && new_idx < main_section.length) {		
		var new_sc = main_section_arr[new_idx];
		$("html, body").stop().animate({ scrollTop : new_sc }, "normal", function(e) {
			setMainSectionNo();
		});
	}
}
/* main section : E */

/* 검색폼 유효성 검증 */
function submitSearchForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	ajaxSubmit(f, function(result) {

	});

	return false;
}

/* 입력폼 유효성 검증 */
function submitWriteForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	ajaxSubmit(f, function(result) {
		alert("등록이 정상적으로 처리되었습니다.\n\n감사합니다.");
		closeLayerPopup();
	});

	return false;
}

/* 시/도 선택으로 인한 시/구/군 목록 갱신 */
function changeSigungu(sido) {

	sido = encodeURIComponent(sido);

	$.ajax({
		url : "/page/process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_sigungu&sido=" + sido,
		cache: false,
		async: false,
		success : function(result) {	
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				$("select.sigungu").html(result.content);				
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

/* 시/구/군 선택으로 인한 읍/면/동 목록 갱신 */
function changeDong(sido, sigungu) {

	sido = encodeURIComponent(sido);
	sigungu = encodeURIComponent(sigungu);

	$.ajax({
		url : "/page/process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=select_dong&sido=" + sido + "&sigungu=" + sigungu,
		cache: false,
		async: false,
		success : function(result) {	
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				$("select.dong").html(result.content);				
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}