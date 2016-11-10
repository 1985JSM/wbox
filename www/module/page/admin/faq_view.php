<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = 'FAQ';
?>

<style>
a.blog_link {margin-right:40px;}

</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">


	<div class="board_view">
		<dl>
		<dt>어플리케이션 다운방법</dt>
		<dd>
			<span><em>작성자</em>최고관리자</span>
			<span><em>작성일시</em>2016-01-25 15:06:41</span>
			<span><em>출력구분</em>가맹점</span>
		</dd>							
		<dd class="cont">
			<div>
				<!-- 게시판 내용 -->
				<p>내용이들어갑니다.</p>
				<!-- //게시판 내용 -->
			</div>
		</dd>				
		</dl>

		<div class="view_paging">
			<dl class="prev">
				<dt>이전글</dt>
				<dd>
				<a href="#">공지사항 테스트입니다. 공지사항 테스트입니다.</a>
				</dd>
			</dl>
			<dl class="next">
				<dt>다음글</dt>
				<dd>다음글이 없습니다.</dd>
			</dl>
		</div>

		<!-- button -->
		<div class="button">
			<div class="left">		
				<a href="#" class="sButton" title="수정">수정</a>
				<a href="#" class="sButton" title="삭제">삭제</a>

			</div>
			<div class="right">
				<a href="./list.html?page=1" class="sButton active" title="목록">목록</a>
			</div>
		</div>
		<!-- //button -->
	</div>
	<!-- //board_view -->
</div>

</div>
<!-- //<?=$module?> -->