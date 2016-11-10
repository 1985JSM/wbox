<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '1:1문의';
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">

<!-- qna -->
<div id="qna">

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
		<input type="hidden" name="" value="" />
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>	
		<tr>
			<th class="required">제목</th>
			<td><input type="text" name="" value="" class="text required" size="120" maxlength="50" title="제목" /></td>
		</tr>		
		<tr>
		<th class="required">문의내용</th>
			<td>
				<textarea name="" class="textarea required" rows="20" cols="120" title="내용"></textarea>	
			</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="qna_list.html" class="sButton active" title="목록">목록</a>
		</p>
		</form>
	</div>

</div>
<!-- //qna -->	
	
</div>
<!-- //<?=$module?> -->