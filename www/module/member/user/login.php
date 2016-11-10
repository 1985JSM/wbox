<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer_nav = false;
$back_url = '../page/main.html';

$oMember = new MemberUser();
$oMember->init();
?>
<script type="text/javascript">
$(document).ready(function() {
	// 네이티브 브릿지
	callNative("initLogin");	
});
</script>
</head>
<body>
<div id="wrap">
	<div id="container5" class="container">
		<div class="member_login">
			<a href="<?=$back_url?>" class="btn_go_back login_close"><i class="xi-close"></i></a>
			<h1><span class="hidden">예약박스</span></h1>
			<div class="login_area">

				<form name="login_form" method="post" action="./process.html" onsubmit="return submitLoginForm(this)">
				<input type="hidden" name="mode" value="login" />
				<input type="hidden" name="mb_push_os" value="" />
				<input type="hidden" name="mb_push_id" value="" />

				<ul class="login_form">
				<li><label><i class="xi-user"></i><input type="text" name="login_email" class="required" placeholder="이메일 주소를 입력하세요." value="" maxlength="50" title="이메일"></label></li>
				<li><label><i class="xi-lock"></i><input type="password" name="login_pass" class="required" placeholder="비밀번호를 입력하세요." value="" maxlength="20" title="비밀번호"></label></li>
				</ul>

				<ul class="form_btn">
				<li><a href="../member/ajax_find_password.html" class="btn_nos btn_search_pw btn_ajax size_280x280" target="#layer_popup" title="비밀번호찾기"><span>비밀번호찾기</span></a></li>
				<li><a href="./join.html" class="btn_nos"><span>회원가입</span></a></li>
				</ul>

				<button type="submit" class="btn_orange">로그인</button>
			</form>
        </div>
		</div>
    </div>
   