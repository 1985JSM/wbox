<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '나의매장';
$footer_nav['4'] = true;

$oShop = new ShopUser();
$oShop->init();

$list_mode = 'reserve';
?>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.shop_page_form, function() { 
		
		});
	});
});
</script>

<div class="tab">
	<ul class="tab_list tab_list03">	
	<li><a href="./favorite_list.html" <? if(!$is_user) { ?>class="btn_only_login"<? } ?>>즐겨찾기매장</a></li>
	<li class="on"><a href="./reserve_list.html" <? if(!$is_user) { ?>class="btn_only_login"<? } ?>>예약한 매장</a></li> 
	<li><a href="./visit_list.html">최근 본 매장</a></li>
	</ul>
</div>

<div id="container" class="container">
	<div class="mysurr">
		<ul id="shop_list" class="shop_list">
		<? include_once(_MODULE_PATH_.'/shop/user/ajax.list.php'); ?>		
		</ul>        
	</div>
</div>

<form name="shop_page_form" method="get" action="../shop/ajax.list.html" target="#shop_list">
<input type="hidden" name="flag_json"	value="1" />
<input type="hidden" name="is_load"		value="" />
<input type="hidden" name="page"		value="2" />
<input type="hidden" name="list_mode"	value="<?=$list_mode?>" />
</form>        
