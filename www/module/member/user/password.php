<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = './modify_index.html';
$doc_title = '프로필관리';
$footer_nav['1'] = true;

$oMember = new MemberUser();
$oMember->init();
?>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>

<div id="container"  class="container">
	<div class="profile_form">
		<p class="txt">회원님의 소중한 정보보호를 위해 현재 비밀번호를 확인해주세요.</p>

		<form name="check_password_form" method="post" action="./process.html" onsubmit="return submitCheckPasswordForm(this)">
		<input type="hidden" name="mode" value="check_password" />
		<input type="hidden" name="return_url" value="<?=$return_url?>" />

		<ul class="profile_modify_form">
		<li>
			<span class="tit"><?=$member['mb_email']?></span>
			<input type="password" name="login_pass" class="input_txt required" placeholder="비밀번호를 입력하세요." title="비밀번호">
		</li>
		</ul>

		<button type="submit" class="btn_orange">확인</button>
		<a href="../member/ajax_find_password.html" class="btn_nos btn_search_pw btn_ajax size_280x280" target="#layer_popup" title="비밀번호찾기"><span>본인 비밀번호가 기억나지 않으세요?</span></a>
		</form>
	</div>
</div>

	