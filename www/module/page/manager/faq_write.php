<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = 'FAQ';
?>

<style>
#faq div.write tr td textarea {width:100%;height:300px;border:1px solid #d2d2d2;} 
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

<!-- faq -->
<div id="faq">

	<div class="write">
		<form name="write_form" method="" action="" onsubmit="" enctype="">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="" value="" />	
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
			<th class="required">분류</th>
			<td>
				<select name="bo_category" class="select required" title="분류">
				<option value="01">카테고리1</option>
				<option value="02">카테고리2</option>
				<option value="03">카테고리3</option>
				<option value="04">카테고리4</option>
				<option value="05">카테고리5</option>
				</select>				
			</td>
		</tr>
		<tr>
			<th class="required">제목</th>
			<td>
				<input type="text" name="" value="" class="text required" size="130" maxlength="50" title="제목" />
			</td>
		</tr>
		<tr class="editor">
			<th class="required">내용</th>
			<td>
				<textarea name="" id="bo_content" class="editor reqruied" title="내용"></textarea>
			</td>
		</tr>				
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="" class="sButton primary">확인</button>
			<a href="faq_list.html" class="sButton active" title="목록">목록</a>
		</p>

		</form>
	</div>
</div>
<!-- //faq -->	
	
</div>
<!-- //<?=$module?> -->