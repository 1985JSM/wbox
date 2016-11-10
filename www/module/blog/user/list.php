<?
if(!defined('_INPLUS_')) { exit; } 

$oBlog = new BlogUser();
$oBlog->init();

$sch_sh_code = $sh_code;
$oBlog->set('sch_sh_code', $sch_sh_code);
$sh_data = dbOnce("tbl_shop", "sh_name", "where sh_code = '$sh_code'", "");
$sh_name = $sh_data['sh_name'];
?>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container3").scroll(function() {
		getNextPageByAjax(this, document.blog_page_form, function() { 
		
		});
	});
});
</script>

<div class="location">
	<h2><?=$sh_name?></h2>
	<button type="button" onclick="closeLayerPage('3')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container3" class="container">
	<div class="blog_board_all">
		<div class="blog_board">
			<ul id="blog_list">
			<? include_once(_MODULE_PATH_.'/blog/user/ajax.list.php'); ?>
			</ul>
		</div>
	</div>
</div>

<form name="blog_page_form" method="get" action="../blog/ajax.list.html" target="#blog_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="sch_sh_code"		value="<?=$sch_sh_code?>" />
</form>
	
