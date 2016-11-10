<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '비밀번호변경';
?>


<div id="<?=$module?>">

	<div class="write">
		
		<form name="" method="" action="" onsubmit="">

		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="check_sales_password" />
		<input type="hidden" name="return_url" value="<?=$return_url?>" />
		</fieldset>


		<fieldset>
		<legend>등록/수정</legend>	
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="200" />
		<col width="*" />
		</colgroup>
		<tbody>	
		<tr>
			<th class="required">현재 비밀번호</th>
			<td>
				<input type="password" name="" value="" class="text" size="30" maxlength="20" title="비밀번호" />	
			</td>
		</tr>
		<tr>
			<th class="required">신규 비밀번호</th>
			<td>
				<input type="password" name="" value="" class="text" size="30" maxlength="20" title="비밀번호" />
				<br />
				<span class="comment">-비밀번호 20자 이하의 영대/소문자, 숫자, 특수숫자만 입력 가능합니다.</span>
			</td>
		</tr>
		<tr>
			<th class="required">신규 비밀번호 확인</th>
			<td>
				<input type="password" name="" value="" class="text" size="30" maxlength="20" title="비밀번호" />					
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
