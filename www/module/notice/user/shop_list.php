<?
if(!defined('_INPLUS_')) { exit; } 

$oNotice = new NoticeUser();
$oNotice->init();
$oNotice->set('sch_sh_code', $sh_code);
$list_mode = 'shop';
?>
<script type="text/javascript">
$(document).ready(function() {
	// 가맹점 탭 변경
	$("#shop_tab > li").not(":eq(3)").removeClass("on").end().eq(3).addClass("on");

	// 다음 페이지 가지고 오기
	$("#container2").scroll(function() {
		getNextPageByAjax(this, document.notice_page_form, function() { 
		
		});
	});
});
</script>

<div class="view_detail">

	<div class="coupon">
		<h4><i class="xi-coupon"></i> 매장 쿠폰 안내입니다.</h4>
		<ul>
		<? include_once(_MODULE_PATH_.'/coupon/user/ajax.list.php'); ?>			
		</ul>
	</div>

	<div class="board">
		<h4><i class="xi-notice"></i> 매장 공지 입니다.</h4>
		<ul id="board_list" class="board_list">
		<? include_once(_MODULE_PATH_.'/notice/user/ajax.list.php'); ?>		
		</ul> 
	</div>
</div>

<form name="notice_page_form" method="get" action="../notice/ajax.list.html" target="#board_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="list_mode"		value="<?=$list_mode?>" />
<input type="hidden" name="sch_sh_code"		value="<?=$sh_code?>" />
</form>
