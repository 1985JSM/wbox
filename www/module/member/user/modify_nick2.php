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
		<form name="nick_form" action="./process.html" method="post" onsubmit="return submitNickForm(this)">
		<input type="hidden" name="mode" value="update_nick" />

		<ul class="profile_modify_form">
		<li>
			<span class="tit">닉네임</span>
			<input type="text" name="mb_nick" value="<?=$member['mb_nick']?>" class="input_txt required" placeholder="최대 10자 이내로 입력해주세요." maxlength="10" title="닉네임">
			<p id="" class="txt_alert">이미 사용 중인 닉네임입니다. <!-- 사용할 수 있는 닉네임입니다. --></p>
		</li>
		</ul>

		<button type="submit" class="btn_orange">확인</button>
		</form>
	</div>
</div>

	