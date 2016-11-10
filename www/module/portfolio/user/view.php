<?
if(!defined('_INPLUS_')) { exit; }

$oPortfolio = new PortfolioUser();
$oPortfolio->init();

$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');

ob_start();
include_once(_MODULE_PATH_.'/portfolio/user/ajax.view.php');
$view_content = ob_get_contents();
ob_end_clean();
?>
<style type="text/css">
#layer_page1.open {display:block; top:0; right:0;}
#layer_page3z {display:none;}
</style>
<script type="text/javascript">
$(document).ready(function() {

	// 다음 페이지 가지고 오기
	$("#container1").scroll(function() {
		getNextPageByAjax(this, document.comment_page_form, function() { 
		
		});
	});
});
</script>


<div class="location">
	<h2><?=$sh_name?></h2>
	<button type="button" onclick="closeLayerPage('1')" class="location_prev"><i class="xi-angle-left"></i></button>
</div>

<div id="container1" class="container">
	<?=$view_content?>
</div>

<!-- 퀵 메뉴는 포트폴리오 > 상세보기에서 출력 -->
<div class="quick_menu">
	<div class="quick_menu_area">
		<ul class="quick_list quick_list02">
		<li><div><a href="../staff/view.html?mb_id=<?=$data['st_id']?>" class="btn_layer_page btn_aqua_line btn_res" target="#layer_page3">디자이너보기</a></div></li>
		<li><div><a href="../shop/view.html?sh_code=<?=$data['sh_code']?>" class="btn_layer_page btn_layer_page btn_aqua" target="#layer_page2">샵바로가기</a></div></li>
		</ul>
	</div>
	<div class="quick_menu_bg"></div>
</div>
<!-- //퀵 메뉴는 포트폴리오 > 상세보기에서 출력 -->

<form name="comment_page_form" method="get" action="../portfolio/ajax.comment_list.html" target="#comment_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="<?=$pk?>"		value="<?=$uid?>" />
</form>
