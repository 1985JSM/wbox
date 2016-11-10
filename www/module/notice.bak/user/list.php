<?
if(!defined('_INPLUS_')) { exit; } 

$oNotice = new NoticeUser();
if($sh_code) {
	$sch_a_sh_code = $sh_code;
	$oNotice->set('sch_a_sh_code', $sh_code);
}
$oNotice->init();


$list = $oService->selectList();
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#container").scroll(function() {
		getNextPage();		
	});
});
</script>

	<div id="container"  class="container">
		<div class="board">
			<ul id="board_list" class="board_list">
			<? include_once(_MODULE_PATH_.'/notice/user/ajax_list.php'); ?>		
			</ul>
		</div>
    </div>

	<input type="hidden" id="is_load"	value="" />
	<input type="hidden" id="ajax_url"	value="ajax_list.html" />
	<input type="hidden" id="next_page"	value="2" />
	<input type="hidden" id="query_string"	value="<?=$query_string?>" />
        
