<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '가맹점등록요청';
$footer_nav['1'] = true;


$oApplication = new ApplicationUser();
$oApplication->init();

$uid = $oApplication->get('uid');
$data = $oApplication->selectDetail($uid);
?>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>

<div id="container" class="container">
	
	<div class="join">
		<div class="join_intro">
			<p>자주가는 매장을 가맹점으로 추천하고 싶은 분!<br>예약박스의 가맹점이 되고 싶으신 분!<br>가맹점 등록 요청을 여기서 해주세요.<br>최대한 빠른 시일내에 가맹점으로 초대하겠습니다.</p>
			<div class="join_intro_cloud_ani"></div>
		</div>

		<div class="join_success_form">
			<h3>가맹점 등록이 완료되었습니다.</h3>
			<ul>
			<li>
				<span class="tit">업체명</span>
				<?=$data['ap_shop_name']?>
			</li>
			<li>
				<span class="tit">담당자</span>
				<?=$data['ap_name']?>
			</li>
			<li>
				<span class="tit">위치안내</span>
				<?=$data['txt_addr']?>
			</li>
			<li>
				<span class="tit">이메일</span>
				<?=$data['ap_email']?>
			</li>
			<li>
				<span class="tit">연락처</span>
				<?=$data['ap_tel']?>
			</li>
			<li>
				<span class="tit">요청이유</span>
				<?=nl2br($data['ap_memo'])?>
			</li>
			</ul>
		</div>

		<a href="../page/main.html" class="btn_gray">홈으로</a>

	</div>
        
</div>

	