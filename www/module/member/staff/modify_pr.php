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

});
</script>

<div id="container" class="container">
	<div class="profile_form">
	<form name="pr_form" action="./process.html" method="post">
	<input type="hidden" name="mode" value="update_pr" />

	<ul class="profile_modify_form">
	<li>
		<span class="tit">한줄소개</span>
		<input type="text" name="mb_pr" value="<?=$member['mb_pr']?>" class="input_txt" placeholder="나를 표현하는 한 줄 소개를 입력해보세요." title="한줄소개">
	</li>
	</ul>

	<button type="submit" class="btn_orange">확인</button>
	</form>
	</div>
</div>

	