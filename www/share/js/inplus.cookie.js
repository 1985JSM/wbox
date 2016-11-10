// Get Cookie
function getCookieValue(ck_name) {
	ck_name = hex_md5(ck_name);
	var value = "";

	var cookies = document.cookie ? document.cookie.split(";") : [];

	for(var i = 0 ; i < cookies.length ; i++) {
		var arr = cookies[i].split("=");
		var name = $.trim(arr[0]);

		if(ck_name == name) {
			arr.shift();
			value = arr.join("=");
		}
	}

	value = decodeURIComponent(value);	
	value = Base64.decode(value);

	return value;
}

// Set Cookie
function setCookieValue(ck_name, value, exp_day) {

	ck_name = hex_md5(ck_name);
	
	value = Base64.encode(value);
	value = encodeURIComponent(value);

	//document.write(value);
	//return false;

	if(!exp_day) { exp_day = 1; }

	var today = new Date();
    today.setTime(today.getTime() + (86400 * 1000 * exp_day));

	document.cookie = ck_name + "=" + value + "; path=/; expires=" + today.toGMTString();
}

// delete Cookie
function deleteCookieValue(ck_name) {
	var value = getCookieValue(ck_name);
	if(value != "") {
		ck_name = hex_md5(ck_name);
		var today = new Date();
	    today.setTime(today.getTime() - 1);
		document.cookie = ck_name + "=" + "" + "; path=/; expires=" + today.toGMTString();
	}
}
