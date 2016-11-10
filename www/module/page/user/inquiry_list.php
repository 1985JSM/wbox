<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '';
$doc_title = '문의하기';
$footer_nav['1'] = true;

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

<div class="tab">
	<ul id="shop_tab" class="tab_list tab_list02">
	<li><a href="#">1:1문의하기</a></li>
	<li class="on"><a href="#">1:1문의내역</a></li>
	</ul>
</div>

<div id="container"  class="container">
	<div class="board">
		<ul id="board_list" class="board_list">
		<li class="on answer"> <!-- 답변이 달리는 경우 class="answer" -->
			<button type="button" onclick="" style="display:block" class="answer"> <!-- on 스타일보여주기위해 들어가있음 -->
				<strong>제목이들어갑니다.제목이들어갑니다.제목이들어갑니다.제목이들어갑니다.제목이들어갑니다.제목이들어갑니다.제목이들어갑니다.제목이들어갑니다.제목이들어갑니다.</strong>
				<span class="icon_answer">답변</span><span class="data">2016.05.30</span>
				<i class="xi-angle-down"></i>
			</button>
			<div class="cont" style="display: block;">
			내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.
				<div class="answer_area">
					<i class="xi-reply-l"></i><span class="icon_reply">답변내용</span><span class="data">2016.05.30</span>
					<p class="answer_view">
						답변 내용이 들어갑니다. 감사합니다. 답변드립니다. 
					</p>
				</div>

			</div>
		</li>
		<li> 
			<button type="button" onclick="" style="display:block" class="answer">
				<strong>제목이들어갑니다.</strong>
				<span class="icon_answer">대기</span><span class="data">2016.05.30</span>
				<i class="xi-angle-down"></i>
			</button>
			<div class="cont">
			내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.내용이들어갑니다.
			</div>
		</li>
		<li class="no_data">
			<p>등록된 공지사항이 없습니다.</p>
		</li>
		</ul>
	</div>
</div>

