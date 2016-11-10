<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = './modify_index.html';
$doc_title = '프로필관리';
$footer_nav['1'] = true;

$oMember = new MemberUser();
$oMember->init();

$oMember->checkPasswordCookie($this_uri);
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div id="container" class="container">
	<div class="profile_form">

		<form name="password_form" action="./process.html" method="post" onsubmit="return submitPasswordForm(this)">
		<input type="hidden" name="mode" value="update_password" />

		<ul class="profile_modify_form">
		<li>
			<span class="tit">비밀번호 변경</span>
			<input type="password" name="mb_pass" class="input_txt required" placeholder="영문, 숫자, 특수문자 포함 6~20자를 입력하세요." maxlength="20" title="비밀번호">
			<input type="password" name="mb_pass2" class="input_txt required" placeholder="비밀번호를 한번 더 입력해주세요" maxlength="20" title="비밀번호 확인">
			<p class="txt_info">비밀번호 분실시 이메일을 통해 확인하므로 정확하게 입력해 주세요.</p>
		</li>
		</ul>

		<button type="submit" class="btn_orange">확인</button>
		</form>
	</div>
</div>

	