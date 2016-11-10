// title 얻기
function getInputTitle(obj) {
	var title = obj.attr("name");
	if(obj.attr("title")) { title = obj.attr("title"); }
	else if($("label[for=" + obj.attr("id") + "]").text()) { title = $("label[for=" + obj.attr("id") + "]").text(); }
	return title;
}

/* 유효성 검사 경고창 */
function validateAlert(obj, type) {
	// msg
	var title = getInputTitle(obj);
	var msg = title;
	if(getLastChar(title)) { msg += "은"; }
	else { msg += "는"; }
	msg += " " + type + " 항목입니다.";
	alert(msg);

	// focus
	try{ obj.focus(); }
	catch(e) { }
}

// radio required
function validateReqRadio(obj, f) {
	var obj_list = $("input[type=radio][name=" + obj.attr("name") + "]", f);
	if(obj_list.filter(":checked").length == 0) {
		validateAlert(obj_list.eq(0), "필수 선택");
		return false;		
	}
	return true;
}

// checkbox required
function validateReqCheckbox(obj, f) {
	if(!obj.is(":checked")) {
		validateAlert(obj, "필수 선택");
		return false;
	}
	return true;
}

// text required
function validateReqText(obj) {
	if(!obj.val() || obj.val() == "")	{
		validateAlert(obj, "필수 입력");
		return false;
	}	
	return true;
}

// select required
function validateReqSelect(obj) {
	if(!obj.find("option:selected").val() || obj.find("option:selected").val() == "") {
		validateAlert(obj, "필수 선택");
		return false;
	}
	return true;
}

// textarea required
function validateReqTextarea(obj) {	
	if(!obj.val() || obj.val() == "" || obj.val() == "<p>&nbsp;</p>") {
		validateAlert(obj, "필수 입력");
		return false;
	}
	return true;
}

function validateForm(f) {
	// 1. required
	var obj_req = $(".required", f);
	for(var i = 0 ; i < obj_req.length ; i++) {
		if(obj_req.eq(i).is("input")) {
			var type = obj_req.eq(i).attr("type");
			if(type == "radio" && !validateReqRadio(obj_req.eq(i), f)) { return false; }
			else if(type == "checkbox" && !validateReqCheckbox(obj_req.eq(i), f)) { return false; }
			else if((type == "text" || type == "password" || type == "number" || type == "tel") && !validateReqText(obj_req.eq(i))) { return false; }
		}
		else if(obj_req.eq(i).is("select") && !validateReqSelect(obj_req.eq(i))) { return false; }
		else if(obj_req.eq(i).is("textarea") && !validateReqTextarea(obj_req.eq(i))) { return false; }
	}

	// 2. number
	var obj_num = $("input.number", f);
	for(var i = 0 ; i < obj_num.length ; i++) {
		if(isNaN(obj_num.eq(i).val())) {
			validateAlert(obj_num.eq(i), "숫자 입력");
			return false;
		}
		if(obj_num.eq(i).val() == "" && obj_num.eq(i).hasClass("not_null")) { obj_num.eq(i).val("0"); }
	}

	// 3. date
	var obj_date = $("input.date, input.birth", f);
	var fmt = /^\d{4}-\d{2}-\d{2}$/; // 포멧 설정
	for(var i = 0 ; i < obj_date.length ; i++) {
		if(obj_date.eq(i).val() && !fmt.test(obj_date.eq(i).val())) {
			validateAlert(obj_date.eq(i), "날짜 입력");
			return false;
		}
	}

	return true;
}

