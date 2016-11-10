<HTML lang=ko xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko"><HEAD><TITLE>가맹점관리자모드 :: 예약박스</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META http-equiv=X-UA-Compatible content=IE=10,chrome=1>
<META http-equiv=Cache-Control content=no-cache>
<META http-equiv=Pragma content=no-cache>
<META http-equiv=imagetoolbar content=no>
<META name=author content="Ma Yong Min(milgam12@inplusweb.com)">
<META name=copyright content="COPYRIGHT © 2014 inplusweb.com ALL RIGHT RESERVED.">
<META name=language content=ko><LINK href="http://wbox.inplus21.com/layout/manager/styles.css" rel=stylesheet type=text/css><LINK href="http://wbox.inplus21.com/share/js/jquery-ui-1.11.1.custom/jquery-ui.min.css" rel=stylesheet type=text/css><LINK href="http://wbox.inplus21.com/share/js/uniform/uniform.css" rel=stylesheet type=text/css><LINK href="http://wbox.inplus21.com/webmanager/customer/style.css" rel=stylesheet type=text/css>
<SCRIPT src="http://wbox.inplus21.com/share/js/jquery-1.8.3.min.js" type=text/javascript></SCRIPT>
<SCRIPT src="http://wbox.inplus21.com/share/js/jquery-ui-1.11.1.custom/jquery-ui.min.js" type=text/javascript></SCRIPT>

<SCRIPT src="http://wbox.inplus21.com/share/js/uniform/jquery.uniform-2.1.1.min.js" type=text/javascript></SCRIPT>

<SCRIPT src="http://wbox.inplus21.com/share/js/jquery.smenu-0.1.2.min.js" type=text/javascript></SCRIPT>

<SCRIPT src="http://wbox.inplus21.com/share/js/inplus.util.js" type=text/javascript></SCRIPT>

<SCRIPT src="http://wbox.inplus21.com/share/js/inplus.validate.js" type=text/javascript></SCRIPT>

<SCRIPT src="http://wbox.inplus21.com/share/js/inplus.msg.js" type=text/javascript></SCRIPT>

<SCRIPT src="http://wbox.inplus21.com/share/js/inplus.common.js" type=text/javascript></SCRIPT>

<SCRIPT type=text/javascript>
//<![CDATA[
$(document).ready(function() {
	
	// GNB
	$("#gnb").sMenu({		
		on_menu1	: "1",
		on_menu2	: "",
		hover_class : "hover",
	});	

	$("#snb").sMenu({		
		on_menu1	: "1",
		on_menu2	: "1",
		hover_class : "hover",
		is_snb		: true,
		hoverCall	: function(obj, depth) {
			obj.removeClass("hover");
			if(!obj.hasClass("on")) {
				obj.addClass("on");				
			}
			else {
				obj.removeClass("on");				
			}
		}
	});	

	initContent(document);
});

var layout = "manager";
var base_uri = "http://wbox.inplus21.com";

//]]>
</SCRIPT>
<SCRIPT src="http://wbox.inplus21.com/webmanager/customer/common.js" type=text/javascript></SCRIPT>
</HEAD>
<BODY class=layout-small>

<DIV id=layer_popup style="HEIGHT: 600px; WIDTH: 600px; MARGIN-LEFT: -300px; MARGIN-TOP: -300px; DISPLAY: block" jQuery18308423671153985832="81">
<DIV id=layer_header>
<H1>선불제 신규 등록</H1><BUTTON title=닫기 onclick=closeLayerPopup() type=button><IMG alt=X src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif"></BUTTON> </DIV>
<DIV id=layer_content style="HEIGHT: 500px"><INPUT name=flag_json type=hidden value=1> <INPUT name=mode type=hidden value=insert> <INPUT name=ad_pc_id type=hidden> <INPUT name=sh_code type=hidden value=QI08Q1DE2C37> <INPUT name=cs_id type=hidden value=296> <INPUT name=ad_pc_type type=hidden value=M> <INPUT name=ad_pc_name type=hidden value=10만원권> <INPUT name=ad_pc_price type=hidden value=100000> 
<TABLE class=write_table border=1>
<COLGROUP>
<COL width=140>
<COL></COLGROUP>
<TBODY class=ad_type_M id=write_tbody>
<TR>
<TH class=required>선불제상품</TH>
<TD>
<DIV class=selector id=uniform-ad_id style="WIDTH: 199px"><SPAN style="WIDTH: 174px; MozUserSelect: none; msUserSelect: none; webkitUserSelect: none" jQuery18308423671153985832="92">10만원권 (100,000원)</SPAN><SELECT name=ad_id title=선불제상품 class=select id=ad_id sizset="true" sizcache0055892159807404085="311.71828182845905 19 0" jQuery18308423671153985832="82"> <OPTION value=27 selected>10만원권 (100,000원)</OPTION> <OPTION value=28>20만원권 (200,000원)</OPTION> <OPTION value=33>20만원권(현) (200,000원)</OPTION> <OPTION value=29>30만원권 (300,000원)</OPTION> <OPTION value=30>50만원권 (500,000원)</OPTION></SELECT></DIV> </TD></TR>
<TR>
<TH class=required>결제수단</TH>
<TD>
<DIV class=selector style="WIDTH: 51px"><SPAN style="WIDTH: 26px; MozUserSelect: none; msUserSelect: none; webkitUserSelect: none" jQuery18308423671153985832="104">카드</SPAN><SELECT name=ad_pc_method title=결제수단 class=select sizset="true" sizcache0055892159807404085="322.71828182845905 19 5" jQuery18308423671153985832="94"> <OPTION value=C selected>카드</OPTION><OPTION value=S>현금</OPTION></SELECT></DIV> </TD></TR>
<TR class="tr_ad_options ad_type_M">
<TH>정액요금</TH>
<TD><INPUT name=ad_pc_money title=정액요금 class="text money" type=text size=15 maxLength=10 value=110,000>원 </TD></TR>
<TR class="tr_ad_options ad_type_Q">
<TH>이용횟수</TH>
<TD><INPUT name=ad_pc_quantity title=이용횟수 class="text number" type=text size=15 maxLength=5 value=0>회 </TD></TR>
<TR>
<TH class=required>시작일</TH>
<TD><INPUT name=ad_pc_start title=시작일 class="text date required hasDatepicker" id=dp1472450200289 type=text size=15 maxLength=10 value=2016-08-29 jQuery18308423671153985832="108"><IMG title="Select date" class=ui-datepicker-trigger alt="Select date" src="/share/js/jquery-ui-1.11.1.custom/images/btn_calendar.gif" jQuery18308423671153985832="106"> </TD></TR>
<TR>
<TH class=required>만료일</TH>
<TD><INPUT name=ad_pc_expire title=만료일 class="text date required hasDatepicker" id=dp1472450200290 type=text size=15 maxLength=10 value=2016-11-29 jQuery18308423671153985832="114"><IMG title="Select date" class=ui-datepicker-trigger alt="Select date" src="/share/js/jquery-ui-1.11.1.custom/images/btn_calendar.gif" jQuery18308423671153985832="112"> </TD></TR></TBODY></TABLE>
<P class=button><BUTTON class="sButton primary" type=submit><SPAN class=sButton-container><SPAN class=sButton-bg><SPAN class=text>등록</SPAN></SPAN></SPAN></BUTTON><BUTTON class="sButton active" onclick=closeLayerPopup() type=button><SPAN class=sButton-container><SPAN class=sButton-bg><SPAN class=text>닫기</SPAN></SPAN></SPAN></BUTTON> </P><FORM></DIV></DIV><!-- //layer popup -->
<DIV class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id=ui-datepicker-div jQuery18308423671153985832="3"></DIV>

</BODY></HTML>