<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'small';
$doc_title = '선불제관리';
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


		<!-- 고객등록을 통해 가입한 고객  -->
		<fieldset>
		<legend>등록/수정</legend>	
		<h4>선불제 상품 등록</h4>
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
			<th class="required">서비스명</th>
			<td>			
				<input type="text" name="" id="" value="" class="text required" size="50" maxlength="50" title="서비스명" />
			</td>
		</tr>		
		</tr>
		<tr>
			<th class="required">가격</th>
			<td>
				<input type="text" name="" id="" value="" class="text required" size="15" maxlength="10" title="가격" /> 원
			</td>
		</tr>
		<tr>
			<th class="required">구분</th>
			<td>
				<select name="sch_type" class="select" title="구분">
				<option value="">정액권</option>
				<option value="">이용권</option>
				<option value="">정기권</option>
				</select>
			</td>
		</tr>
		<tr> <!-- 해당 필드는 구분 선택시 출력 -->
			<th class="required">정액요금 </th> <!--  이용권수량 / 정기권기간 -->
			<td>
				<div><input type="text" name="" id="" value="" class="text required" size="30" maxlength="20" title="가격" /> 원</div>
				<div><input type="text" name="" id="" value="" class="text required" size="15" maxlength="10" title="횟수" /> 회</div>
				<div>
					<select name="sch_type" class="select" title="기간구분">
					<option value="">1개월</option>
					<option value="">3개월</option>
					<option value="">6개월</option>
					<option value="">1년</option>
					</select>
				</div>
			</td>
		</tr>		
		<tr>
			<th class="required">내용</th>
			<td>
				<textarea name="" class="textarea" rows="5" cols="80" title="내용"></textarea>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="#" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="삭제">삭제</a>
		</p>

		</form>
	</div>
</div>
<!-- //<?=$module?> -->
