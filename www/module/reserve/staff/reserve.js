$(document).ready(function() {

	
});

/* 검색폼 유효성 검사 */
function submitSearchForm(f) {
	return validateForm(f);
}

/* 예약상태 변경 
function changeReserveState(obj, mode) {
	var obj = $(obj);

	var title = obj.attr("title");
	var msg = title + " 상태로 변경하시겠습니까?";
	var href = obj.attr("href");

	if(confirm(msg)) {
		$.ajax({
			url : href + "&flag_json=1",
			type : "get",
			dataType : "json",
			cache: false,
			async: false,
			success : function(result) {
				if(result.code == "ok") {

					obj.parent("div.btn_switch2").find("a").removeClass("on");
					obj.addClass("on");

					if(mode == "view") {
						$("#txt_rs_state").text(title);
					}
					else if(mode == "list") {
						obj.parent().parent().find("span.txt_rs_state").text(title).attr("class", "txt_rs_state state_" + result.rs_state);
					}
								
				}
			},
			error : function(e)	{			
				alert(msg_arr["ajax_error"]);
			}
		});
	}
}*/
