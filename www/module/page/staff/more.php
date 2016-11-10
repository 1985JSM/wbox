<?
if(!defined('_INPLUS_')) { exit; } 

if(!$member['mb_id']) {
	movePage('../member/login.html');
}

$flag_use_info = true;
$footer_nav['5'] = true;

$oPage = new PageStaff();
$oPage->init();
?>
<script type="text/javascript">
$(document).ready(function() {
//	callNative("storeMemberId/<?=$member['mb_id']?>");
});
</script>
</head>
<body>

	<div id="container" class="other">

        <ul class="other_nav">
         <li><a href="../notice/list.html" class="nav01">공지사항<!-- <img src="<?=$img_uri?>/ico/ico_n.png" alt=""--></a></li>
        <li><a href="../page/ready_event.html" class="nav02">이벤트</a></li>
        <li><a href="../member/profile.html" class="nav03<? if(!$is_staff) { ?> btn_only_login<? } ?>">프로필관리</a></li>
        <li><a href="../gallery/list.html" class="nav05">갤러리관리</a></li>
        <li><a href="../page/ready_coupon.html" class="nav13">쿠폰보내기</a></li>
        <li><a href="../page/ready_sms.html" class="nav14">SMS보내기</a></li>
        <li><a href="../config/setting.html" class="nav12">설정</a></li>
        <li><a href="#" class="null">&nbsp;</a></li>
        </ul>

    </div>
    
    <div id="banner">
    	<div class="banner">
        <div><a href="#"><img src="<?=$img_uri?>/banner/banner01.png" alt=""></a></div>
        <div><a href="#"><img src="<?=$img_uri?>/banner/banner02.png" alt=""></a></div>
        <div><a href="#"><img src="<?=$img_uri?>/banner/banner03.png" alt=""></a></div>
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