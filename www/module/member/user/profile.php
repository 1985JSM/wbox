<?
if(!defined('_INPLUS_')) { exit; } 

if(!$is_user) {
	alert('로그인 후 이용할 수 있습니다.');
}

$back_url = '../page/main.html';
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
		<div class="profile_info">
			<a href="./modify_index.html">
				<em>계정관리</em><span class="btn_modify">변경하기</span>
				<span class="txt"><?=$member['mb_email']?></span>
				<span class="txt2">계정의 이메일, 비밀번호, 기본정보, 닉네임, 한줄소개를 변경합니다.</span>
			</a>
			<div class="img_area"><img src="<?=$member['thumb']?>" id="profile_photo" width="90" height="90" alt="profile-image" /></div>
			<button type="button" onclick="chooseProfilePhoto('<?=$member['mb_id']?>')" class="btn_camera"><span class="hidden">사진선택</span></button>		
		</div>

		<ul class="profile_list">
		<li>
			<div>
				<em>이름</em><?=$member['mb_name']?>
			</div>
		</li>
		<li>
			<div>
				<em>지역</em><?=$member['txt_mb_area']?>
			</div>
		</li>
		<li>
			<div class="bir">
				<em>생일/성별</em>
				<?=$member['txt_mb_birth']?>(<?=$member['txt_mb_birth_type2']?>) <?=$member['txt_mb_gender']?>자
				<span class="txt">생일을 입력하면 예약박스에서 월/일로 표시되며 생일 쿠폰 및 이벤트 등록 등 다양한 혜택을 받으실 수 있습니다.</span>
			</div>
		</li>
		<li>
			<div>
				<em>휴대폰</em>
				<?=$member['mb_hp']?>
			</div>
		</li>
		<li>
			<div>
				<em>닉네임</em>
				<?=$member['mb_nick']?>
			</div>
		</li>
		<li>
			<div>
				<em>한줄소개</em>
				<?=getWithoutNull($member['mb_pr'], '-')?>
			</div>
		</li>
		
		</ul>
		
		<ul class="profile_list2">
		<li>
			<a href="./process.html?mode=logout">
				<em>로그아웃</em>
				<span class="txt"><?=$member['mb_email']?>계정을 로그아웃 합니다.</span>
			</a>
		</li>

		<li>
			<a href="./leave.html">
				<em>회원탈퇴</em>
			</a>
		</li>
		</ul>
	</div>
</div>

<form name="profile_photo_form" method="post" id="profile_form" action="./process.html">
<input type="hidden" name="mode" value="upload_photo" />
<input type="hidden" name="file_id" value="" />
<input type="hidden" name="uid" value="<?=$member['mb_id']?>" />
</form>

<!--form name="profile_photo_form" method="post" action="./process.html">
<input type="hidden" name="mode" value="upload_photo" />
<input type="hidden" name="file_name" value="" />
<input type="hidden" name="file_content" value="" />
</form-->
	