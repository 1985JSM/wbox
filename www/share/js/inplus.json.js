

/**
* json Data By Ajax
*/

// setJsonDataByAjax
function setJsonDataByAjax(name, data) {

	var str_data = JSON.stringify(data);
	str_data = Base64.encode(str_data);
	//str_data = encodeURIComponent(str_data);

	//alert(str_data);
	//document.write("[" + str_data + "]");

	$.ajax({
		url : "/json.php",
		type : "post",
		dataType : "text",
		data : {
			mode		: "set",
			name		: name,
			str_data	: str_data		
		},
		cache: false,
		async: false,
		error : function(e)	{			
			alert(msg_arr["ajax_error"]);
		}
	});
}

// getJsonDataByAjax
function getJsonDataByAjax(name) {

	var data = "";

	$.ajax({
		url : "/json.php",
		type : "post",
		dataType : "text",
		data : {
			mode	: "get",
			name	: name					
		},
		cache: false,
		async: false,
		success : function(str_data) {	
			str_data = Base64.decode(str_data);
			data = JSON.parse(str_data);			
		},
		error : function(e)	{					
			alert(msg_arr["ajax_error"]);
		}
	});

	return data;
}