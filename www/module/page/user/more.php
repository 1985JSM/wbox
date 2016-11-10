<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$footer_nav['5'] = true;

$oPage = new PageUser();
$oPage->init();

// reserve
global $oReserve;
if(!isset($oReserve)) {
	include_once(_MODULE_PATH_.'/reserve/reserve.class.php');
	$oReserve = new Reserve();
	$oReserve->init();
}
$member['cnt_reserve'] = $oReserve->countByUserId($member['mb_id']);

if($member['thumb']) {
	$user_photo = $member['thumb'];
}
else {
	$user_photo = $img_uri.'/common/s_logo2.png';

}
?>
<script type="text/javascript">
$(document).ready(function() {
//	callNative("storeMemberId/<?=$member['mb_id']?>");
});
</script>
</head>
<body>
<div id="wrap">
	<div class="member_info">
    	<div class="img_area"><img src="<?=$user_photo?>" alt=""></div>

		<? if($is_user) { ?>
    	<h3><?=$member['mb_nick']?></h3>
        <ul>
        <li>내위치<strong><?=_DONG_?></strong></li>
        <li>예약현황<strong><?=number_format($member['cnt_reserve'])?></strong></li>
        <li>포인트<strong><?=number_format($member['mb_point'])?> <img src="<?=$img_uri?>/ico/ico_p.png" alt=""></strong> </li>
        </ul>
		<? } else { ?>
        <p>회원혜택을 원하시면<br>로그인해주세요</p>
        <a href="../member/login.html" class="btn_black_line">로그인 </a>
		<? } ?>
    </div>
        
	<div id="container" class="other">
        <ul class="other_nav">
        <li><a href="../notice/list.html" class="nav01">공지사항<!-- <img src="<?=$img_uri?>/ico/ico_n.png" alt=""--></a></li>
        <li><a href="../page/ready_event.html" class="nav02">이벤트</a></li>
        <li><a href="../member/profile.html" class="nav03<? if(!$is_user) { ?> btn_only_login<? } ?>">프로필관리</a></li>
        <li><a href="../page/ready_guide.html" class="nav04">이용안내</a></li>
        <li><a href="../reserve/list.html" class="nav05<? if(!$is_user) { ?> btn_only_login<? } ?>">예약보기</a></li>
        <li><a href="../page/ready_coupon.html" class="nav06">나의쿠폰</a></li>
        <li><a href="../page/ready_invitation.html" class="nav07">친구초대</a></li>
        <li><a href="../application/write.html" class="nav08">가맹점 등록요청</a></li>
        <li><a href="../page/ready_faq.html" class="nav09">자주묻는질문</a></li>
        <li><a href="../page/ready_qna.html" class="nav10">1:1 상담</a></li>
        <li><a href="../page/ready_tutorial.html" class="nav11">튜토리얼보기</a></li>
        <li><a href="../config/setting.html" class="nav12<? if(!$is_user) { ?> btn_only_login<? } ?>">설정</a></li>
        </ul>
    </div>
    <div id="banner">
    	<div class="banner">
        <div><a href="http://wbox.inplus21.com/webuser/application/write.html"><img src="<?=$img_uri?>/banner/banner01.png" alt=""></a></div>
        <div><a href="#"><img src="<?=$img_uri?>/banner/banner02.png" alt=""></a></div>
        </div>
        <script>
        $(".banner").slick({
			arrows: false,
			infinite: true,
			dots: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
  			autoplaySpeed: 4000
		});
        </script>
    </div>