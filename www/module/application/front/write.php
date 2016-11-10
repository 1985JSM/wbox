<?
if(!defined('_INPLUS_')) { exit; } 

$oApplication = new ApplicationFront();
$oApplication->init();

$sido_arr = selectSido();
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>
<div class="write">

	<form name="write_form" action="<?=$base_uri?>/application/process.html" method="post" onsubmit="return submitWriteForm(this)">
	<input type="hidden" name="flag_json" value="1" />
	<input type="hidden" name="mode" value="insert" />

	<table class="write_table" border="1">
	<caption>등록/수정</caption>
	<colgroup>
	<col width="140" />
	<col width="*" />
	</colgroup>
	<tbody>
	<tr>
		<th class="required">신청자</th>
		<td>
			<input type="text" name="ap_name" class="text required" size="20" maxlength="10" title="신청자" />
			<span class="comment">- 신청하시는 분 성함을 입력해주세요.</span>
		</td>				
	</tr>
	<tr>
		<th class="required">업체명</th>
		<td>
			<input type="text" name="ap_shop_name" class="text required" size="50" maxlength="30" title="업체명" />
			<span class="comment">- 신청하시는 업체명을 입력해주세요.</span>
		</td>
	</tr>
	<tr>
		<th class="required">주소</th>
		<td>	
			<select name="ap_sido" class="select required sido" title="시/도">
			<option value="">시/도</option>
			<? printSelectOption($sido_arr, ''); ?>
			</select>
		
			<select name="ap_sigungu" class="select required sigungu" title="시/군/구">
			<option value="">시/군/구</option>
			</select>
		
			<select name="ap_dong" class="select required dong" title="읍/면/동">
			<option value="">읍/면/동</option>
			</select>
		</td>	
	</tr>
	<tr>
		<th class="required">이메일</th>
		<td>
			<input type="text" name="ap_email" class="text required" size="50" maxlength="50" title="이메일" />
			<span class="comment">- 신청하시는 업체 이메일를 입력해주세요.</span>
		</td>
	</tr>
	<tr>
		<th class="required">연락처</th>
		<td>
			<input type="text" name="ap_tel" class="text required" size="20" maxlength="15" title="연락처" />
			<span class="comment">- 신청하시는 업체 연락처를 입력해주세요.</span>
		</td>
	</tr>			
	<tr>
		<th>요청이유</th>
		<td>
			<textarea name="ap_memo" cols="80" rows="3" class="textarea" title="요청이유"></textarea>	
			<span class="comment">- 등록 요청 접수 후 섭외까지 약 2주간의 시간이 소요됩니다.</span>
		</td>
	</tr>
	<? /*
	<tr>
		<th class="required">자동등록방지</th>
		<td>
			<input type="text"class="text required" size="20" maxlength="10" title="자동등록방지" />
		</td>
	</tr>
	*/ ?>
	</tbody>
	</table>

	<div class="agree">
		<div>			
			예약박스는 고객님께서 문의하신 내용을 통해서 상담을 짂행하고자 아래와 같은 개인정보를 수집 이용합니다.	
			<br />
			- 수집이용·목적 : 광고 상담 신청 문의<br />
			- 수집항목 : 이름, 연락처, 이메일 <br />
			- 보유기간 : 상담종료 후 3개월 이내에 파기
		</div>
		<p><input type="checkbox" name="chk_agree" id="chk_agree" class="required" value="1" />
		<label for="chk_agree">개인정보 수집 및 이용에 동의합니다.</label></p>
	</div>

	<p class="button">
		<button type="submit" class="sButton primary">확인</button>
	</p>

	</form>
</div>