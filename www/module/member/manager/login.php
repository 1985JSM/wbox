<?
if(!defined('_INPLUS_')) { exit; } 

if($member['mb_id']) { alert('현재 로그인 중입니다.', _BASE_URI_.'/webadmin'); }

$flag_use_header = false;
$flag_use_footer = false;

$oMember = new MemberManager();
$oMember->init();
?>
<!-- $module -->
<div id="<?=$module?>">

	<div id="login_box">
		<h3><!--img src="<?=$module_uri?>/img/h3_login.gif" alt="Manageristrator LOGIN" /-->예약박스 가맹점 관리자 <span>로그인</span></h3>

		<p class="comment">
			로그인 후 이용하실 수 있습니다.<br />
			발급받은 아이디/패스워드를 입력하신 후 <strong>로그인 버튼</strong>을 클릭해주세요.
		</p>

		<div class="form_box">			

			<form name="login_form" method="post" action="./process.html" onsubmit="return submitLoginForm(this)">
			<input type="hidden" name="mode" value="login" />
			<input type="hidden" name="return_url" value="<?=$return_url?>" />

			<ul>
			<li class="login_id">
				<input type="text" name="login_id" id="login_id" class="text required placeholder" size="20" maxlength="20" title="아이디" />
			</li>
			<li class="login_pass">
				<input type="password" name="login_pass" id="login_pass" class="text required placeholder" size="20" maxlength="20" title="비밀번호" />
			</li>
			</ul>

			<div class="btn_login">
				<p>
					<input type="image" src="<?=$module_uri?>/img/btn_login.gif" alt="LOGIN" title="Login" />
				</p>
			</div>

			</form>

			<p class="pw_info"><span class="icon tip_info"></span>아이디 및 패스워드 분실 시 <span class="info">예약박스 고객센터(051-747-0310)</span>로 문의바랍니다.</p>
		</div>

		<div class="copyright">
			<p>Copyright © <strong>Reservation box</strong>. All rights reserved.</p>
		</div>
	</div>
	
</div>
<!-- //$module -->
