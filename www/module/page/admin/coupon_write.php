<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'tiny';
$doc_title = '쿠폰 관리';
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
		<h4>기본정보</h4>		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th class="required">쿠폰명</th>
			<td>
				<input type="text" name="" class="text" value="" size="50" maxlength="10" title="제목" />
			</td>
		</tr>	
		
		<tr>
			<th class="required">쿠폰유형</th>
			<td>
				<input type="radio" name="" value=""/> <label>쿠폰</label>
				<input type="radio" name="" value=""/> <label>이벤트</label>
				<input type="radio" name="" value=""/> <label>무료</label>
				<input type="radio" name="" value=""/> <label>1+1</label>

				<input type="radio" name="" value=""/> <label>할인</label>				
				<select name="sch_type" class="select" title="할인율">
				<option value="">할인금액</option>
				<option value="">할인율</option>
				</select>
			</td>
		</tr>
		<tr>
			<th class="required">할인금액</th>
			<td>
				<input type="text" name="" class="text" value="" size="10" maxlength="10" title="원" /> 원 
			</td>
		</tr>
		<tr>
			<th class="required">할인율</th>
			<td>
				<input type="text" name="" class="text" value="" size="10" maxlength="10" title="%" /> % 
			</td>
		</tr>
		<tr>
			<th class="required">사용등급</th>
			<td>
				<input type="checkbox" name="" value=""/> <label>일반</label>
				<input type="checkbox" name="" value=""/> <label>브론즈</label>
				<input type="checkbox" name="" value=""/> <label>실버</label>
				<input type="checkbox" name="" value=""/> <label>골드</label>
				<input type="checkbox" name="" value=""/> <label>VIP</label>	
			</td>
		</tr>
		<tr>
			<th>제공수량</th>
			<td>
				<input type="text" name="" class="text" value="" size="10" maxlength="10" title="제공수량" /> 개 까지 사용가능
				<br />
				<span class="comment">- 0개 또는 비워놓는 경우 <strong class="info">무제한 제공</strong>됩니다.</span>
				
			</td>
		</tr>
		<tr>
			<th class="required">사용제한</th>
			<td>
				<input type="radio" name="" value=""/> <label>1인 1회 사용 가능</label>
				<input type="radio" name="" value=""/> <label>1인 반복 사용 가능 </label>
			</td>
		</tr>
		<tr>
			<th class="required">노출여부</th>
			<td>
				<input type="radio" name="" value=""/> <label>노출</label>
				<input type="radio" name="" value=""/> <label>미노출 </label>
			</td>
		</tr>
		<tr>
			<th class="required">이용안내1</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="60" title="쿠폰이용안내" />
			</td>
		</tr>
		<tr>
			<th>이용안내2</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="60" title="쿠폰이용안내" />
			</td>
		</tr>
		<tr>
			<th>이용안내3</th>
			<td>
				<input type="text" name="" class="text" value=""  size="80" maxlength="60" title="쿠폰이용안내" />
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>



		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="/webadmin/page/mainvisual_list.html" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="즉시탈퇴처리">삭제</a>
		</p>

		</form>
	</div>
</div>
<!-- //<?=$module?> -->


