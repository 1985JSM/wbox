function openGnb() {
	$("#layer_back").show();
	$("#wrap").addClass("open");
}

function closeGnb() {
	$("#layer_back").hide();	
	$("#wrap").removeClass("open");
}

/*
function changeMainVisual() {
	$.ajax({
		url : "./ajax_main_visual.html",
		type : "get",
		dataType : "json",
		data : "flag_json=1",
		cache: false,
		async: false,
		success : function(result) {				
			if(result.code == "ok") {
				$("#main_visual").html(result.content);
			}			
		},
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}
*/