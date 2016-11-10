<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '블로그포스팅';
?>

<style>
a.blog_link {margin-right:40px;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">


	<div class="write">

		<form name="write_form" method="" action="" onsubmit="" enctype="" autocomplete="">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="" value="" />		
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />
		</fieldset>
		
		<fieldset>
		<legend>등록/수정</legend>	
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th class="required">제목</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="80" title="제목" />
			</td>
		</tr>
		<tr>
			<th class="required">연결URL</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="150" title="연결URL" />
			</td>
		</tr>
		<tr>
			<th class="required">내용</th>
			<td>
				<textarea name="" class="textarea" rows="3" cols="100" title="내용">내용이들어갑니다. 이 글은 공백포함 100자입니다.내용이들어갑니다. 이 글은 공백포함 100자입니다.내용이들어갑니다. 이 글은 공백포함 100자입니다.내용이들어갑니다. 글자입니다.</textarea>
				<br />
				<span class="comment"><strong class="info">최대 100자</strong>까지 입력 가능합니다. </span>
			</td>
		</tr>

		<tr class="file">			
			<th>출력이미지<br />(180 * 180)</th>
			<td class="file">	
				<input type="file" name="" value="" class="file" size="80" title="첨부파일" />
				<br />
				<a href="" target="_blank"><img src="/img/mobile/main/img_main.jpg" width="90" height="90" alt="thumbnail" /></a>
				<span>|</span>
				<input type="checkbox" name="" value="" title="파일삭제" />
				<label>기존파일삭제</label>
				Test.png (150.5KB, 0회)
				<a href="" class="sButton tiny" target="_blank" title="다운로드">다운로드</a>		
				<br />
				<span class="comment">이미지 미등록시 no-imege로 출력됩니다.</span>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>


		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="/webadmin/page/mainshop_list.html" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="즉시탈퇴처리">삭제</a>
		</p>

		</form>
	</div>
</div>
<!-- //<?=$module?> -->