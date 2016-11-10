<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/more.html';
$doc_title = '관리자메모 ';
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
div.admin_memo {position:relative; padding:20px 10px;}
div.admin_memo div.layer_textarea{padding:10px;border:1px solid #ccc; border-radius:2px; margin-bottom:5px; background:#fff;}
div.admin_memo div.layer_textarea textarea{ border:0;width:100%;height:200px}
</style>

<div id="container6" class="container">

	<div class="admin_memo">
		<form name="" method="" action="" target="#layer_content" onsubmit="">

		<div class="layer_textarea">
			<textarea name="" title="고객관리용 관리자메모" class="" placeholder="고객관리를 위한 관리자 메모입니다. 해당 메모는 관리자만 확인 가능합니다." maxlength="500"></textarea>
		</div>

		<ul class="layer_btn">
		<li><div><button type="button" class="btn_orange">확인</button></div></li>	
		</ul>

		</form>
	</div>

</div>
<!-- //container -->