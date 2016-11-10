/* 예약 옵션 
function toggleReserveOptions(obj) {

	var f = document.write_form;

	var obj_par = $(obj).parent("li");
	if(obj_par.hasClass("on")) {
		obj_par.removeClass("on").find("ul").slideUp();
	}
	else {
		var this_type = obj_par.parent("ul").attr("id").replace("_list", "");
		var flag_open = false;

		if(this_type == reserve_type) {
			flag_open = true;
		}
		else if(this_type == "service") {
			if(f.st_id.value) { flag_open = true; }
			else {
				alert("담당자를 먼저 선택하세요.");
			}
		}
		else if(this_type == "staff") {
			if(f.sv_id.value) { flag_open = true; }
			else {
				alert("서비스를 먼저 선택하세요.");
			}
		}

		if(flag_open) {		
			obj_par.addClass("on").find("ul").slideDown();		
		}
	}
}
*/




