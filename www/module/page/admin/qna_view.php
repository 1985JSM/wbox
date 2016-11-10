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
			<span><em>회원구분</em>회원</span>
			<span><em>답변여부</em>답변완료</span>
		</dd>	
		<dd>
			<span><em>휴대폰</em>0102345678</span>
			<span><em>이메일</em>smile@inplusweb.comsmile@inplusweb.comsmile@inplus</span>
			
		</dd>	
		<dd class="cont">
			<div>
				<!-- 게시판 내용 -->
				<p>내용이들어갑니다.</p>
				<!-- //게시판 내용 -->
			</div>
		</dd>				
		</dl>

		<dl class="comment">
		<dt><span class="success">[답변]</span> 답변입니다.</dt>
		<dd>
			<span><em>작성자</em>최고관리자</span>
			<span><em>작성일시</em>2016-05-20 16:13:05</span>
		</dd>
		<dd class="cont">
			<div>
				답변내용이 들어갑니다.
			</div>
		</dd>		
		</dl>

		<div class="button">
			<div class="right">		
				<a href="#" class="sButton" title="답변수정">답변수정</a>
				<a href="#" class="sButton" title="답변삭제">답변삭제</a>

			</div>
		</div>


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
				<a href="./list.html?page=1" class="sButton primary" title="답변">답변</a>
				<a href="./list.html?page=1" class="sButton active" title="목록">목록</a>
			</div>
		</div>
		<!-- //button -->
	</div>
	<!-- //board_view -->

</div>
<!-- //<?=$module?> -->