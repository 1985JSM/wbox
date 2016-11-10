<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '예약박스 추천샵';
$footer_nav['1'] = true;

/* recommend */
if(!isset($oRecommend)) {
	include_once(_MODULE_PATH_.'/recommend/recommend.user.class.php');
	$oRecommend = new RecommendUser();
	$oRecommend->init();
}
$rc_pk = $oRecommend->get('pk');
$rc_id = $oRecommend->get('uid');
$rc_data = $oRecommend->selectDetail($rc_id);
$sh_code_arr = $oRecommend->selectShopCodeArray($rc_id);

/* shop */
$oShop = new ShopUser();
$oShop->init();
$list_mode = 'recommend';
?>
<style type="text/css">
div.recommend_shop {display:block; position:relative; width:100%;  margin-bottom:20px;  box-sizing:border-box; }
div.recommend_shop div.theme ul li {position:relative; width:100%; margin-bottom:10px; }
div.recommend_shop div.theme ul li div.info_area {display:block; overflow:hidden; position:absolute; z-index:10; width:100%; top:50%; margin-top:-36px; padding-top:10px; text-align:center; color:#fff; box-sizing:border-box;  background:url("/img/mobile/bg/bg_recommend_shop.png") top center no-repeat; background-size:23px 5px;}
div.recommend_shop div.theme ul li div.info_area strong {display:block; overflow:hidden; font-size:16px;text-overflow:ellipsis; white-space:nowrap;}
div.recommend_shop div.theme ul li div.info_area em {display:block; font-size:14px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.recommend_shop div.theme ul li div.img_area {display:block; overflow:hidden; background:#000; }
div.recommend_shop div.theme ul li div.img_area img {width:100%; height:auto; opacity:0.7; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.shop_page_form, function() { 
		
		});
	});
});
</script>
	
<div id="container" class="container">
	<div class="recommend_shop">
		<div class="theme">
			<ul>
			<li class="theme_list01">
				<div class="info_area">
					<strong><?=$rc_data['rc_subject']?></strong>
					<em><?=$rc_data['rc_subject2']?></em>
				</div>
				<div class="img_area">
					<img src="<?=$rc_data['thumb']?>" alt="<?=$rc_data['rc_subject']?> thumbnail image" />
				</div>
			</li>					
			</ul>
		</div>

		<ul id="shop_list" class="shop_list">
		<? include_once(_MODULE_PATH_.'/shop/user/ajax.list.php'); ?>
		</ul>			
		
	</div>
	<!-- search_result -->
</div>

<form name="shop_page_form" method="get" action="../shop/ajax.list.html" target="#shop_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="list_mode"		value="<?=$list_mode?>" />
<? for($i = 0 ; $i < sizeof($sh_code_arr) ; $i++) { ?>
<input type="hidden" name="sh_code_arr[]"		value="<?=$sh_code_arr[$i]?>" />
<? } ?>
</form>