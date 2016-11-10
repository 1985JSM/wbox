<?
$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;
?>
<!DOCTYPE html>
<html>
<head>
	<title>결제모듈</title>
</head>
<body>
<form id="form" name="form" method="post" action="http://smscore.co.kr/webapi/payment/popup.request.html">
	<input type="hidden" name="mb_partner" value="wbox">
</form>
<script type="text/javascript">
	window.onload = function() {
        document.form.submit();
    }
</script>
</body>
</html>