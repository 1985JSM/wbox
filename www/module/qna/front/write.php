<?
if(!defined('_INPLUS_')) { exit; } 

$oQna = new QnaFront();
$oQna->init();

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
	<p class="layer_txt"><img src="/module/page/front/img/img_txt_qna.gif" alt="이용하시면서 불편한 사항이나 문의내용이 있으면 접수 부탁드립니다. - 작성하신 이메일과 연락처로 답변안내를 드립니다. 정확한 정보 작성부탁드립니다. 제휴제안에 관한 문의는 제휴안내로 접수해 주시면 가장 빠르게 확인받으실 수 있습니다." /></p>
	
	<form name="write_form" method="post" action="<?=$base_uri?>/qna/process.html" onsubmit="return submitWriteForm(this)">
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
			<input type="text" name="bo_name" class="text required" size="20" maxlength="10" title="작성자" />
		</td>				
	</tr>
	<tr>
		<th class="required">제목</th>
		<td>
			<input type="text" name="bo_subject" class="text required" size="80" maxlength="50" title="제목" />
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
		<th class="required">이메일</th>
		<td>
			<input type="text" name="bo_email" class="text required" size="50" maxlength="50" title="이메일" />
			<input type="checkbox" name="flag_email" id="flag_email" value="Y" />
			<label for="flag_email">답변시 이메일 수신 동의</label>
		</td>
	</tr>
	<tr>
		<th>내용</th>
		<td>
			<textarea title="내용" name="bo_content" cols="80" rows="5" class="textarea required" title="내용"></textarea>	
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
			문의하신 내용에 대해 정확한 답변 및 원활한 상담을 위하여 고객님의 이메일, 휴대폰번호를 수집합니다. 수집된 개인정보는 개인정보의 수집 및 이용 목적이 달성되면 관련 법령 또는 회사				
			내부 방침에 의해 보존할 필요가 있는 경우를 제외하고는 지체없이 파기됩니다. 더 자세한 내용에 대해서는 개인정보취급방침을	참고하시기 바랍니다.	
		</div>
		<p>
			<input type="checkbox" name="chk_agree" id="chk_agree" class="required" value="Y" title="개인정보수집동의" />
			<label for="chk_agree">서비스 이용약관에 동의합니다.</label>
		</p>
	</div>

	<p class="button">
		<button type="submit" class="sButton primary">문의하기</button>
	</p>

	</form>
</div>
<!-- //1:1 문의 쓰기폼 -->