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
<script type="text/javascript">
$(document).ready(function() {

	// 다음 페이지 가지고 오기
	$("#container5").scroll(function() {
		getNextPageByAjax(this, document.comment_page_form, function() { 
		
		});
	});
});
</script>


<div class="location">
	<h2><?=$sh_name?></h2>
	<button type="button" onclick="closeLayerPage('5')" class="location_prev"><i class="xi-angle-left"></i></button>
</div>

<div id="container5" class="container">
	<?=$view_content?>
</div>

<form name="comment_page_form" method="get" action="../portfolio/ajax.comment_list.html" target="#comment_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="<?=$pk?>"		value="<?=$uid?>" />
</form>
