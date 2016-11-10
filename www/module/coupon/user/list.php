<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '나의쿠폰';
$footer_nav['1'] = true;

$oCoupon = new CouponUser();
$oCoupon->init();

$list_mode = 'admin';
?>
<style type="text/css">
div.coupon {margin-bottom:20px; background:#fff;}
div.coupon h4 {padding:10px; font-size:14px; border-bottom:4px solid #f6f6f6; color:#000;}
div.coupon > ul > li {border-bottom:1px solid #f6f6f6}
div.coupon_area a {display:block;padding:20px 10px;}
div.coupon_area div.coupon_info {position:relative;}
div.coupon_area div.coupon_info span.tit {display:block; margin-right:92px; font-size:16px; font-weight:bold; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}
div.coupon_area div.coupon_info span.btn_use {display:block; width:80px; height:24px; margin:10px 0 12px 0;  line-height:24px; font-size:14px; text-align:center; border:1px solid #f06e58; border-radius:24px; color:#f06e58}
div.coupon_area div.coupon_info span.benefit {display:block; position:absolute; top:0; right:0; width:80px; height:80px; line-height:80px; font-weight:bold;text-align:center;  box-sizing:border-box;border-radius:60px; background:#f06e58; color:#fff;}
div.coupon_area div.coupon_guide {font-size:12px; color:#888888}
div.coupon_area div.coupon_guide span {display:block;}

div.coupon_area div.coupon_guide ul {margin-top:6px;}
div.coupon_area div.coupon_guide ul li {padding-left:16px; background:url("/img/mobile/ico/ico_belit.png") 6px 6px no-repeat; background-size:3px;}

div.coupon_area.disable div.coupon_info span.btn_use {border-color:#999999; color:#999999; }
div.coupon_area.disable div.coupon_info span.benefit {background-color:#999999; }

div.coupon li.no_data p { padding:15px 10px; text-align:center;color:#888;}
div.coupon li.no_data p i {display:block; margin-bottom:10px; font-size:40px; color:#cccccc }
</style>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>

<div id="container" class="container">

	<div class="coupon">
		<ul>
		<? include_once(_MODULE_PATH_.'/coupon/user/ajax.list.php'); ?>		
		</ul>
	</div>

</div>

<form name="portfolio_page_form" method="get" action="../portfolio/ajax.list.html" target="#portfolio_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="list_mode"		value="<?=$list_mode?>" />
</form>