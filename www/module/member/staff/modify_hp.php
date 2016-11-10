<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = './modify_index.html';
$doc_title = '프로필관리';
$footer_nav['1'] = true;

$oMember = new MemberStaff();
$oMember->init();

$oMember->checkPasswordCookie($this_uri);
?>
<script type="text/javascript">
$(document).ready(function() {
	// 네이티브 브릿지
	callNative("initJoin");	

	// 인증번호 발송
	$("#btn_send_auth_no").on("click", function(e) {		
		sendAuthNo(this);
		e.preventDefault();
	});	

	// 인증번호 검증
	$("#btn_validate_auth_no").on("click", function(e) {
		validateAuthNo(this);
		e.preventDefault();
	});
});
</script>

<div id="container" class="container">
	<div class="profile_form">
		<form name="hp_form" action="./process.html" method="post" onsubmit="return submitHpForm(this)">
		<input type="hidden" name="mode" value="update_hp" />
		<input type="hidden" name="mb_push_os" value="<?=_DEVICE_OS_?>" />
		<input type="hidden" name="mb_push_id" value="" />
		<input type="hidden" name="flag_send_auth_no" id="flag_send_auth_no" value="N" />
		<input type="hidden" name="flag_validate_auth_no" id="flag_validate_auth_no" value="N" />

		<ul class="profile_modify_form">
		<li>
			<span class="tit">휴대폰</span>
			<div class="mod_tel01">
				<ul>
				<li>
					<div>
						<input type="text" name="pre_hp" class="input_txt" placeholder="<?=$member['mb_hp']?>" readonly>
					</div>
				</li>
				<li>
					<div>
						<button type="button" onclick="changeModifyHp('update')" class="btn_gray_s btn_mod_mail">변경하기</button>
					</div>
				</li>
				</ul>
				<p class="txt_info">휴대폰을  변경하시려면 변경하기를 눌러주세요.</p>
			</div>
			
			<div class="mod_tel02">
				<ul class="tel_num">
				<li>
					<div>
						<select name="mb_hp_comp" id="mb_hp_comp" class="required" title="통신사">
						<option value="">통신사</option>
						<? printSelectOption($hp_comp_arr, ''); ?>
						</select>
					</div>
				</li>
				<li>
					<div>
						<input type="tel" name="mb_hp" id="mb_hp" class="input_txt required" placeholder="휴대폰번호 (-제외)" maxlength="15" title="휴대폰번호">
					</div>
				</li>
				<li>
					<div>
						<button type="button" onclick="changeModifyHp('view')" class="btn_gray_s btn_cancel_mail">취소하기</button>
					</div>
				</li>
				</ul>
				<div class="cer">
					<a href="./ajax_send_auth_no.html" id="btn_send_auth_no" class="btn_gray size_280x170" target="#layer_popup" title="인증번호 발송">인증번호발송</a>
				</div>
				<ul class="cer_num">
				<li><div><input type="number" name="auth_no" id="auth_no" class="input_txt required" maxlength="6" title="인증번호"></div></li>
				<li><div><a href="./ajax_validate_auth_no.html" id="btn_validate_auth_no" class="btn_gray_s size_280x150" target="#layer_popup" title="인증하기">인증하기</a></div></li>
				</ul>

				<button type="submit" class="btn_orange">확인</button>
			</div>
		</li>
		</ul>
		</form>
	</div>
</div>

	