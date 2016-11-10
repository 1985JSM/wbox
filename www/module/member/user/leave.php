<?
if(!defined('_INPLUS_')) { exit; } 

if(!$is_user) {
	alert('로그인 후 이용할 수 있습니다.');
}

$back_url = '../member/profile.html';
$doc_title = '회원탈퇴';
$footer_nav['1'] = true;

$oMember = new MemberUser();
$oMember->init();
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div id="container" class="container">
	
	<div class="leave">
		
		<div class="leave_intro">
			<p>회원탈퇴를 진행하기 위해 본인 확인이 필요합니다.<br />회원탈퇴시, 회원님의 개인정보 및 관련 모든 정보가 삭제처리 됩니다.</p>
			<div class="join_intro_cloud_ani"></div>
		</div>

		<form name="leave_form" action="./process.html" method="post" onsubmit="return submitLeaveForm(this)">
		<input type="hidden" name="mode" value="leave" />
		
		<ul class="leave_form">
		<li>
			<span class="tit">탈퇴할 이메일</span>
			<input type="text" name="mb_email" value="<?=$member['mb_email']?>" class="input_txt required readonly" placeholder="이메일" title="이메일" />
		</li>
		 <li>
			<span class="tit">비밀번호</span>
			<input type="password" name="mb_pass" class="input_txt required" placeholder="비밀번호를 입력해주세요." title="비밀번호" />
		</li>				
		<li>
			<span class="tit">탈퇴사유</span>
			<textarea type="text" name="lv_memo" class="input_txt" title="탈퇴사유"  placeholder="예약박스를 탈퇴하시는 이유를 작성해주시면 앞으로 더 좋은 모습으로 만나될 수 있도록 노력하겠습니다." ></textarea>
			<p class="txt"></p>
		</li>
		</ul>	

		<div class="leave_btn"> 
			<ul>
				<li><a href="./profile.html" class="btn_gray">취소</a></li>
				<li><button type="submit" class="btn_orange">확인</button></li>
			</ul>
		</div>

		</form>
	</div>
	
</div>

	