$(document).ready(function() {	

	/* 준비중 */
	$("a.btn_no_complete, button.btn_no_complete").on("click", function(e) {
		alert("해당 메뉴는 준비중입니다.");
		e.preventDefault();
	});

	/* 삭제 */
	$("#btn_delete").on("click", function(e) {
		if(!confirm("정말 삭제하시겠습니까?")) {
			e.preventDefault();
		} 
	});

	$(document).on("click", ".btn_delete", function(e) {
		if(!confirm("정말 삭제하시겠습니까?")) {
			e.preventDefault();
		} 
	});

	/* 전체선택 */
	$("#all_check").on("click", function(e){
		if($(this).is(":checked")) {
			$("input.list_check").attr("checked", true);
		} else {
			$("input.list_check").removeAttr("checked");
		}
	});	

	/* 한글 ime mode */
	$("input.text, textarea.textarea").not("#login_id").css("ime-mode", "active");

	/* 숫자 처리 관련 : S */
	$("input.number, input.money, input.double").css("ime-mode", "disabled");
	$(document).on("keydown", "input.number", function(e){				
		if(e.keyCode != 8 && e.keyCode != 9 && e.keyCode != 13 && e.keyCode != 35 && e.keyCode != 36 && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 46 &&!(e.keyCode > 47 && e.keyCode < 58) && !(e.keyCode > 95 && e.keyCode < 106)) {
			e.preventDefault();			
		}
	}).on("focus", "input.number", function(e) {
		if($(this).val() == 0) { $(this).val("").attr("value", ""); }		
	}).on("blur", "input.number", function(e) {
		if($(this).val() == "" && $(this).hasClass("not_null")) { $(this).val("0").attr("value", "0"); }		
	}).on("focus", "input.money", function(e) {
		var money = $(this).val();
		if(money == 0) { 
			$(this).val("").attr("value", "");
		}
		else {
			money = delComma(money);			
			$(this).val(money).attr("value", money); 
		}		
	}).on("keydown", "input.money", function(e){	
		if(e.keyCode != 8 && e.keyCode != 9 && e.keyCode != 13 && e.keyCode != 35 && e.keyCode != 36 && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 46 && e.keyCode != 188 && !(e.keyCode > 47 && e.keyCode < 58) && !(e.keyCode > 95 && e.keyCode < 106))	{
			e.preventDefault();			
		}
	}).on("blur", "input.money", function(e){
		var money = $(this).val();
		money = setComma(delComma(money));
		$(this).val(money).attr("value", money);
	});
	/* 숫자 처리 관련 : E */

	/* readonly : S */
	$(document).on("click", "input.readonly", function(e){
		var title = getInputTitle($(this));
		var msg = title;
		if(getLastChar(title)) { msg += "은"; }
		else { msg += "는"; }
		msg += " 직접 작성할 수 없는 항목입니다.";
		alert(msg);
		e.preventDefault();
	});
	/* readonly : E */

	/* a tag to ajax or popup : S */
	$(document).on("click", "a.btn_ajax", function(e) {
		getContentsbyAjax(this);
		e.preventDefault();
	}).on("click", "a.btn_open_popup", function(e) {
		openPopup(this);
		e.preventDefault();		
	}).on("click", "a.btn_confirm", function(e) {
		var result = confirmByButton(this);
		if(!result) {
			e.preventDefault();
		}		
	}).on("click", "a.btn_quick_date", function(e) {
		changeQuickDate(this);
		e.preventDefault();			
	});
	/* a tag to ajax or popup : E */

	/* placeholder : S */
	$(document).on("focus", "input.placeholder, textarea.placeholder", function(){
		$(this).addClass("no_placeholder");
	}).on("blur", "input.placeholder, textarea.placeholder", function(){
		checkPlaceholder(this);
	});
	checkAllPlaceholder(document);	
	/* placeholder : E */
});

/* 사용자 컨펌 */
function confirmByButton(obj) {
	var obj = $(obj);
	var title = obj.attr("title");
	var flag_change = obj.hasClass("btn_change");
	var msg = title;

	if(flag_change) {
		msg += " 상태로 변경하시겠습니까?";
	} else {
		msg += " 페이지로 이동하시겠습니까?";
	}
	
	return confirm(msg);
}

/* 팝업창 열기 */
function openPopup(obj) {

	obj = $(obj);
	var url = obj.attr("href");
	var title = obj.attr("title");
	var popup_size = "size_640x480";
		
	var class_arr = obj.attr("class").split(" ");
	var size_fmt = /^size_\d{3,4}x\d{3,4}$/;
	for(var i = 0 ; i < class_arr.length ; i++) {
		if(size_fmt.test(class_arr[i])) { popup_size = class_arr[i]; break; }
	}
	
	size_arr = popup_size.replace("size_", "").split("x");
	var popup_width = size_arr[0];
	var popup_height = size_arr[1];
	
	try {
		window.open(url, title, "scrollbars=yes,width=" + popup_width + ",height=" + popup_height + ",top=10,left=20");		
	}
	catch (e) {
		window.open(url, "", "scrollbars=yes,width=" + popup_width + ",height=" + popup_height + ",top=10,left=20");
	}
}

/* Layer Popup */
function openLayerPopup() {
	$("#layer_back, #layer_popup").show();
}

function closeLayerPopup() {
	$("#layer_back, #layer_popup").hide();
	$("#layer_content").html("");
}

function resizeLayerPopup(layer_width, layer_height, title) {
	var layer_margin_top = (layer_height / 2) * (-1);
	var layer_margin_left = (layer_width / 2) * (-1);
	var layer_content_height = layer_height;
	
	if(layout == "user" || layout == "staff") {
		//layer_content_height -= 110;
		layer_content_height -= 60;
	}
	else if(layout == "front") {
		layout_content_height -= 150;
	}
	else {
		//layer_content_height -= 250;
		layer_content_height -= 100;
	}

	$("#layer_popup").css({
		width	: layer_width + "px",
		height	: layer_height + "px",
		marginTop	: layer_margin_top + "px",
		marginLeft	: layer_margin_left + "px"
	});
	$("#layer_content").css("height", layer_content_height + "px");
	
	// layer title
	if(title) {
		$("#layer_popup h1").text(title);			
	}
}

function getLayerPopupSize(class_name) {

	var layer_size = "size_600x600";
	if(class_name) {
		var class_arr = class_name.split(" ");
		var size_fmt = /^size_\d{3,4}x\d{3,4}$/;
		
		for(var i = 0 ; i < class_arr.length ; i++) {
			if(size_fmt.test(class_arr[i])) { layer_size = class_arr[i]; break; }
		}
	}
		
	var size_arr = layer_size.replace("size_", "").split("x");

	return size_arr;
}

/* get Contents by Ajax */
function getContentsbyAjax(obj) {
	obj = $(obj);
	var href = obj.attr("href");
	var target = obj.attr("target");
	var title = obj.attr("title");

	var layer_width = 600;
	var layer_height = 600;

	if(target == "#layer_popup") {			
		var layer_size = "size_600x600";
		var class_arr = obj.attr("class").split(" ");
		var size_fmt = /^size_\d{3,4}x\d{3,4}$/;
		for(var i = 0 ; i < class_arr.length ; i++) {
			if(size_fmt.test(class_arr[i])) { layer_size = class_arr[i]; break; }
		}
		
		size_arr = layer_size.replace("size_", "").split("x");
		layer_width = size_arr[0];
		layer_height = size_arr[1];
	}

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
				if(target == "#layer_popup") {
					target = "#layer_content";

					// resize layer layout
					var layer_margin_top = (layer_height / 2) * (-1);
					var layer_margin_left = (layer_width / 2) * (-1);
					var layer_content_height = layer_height;

					if(layout == "user" || layout == "staff") {
						layer_content_height -= 60;
					}
					else if(layout == "front") {
						layer_content_height -= 150;
					}						 
					else {
						layer_content_height -= 100;
					}

					$("#layer_popup").css({
						width	: layer_width + "px",
						height	: layer_height + "px",
						marginTop	: layer_margin_top + "px",
						marginLeft	: layer_margin_left + "px"
					});
					$("#layer_content").css("height", layer_content_height + "px");
					
					// layer title
					if(title) {
						$("#layer_popup h1").text(title);		
						$("#layer_popup h2").text(title);			
					}

					openLayerPopup();
				}

				if(target) {
					insertContent($(target), result.content);
				}					
			}
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}



/* check placeholder */
function checkPlaceholder(obj) {
	var value = $(obj).val();
	if(value) {
		$(obj).addClass("no_placeholder");		
	} else {
		$(obj).removeClass("no_placeholder");		
	}
}

function checkAllPlaceholder(obj) {
	var obj_placeholder = $("input.placeholder, textarea.placeholder", $(obj));
	for(var i = 0 ; i < obj_placeholder.length ; i++) {
		checkPlaceholder(obj_placeholder.eq(i));
	}
}

/* 한글 처리 관련 : S */
function iSound(a) {
	var r = ((a.charCodeAt(0) - parseInt("0xac00",16)) /28) / 21;
	var t = String.fromCharCode(r + parseInt("0x1100",16));	
	return t;
} 

function mSound(a) {	
	var r = ((a.charCodeAt(0)- parseInt("0xac00",16)) / 28) % 21;	
	var t = String.fromCharCode(r + parseInt("0x1161",16));	
	return t;
} 

function tSound(a) {
	var r = (a.charCodeAt(0) - parseInt("0xac00",16)) % 28;
	var t = "";
	if(r + parseInt("0x11A8") -1 != 4516 && r + parseInt("0x11A8") -1 != 4519) { var t = String.fromCharCode(r + parseInt("0x11A8") -1); }
	return t;
}

function getLastChar(str) {
	return tSound(str.substr(str.length - 1, 1));
}
/* 한글 처리 관련 : E */

/* 콤마 : S */
function setComma(str) {
	var result = str.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
	return result;	
}

function delComma(str) {
	var result = str;
	try
	{
		result = str.toString().replace(/,/g, ""); 		
	}
	catch (e){}

	return result;	
}
/* 콤마 : E */

/**
* Submit Form by Ajax
*/
function ajaxSubmit(f, func) {
	var f_action = f.action;
	var f_data = $(f).serialize();
	var f_method = f.method;
	var f_target = f.target;
	var f_title = f.title;
	
	var layer_width = 0;
	var layer_height = 0;

	if(f_target == "#layer_popup") {
		var size_arr = getLayerPopupSize($(f).attr("class"));		
		layer_width = size_arr[0];
		layer_height = size_arr[1];
	}

	

	if($(f).attr("enctype") == "multipart/form-data") {
		$ifm = $("<iframe />");
		$ifm.css({
			width	: "300px",
			height	: "300px"
		}).attr({
			id		: "ajax_iframe",
			name	: "ajax_iframe"
		}).appendTo($(f));		

		f.target = "ajax_iframe";
		setTimeout(function(){

			$("#ajax_iframe").on("load", function(){
				var result = JSON.parse($("#ajax_iframe").contents().text());
				if(result.code == "error") { alert(result.msg); }
				else {
					if(f_target && result.content) { insertContent($(f_target), result.content); }
					if(typeof func == "function") { func(result); }
				}
				//$("#ajax_iframe").remove();
			});
			f.submit();			
			f.target = f_target;
		}, 100);

		
	} else {
		$.ajax({
			url : f_action,
			type : f_method,
			dataType : "json",
			data : f_data,
			cache: false,
			async: false,
			success : function(result) {		
				if(result.code == "error") { alert(result.msg); }
				else {
					if(f_target && result.content) { 
						if(f_target == "#layer_popup") {							
							f_target = "#layer_content";
							resizeLayerPopup(layer_width, layer_height, f_title);
							openLayerPopup();
						}

						insertContent($(f_target), result.content); 
					}
					if(typeof func == "function") { func(result); }
				}
			},
			error:function(request,status,error){
				alert(msg_arr["ajax_error"]);
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			},
			complete : function() {
			
			}
		});
	}
}

/**
* Insert Content
*/
function insertContent(obj, content) {
	
	obj.html(content);
	initContent(obj);

	// scrollTop
	$(obj).scrollTop(0);
}

/* initContent */
function initContent(obj) {

	if(layout == "user" || layout == "staff") {
		return false;
	}

	// readonly
	$("input.readonly", obj).prop("readonly", true);
	$("select.readonly > option", obj).not(":selected").prop("disabled", true).trigger("change");

	// uniform
	$("select.select", obj).uniform();

	// sButton
	setButtonStyle(obj);

	// datepicker
	$.datepicker.regional["ko"] = {
		closeText: "닫기",
		prevText: "이전달",
		nextText: "다음달",
		currentText: "오늘",
		changeMonth: true,
		changeYear: true,
		showButtonPanel: false,
		yearRange: "c-99:c+99",
		maxDate: "+"+365*10+"d",
		minDate: "-"+365*10+"d",
		monthNames: ["1월","2월","3월","4월","5월","6월",
		"7월","8월","9월","10월","11월","12월"],
		monthNamesShort: ["1월","2월","3월","4월","5월","6월",
		"7월","8월","9월","10월","11월","12월"],
		dayNames: ["일요일","월요일","화요일","수요일","목요일","금요일","토요일"],
		dayNamesShort: ["일","월","화","수","목","금","토"],
		dayNamesMin: ["일","월","화","수","목","금","토"],
		weekHeader: "Wk",
		dateFormat: "yy-mm-dd",
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: "",
		showOn: "button",
		buttonImage: "/share/js/jquery-ui-1.11.1.custom/images/btn_calendar.gif",
		buttonImageOnly: true,
		buttonText: "Select date"
	};
	$.datepicker.setDefaults($.datepicker.regional["ko"]);
	 
	$("input.date", obj).datepicker(); 

	$("input.birth").datepicker({
			maxDate: "+"+365*0+"d",
			minDate: "-"+365*100+"d"
		}); 

	// placeholder
	checkAllPlaceholder(obj);
}


/* change quick date */
function changeQuickDate(obj) {

	var obj = $(obj);	
	var obj_a = $("a.btn_quick_date");

	var sch_s_date = "";
	var sch_e_date = "";
	var idx = obj_a.length - 1;

	var arr = obj.attr("href").split("sch_s_date=");
	
	if(arr.length > 1) {
		arr = arr[1].split("&sch_e_date=");
		sch_s_date = arr[0];

		arr = arr[1].split("&");
		sch_e_date = arr[0];

		idx = obj_a.index(obj);
	}

	$("#sch_s_date").val(sch_s_date).attr("value", sch_s_date);
	$("#sch_e_date").val(sch_e_date).attr("value", sch_e_date);
	obj_a.not(":eq(" + idx + ")").removeClass("active").end().eq(idx).addClass("active");	
	//obj_a.find(">span").not(":eq(" + idx + ")").removeClass("on").end().eq(idx).addClass("on");	
	//obj_a.parent("li").not(":eq(" + idx + ")").removeClass("on").end().eq(idx).addClass("on");		
}

/**
* sButton
*/
function setButtonStyle(obj) {
	
	/* sButton */
	$("a.sButton, button.sButton", obj).each(function() {
		var content = "<span class='sButton-container'><span class='sButton-bg'>";
		if($(this).hasClass("icon")) {
			content += "<span class='icon'></span>";
		}
		content += "<span class='text'>" + $(this).text() + "</span></span></span>";

		$(this).html(content);
	});	
}

/**
* responsive div
*/
function addResponsiveDiv(obj) {
	
	/* sButton */
	$("table", obj).each(function() {
		var tmp_obj = $(this).clone();
		$(this).after("<div class='table-responsive'></div>");
	});	
}

/**
* 반응형 레이아웃
*/
function resizeLayout() {

	var win_width = $(window).width();
	var device_class = "wide,normal,tablet,mobile".split(",");
	var width_class = "1300,900,700,0".split(",");
	var device_idx = null;

	for(var i = 0 ; i < width_class.length ; i++) {
		if(win_width > width_class[i]) {
			device_idx = i;
			break;
		}
	}

	for(var i = 0 ; i < width_class.length ; i++) {
		if(i == device_idx) {
			$("body").addClass(device_class[i]);
		}
		else {
			$("body").removeClass(device_class[i]);
		}
	}
}
