<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = './profile.html';
$doc_title = '프로필관리';
$footer_nav['1'] = true;

$oMember = new MemberUser();
$oMember->init();
?>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>

<div id="container" class="container">
	<div class="profile">
		<p class="profile_info02"><?=$member['mb_email']?></p>
		<ul class="profile_list3">
		<li><a href="./modify_email.html">이메일변경<i class="fa fa-angle-right"></i></a></li>
		<li><a href="./modify_password.html">비밀번호변경<i class="fa fa-angle-right"></i></a></li>
		<li><a href="./modify_default.html">기본정보변경<i class="fa fa-angle-right"></i></a></li>
		<li><a href="./modify_hp.html">휴대폰변경<i class="fa fa-angle-right"></i></a></li>
		<li><a href="./modify_nick.html">닉네임변경<i class="fa fa-angle-right"></i></a></li>
		<li><a href="./modify_pr.html">한줄소개변경<i class="fa fa-angle-right"></i></a></li>
		</ul>

		<?
		/*
		<ul class="profile_list3">
		<li><a href="#">서비스탈퇴</a></li>
		</ul>
		*/
		?>
	</div>
</div>

	