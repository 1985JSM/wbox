<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* set URI */
$layout_size = 'small';
$doc_title = '1:1문의';
?>

<link rel="stylesheet" type="text/css" href="http://smscore.inplus21.com/common/css/ui.css" />

<!-- <?=$module?> -->
<div id="<?=$module?>">

<!-- qna -->
<div id="qna">

	<div class="board_view">
		<dl>
		<dt>문의사항 있습니다~</dt>
		<dd>
			<span><em>작성자</em>로드네일(test)</span>
			<span><em>작성일시</em>2016-09-26 19:06:07</span>
			<span><em>답변여부</em>답변대기</span>
		</dd>							
		<dd class="cont">
			<div>
				<!-- 게시판 내용 -->
				<p>문의사항 있습니다~~</p>
				<!-- //게시판 내용 -->
			</div>
		</dd>				
		</dl>
		
		<!-- view_paging -->
		<div class="view_paging">
			<dl class="prev">
			<dt>이전글</dt>
			<dd>이전글이 없습니다.</dd>
			</dl>
			<dl class="next">
			<dt>다음글</dt>
			<dd>다음글이 없습니다.</dd>
			</dl>
		</div>
		<!-- //view_paging -->

		<!-- button -->
		<div class="button">
			<div class="left">		
				<a href="qna_write_if.html" class="sButton" title="수정">수정</a>
				<a href="" id="btn_delete" class="sButton warning" title="삭제">삭제</a>									
			</div>
			<div class="right">
				<a href="qna_list_if.html" class="sButton active" title="목록">목록</a>
			</div>
		</div>
		<!-- //button -->

	</div>
	<!-- //board_view -->
</div>
<!-- //qna -->	
	
</div>
<!-- //<?=$module?> -->