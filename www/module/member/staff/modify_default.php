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
		<form name="default_form" action="./process.html" method="post" onsubmit="return submitDefaultForm(this)">
		<input type="hidden" name="mode" value="update_default" />

		<ul class="profile_modify_form">
		<li>
			<span class="tit">기본정보</span>
			<ul class="inp_info01">
			<li>
				<div>
					<input type="text" name="mb_name" value="<?=$member['mb_name']?>" class="input_txt required" placeholder="이름" maxlength="20" title="이름">
				</div>
			</li>
			<li>
				<div>
					<input type="text" name="mb_position" value="<?=$member['mb_position']?>" class="input_txt" placeholder="직책" maxlength="10" title="직책">
				</div>
			</li>
			</ul>		
		</li>
		</ul>

		<button type="submit" class="btn_orange">확인</button>
		</form>
	</div>
</div>

	