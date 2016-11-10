<?
$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;
?>
<!DOCTYPE html>
<html>
<head>
	<title>결과</title>
</head>
<body>
<form action="./sms_join_result.html" name="myForm" target="_parent" method="post">
<? foreach ($_POST as $key => $value) { ?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<? } ?>
</form>
<script>
window.onload = function() {
	document.myForm.submit();
}
</script>
</body>
</html>
