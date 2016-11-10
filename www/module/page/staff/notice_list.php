<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '공지사항';
$footer_nav['1'] = true;

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
		<li>
			<button type="button" onclick="toggleArticle(this)">
				<strong>제목이들어가는공간입니다.</strong>
				<span class="data">2016.06.01</span>
				<i class="xi-angle-down"></i>
			</button>
			<div class="cont">
			내용이들어가는공간입니다.
			</div>
		</li>
		</ul>
	</div>
</div>
