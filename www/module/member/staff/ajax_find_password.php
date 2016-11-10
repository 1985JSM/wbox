<?
if(!defined('_INPLUS_')) { exit; } 

$oMember = new MemberStaff();
$oMember->init();
?>
<script type="text/javascript">
function submitFindPasswordForm(f) {
	if(!validateForm(f)) {
		return false;
	}
		
	ajaxSubmit(f, function() {
		// resize layer layout
		var layer_width = 280;
		var layer_height = 140;
		var layer_margin_top = (layer_height / 2) * (-1);
		var layer_margin_left = (layer_width / 2) * (-1);
		var layer_content_height = layer_height - 60;
		$("#layer_popup").css({
			width	: layer_width + "px",
			height	: layer_height + "px",
			marginTop	: layer_margin_top + "px",
			marginLeft	: layer_margin_left + "px"
		});
		$("#layer_content").css("height", layer_content_height + "px");		
	});
	
	return false;
}
</script>
<div class="search_pw_area">
	<form name="find_password_form" method="get" action="../member/ajax_find_password_result.html" target="#layer_content" onsubmit="return submitFindPasswordForm(this)">
	<input type="hidden" name="flag_json" value="1" />

	<ul class="email_form">
	<li><label><input type="email" name="find_email" class="required" placeholder="이메일 주소를 입력하세요." title="이메일"></label></li>
	</ul>
	<ul class="layer_list">
	<li>가입 시 등록하신 <span class="col_orange">이메일 주소</span>를 입력하여 주시면 비밀번호 초기화 안내 메일이 발송됩니다.</li>
	<li>hanmail 계정은 Daum의 스팸정책으로 인해 메일 수신이 제한될 수 있습니다.</li>
	<li>이용문의 : <?=_HOMEPAGE_EMAIL_?></li>
	</ul>
	<ul class="layer_btn layer_btn2">
	<li><div><button type="submit" class="btn_orange">확인</button></div></li>
	<li><div><button type="button" class="btn_gray" onclick="closeLayerPopup()">취소</button></div></li>	
	</ul>
	</form>
</div>