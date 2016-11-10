$(document).ready(function() {

	
});

/* 검색폼 유효성 검사 */
function submitSearchForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	return true;
}

/* 등록폼 유효성 검사 */
function submitWriteForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
		return false;
	}
	
	return true;	
}

/* 대시보드 새로 고침 */
function refreshDashboard() {
	var f = document.dashboard_form;
	ajaxSubmit(f, function(result) {

		var cnt_arr = result.json_etc.cnt_arr;
		$("#cnt_reserve_total").text(setComma(cnt_arr["total"]));
		$("#cnt_reserve_W").text(setComma(cnt_arr["W"]));
		$("#cnt_reserve_A").text(setComma(cnt_arr["A"]));
		$("#cnt_reserve_P").text(setComma(cnt_arr["P"]));
		$("#cnt_reserve_E").text(setComma(cnt_arr["E"]));
		$("#cnt_reserve_C").text(setComma(cnt_arr["C"]));
		$("#cnt_reserve_B").text(setComma(cnt_arr["B"]));

		console.log("refresh success");
	});
}

/* 대시보드 검색 */
function submitSearchReserveForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	ajaxSubmit(f, function(result) {

	});

	return false;
}

/* 대시보드 > 예약일자 선택 */
function chooseReserveDate(obj) {
	var obj_td = $("#dashboard_calendar").find("td");
	var idx = obj_td.index($(obj).parent("li").parent("ul").parent("div").parent("td"));
	obj_td.not(":eq(" + idx + ")").removeClass("sel").end().eq(idx).addClass("sel");
}

/* 대시보드 > 담당자 선택 */
function chooseStaffId(obj) {
	var f = document.dashboard_form;
	f.action = "./dashboard.html";
	f.target = "_self";
	f.flag_json.value = "";
	f.sch_st_id.value = $(obj).val();
	f.submit();
}

/* 대시보드 > 예약정보 선택 */
function chooseReserveInfo() {
	$("#dashboard_calendar").find("td").removeClass("sel");
	closeLayerPopup();		
}

/* 대시보드 > 예약 상태 토글 */
function toggleChangeState(obj) {
	$(obj).parent("span").parent("div").toggleClass("open");
}

/* 대시보드 > 예약 상태 변경 */
function changeReserveState(rs_id, rs_state) {

	var f = document.change_state_form;
	f.rs_id.value = rs_id;
	f.rs_state.value = rs_state;

	ajaxSubmit(f, function(result) {
		refreshDashboard();		
	});
}

/* 대시보드 > 결제수단 선택 */
function choosePayMethod(obj) {
	var td_class = $(obj).attr("id").replace("flag", "td");
	var obj_parent = $(obj).parent("th").parent("tr").find(" > td." + td_class);
	if($(obj).is(":checked")) {
		$("input.text", obj_parent).removeClass("readonly").removeProp("readonly").val("").attr("value", "");
		if($("select.select", obj_parent).length > 0) {			
			$("select.select", obj_parent).addClass("required").removeClass("readonly").find("> option").removeProp("disabled").eq(0).prop("selected", true).parent("select").trigger("change").focus();
		}
		else {
			$("input.text", obj_parent).addClass("required").focus();
		}
	}
	else {
		$("input.text", obj_parent).addClass("readonly").prop("readonly", true).val("0").attr("value", "0");
		if($("select.select", obj_parent).length > 0) {
			$("select.select", obj_parent).removeClass("required").addClass("readonly").find("> option").not(":eq(0)").prop("disabled", true).end().eq(0).prop("selected", true).parent("select").trigger("change")
		}
		else {
			$("input.text", obj_parent).removeClass("required");
		}
	}
}

/* 대시보드 > 총금액 계산 */
function sumTotalPrice() {

	var f = document.payment_form;	
	if($(f).length == 0) {
		f = document.reserve_payment_form;
	}

	var service_price = 0;
	try
	{
		service_price = f.service_price.value;		
	}
	catch (e)
	{
	}
	
	var real_price = service_price;
	var total_price = 0;

	var obj_price = $("input.pay_price");
	for(var i = 0 ; i < obj_price.length ; i++) {
		var pay_price = delComma(obj_price.eq(i).val());
		var price_name = obj_price.eq(i).attr("name");
		if(price_name == "pm_sale_price" || price_name == "pm_coupon_price" || price_name == "pm_advance_price") {
			// 실제 결제금액
			real_price -= pay_price * 1;
		}
		else {
			// 매출액
			total_price += pay_price * 1;
		}
	}

	$("#txt_real_price").text(setComma(real_price));
	$("#txt_total_price").text(setComma(total_price));

}

/* 대시보드 > 결제정보 폼 유효성 검사 */
function submitPaymentForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	/*
	// 실제결제금액과 매출액이 일치하는지 검사
	var real_price = f.service_price.value - delComma(f.pm_sale_price.value) - delComma(f.pm_coupon_price.value) - delComma(f.pm_advance_price.value);
	var total_price = delComma(f.pm_card_price.value) * 1 + delComma(f.pm_cash_price.value) * 1;
	if(real_price != total_price) {
		alert("실제결제금액과 매출액이 일치하지 않습니다.\n\n카드 또는 현금 결제 금액을 확인해주세요.");
		console.log(real_price + " / " + total_price);
		return false;
	}
	*/

	ajaxSubmit(f, function(result) {
		closeLayerPopup();
	});

	return false;
}

/* 대시보드 > 관리자메모 폼 유효성 검사 */
function submitMemoForm(f) {

	ajaxSubmit(f, function(result) {
		closeLayerPopup();
	});

	return false;
}

/* 대시보드 > 담당자 승인 폼 유효성 검사 */
function submitAcceptForm(f) {

	ajaxSubmit(f, function(result) {
		closeLayerPopup();
	});

	return false;
}

/* 대시보드 > 고객 검색폼 유효성 검사 */
function submitSearchCustomerForm(f) {

	if(!validateForm(f)) {
		return false;
	}

	ajaxSubmit(f, function(result) {

	});

	return false;
}

/* 대시보드 > 고객의 예약정보 토글 */
function toggleCustomerReserveInfo(obj) {

	$(obj).parent("div").parent("li").toggleClass("open");

}

/* 대시보드 > 담당자 선택 */
function chooseStaff(obj) {

	var f = document.reserve_form;
	var flag_nomember = false;
	if($(f).length == 0) {
		f = document.reserve_payment_form;
		flag_nomember = true;
	}

	f.action = "../service/ajax.option.html";
	f.target = "#reserve_sv_id";
	ajaxSubmit(f, function(result) {
		// 담당자가 변경되었기 때문에 기선택된 서비스 해제
		$("#selected_service").html("");
	});

	// 담당자가 변경되었기 때문에 기선택된 예약일시 해제
	f.rs_date.value = "";
	f.rs_time.value = "";
	$("#reserve_time").removeClass("open").find("strong").text("선택해주세요");

	if(flag_nomember) {
		sumTotalPrice();
	}
}

function checkChooseStaff(obj) {

	var f = document.reserve_form;
	if($(f).length == 0) {
		f = document.reserve_payment_form;
	}

	var st_id = f.st_id.value;
	if(!st_id) {
		alert("담당자를 먼저 선택해주세요.");
		return false;
	}

	return true;
}

/* 대시보드 > 서비스 선택 */
function chooseService(obj) {

	var f = document.reserve_form;
	var flag_nomember = false;
	if($(f).length == 0) {
		f = document.reserve_payment_form;
		flag_nomember = true;
	}

	// 선택된 서비스 정보를 추가
	f.action = "../service/ajax.selected.html";
	f.target = "#selected_service";	

	ajaxSubmit(f, function(result) {
		$(obj).val("");	

		if(flag_nomember) {		
			sumTotalPrice();
		}
	});

	// 서비스가 변경되었기 때문에 기선택된 예약일시 해제
	f.rs_date.value = "";
	f.rs_time.value = "";
	$("#reserve_time").removeClass("open").find("strong").text("선택해주세요");
}

/* 대시보드 > 서비스 삭제 */
function removeSelectedService(obj) {
	$(obj).parent("li").find("input[name='sv_id[]']").val("");
	chooseService(document.getElementById("reserve_sv_id"));
}

/* 대시보드 > 타임테이블 열기 */
function toggleCalendar() {

	if($("#reserve_time").hasClass("open")) {
		$("#reserve_time").removeClass("open");
	}
	else {
		var f = document.reserve_form;
		if($(f).length == 0) {
			f = document.reserve_payment_form;
		}

		if(!f.st_id.value) { 
			alert("담당자를 선택하세요.");
			return false;
		}

		if($("#selected_service > ul > li").length == 0) {
			alert("서비스를 선택하세요.");
			return false;
		}

		f.action = "../reserve/ajax.calendar.html";
		f.target = "#reserve_datetime";

		//f.submit();
		ajaxSubmit(f, function(result) {	
			$("#reserve_time").addClass("open");

		});
	}
}

/* 대시보드 > 예약일시 선택 */
function chooseDateTime(rs_date, rs_time) {
	var f = document.reserve_form;
	if($(f).length == 0) {
		f = document.reserve_payment_form;
	}

	f.rs_date.value = rs_date;
	f.rs_time.value = rs_time;

	var str_rs_date = rs_date.substring(0, 4) + "년 " + rs_date.substring(5, 7) + "월 " + rs_date.substring(8, 10) + "일";
	$("#reserve_time").find("strong").text(str_rs_date + " " + rs_time);

	$("#reserve_time").removeClass("open");
}

/* 대시보드 > 예약하기 폼 유효성 검사 */
function submitReserveForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
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

	f.target = "#reserve_list";
	f.action = "../reserve/process.html";

	ajaxSubmit(f, function(result) {
		closeLayerPopup();
		refreshDashboard();
	});

	return false;
}

/* 현금 결제 금액 변경 */
function changeCashPrice(obj) {
	obj = $(obj);
	var pm_cash_price = delComma(obj.val());
	var pm_card_price = obj.parent("td").find("input.pm_card_price").val();
	var total_price = obj.parent("td").find("input.total_price").val();

	var new_total_price =pm_cash_price * 1 + pm_card_price * 1;
	obj.parent("td").parent("tr").find(".txt_total_price").text(setComma(new_total_price));
	if(new_total_price != total_price) {
		obj.parent("td").addClass("different");
	}
	else {
		obj.parent("td").removeClass("different");
	}
}

/* 매출내역 현금결제폼 유효성 검사 */
function submitSalesListForm(f) {

	var chk = $("td.different").length;
	if(!chk && !confirm("현금 결제 금액을 변경하지 않았습니다.\n\n그래도 반영하시겠습니까?")) {
		return false;		
	}

	return true;
}

/* 예약등록폼 유효성 검사 */
function submitReservePaymentForm(f) {

	// 기본 유효성
	if(!validateForm(f)) {
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
	
	f.target = "#reserve_list";
	f.action = "../reserve/process.html";

	ajaxSubmit(f, function(result) {
		closeLayerPopup();
		refreshDashboard();
	});

	return false;
}