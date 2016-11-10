<?
if(!defined('_INPLUS_')) { exit; } 

$oAlliance = new AllianceFront();
$oAlliance->init();

$sido_arr = selectSido();
$time_arr = getTimeTableArray();
// captcha
/*
if(!isset($oCaptcha)) {
include_once(_MODULE_PATH_.'/captcha/captcha.class.php');
$oCaptcha = new Captcha();
$oCaptcha->init();
}
$oCaptcha->makeCaptcha();
$captcha_img_src = $oCaptcha->get('img_src');
*/
?>
<div class="write">
	<p class="layer_txt"><img src="/module/page/front/img/img_txt_alliance.gif" alt="지금 바로 제휴하시면 최초 2개월 체험서비스!" /></p>
				
	<form name="write_form" method="post" action="<?=$base_uri?>/alliance/process.html" onsubmit="return submitWriteForm(this)">
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
		<th class="required">작성자</th>
		<td>
			<input type="text" name="bo_name" class="text required" size="20" maxlength="10" title="이름" />
		</td>				
	</tr>
	<tr>
		<th class="required">연락처</th>
		<td>
			<input type="text" name="bo_tel" class="text required" size="30" maxlength="15" title="연락처" />
			<input type="checkbox" name="flag_sms" id="flag_sms" value="Y" />
			<label for="flag_sms">답변시 휴대폰 수신 동의</label>
		</td>
	</tr>
	<tr>
		<th class="required">통화가능시간</th>
		<td>
			<select name="bo_etc1" class="select required" title="통화가능시간">
			<? printSelectOption($time_arr, '', 1); ?>
			</select>
			~
			<select name="bo_etc2" class="select required" title="통화가능시간">
			<? printSelectOption($time_arr, '', 1); ?>
			</select>
		</td>
	</tr>
	<tr>
		<th class="required">이메일</th>
		<td>
			<input type="text" name="bo_email" class="text required" size="50" maxlength="50" title="이메일" />
			<input type="checkbox" name="flag_email" id="flag_email" value="Y" />
			<label for="flag_email">답변시 이메일 수신 동의</label>
		</td>
	</tr>
	
	<tr>
		<th>업체명</th>
		<td>
			<input type="text" name="bo_etc3" class="text" size="30" maxlength="30" title="업체명" />
		</td>
	</tr>

	<tr>
		<th>대표자</th>
		<td>
			<input type="text" name="bo_etc4" class="text" size="20" maxlength="10" title="대표자" />
		</td>
	</tr>

	<tr>
		<th>사업자등록번호</th>
		<td>
			<input type="text" name="bo_etc5" class="text" size="20" maxlength="15" title="대표자" />
		</td>
	</tr>

	<tr>
		<th>업체연락처</th>
		<td>
			<input type="text" name="bo_etc6" class="text" size="20" maxlength="15" title="업체연락처" />
		</td>
	</tr>

	<tr class="addr">
		<th>주소</th>
		<td>	
			<select name="bo_sido" class="select sido" title="시/도">
			<option value="">시/도</option>
			<? printSelectOption($sido_arr, ''); ?>
			</select>
		
			<select name="bo_sigungu" class="select sigungu" title="시/구/군">
			<option value="">시/군/구</option>
			</select>
		
			<select name="bo_dong" class="select dong" title="읍/면/동">
			<option value="">읍/면/동</option>
			</select>
			<br />
			<input type="text" name="bo_addr" class="text" size="50" maxlength="50" title="상세주소" />
		</td>	
	</tr>		
	<tr>
		<th>문의내용</th>
		<td>
			<textarea name="bo_content" cols="80" rows="3" class="textarea" title="문의내용"></textarea>	
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
		<p>
			<input type="checkbox" name="chk_agree" id="chk_agree" value="1" class="required" title="개인정보 수집 필수 동의" />
			<label for="chk_agree">개인정보 수집 및 이용에 동의합니다.(필수)</label>
		</p>
	</div>

	<div class="agree">
		<div>			
			예약박스는 고객님께서 문의하신 내용을 통해서 상담을 짂행하고자 아래와 같은 개인정보를 수집 이용합니다. 동의를 거부하시더라도 상담 신청을 이용하실 수 있습니다.
			<br />
			- 수집이용·목적 : 광고 상담 신청 문의<br />
			- 수집항목 : 업체명, 대표자성함, 연락처, 매장주소, 사업자등록번호 <br />
			- 보유기간 : 상담종료 후 3개월 이내에 파기
		</div>
		<p>
			<input type="checkbox" name="chk_agree2" id="chk_agree2" value="1" title="개인정보 수집 선택 동의" />
			<label for="chk_agree2">개인정보 수집 및 이용에 동의합니다.(선택)</label>
		</p>
	</div>

	<p class="button">
		<button type="1" class="sButton primary">문의하기</button>
	</p>

	</form>
</div>