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


	<div class="write">
		
		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>		
		<tr>
			<th class="required">제목</th>
			<td><input type="text" name="nt_subject" value="" class="text required" size="122" maxlength="50" title="제목" /></td>
		</tr>
		<tr>
			<th class="required">노출 사용자<br />선택</th>
			<td>
			<input type="radio" name="" id="" class="" value="" /> <label for="">가맹점</label> 
			<input type="radio" name="" id="" class="" value="" /> <label for="">사용자</label> 	
			<input type="radio" name="" id="" class="" value="" /> <label for="">홈페이지</label> 	
			<br />
			<span class="comment">선택하신 사용자에만 <strong class="info">해당 게시물이 출력</strong>됩니다.</span>
			</td>
		</tr>
		<tr>
		<th class="required">내용</th>
			<td>
			<textarea name="nt_content" class="textarea required" rows="30" cols="120" title="내용"></textarea>	</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="#" class="sButton active" title="목록">목록</a>
			<a href="#" id="" class="sButton warning" title="삭제">삭제</a>
		</p>

		</form>
	</div>


</div>
<!-- //<?=$module?> -->