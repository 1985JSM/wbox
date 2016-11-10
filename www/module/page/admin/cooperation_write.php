<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '제휴문의';
?>

<style>
a.blog_link {margin-right:40px;}

</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">


	<div class="write">
		
		<form name="" method="" action="" onsubmit="" enctype="" autocomplete="">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="" value="" />		
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />	
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>	
		<tr>
			<th class="required">이름</th>
			<td colspan="3"><input type="text" name="" value="" class="text required" size="20" maxlength="15" title="이름" /></td>
		</tr>
		<tr>
			<th class="required">연락처</th>
			<td><input type="text" name="" value="" class="text required" size="20" maxlength="15" title="연락처" /></td>
			<th class="required">통화가능시간</th>
			<td>
				<select name="" id="" class="select required" title="시간">
				<option value="">00:00</option>
				<option value="">00:30</option>
				<!-- 30분 단위 -->
				</select>
			</td>
		</tr>
		<tr>
			<th class="required">이메일</th>
			<td colspan="3"><input type="text" name="" value="" class="text required" size="50" maxlength="30" title="이메일" /></td>
		</tr>
		<tr>
			
		</tr>
		<tr>
			<th>업체명</th>
			<td><input type="text" name="" value="" class="text required" size="30" maxlength="30" title="업체명" /></td>
			<th>대표자</th>
			<td><input type="text" name="" value="" class="text required" size="20" maxlength="10" title="대표자" /></td>
		</tr>
		<tr>
			<th>사업자등록번호</th>
			<td><input type="text" name="" value="" class="text required" size="20" maxlength="10" title="사업자등록번호" /></td>
			<th>업체연락처</th>
			<td><input type="text" name="" value="" class="text required" size="20" maxlength="30" title="업체연락처" /></td>
		</tr>
		<tr class="addr">
			<th>주소</th>
			<td colspan="3">	
				<select name="" id="" class="select required" title="주소 시/도">
				<option value="">시/도</option>
				</select>
			
				<select name="" id="" class="select required" title="주소 시/군/구">
				<option value="">시/군/구</option>
				</select>
			
				<select name="" id="" class="select required" title="주소 읍/면/동">
				<option value="">읍/면/동</option>				
				</select>
				<br />
				<input type="text" name="" value="" class="text required" size="50" maxlength="30" title="상세주소" >
			</td>	
		</tr>
		<tr>
		
		<tr>
			<th>문의내용</th>
			<td colspan="3">
			<textarea name="" class="textarea" rows="5" cols="120" title="요청이유" ></textarea>	
			</td>
		</tr>
			
				
		<tr>
			<th>작성일시</th>
			<td colspan="3">	
				2016-05-10 18:16:56			
			</td>	
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?page=1" class="sButton active" title="목록">목록</a>
						<a href="./process.html?mode=delete&ap_code=QF10S1GF6H10&page=1" id="btn_delete" class="sButton" title="삭제">삭제</a>
					</p>

		</form>
	</div>
	<!-- write -->
</div>
<!-- //<?=$module?> -->