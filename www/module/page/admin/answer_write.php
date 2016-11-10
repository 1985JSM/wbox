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
	</div>
	<!-- //board_view -->

	<div class="write">

		<h4>답변작성</h4>
		
		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="" value="" />		
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />>
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	
		<input type="hidden" name="wr_id" value="2">

		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140">
		<col width="*">
		</colgroup>
		<tbody>		
		<tr>
			<th class="required">답변내용</th>
			<td>
			<textarea name="re_content" class="textarea required" rows="15" cols="120" title="답변내용"></textarea>	
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="#" class="sButton active" title="뒤로">뒤로</a>
		</p>

		</form>
	</div>

</div>
<!-- //<?=$module?> -->