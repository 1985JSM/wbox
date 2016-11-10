<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/more.html';
$doc_title = '담당자승인';
$footer_nav['2'] = true;


?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$(document).on("click", ".btn_change_state", function(e) {
		changeReserveState(this, "view");
		e.preventDefault();
	});
});
//]]>
</script>
<style type="text/css">
div.approval {position:relative; padding:20px 10px; background:#fff;}
div.approval em {position:absolute; top:30px; left:10px; border-bottom:0; font-size:14px; font-weight:bold;color:#999;}
div.approval div.btn_switch3 {display:block; margin-bottom:20px; float:right;}
div.approval div.btn_switch3:after {display:block;content:'';clear:both;}
div.approval div.btn_switch3 a, div.approvaldiv.btn_switch3 button {display:block; float:left; height:30px; padding:0 10px; line-height:30px; color:#bbb; border:1px solid #fff; text-align:center; background:#ebebeb;}
div.approval div.btn_switch3 a.on, div.approvaldiv.btn_switch3 button.on {color:#fff; border:1px solid #fff; background:#72ced4;}
div.approval div.btn_switch3 a:first-child, div.approvaldiv.btn_switch3 button:first-child{border-radius:2px 0 0 2px;}
div.approval div.btn_switch3 a:last-child, div.approvaldiv.btn_switch3 button:last-child{border-radius:0px 2px 2px 0px;}

div.approval p {display:block; clear:both; margin-bottom:20px; font-size:12px;}

div.approval ul.layer_btn2 {display:block; width:100%; clear:both;}
div.approval ul.layer_btn2:after {display:block;content:'';clear:both;}

div.approval ul.layer_btn2 li { width:49%; float:right; }
div.approval ul.layer_btn2 li:first-child {float:left; }
</style>

<div id="container4" class="container">

	<div class="approval">

		<em>승인여부</em>
		<div class="btn_switch3">
			<a href="#" class="on" title="예약승인">예약승인</a>
			<a href="#" class="" title="예약불가">예약불가</a>
		</div>
		<p class="col_orange">예약승인 후 변경은 불가능합니다. 신중히 선택바랍니다.</p>
			
		<ul class="layer_btn2">
		<li><button type="button" class="btn_orange">확인</button></li>
		<li><button type="button" class="btn_gray" onclick="closeLayerPopup()">취소</button></li>	
		</ul>

		</div>
	</div>  

</div>
<!-- //container -->