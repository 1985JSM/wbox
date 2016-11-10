<? if(!defined('_INPLUS_')) { exit; } 
$html_title = '최고관리자모드 :: 예약박스';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>" />
<? if($is_mobile) { ?>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<? } ?>
<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="Ma Yong Min(milgam12@inplusweb.com)" />
<meta name="copyright" content="COPYRIGHT &copy; 2014 inplusweb.com ALL RIGHT RESERVED." />
<meta name="language" content="ko" />
<title><?=$html_title?></title>
<link rel="stylesheet" type="text/css" href="<?=$layout_uri?>/styles.css" />
<link rel="stylesheet" type="text/css" href="<?=$js_uri?>/jquery-ui-1.11.1.custom/jquery-ui.min.css" />
<script type="text/javascript" src="<?=$js_uri?>/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/jquery-ui-1.11.1.custom/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/inplus.util.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/inplus.validate.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/inplus.msg.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/inplus.common.js"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	// 버튼
	setButtonStyle(document);

	// 달력
	$.datepicker.regional["ko"] = {
		closeText: "닫기",
		prevText: "이전달",
		nextText: "다음달",
		currentText: "오늘",
		changeMonth: true,
		changeYear: true,
		showButtonPanel: false,
		yearRange: "c-99:c+99",
		maxDate: "+"+365*10+"d",
		minDate: "-"+365*10+"d",
		monthNames: ["1월","2월","3월","4월","5월","6월",
		"7월","8월","9월","10월","11월","12월"],
		monthNamesShort: ["1월","2월","3월","4월","5월","6월",
		"7월","8월","9월","10월","11월","12월"],
		dayNames: ["일요일","월요일","화요일","수요일","목요일","금요일","토요일"],
		dayNamesShort: ["일","월","화","수","목","금","토"],
		dayNamesMin: ["일","월","화","수","목","금","토"],
		weekHeader: "Wk",
		dateFormat: "yy-mm-dd",
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: "",
		showOn: "button",
		buttonImage: "/share/js/jquery-ui-1.11.1.custom/images/btn_calendar.gif",
		buttonImageOnly: true,
		buttonText: "Select date"
	};
	$.datepicker.setDefaults($.datepicker.regional["ko"]);
	 
	$("input.date").datepicker(); 

	/*
	// 테이블
	addResponsiveDiv(document);

	// 반응형
	resizeLayout();
	$(window).resize(function() {
		resizeLayout()
	});
	*/
});

var base_uri = "<?=_BASE_URI_?>";
//]]>
</script>
