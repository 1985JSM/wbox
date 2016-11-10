<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../shop/area.html?sch_sh_sido='.$sch_sh_sido;
$doc_title = '검색';
$footer_nav['3'] = true;

$oShop = new ShopUser();
$oShop->init();
$query_string = $oShop->get('query_string');

$order_field_arr = $oShop->get('order_field_arr');
?>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.shop_page_form, function() { 
		
		});
	});

	// 정렬순서 변경
	$("#sch_order_field").on("change", function() {
		var sch_order_field = $(this).val();
		location.replace("./area_list.html?sch_sh_sido=<?=$sch_sh_sido?>&sch_sh_sigungu=<?=$sch_sh_sigungu?>&sch_order_field=" + sch_order_field);
	});
});
</script>

<div class="geo">
	<p class="current"><i class="xi-marker-circle"></i> <?=$sch_sh_sido?> <?=$sch_sh_sigungu?></p>

	<div class="selection_range_shop">
		<ul>
			<li><i class="xi-lineheight-plus"></i></li>
			<li>
			<select name="sch_order_field" id="sch_order_field">
			<? printSelectOption($order_field_arr, $sch_order_field, 1); ?>
			</select>
			</li>
		</ul>	
	</div>
</div>



<div id="container" class="container">
	<div class="mysurr">
		<ul id="shop_list" class="shop_list">
		<? include_once(_MODULE_PATH_.'/shop/user/ajax.list.php'); ?>		
		</ul>        
	</div>
</div>

<form name="shop_page_form" method="get" action="../shop/ajax.list.html" target="#shop_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="sch_sh_sido"		value="<?=$sch_sh_sido?>" />
<input type="hidden" name="sch_sh_sigungu"	value="<?=$sch_sh_sigungu?>" />
<input type="hidden" name="sch_order_field"	value="<?=$sch_order_field?>" />
</form>
	
