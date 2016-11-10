<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioUser();
if($sh_code) {
	$sch_a_sh_code = $sh_code;
	$oPortfolio->set('sch_a_sh_code', $sh_code);
}
$oPortfolio->init();
?>
<script type="text/javascript">
$(document).ready(function() {
	// 가맹점 탭 변경
	$("#shop_tab > li").not(":eq(4)").removeClass("on").end().eq(4).addClass("on");

	// 다음 페이지 가지고 오기
	$("#container2").scroll(function() {
		getNextPageByAjax(this, document.portfolio_page_form, function() { 
		
		});
	});
});
</script>

<div class="view_detail">	
	<div class="portfolio">
		<ul id="portfolio_list">
		<? include_once(_MODULE_PATH_.'/portfolio/user/ajax.list.php'); ?>		
		</ul>	
	</div>
</div>

<form name="portfolio_page_form" method="get" action="../portfolio/ajax.list.html" target="#portfolio_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="sch_a_sh_code"		value="<?=$sch_a_sh_code?>" />
<input type="hidden" name="sch_a_st_id"		value="<?=$sch_a_st_id?>" />
</form>