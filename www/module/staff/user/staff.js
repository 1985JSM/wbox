/* 다음 페이지 조회 */
function getNextPage() {

	var obj_container = $("#container");
	var obj_list = $("#shop_list", obj_container);

	if(obj_container.scrollTop() * 1 + obj_container.height() * 1 >= obj_list.height() * 0.5 ) {

		var is_load = $("#is_load").val();		
		if(!is_load) {
			$("#is_load").val("1").attr("value", "1");
			var next_page = $("#next_page").val();
			var href = "../staff/" + $("#ajax_url").val();
			var query_string = $("#query_string").val();

			//document.write(href + "?flag_json=1&page=" + next_page + "&" + query_string);

			$("#loader").show();
			$.ajax({
				url : href,
				type : "get",
				dataType : "json",
				data : "flag_json=1&page=" + next_page + "&" + query_string,
				cache: false,
				async: false,
				success : function(result) {	
					if(result.code == "ok") {						
						if(result.content) {
							obj_list.append(result.content);
							$("#next_page").val(next_page * 1 + 1);
							$("#is_load").val("").attr("value", "");
						}
					}					
				},
				error : function(e)	{			
					alert(msg_arr["ajax_error"]);
					$("#is_load").val("").attr("value", "");
				},
				complete : function() {
					$("#loader").hide();

				}
			});

		}
	}
}

/* 검색 폼 유효성 검사 */
function submitSearchForm(f) {
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

