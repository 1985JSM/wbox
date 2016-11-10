$(document).ready(function() {
	$(document).on("click", "a#btn_delete", function(e) {
		if(!confirm("정말 삭제하시겠습니까?")) {
			e.preventDefault();
		}
	});
});

/* 다음 페이지 조회 */
function getNextPage() {

	var obj_container = $("#container");
	var obj_list = $("#portfolio_list", obj_container);

	if(obj_container.scrollTop() * 1 + obj_container.height() * 1 >= obj_list.height() * 0.5 ) {

		var is_load = $("#is_load").val();		
		if(!is_load) {
			$("#is_load").val("1").attr("value", "1");
			var next_page = $("#next_page").val();
			var href = "../portfolio/" + $("#ajax_url").val();
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

/* 등록폼 유효성 검사 */
function submitPortfolioForm(f) {
	
	if(!validateForm(f)) {
		return false;
	}

	if(!$("#photo_thumb").is(":visible")) {
		alert("사진을 등록하세요.");
		return false;
	}

	return true;
}
