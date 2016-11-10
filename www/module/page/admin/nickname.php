<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'tiny';
$doc_title = '닉네임 관리';
?>


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
		<input type="hidden" name="bl_id" value="" />
				
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody id="">		
		<tr>
			<th class="required">회원 사용불가<br /> 닉네임</th>
			<td>
			<textarea name="" class="textarea" rows="10" cols="100" title="내용" maxlength="100" ></textarea>
			<br />
			<span class="comment">- 입력된 단어는 <strong class="info">회원의 닉네임으로 사용할 수 없습니다.</strong> 단어와 단어 사이는 ,(콤마)로 구분합니다. </span>
		</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
		</p>

		</form>
	</div>
</div>
<!-- //<?=$module?> -->
