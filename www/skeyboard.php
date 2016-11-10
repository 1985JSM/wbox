<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="Ma Yong Min(milgam12@inplusweb.com)" />
<meta name="copyright" content="COPYRIGHT &copy; 2014 inplusweb.com ALL RIGHT RESERVED." />
<meta name="language" content="ko" />
<title>가상 키보드 테스트</title>
<link rel="stylesheet" type="text/css" href="http://husone.co.kr/share/css/reset.css" />
<link rel="stylesheet" type="text/css" href="/share/font-awesome-4.3.0/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="http://archive.sdn21.com/archive/Javascript/skeyboard/skeyboard-basic.css" />
<script type="text/javascript" src="/share/js/jquery-1.8.3.min.js"></script>
<!--
script type="text/javascript" src="http://archive.sdn21.com/archive/Javascript/skeyboard/jquery.skeyboard-0.1.min.js"></script
-->
<script type="text/javascript" src="./jquery.skeyboard-0.1.js"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$("input.sKeyboard").sKeyboard({
		default_mode	: "korean"
		
	});
});
//]]>
</script>
</head>
<body>
<input type="text" name="test1" value="1" class="sKeyboard" />
</body>
</html>