<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../shop/area.html';
$doc_title = '검색';
$footer_nav['3'] = true;

$oShop = new ShopUser();
$oShop->init();
$list = $oShop->selectList();

$order_field_arr = $oShop->get('order_field_arr');

ob_start();
include_once(_MODULE_PATH_.'/shop/user/ajax.list.php');
$search_list = ob_get_contents();
ob_end_clean();
?>
<style type="text/css">
div.search_result div.search_result_txt {background:#fff; padding:20px 10px; color:#000000; overflow:hidden; text-overflow:ellipsis;  white-space:nowrap;}
div.search_result div.search_result_txt strong {}

div.selection_range {position:relative; display:block; margin:0; background:#f6f6f6; padding:15px 10px 0 10px; box-sizing:border-box;  font-size:12px; height:34px; }
div.selection_range ul:after {display:block; clear:both; content:'';}
div.selection_range ul li {display:block;float:left; width:auto; margin:0; padding:0; }
div.selection_range ul li:first-child {}

div.selection_range i {display:inline-block; line-height:20px; padding-right:5px; color:#bbb }
div.selection_range select { height:20px; line-height:20px; font-size:12px; padding:0 10px 0 0; background:transparent; -webkit-appearance:none; border:0; }
</style>
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
		var f = document.search_shop_form;
		f.sch_order_field.value = sch_order_field;
		f.submit();
	});
});
</script>


<div class="search">
	<form name="search_shop_form" method="get" action="./search_list.html" onsubmit="return submitSearchShopForm(this)">
	<input type="hidden" name="sch_type" value="<?=$sch_type?>" />
	<input type="hidden" name="sch_order_field" value="<?=$sch_order_field?>" />

	<div class="search_area">
		<button class="btn_search"><i class="xi-magnifier"></i></button>
		<div class="search_input">
			<input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="required" placeholder="검색어를 입력해주세요." title="검색어">
		</div>
	</div>
	<button type="submit" class="btn_search02">검색</button>
	</form>
</div>
	
<div id="container" class="container">
	<div class="search_result">
		<div class="search_result_txt">
			<strong class="col_orange"><?=$sch_keyword?></strong> <strong class="col_aqua"><?=number_format($total_cnt)?>개</strong> 검색 결과			
		</div>

		<div class="selection_range">
			<ul>
			<li><i class="xi-lineheight-plus"></i></li>
			<li>
				<select name="sch_order_field" id="sch_order_field">
				<? printSelectOption($order_field_arr, $sch_order_field, 1); ?>
				</select>
			</li>
			
			</ul>
		</div>

		<ul id="shop_list" class="shop_list">
		<?=$search_list?>
		</ul>			
		
	</div>
	<!-- search_result -->
</div>

<form name="shop_page_form" method="get" action="../shop/ajax.list.html" target="#shop_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="sch_type"		value="<?=$sch_type?>" />
<input type="hidden" name="sch_keyword"		value="<?=$sch_keyword?>" />
<input type="hidden" name="sch_order_field"	value="<?=$sch_order_field?>" />
</form>