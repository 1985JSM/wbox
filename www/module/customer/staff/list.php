<?
if(!defined('_INPLUS_')) { exit; } 

$oCustomer = new CustomerStaff();
$oCustomer->init();
?>
<style style="text/css">
div.reservation_user_select { background:#fff;}
div.reservation_user_select form {padding:20px 10px;}
div.reservation_user_select select{position:relative;width:100%}
div.reservation_user_select div.list_search_form {position:relative; height:38px; margin-bottom:10px; padding:0 35px 0 10px; border:1px solid #ccc; border-radius:2px;}
div.reservation_user_select div.list_search_form input{width:100%;height:38px; line-height:38px;color:#555; border:0}
div.reservation_user_select div.list_search_form button.btn_search { position:absolute;top:0;right:0; padding:0 10px; height:40px;line-height:40px; background:none; border:0;}

div.reservation_user_select div.list_serch_user {border-top:20px #f6f6f6 solid;}
div.reservation_user_select div.list_serch_user ul > li {position:relative; padding:0 14px; height:60px; line-height:60px; border-bottom:solid 4px #f6f6f6;}
div.reservation_user_select div.list_serch_user ul > li > a {display:block; color:#212121;}
div.reservation_user_select div.list_serch_user ul > li em {color:#7d7d7d; position: absolute; top:0; right:80px; text-align:right;}
div.reservation_user_select div.list_serch_user ul > li span > button, #layer_popup2 div.reservation_user_select div.list_serch_user ul > li span > a {position: absolute; top:10px; right:14px; display:block; height:40px; line-height:40px; text-align:center;color:#fff !important; font-weight:bold; background:#888; border-radius:2px; border:0; padding:0 10px; width:auto;}
div.car_number ul > li > a > span.active {  width:20%; text-align:right; color:#7d7d7d;}
div.reservation_user_select div.list_serch_user ul > li.no_date {text-align:center; line-height:18px; height:auto;padding:40px;}
div.reservation_user_select div.list_serch_user ul > li.no_date p {margin-bottom:20px;}
#layer_page6.open {display:block; top:0; right:0;}
</style>
<script type="text/javascript">
$(document).ready(function() {

	// 다음 페이지 가지고 오기
	$("#container6").scroll(function() {
		getNextPageByAjax(this, document.customer_page_form, function() { 
		
		});
	});
});
</script>

<div class="location">
	<h2>고객검색</h2>
	<button type="button" onclick="closeLayerPage('6')" class="location_prev"><i class="xi-angle-left"></i></button>
</div>

<div id="container6" class="container">

	<div  class="reservation_user_select" >
		<form name="search_customer_form" method="get" action="<?=$base_uri?>/customer/list.html" onsubmit="return submitSearchCustomerForm(this)" target="#layer_page6">
		<input type="hidden" name="flag_json" value="1" />
		<input type="hidden" name="sch_type" value="all" />

		<div class="list_search_form">			
			<div class="list_search_input"><input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="input_txt required" placeholder="이름/휴대폰 검색해주세요" title="이름 또는 휴대폰" /></div>
			<button type="submit" class="btn_search"><i class="xi-magnifier"></i></button>
		</div>
		</form>

		<div class="list_serch_user">
			<ul id="customer_list">
			<? include_once(_MODULE_PATH_.'/customer/staff/ajax.list.php'); ?>					
			</ul>
		</div>
		</form>
	</div>
</div>

<form name="customer_page_form" method="get" action="<?=$base_uri?>/customer/ajax.list.html" target="#customer_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="sch_type"		value="all" />
<input type="hidden" name="sch_keyword"		value="<?=$sch_keyword?>" />
</form>