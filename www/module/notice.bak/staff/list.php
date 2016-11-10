<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/more.html';
$doc_title = '공지사항';
$footer_nav['5'] = true;

$oNotice = new NoticeStaff();
$oNotice->init();

$query_string = $oNotice->get('query_string');
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#container").scroll(function() {
		getNextPage();		
	});
});
</script>

	<div id="container" class="board">
        <ul id="board_list" class="board_list">
		<? include_once(_MODULE_PATH_.'/notice/staff/ajax_list.php'); ?>		
        </ul>        
    </div>

	<input type="hidden" id="is_load"	value="" />
	<input type="hidden" id="ajax_url"	value="ajax_list.html" />
	<input type="hidden" id="next_page"	value="2" />
	<input type="hidden" id="query_string"	value="<?=$query_string?>" />
        
