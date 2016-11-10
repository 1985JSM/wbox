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

	// 이메일 검사
	$("#mb_email").on("focusout", function() {
		checkMemberEmail();
	});
});
</script>

<div id="container" class="container">
	<div class="profile_form">
		<form name="email_form" action="./process.html" method="post" onsubmit="return submitEmailForm(this)">
		<input type="hidden" name="mode" value="update_email" />
		<input type="hidden" name="chk_mb_email" value="" />		

		<ul class="profile_modify_form">
		<li>
			<span class="tit">이메일</span>
			<div class="mod_mail01">
				<ul>
				<li>
					<div>
						<input type="text" name="pre_email" class="input_txt" placeholder="<?=$member['mb_email']?>" readonly>
					</div>
				</li>
				<li>
					<div>
						<button type="button" onclick="changeModifyEmail('update')" class="btn_gray_s btn_mod_mail">변경하기</button>
					</div>
				</li>
				</ul>
				<p class="txt_info">이메일을  변경하시려면 변경하기를 눌러주세요.</p>
			</div>
			
			<div class="mod_mail02">
				<ul>
				<li>
					<div>
						<input type="email" name="mb_email" id="mb_email" value="<?=$member['mb_email']?>" class="input_txt required" placeholder="이메일 주소를 입력하세요." maxlength="50" title="이메일">
					</div>
				</li>
				<li>
					<div>
						<button type="button" onclick="changeModifyEmail('view')" class="btn_gray_s btn_cancel_mail">취소하기</button>
					</div>
				</li>
				</ul>
				<p id="state_mb_email" class="txt_alert">비밀번호 분실시 이메일을 통해 확인하므로 정확하게 입력해 주세요.</p>
				<button type="submit" class="btn_orange">확인</button>
			</div>
		</li>	
		</ul>
		</form>
	</div>
</div>

	