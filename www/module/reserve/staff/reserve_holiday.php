<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/more.html';
$doc_title = '휴무일정 ';
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
div.layer_res_list {padding:20px 10px; background:#fff; box-sizing:border-box;}
div.layer_res_list div {margin-bottom:20px;}
div.layer_res_list li{padding-left:10px;position:relative;color:#555;line-height:15px;font-size:12px; margin-bottom:10px}
div.layer_res_list li:after{display:block;content:'';width:3px;height:3px; background:#555; position:absolute;top:5px;left:0}
div > ul.layer_btn > li {}

</style>

<div id="container2" class="container">

	<div class="layer_res_list">
		<div>
			<ul class="layer_list">
			<li>2016-06-08 00:00 ~ 2016-06-09 00:00</li>
			<li>Basic Pedcure (60분) 외 1건 </li> <!-- 서비스가 2개 이상인 경우, 외 몇개라고 표시 -->
			<li>2016-05-28 11:30</li>
			</ul>
		</div>
	</div> 

</div>
<!-- //container -->