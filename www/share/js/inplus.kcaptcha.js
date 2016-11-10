/* refreshCaptcha */
function refreshCaptcha() {	
	$.ajax({
		url : base_uri + "/captcha/refresh_image.html",
		dataType : "json",
		cache: false,
		async: false,
		success : function(result) {	

			if(result.code == "error") { alert(result.msg); }
			else {
				$("#captcha_img").attr("src", result.img_src);
			}		
		},
		error : function(e)
		{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

/* validateCaptcha */
function validateCaptcha() {
	var flag = false;

	var captcha_key =  $("#captcha_key").val();
	if(!captcha_key) { return flag; }
	$.ajax({
		url : base_uri + "/captcha/validate_captcha.html",
		type : "post",
		dataType : "json",
		data : {
			"captcha_key"	: captcha_key
		},
		cache: false,
		async: false,
		success : function(result)
		{	
			if(result.code == "ok") { flag = true; }				
		},
		error : function(e)
		{			
			alert(msg_arr["ajax_error"]);
		}
	});

	return flag;
}