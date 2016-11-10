$(function() {

	/**
	* 공용
	*/

	/* 비로그인 */
	$(document).on("click", ".btn_only_login", function(e) {
		if(confirm("해당 서비스는 로그인 후 이용할 수 있습니다.\n\n로그인 페이지로 이동하시겠습니까?")) {
			location.replace(base_uri + "/webuser/member/login.html");
		}
		//alert("로그인 후 이용할 수 있습니다.");
		e.preventDefault();
	});
	
	$(document).on("click", "a.btn_layer_page", function(e) {
		// 레이어 페이지
		openLayerPage(this);
		e.preventDefault();		
	});


	/**
	* 예약하기
	*/
	$(document).on("change", "#reserve_st_id", function(e) {
		// 담당자 선택
		chooseStaff(this);
	}).on("click", "#reserve_sv_id", function(e) {
		// 서비스 클릭
		if(!checkChooseStaff(this)) {
			e.preventDefault();
		}
	}).on("change", "#reserve_sv_id", function(e) {
		// 서비스 선택
		chooseService(this);
	}).on("click", "a.btn_choose_date", function(e) {
		// 예약 캘린더
		//$("#reserve_calendar").find("td").removeClass("on");
		$("td.on").removeClass("on");
		$(this).parent("td").addClass("on");
	}).on("click", "a.btn_change_state", function(e) {
		// 예약 상태 변경
		changeReserveState(this);		
		e.preventDefault();
	});

	/**
	* 포트폴리오
	*/


	/* 날짜 선택 
	$("input.input_date").on("focus", function() {
		$(this).prop("type", "date");
	}).on("blur", function() {
		$(this).prop("type", "text");	
	});
	
	/*공유하기 레이어 이벤트
	$(".btn_share").click(function(){
		$(".layer.share_sns").show();
		$(".layer_bg").show();								
	});
	
	

	/*온오프 버튼
	$(".btn_switch").each(function(){
		$(this).click(function(){
			$(this).toggleClass("on");
		});
	});
	
	/*담당자 종료된예약
	$(".res2_list .list2 li a").each(function(){
		$(this).click(function(){
			if($(this).parent().hasClass("on")){
				$(this).parent().removeClass("on");
				$(this).parent().find(".cont").slideUp();
			}else{
				$(".res2_list .list2 li").removeClass("on");
				$(".res2_list .list2 li .cont").slideUp();
				$(this).parent().addClass("on");
				$(this).parent().find(".cont").slideDown();
			}
		});
	});

	/*일정관리 
	$(".time_list>li>span").click(function(){
		$(".layer.res_layer").show();
		$(".layer_bg").show();
	});

	/*리뷰관리 
	$(".btn_rep").each(function(){
		$(this).click(function(){
			$(".layer.rep_add").show();
			$(".layer_bg").show();
		});						
	});
	
	/*갤러리 등록
	$(".btn_add_photo").click(function(){
		$(".layer.photo_add").show();
		$(".layer_bg").show();
	});			
	
	/*예약보기 예약진행버튼
	$(".btn_next_rev").each(function(){
		$(this).click(function(){
								 
			$(".layer.point_layer").show();
			$(".layer_bg").show();
		});
	});
	*/
	
});

/**
* 네이티브 브릿지
*/

/* 네이티브 브릿지 호출 */
function callNative(param) {
	if(!is_webview) {
		alert("앱에서만 실행 가능한 기능입니다.");
		return false;
	}

	$("#native_bridge").prop("src", "native://" + param);
}


/* 상점정보 공유 */
function shareBySend(send_info) {
	callNative("shareBySend/" + send_info);
}

/* 인증번호 자동 수신&세팅 */
function setAuthNo(auth_no) {
	$("#auth_no").val(auth_no).attr("auth_no", auth_no);
}


/**
* 페이지 & 레이어 관련
*/

/* 백버튼 트리거 */
function triggerBackButton() {

	// 예약 레이어 검사
	if($("#layer_reserve").hasClass("open")) {
		closeReserveLayer();
		return;
	}

	// 레이어 팝업 검사
	if($("#layer_popup").hasClass("open")) {
		closeLayerPopup();
		return;
	}


	for(var i = 6 ; i > 0 ; i--) {
		if($("#layer_page" + i).hasClass("open")) {
			$("#layer_page" + i).removeClass("open");
			return;			
		}
	}

	// 백 URL 있는지 검사
	var back_url = $("#btn_back").attr("href");
	if(back_url) {
		location.replace(back_url);
	}
	else {
		callNative("confirmExit");
	}
}

/* 레이어 페이지 열기 */
function openLayerPage(obj) {
	obj = $(obj);
	var href = obj.attr("href");
	var target = obj.attr("target");

	$.ajax({
		url : href,
		type : "get",
		dataType : "json",
		data : "flag_json=1",
		cache: false,
		async: false,
		success : function(result) {		
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {				

				closeLayerPopup();
				closeReserveLayer();

				insertContent($(target), result.content);
				$(target).addClass("open").find("div.container").scrollTop(0);
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

/* 레이어 페이지 닫기 */
function closeLayerPage(layer_no) {
	$("#layer_page" + layer_no).removeClass("open");
}

/* 레이어로 폼 전송 */
function submitToLayerPage(f, func) {
	var f_action = f.action;
	var f_data = $(f).serialize();
	var f_method = f.method;
	var f_target = f.target;
	
	
	$.ajax({
		url : f_action,
		type : f_method,
		dataType : "json",
		data : f_data,
		cache: false,
		async: false,
		success : function(result) {		
			if(result.code == "error") { alert(result.msg); }
			else if(result.code == "ok") {
				closeLayerPopup();
				closeReserveLayer();

				insertContent($(f_target), result.content);
				$(f_target).addClass("open");

				if(typeof func == "function") { func(result); }
			}
		},
		error : function(e) {			
			alert(msg_arr["ajax_error"]);
		},
		complete : function() {
		
		}
	});
}

/* 다음 페이지 가지고 오기 */
function getNextPageByAjax(obj, f, func) {

	if(f.page.value < 2) {
		return;
	}

	var f_action = f.action;
	var f_data = $(f).serialize();
	var f_method = f.method;
	var f_target = f.target;

	var obj_container = $(obj);
	var obj_list = $(f_target);

	if(obj_container.scrollTop() * 1 + obj_container.height() * 1 >= obj_list.height() * 0.75) {
		var is_load = f.is_load.value;
		if(!is_load) {
			f.is_load.value = "1";
		
			$.ajax({
				url : f_action,
				type : f_method,
				dataType : "json",
				data : f_data,
				cache: false,
				async: false,
				success : function(result) {		
					if(result.code == "error") { alert(result.msg); }
					else if(result.code == "ok") {

						f.page.value = result.json_etc.next_page;
						f.is_load.value = "";

						if(result.content) {
							$div = $("<div />").html(result.content);
							initContent($div);
							obj_list.append($div.find(">li"));							
						}

						if(typeof func == "function") { func(result); }
					}
				},
				error : function(e) {			
					alert(msg_arr["ajax_error"]);
				},
				complete : function() {
				
				}
			});
			

		}
	}
}

/* 예약 퀵메뉴 레이어 열기 */
function openReserveLayer(sh_code) {
	if(!is_user) {
		//alert("로그인 후 이용할 수 있습니다.");
		if(confirm("해당 서비스는 로그인 후 이용할 수 있습니다.\n\n로그인 페이지로 이동하시겠습니까?")) {
			location.replace(base_uri + "/webuser/member/login.html");
		}
		return false;
	}

	$("#layer_back").show();
	$("#layer_reserve").addClass("open").find("a.btn_reserve_by_staff").attr("href", "../reserve/write.html?reserve_type=staff&sh_code=" + sh_code).end().find("a.btn_reserve_by_service").attr("href", "../reserve/write.html?reserve_type=service&sh_code=" + sh_code);
}

/* 예약 퀵메뉴 레이어 닫기 */
function closeReserveLayer() {
	$("#layer_back").hide();
	$("#layer_reserve").removeClass("open");//css({"bottom":"-300px"});
}


/**
* 상점 점보
*/

/* 나의 매장 토글 */
function toggleFavoriteShop(obj, sh_code) {

	var mode = "insert";
	if($(obj).hasClass("on")) {
		mode = "delete";
	}

	$.ajax({
		url : "../favorite/process.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1&mode=" + mode + "_by_ajax&sh_code=" + sh_code,
		cache: false,
		async: false,
		success : function(result) {	
			if(result.code == "insert_ok") {
				$(obj).addClass("on");
				//alert("나의 매장에 등록하였습니다.");
			}
			else if(result.code == "delete_ok") {
				$(obj).removeClass("on");
				//alert("나의 매장에서 제외하였습니다.");
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

/* 상점 좋아요 */
function toggleShopLike(obj, sh_code, like_type) {
	var mode = "like";
	if($(obj).hasClass("on")) {
		mode = "dislike";
	}

	$.ajax({
		url : "../shop/process.html",
		type : "post",
		dataType : "json",
		data : "flag_json=1&mode=" + mode + "&sh_code=" + sh_code + "&like_type=" + like_type,
		cache: false,
		async: false,
		success : function(result) {			
			$(obj).toggleClass("on").parent("div").parent("li").parent("ul").find("button").not(obj).removeClass("on");
			$("#cnt_shop_like_" + like_type).text(setComma(result.cnt_like));
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}


/* 서비스 더보기 */
function toggleMoreService(obj) {
	$(obj).parent("div").toggleClass("on");
}

/* 담당자 좋아요 */
function toggleStaffLike(obj, st_id) {

	var mode = "like";
	if($(obj).hasClass("on")) {
		// 해제
		mode = "dislike";
	}

	$.ajax({
		url : "../staff/process.html",
		type : "post",
		dataType : "json",
		data : "flag_json=1&mode=" + mode + "&st_id=" + st_id,
		cache: false,
		async: false,
		success : function(result) {	
			$(obj).toggleClass("on");
			$("#cnt_staff_like").text(setComma(result.cnt_like));
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}


/**
* 예약 하기
*/

/* 고객 검색 */
function submitSearchCustomerForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	submitToLayerPage(f, function(result) {	

	});

	return false;

}

/* 고객 선택 */
function chooseCustomer(cs_id, us_id, cs_name, cs_hp) {

	var f = document.reserve_form;
	f.cs_id.value = cs_id;
	f.us_id.value = us_id;
	f.us_name.value = cs_name;
	f.us_hp.value = cs_hp;

	$("#container5").find("#sch_keyword").val("").attr("value", "");

	closeLayerPage("6");

}

/* 담당자 선택 */
function chooseStaff(obj) {

	var f = document.reserve_form;
	var reserve_type = f.reserve_type.value;
	
	if(reserve_type == "staff") {
		// 담당자 -> 서비스 순서로 진행하므로, 해당 담당자에 해당하는 서비스만 출력
		f.action = "../service/ajax.option.html";
		f.target = "#reserve_sv_id";
		ajaxSubmit(f, function(result) {
			// 담당자가 변경되었기 때문에 기선택된 서비스 해제
			$("#selected_service").html("");
		});
	}
	else if(reserve_type == "service") {
		

	}

	// 담당자가 변경되었기 때문에 기선택된 예약일시 해제
	f.rs_date.value = "";
	f.rs_time.value = "";
	$("#reserve_time").find("strong").text("선택해주세요");
}

function checkChooseStaff(obj) {

	var f = document.reserve_form;
	var reserve_type = f.reserve_type.value;
	var st_id = f.st_id.value;
	if(reserve_type == "staff" && !st_id) {
		alert("담당자를 먼저 선택해주세요.");
		return false;
	}

	return true;
}

/* 서비스 선택 */
function chooseService(obj) {

	var f = document.reserve_form;
	var reserve_type = f.reserve_type.value;

	// 선택된 서비스 정보를 추가
	f.action = "../service/ajax.selected.html";
	f.target = "#selected_service";	
	ajaxSubmit(f, function(result) {
		$(obj).val("");		

		if(reserve_type == "service") {
			// 서비스 -> 담당자 순서로 진행하므로, 서비스가 가능한 담당자만 출력
			f.action = "../staff/ajax.option.html";
			f.target = "#reserve_st_id";

			var cnt = $("input[name='sv_id[]']", f).length;

			//f.submit();	return false;

			ajaxSubmit(f, function(result) {

			});
		}
	});



	// 서비스가 변경되었기 때문에 기선택된 예약일시 해제
	f.rs_date.value = "";
	f.rs_time.value = "";
	$("#reserve_time").find("strong").text("선택해주세요");
}

/* 서비스 삭제 */
function removeSelectedService(obj) {
	$(obj).parent("li").find("input[name='sv_id[]']").val("");
	chooseService(document.getElementById("reserve_sv_id"));
}

/* 타임테이블 열기 */
function openCalendar() {

	var f = document.reserve_form;
	if(!f.st_id.value) { 
		alert("담당자를 선택하세요.");
		return false;
	}

	if($("#selected_service > ul > li").length == 0) {
		alert("서비스를 선택하세요.");
		return false;
	}

	f.action = "../reserve/ajax.calendar.html";
	f.target = "#layer_page6";

	//f.submit();
	submitToLayerPage(f, function(result) {	

	});
}

/* 예약일시 선택 */
function chooseDateTime(rs_date, rs_time) {
	var f = document.reserve_form;
	f.rs_date.value = rs_date;
	f.rs_time.value = rs_time;

	var str_rs_date = rs_date.substring(0, 4) + "년 " + rs_date.substring(5, 7) + "월 " + rs_date.substring(8, 10) + "일";
	$("#reserve_time").find("strong").text(str_rs_date + " " + rs_time);

	closeLayerPage("6");
}

/* 예약폼 유효성 검사 */
function submitReserveForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}

	if(!f.sh_code.value) {
		alert("상점이 정확하지 않습니다.");
		return false;
	}

	if(!f.st_id.value) {
		alert("담당자를 선택하세요.");
		return false;
	}

	if($("#selected_service > ul > li").length == 0) {
		alert("서비스를 선택하세요.");
		return false;
	}

	if(!f.rs_date.value) {
		alert("예약일을 선택하세요.");
		return false;
	}

	if(!f.rs_time.value) {
		alert("예약시간을 선택하세요.");
		return false;
	}

	f.target = "#layer_page5";
	f.action = "../reserve/process.html";

	ajaxSubmit(f, function(result) {

		if(f.mode.value == "insert") {
			// 신규 등록일 경우 결과 페이지 출력
			$a = $("<a />");
			$a.attr("target", "#layer_page5").attr("href", result.url);
			openLayerPage($a);
		}
		else {
			// 수정일 경우 상세보기 페이지 새로고침
			$a = $("<a />");
			$a.attr("target", "#layer_page3").attr("href", result.url);			
			openLayerPage($a);

			// 리스트 페이지도 새로고침
			$("li.rs_id_" + result.rs_id).replaceWith(result.list_item);


			closeLayerPage("5");
		}
	});

	return false;
}

/* 예약 관리자 메모폼 유효성 검사 */
function submitMemoForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}

	ajaxSubmit(f, function(result) {
		//alert("메모가 정상적으로 저장되었습니다.");

		var obj_parent = $(".rs_id_" + result.rs_id).find("a.rs_pay_memo").parent("li");

		if(result.rs_pay_memo) {
			obj_parent.addClass("on");
		}
		else {
			obj_parent.removeClass("on");
		}

		closeLayerPage("6");
	});

	return false;
}

/* 예약 상태 변경 */
function changeReserveState(obj) {

	var title = $(obj).attr("title");
	if(confirm("해당 예약건을 " + title + " 상태로 변경하시겠습니까?")) {

		var href = $(obj).attr("href");
		$.ajax({
			url : href + "&flag_json=1",
			type : "get",
			dataType : "json",
			cache: false,
			async: false,
			success : function(result) {
				if(result.code == "ok") {

					var obj_parent = $(".rs_id_" + result.rs_id);

					// 예약승인 제거
					$("a.rs_accept", obj_parent).remove();

					// 예약상태 스위치 변경
					$("a.btn_change_state", obj_parent).not(".rs_state_" + result.rs_state).removeClass("on").end().filter(".rs_state_" + result.rs_state).addClass("on");

					// 예약상태 텍스트 변경
					$(".txt_rs_state", obj_parent).text(result.txt_rs_state).attr("class", "txt_rs_state state_" + result.rs_state);
				}
			},
			error : function(e)	{			
				alert(msg_arr["ajax_error"]);
			}
		});
	}
}

/* 예약 승인 플립 스위치 */
function toggleReserveAccept(obj, rs_state) {

	var f = document.accept_form;
	f.rs_state.value = rs_state;

	$(obj).parent("div").attr("class", "btn_switch3 rs_state_" + rs_state);
}

/* 예약 승인폼 유효성 검사 */
function submitAcceptForm(f) {

	ajaxSubmit(f, function (result) {

		var obj_parent = $(".rs_id_" + result.rs_id);

		// 예약승인 제거
		$("a.rs_accept", obj_parent).remove();

		// 예약상태 스위치 변경
		$("a.btn_change_state", obj_parent).not(".rs_state_" + result.rs_state).removeClass("on").end().filter(".rs_state_" + result.rs_state).addClass("on");

		// 예약상태 텍스트 변경
		$(".txt_rs_state", obj_parent).text(result.txt_rs_state).attr("class", "txt_rs_state state_" + result.rs_state);

		closeLayerPage("4");

	});

	return false;

}


/**
* 포트폴리오
*/

/* 포트폴리오 좋아요 */
function togglePortfolioLike(obj, pf_id) {

	var mode = "like";
	if($(obj).hasClass("on")) {
		// 해제
		mode = "dislike";
	}

	$.ajax({
		url : "../portfolio/process.html",
		type : "post",
		dataType : "json",
		data : "flag_json=1&mode=" + mode + "&pf_id=" + pf_id,
		cache: false,
		async: false,
		success : function(result) {	
			$(obj).toggleClass("on");
			$("#cnt_portfolio_like").text(setComma(result.cnt_like));
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

/* 포트폴리오 댓글 작성 */
function submitWritePortfolioCommentForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	ajaxSubmit(f, function(result) {

		$("#cnt_comment").text(setComma(result.cnt_comment));
		document.comment_page_form.page.value = "2";
		closeLayerPage("6");

	});

	return false;
}

/* 포트폴리오 댓글 삭제 */
function deletePortfolioComment(obj, cm_id) {

	if(!confirm("댓글을 삭제하시겠습니까?")) {
		return false;
	}

	var f = document.delete_comment_form;
	f.cm_id.value = cm_id;

	ajaxSubmit(f, function(result) {

		$("#cnt_comment").text(setComma(result.cnt_comment));
		$(obj).parent("li").remove();

	});
}

/* 포트폴리오 답변 작성 */
function submitReplyPortfolioCommentForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	ajaxSubmit(f, function(result) {
		$("li.cm_id_" + result.cm_id).replaceWith(result.content);
		closeLayerPage("6");
	});

	return false;
}

/* 포트폴리오 답변 삭제 */
function deletePortfolioReply(obj, cm_id) {

	if(!confirm("답변을 삭제하시겠습니까?")) {
		return false;
	}

	var f = document.delete_reply_form;
	f.cm_id.value = cm_id;

	ajaxSubmit(f, function(result) {

		$(obj).parent("div").remove();
	});
}

/* 포트폴리오 사진 선택 */
function choosePortfolioPhoto(pf_id, photo_id) {
	callNative("openFileChooser/20001/" + pf_id+"/" + photo_id);
}

/* 포트폴리오 사진 교체 */
function changePortfolioPhoto(photo_id, file_name, file_content) {

	var obj_parent = $("#" + photo_id);

	/*
	obj_parent.addClass("on").find("input[name='file_name[]']").val(file_name).attr("value", file_name)
		.parent("li").find("input[name='file_content[]']").val(file_content).attr("value", file_content)
		//.parent("li").find("input[name='file_content[]']").val("test").attr("value", "test")
		.parent("li").find("img").attr("src", "data:image/jpeg;base64," + file_content);	
	*/

	obj_parent.addClass("on").find("img").attr("src", "data:image/jpeg;base64," + file_content);	
}

function changeFileId(photo_id, file_id) {
	var obj_parent = $("#" + photo_id);
	obj_parent.find("input[name='file_id[]']").val(file_id);
}

function changeProfileId(file_id) {

	var f = document.profile_photo_form;
	f.file_id.value = file_id;
	
	ajaxSubmit(f, function(result) {
		//alert("프로필 사진이 등록되었습니다.");
		callNative("hideProgressbar");
	});
	
}

/* 포트폴리오 사진 삭제 */
function deletePortfolioPhoto(pf_id, photo_id) {
	var obj_parent = $("#" + photo_id);

	

	/*
	
	obj_parent.removeClass("on").find("input[name='file_name[]']").val("").attr("value", "")
		.parent("li").find("input[name='file_content[]']").val("").attr("value", "")
		.parent("li").find("input[name='file_id[]']").val("").attr("value", "")
		.parent("li").find("img").attr("src", "/img/mobile/common/s_logo2.png");	
	*/	
	obj_parent.removeClass("on").find("input[name='file_id[]']").val("").attr("value", "").parent("li").find("img").attr("src", "/img/mobile/common/s_logo2.png");	

	// 삭제 파일 아이디 추가
	/*
	if(file_id) {
		$input = $("<input />");
		$input.attr("type", "hidden").attr("name", "del_file[]").val(file_id).attr("value", file_id);

		$("#hidden_delete_area").append($input);
	}
	*/

}

/* 포트폴리오 어플에서 등록 호출 요청 */
function submitWritePortfolioForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	callNative("submitPortfolioFromApp");

	return false;
}

/* 포트폴리오 실제 등록 */
function submitPortfolioFromApp() {

	var f = document.write_portfolio_form;
	
	f.submit();
	/*
	ajaxSubmit(f, function(result) {

		$li = $("<li />").replaceWith(result.content);

		if(f.mode.value == "insert") {			
			$("#portfolio_list").prepend($li);
		}
		else if(f.mode.value == "update") {
			closeLayerPage("1");
			$("li.pf_id_" + result.pf_id).replaceWith($li);
		}

		callNative("hideProgressbar");

		closeLayerPage("3");
	});
	*/
}

/* 쿠폰 사용 */
function submitUseCouponForm(f) {

	submitToLayerPage(f, function(result) {	
		alert("쿠폰이 사용처리 되었습니다.");
	});

	return false;
}

/* 게시물 토글 */
function toggleArticle(obj) {

	$(obj).parent("li").toggleClass("open");
}

/* 프로필 사진 */
function chooseProfilePhoto(pf_id) {
	callNative("openFileChooser/10001/"+pf_id);
}

function changeProfilePhoto(file_name, file_content) {

	$("#profile_photo").attr("src", "data:image/jpeg;base64," + file_content);
	/*
	var f = profile_photo_form;
	f.file_name.value = file_name;
	f.file_content.value = file_content;
	
	//callNative("showProgressbar");
	ajaxSubmit(f, function(result) {
		//alert("프로필 사진이 등록되었습니다.");
		callNative("hideProgressbar");
	});
	*/
}

function consoleLog(strings) {
	console.log(strings);
}

function validateUpdate(app_version) {
	if (app_version != "1.1.0")
	{
		alert("최신버전으로 업데이트 해주세요.");
		callNative("exitApp");
	}
}

function setConfigVersion(app_version) {
	//alert(app_version);
	$(".version").text(app_version);
}

//callNative("checkAppVersion/validateUpdate");
//callNative("checkAppVersion/setConfigVersion");