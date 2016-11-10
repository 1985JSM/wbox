<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '1:1문의';
$footer_nav['1'] = true;

$oQna = new QnaUser();
$oQna->init();
?>
<style type="text/css">

div.board ul.board_list li button > span.icon_answer {display:inline-block; padding:4px 8px; margin-right:8px; border-radius:20px;line-height:12px; font-size:12px; background:#888888; color:#fff;}

div.board ul.board_list li.answer button > span.icon_answer {background:#f06e58;}

div.board ul.board_list li.answer div.cont > div.answer_area {margin-top:20px;}
div.board ul.board_list li.answer div.cont > div.answer_area i {transform:rotate(180deg); -webkit-transform:rotate(180deg); color:#888; margin-right:8px;}
div.board ul.board_list li.answer div.cont > div.answer_area span.icon_reply {display:inline-block; padding:4px 8px; margin-right:8px; border-radius:20px; border:1px solid #f06e58; line-height:12px; font-size:12px; background:#fff; color:#f06e58; box-sizing:border-box;}
div.board ul.board_list li.answer div.cont > div.answer_area span.data{display:inline-block;color:#888;font-size:12px; padding:5px 0; font-weight:normal}
div.board ul.board_list li.answer div.cont > div.answer_area p.answer_view {margin-left:28px}

</style>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.qna_page_form, function() { 
		
		});
	});
});
</script>

<div class="tab">
	<ul id="shop_tab" class="tab_list tab_list02">
	<li><a href="./write.html">문의하기</a></li>
	<li class="on"><a href="./list.html">문의내역</a></li>
	</ul>
</div>

<div id="container" class="container">
	<div class="board">	
		<div class="portfolio">

		<ul id="board_list" class="board_list">
		<? include_once(_MODULE_PATH_.'/qna/user/ajax.list.php'); ?>		
		</ul>
	</div>
</div>

<form name="qna_page_form" method="get" action="../qna/ajax.list.html" target="#board_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
</form>
