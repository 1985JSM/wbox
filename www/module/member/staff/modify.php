<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = './modify_index.html';
$doc_title = '프로필관리';
$footer_nav['5'] = true;

$oMember = new MemberStaff();
$oMember->init();
?>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>

<div id="container" class="profile_form">

	<form name="write_form" action="./process.html" method="post" onsubmit="return submitWriteForm(this)">
	<input type="hidden" name="mode" value="update" />
	<input type="hidden" name="mb_push_os" value="<?=_DEVICE_OS_?>" />
	<input type="hidden" name="mb_push_id" value="" />
	<input type="hidden" name="chk_mb_email" value="" />		
	<input type="hidden" name="flag_send_auth_no" id="flag_send_auth_no" value="N" />
	<input type="hidden" name="flag_validate_auth_no" id="flag_validate_auth_no" value="N" />

	<ul class="profile_modify_form">
	<li>
		<span class="tit">이메일</span>
		<div class="mod_mail01">
			<ul>
			<li>
				<div>
					<input type="text" class="input_txt" placeholder="smile@inplusweb.com" readonly>
				</div>
			</li>
			<li>
				<div>
					<a href="#this" class="btn_gray_s btn_mod_mail">변경하기</a>
				</div>
			</li>
			</ul>
			<p class="txt_info">이메일을  변경하시려면 변경하기를 눌러주세요.</p>
		</div>
		
		<div class="mod_mail02">
			<ul>
			<li>
				<div>
					<input type="text" class="input_txt" placeholder="이메일 주소를 입력하세요.">
				</div>
			</li>
			<li>
				<div>
					<a href="#this" class="btn_gray_s btn_cancel_mail">취소하기</a>
				</div>
			</li>
			</ul>
			<p class="txt_alert">사용하실 수 있는 아이디입니다.</p>
			<!--<p class="txt_alert">사용하실 수 없는 아이디입니다.</p>-->
			<p class="txt_info">비밀번호 분실시 이메일을 통해 확인하므로 정확하게 입력해 주세요.</p>
		</div>
	</li>
	<li>
		<span class="tit">비밀번호 변경</span>
		<input type="password" class="input_txt" placeholder="신규 비밀번호를 입력하세요.">
		<input type="password" class="input_txt" placeholder="신규 비밀번호를 한번 더 입력해주세요.">
	</li>
	<li>
		<span class="tit">기본정보</span>
		<ul class="inp_info01">
		<li>
			<div>
				<input type="text" class="input_txt" placeholder="이름">
			</div>
		</li>
		<li>
			<div>
				<select>
				<option>서울특별시</option>
				</select>
			</div>
		</li>
		</ul>
		<ul class="inp_info02">
		<li>
			<div>
				<select>
				<option>년</option>
				</select>
			</div>
		</li>
		<li>
			<div>
				<select>
				<option>음력</option>
				</select>
			</div>
		</li>
		<li>
			<div>
				<select>
				<option>남자</option>
				</select>
			</div>
		</li>
		</ul>
	</li>
	
	<li>
		<span class="tit">휴대폰</span>
		<div class="mod_tel01">
			<ul>
			<li>
				<div>
					<input type="text" class="input_txt" placeholder="01012345678" readonly>
				</div>
			</li>
			<li>
				<div>
					<a href="#this" class="btn_gray_s btn_mod_tel">변경하기</a>
				</div>
			</li>
			</ul>
			<p class="txt_info">휴대폰을  변경하시려면 변경하기를 눌러주세요.</p>
		</div>
		
		<div class="mod_tel02">
			<ul class="tel_num">
			<li>
				<div>
					<select>
					<option>통신사</option>
					</select>
				</div>
			</li>
			<li>
				<div>
					<input type="text" class="input_txt" placeholder="휴대폰번호 (-제외)">
				</div>
			</li>
			<li><div><a href="#this" class="btn_gray_s btn_cancel_tel">취소하기</a></div></li>
			</ul>
			<div class="cer">
				<a href="#" class="btn_gray btn_phone_cer">인증번호발송</a>
			</div>
			<ul class="cer_num">
			<li><div><input type="text" class="input_txt"></div></li>
			<li><div><a href="#" class="btn_gray_s btn_phone_cer02">인증하기</a></div></li>
			</ul>
		</div>
	</li>
	
	<li>
		<span class="tit">닉네임</span>
		<input type="text" class="input_txt" placeholder="최대 10자 이내로 입력해주세요.">
	</li>
	<li>
		<span class="tit">한줄소개</span>
		<input type="text" class="input_txt" placeholder="나를 표현하는 한 줄 소개를 입력해보세요.">
	</li>
	</ul>
	<a href="#" class="btn_orange">확인</a>

	</form>
</div>

	