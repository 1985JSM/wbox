<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '공지사항';
$footer_nav['1'] = true;

$oNotice = new NoticeUser();
$oNotice->init();

$list_mode = 'admin';
?>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.notice_page_form, function() { 
		
		});
	});
});
</script>

<div id="container" class="container">
	<div class="board">	
		<ul id="board_list" class="board_list">
		<? include_once(_MODULE_PATH_.'/notice/user/ajax.list.php'); ?>		
		</ul>
	</div>
</div>

<form name="notice_page_form" method="get" action="../notice/ajax.list.html" target="#board_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="list_mode"		value="<?=$list_mode?>" />
</form>
