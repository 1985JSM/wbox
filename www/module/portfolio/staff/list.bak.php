<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '포트폴리오관리';
$footer_nav['5'] = true;
$back_url = '../page/more.html';

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#container").scroll(function() {
		getNextPage();		
	});
});
</script>

	<div id="container" class="portfolio">
		
		<a href="../portfolio/ajax_write.html" class="btn_ajax size_280x290 btn_gray" target="#layer_popup" title="포트폴리오 등록">포트폴리오 등록</a>

        <ul id="portfolio_list" class="photo_list">
		<? include_once(_MODULE_PATH_.'/portfolio/staff/ajax_list.php'); ?>				
        </ul>
    </div>

	<input type="hidden" id="is_load"	value="" />
	<input type="hidden" id="ajax_url"	value="ajax_list.html" />
	<input type="hidden" id="next_page"	value="2" />
	<input type="hidden" id="query_string"	value="<?=$query_string?>" />


	