<?
if(!defined('_INPLUS_')) { exit; } 

// welcome 사용 금지
if(!strpos($this_uri, 'page/main.html')) {
	movePage($base_uri.'/page/main.html');
}

$flag_use_header = false;
$footer_nav['1'] = true;

$oPage = new PageUser();
$oPage->init();

$flag_first = $_GET['flag_first'];

if($member['thumb']) { $user_photo = $member['thumb']; }
else { $user_photo = $img_uri.'/common/s_logo2.png'; }

// visual
global $oVisual;
if(!isset($oVisual)) {
	include_once(_MODULE_PATH_.'/visual/visual.user.class.php');
	$oVisual = new Visual();
	$oVisual->init();
}
$vs_list = $oVisual->selectList();

// reserve
global $oReserve;
if(!isset($oReserve)) {
	include_once(_MODULE_PATH_.'/reserve/reserve.user.class.php');
	$oReserve = new Reserve();
	$oReserve->init();
}
$member['cnt_reserve'] = $oReserve->countByUserId($member['mb_id']);

// coupon
global $oCoupon;
if(!isset($oCoupon)) {
	include_once(_MODULE_PATH_.'/coupon/coupon.user.class.php');
	$oCoupon = new Coupon();
	$oCoupon->init();
}
$member['cnt_coupon'] = $oCoupon->countCouponByMemberLevel($member['mb_level']);

// portfolio
global $oPortfolio;
if(!isset($oPortfolio)) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.user.class.php');
	$oPortfolio = new Portfolio();
	$oPortfolio->init();
}
$oPortfolio->set('thumb_width', '320');
$oPortfolio->set('thumb_height', '190');
$oPortfolio->set('cnt_rows', 8);
$pf_list = $oPortfolio->selectList();

$pf_pk = $oPortfolio->get('pk');

// recommend
global $oRecommend;
if(!isset($oRecommend)) {
	include_once(_MODULE_PATH_.'/recommend/recommend.user.class.php');
	$oRecommend = new Recommend();
	$oRecommend->init();
}
$oRecommend->set('cnt_rows', 9999);
$rc_list = $oRecommend->selectList();
$rc_pk = $oRecommend->get('pk');
?>
<style type="text/css">
div.header {display:block; border:0; background:#fff!important;}
div.header:after {height:0;}

div.header div.btn_open_gnb { position:absolute; top:0; left:0; }
div.header div.btn_open_gnb > button { width:40px; height:50px; line-height:50px; margin:0; padding:0; background:none; border:0; color:#58585a; font-size:24px;}

/* header > gnb */
#gnb { position:fixed; top:0; left:-300px; z-index:910; width:265px; height:100%; background:#ffffff; 
	transition:all 300ms ease; -webkit-transition:all 300ms ease; }
#wrap.open #gnb { left:0; }
#wrap.open {position:absolute; width:100%; height:100%; overflow:hidden;}

#gnb div.btn_close_gnb {position:absolute; top:0px; right:0; height:50px; text-align:right;z-index:50; }
#gnb div.btn_close_gnb button { width:50px; height:50px; margin:0; padding:0; background:none; border:0; }
#gnb div.btn_close_gnb button i {color:#fff; font-size:28px; color:#58585a;}

#gnb div.gnb_top_area {height:140px; background:#ffea00; padding-top:20px; box-sizing:border-box;}
#gnb div.gnb_top_area a {display:block; position:absolute; top:5px; left:0; width:50px; height:50px; line-height:50px; text-align:center; }
#gnb div.gnb_top_area a i {color:#58585a; font-size:28px;}
#gnb div.gnb_top_area div.img_profile {display:block; position:relative; overflow:hidden;  width:80px; height:80px; border-radius:80px; left:50%; margin-left:-40px; box-sizing:border-box; text-align:center;}
#gnb div.gnb_top_area div.img_profile img { width:100%; height:100%; }
#gnb div.gnb_top_area div.img_profile.no_img {display:block; width:80px; height:80px; background:#fff;line-height:80px;padding-top:10px; box-sizing:border-box; }
#gnb div.gnb_top_area div.img_profile.no_img img {text-align:center; width:60px; height:60px;  }
#gnb div.gnb_top_area p {text-align:center; color:#3c3c3c; font-weight:bold; margin-top:10px;}


#gnb div.login_area {top:0; width:100%; height:66px; background:#3c3c3c; }
#gnb div.login_area ul { height:100%; }
#gnb div.login_area ul:after { clear:both; display:block; content:""; }
#gnb div.login_area ul li {float:left; width:33.3%; height:100%; }
#gnb div.login_area ul li:first-child {width:33.4%;}
#gnb div.login_area ul li a { display:block; width:100%; height:100%; box-sizing:border-box; padding-top:16px; text-align:center; font-size:12px; color:#acacac; }
#gnb div.login_area ul li a span {display:block; font-size:14px; color:#fff;}
#gnb div.login_area p a {display:block; line-height:66px; padding-left:20px; color:#fff; box-sizing:border-box; font-size:16px; }
#gnb div.login_area p a span {float:right; padding-right:20px;}

#gnb div.gnb_more {position:absolute; top:0; height:100%; width:100%; box-sizing:border-box; padding-top:140px; overflow:hidden;}
#gnb div.gnb_more div.section { height:100%; overflow-y:auto; overflow-x:hidden; }
#gnb div.gnb_more div.gnb p {height:60px; line-height:60px; padding:0 20px; border-bottom:1px solid #d2d2d2; font-size:18px; font-weight:bold;color:#3c3c3c; }
#gnb div.gnb_more div.gnb p a {display:block; width:100%;}
#gnb div.gnb_more div.gnb p a span {float:right;}
#gnb div.gnb_more div.gnb ul {padding:8px 0;}
#gnb div.gnb_more div.gnb ul li {height:44px; padding-left:20px; line-height:44px; font-size:14px; box-sizing:border-box;}
#gnb div.gnb_more div.gnb ul li a {display:block; width:100%; }
#gnb div.gnb_more div.gnb ul li a i {font-size:18px;}

#gnb div.gnb_more div.side_menu {border-top:1px #d2d2d2 solid; border-bottom:1px #d2d2d2 solid}
#gnb div.gnb_more div.side_menu ul:after { clear:both; display:block; content:""; }
#gnb div.gnb_more div.side_menu ul li {float:left; width:25%; height:68px; border-left:1px #d2d2d2 solid; text-align:center; padding-top:14px; box-sizing:border-box;  }
#gnb div.gnb_more div.side_menu ul li:first-child {border-left:0;  }
#gnb div.gnb_more div.side_menu ul li a {display:block; width:100%; font-size:11px; color:#58585a;}
#gnb div.gnb_more div.side_menu ul li a i {display:block; padding-bottom:5px; font-size:18px;  color:#acacac;}

#gnb div.gnb_more div.gnb_quick_menu {}
#gnb div.gnb_more div.gnb_quick_menu ul:after { clear:both; display:block; content:""; }
#gnb div.gnb_more div.gnb_quick_menu ul li { width:100%; height:40px; line-height:40px; box-sizing:border-box; border-bottom:1px #d2d2d2 solid; background:#f6f6f6;  }
#gnb div.gnb_more div.gnb_quick_menu ul li a {display:block; width:100%; font-size:11px; color:#58585a; padding-left:20px;}

#gnb a:hover, #gnb a:active, #gnb a:focus {background:##f6f6f6;  color:#000;}

div.main_detai_img {position:relative; padding-top:62%; overflow:hidden; margin-bottom:20px;}
div.main_detai_img  div.main_img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.main_detai_img  div.main_img_area img {top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}
/*
#main_img_area { position:relative; margin-bottom:20px;}
#main_img_area .slick-slide img { width:100%; } */
#main_img_area .slick-prev { overflow:hidden; position:absolute; top:50%; left:10px; width:17px; height:26px; margin-top:-33px; background:url("/img/mobile/btn/btn_img_control.png") no-repeat 0 0; background-size:14px 50px; text-indent:-9999px; -webkit-background-size:17px 52px; border:0; }
#main_img_area .slick-next { overflow:hidden; position:absolute; top:50%; right:10px; width:17px; height:26px; margin-top:-33px; background:url("/img/mobile/btn/btn_img_control.png") no-repeat 0 -25px; background-size:14px 50px; text-indent:-9999px; -webkit-background-size:17px 52px; border:0;}
#main_img_area ul.slick-dots { position:absolute; width:100%; bottom:10px; height:10px; padding:0; text-align:center; }
#main_img_area ul.slick-dots li { display:inline-block; margin-left:10px; }
#main_img_area ul.slick-dots li:first-child { margin-left:0; }
#main_img_area ul.slick-dots li button { display:block; overflow:hidden; width:10px; height:10px; border:2px solid #ddd; background:none;  border-radius:10px; text-indent:-9999px; }
#main_img_area ul.slick-dots li.slick-active button { border:2px solid #f06e58; background:#f06e58; }

div.main_quick_menu {display:block; position:relative; margin-bottom:20px;}
div.main_quick_menu ul:after {display:block;content:'';clear:both}
div.main_quick_menu ul li {float:left; width:50%; height:60px; }
div.main_quick_menu ul li a {display:block; width:100%;  padding-left:20px; line-height:60px; font-size:16px; box-sizing:border-box; border-top:2px solid #f6f6f6; background:#fff;}

div.main_quick_menu ul li.right a {border-left:2px solid #f6f6f6; }
div.main_quick_menu ul li a i {padding-right:20px; }
div.main_quick_menu ul li a i.q_myshop {color:#f06e58;}
div.main_quick_menu ul li a i.q_reserve {color:#72ced4;}
div.main_quick_menu ul li a i.q_portfolio {color:#9e6eaf;}
div.main_quick_menu ul li a i.q_search {color:#ffb400;}

#banner {width:100%; height:100%; border-top:none; }
#banner .banner img{width:100%; height:auto; }
#banner .banner .slick-dots{top:-20px;left:20px;}

div.banner_img {position:relative; margin-bottom:10px; width:100%; height:100%; border-top:none; }
div.banner_img img{width:100%; height:auto; }

div.recommend_shop {display:block; position:relative; width:100%; padding:20px 10px; margin-bottom:20px;  box-sizing:border-box; background:#fff; box-sizing:border-box; }
div.recommend_shop h2 {font-size:16px; margin-bottom:5px;}
div.recommend_shop h2 i {color:#f06e58;}
div.recommend_shop div.theme ul li {position:relative; width:100%; margin-bottom:10px; }
div.recommend_shop div.theme ul li a div.info_area {display:block; overflow:hidden; position:absolute; z-index:10; width:100%; top:50%; margin-top:-36px; padding-top:10px; text-align:center; color:#fff; box-sizing:border-box;  background:url("/img/mobile/bg/bg_recommend_shop.png") top center no-repeat; background-size:23px 5px;}
div.recommend_shop div.theme ul li a div.info_area strong {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.recommend_shop div.theme ul li a div.info_area em {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.recommend_shop div.theme ul li a div.info_area span {display:block; position:relative; overflow:hidden; left:50%;  margin-left:-30px; padding-left:-30px; width:60px; height:20px; border-radius:20px; font-size:14px; background:#fff center; color:#58585a; text-overflow:ellipsis; white-space:nowrap; }
div.recommend_shop div.theme ul li a div.img_area {display:block; overflow:hidden; border-radius:4px; background:#000; }
div.recommend_shop div.theme ul li a div.img_area img {width:100%; height:auto; opacity:0.7; }

div.portfolio {display:block; position:relative; padding:0 10px 20px 10px; box-sizing:border-box;}
div.portfolio h2 {font-size:16px;}
div.portfolio h2 i {color:#72ced4;}

div.portfolio div.best ul:after {display:block;content:'';clear:both}
div.portfolio div.best ul li {position:relative; width:50%;float:left; margin-top:5px; border-radius:10px;  }
div.portfolio div.best ul li div.best_list {position:relative; padding-top:57%; overflow:hidden; margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}

div.portfolio div.best ul li div.best_list div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.portfolio div.best ul li div.best_list div.img_area > img {position:absolute; top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}
/*
div.portfolio div.best ul li div.best_list div.img_area {position:relative; width:100%; border-bottom:0;}
div.portfolio div.best ul li div.best_list div.img_area > img {width:100%; border-top-right-radius:4px; border-top-left-radius:4px;} 
div.portfolio div.best ul li div.best_list div.img_area span.ico_good {position:absolute; bottom:-19px; right:8px; display:block; width:38px; height:38px; border-radius:40px; font-size:10px; text-align:center; font-weight:bold; background:#f06e58; color:#fff; }
div.portfolio div.best ul li div.best_list div.img_area span.ico_good i {display:block; padding-top:6px;}
*/

div.portfolio div.best ul li div.best_list div.info_area { display:block; height:120px; padding:16px; box-sizing:border-box; text-overflow:ellipsis; white-space:nowrap; overflow:hidden }
div.portfolio div.best ul li div.best_list div.info_area span {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.portfolio div.best ul li div.best_list div.info_area span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.portfolio div.best ul li div.best_list div.info_area span.writer strong {font-weight:normal; color:#70cdd4;}
div.portfolio div.best ul li div.best_list div.info_area span.tit {font-size:16px; padding-bottom:20px; color:#333; }
div.portfolio div.best ul li div.best_list div.info_area a.tag {font-size:14px; color:#f06e58; }
div.portfolio div.best ul li div.best_list div.info_area span.ico_good {position:absolute; bottom:100px; right:8px; display:block; width:38px; height:38px; border-radius:40px; font-size:10px; text-align:center; font-weight:bold; background:#f06e58; color:#fff; }
div.portfolio div.best ul li div.best_list div.info_area span.ico_good i {display:block; padding-top:6px;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	callNative("checkAppVersion/validateUpdate");
	var cnt_run = "<?=$cnt_run?>";
	if(cnt_run == "1") {		
		$("#btn_open_tutorial").trigger("click");
	}

	// GNB
	$("#layer_back").on("click", function() {
		closeGnb();
	});

	// 메인비주얼
	$("#main_img_area > div.main_img_area").slick({
		arrows: true,
		infinite: true,
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4000
	});

	/*
	// 메인 중앙배너
	$(".banner").slick({
		arrows: false,
		infinite: true,
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4000
	});
	*/
});

var flag_first = "<?=$flag_first?>";
</script>
</head>
<body>
<div id="wrap" class="wrap">
	
	<div id="header" class="header">
    	<h1><img src="<?=$img_uri?>/common/logo.png" alt="예약박스"></h1>
		<div class="btn_open_gnb">
			<button type="button" onclick="openGnb()" title="주메뉴 열기"><i class="xi-bars"></i></button>
		</div>

		 <!-- gnb -->
        <div id="gnb">
			<div class="gnb_top_area">
				<? if($is_user) { ?>
				<div class="img_profile"><img src="<?=$member['thumb']?>" alt="<?=$user_photo?> profile image" /></div>
				<p><?=$member['mb_nick']?></p>
				<? } else { ?>
				<div class="img_profile no_img"><img src="<?=$user_photo?>" alt="no_img" /></div>
				<p>로그인해주세요</p>
				<? } ?>
			</div>

			<div class="btn_close_gnb">
				<button type="button" onclick="closeGnb()" title="주메뉴 닫기"><i class="xi-close"></i></button>
			</div>

			<div class="gnb_more">

				<div class="section">	

					<div class="login_area">
						<? if($is_user) { ?>
						<ul>
						<li><a href="<?=$base_uri?>/reserve/list.html">예약현황<span><?=number_format($member['cnt_reserve'])?></span></a></li>
						<li><a href="<?=$base_uri?>/coupon/list.html">쿠폰<span><?=number_format($member['cnt_coupon'])?></span></a></li>
						<li><a href="<?=$base_uri?>/member/profile.html">회원등급<span><?=$member['txt_mb_level']?></span></a></li>
						</ul>
						<? } else { ?>
						<p><a href="<?=$base_uri?>/member/login.html">로그인 <span><i class="xi-angle-right"></i></span></a></p>
						<? } ?>				
					</div>


					<div class="gnb">
						<p><a href="<?=$base_uri?>/reserve/list.html"<? if(!$is_user) { ?> class="btn_only_login"<? } ?>>예약보기 <span><i class="xi-angle-right"></i></span></a></p>
						<ul>
						<li><a href="<?=$base_uri?>/member/profile.html"<? if(!$is_user) { ?> class="btn_only_login"<? } ?>><i class="xi-pen"></i> 프로필관리</a></li>
						<li><a href="<?=$base_uri?>/coupon/list.html"<? if(!$is_user) { ?> class="btn_only_login"<? } ?>><i class="xi-coupon"></i> 나의쿠폰</a></li>
						<li><a href="<?=$base_uri?>/page/invitation.html"<? if(!$is_user) { ?> class="btn_only_login"<? } ?>><i class="xi-user-add"></i> 친구초대</a></li>
						<li><a href="<?=$base_uri?>/qna/write.html"<? if(!$is_user) { ?> class="btn_only_login"<? } ?>><i class="xi-calendar-check"></i> 1:1 문의</a></li>
						</ul>
					</div>

					<div class="side_menu">
						<ul>
						<li><a href="<?=$base_uri?>/notice/list.html"><i class="xi-announce"></i> 공지사항</a></li>
						<li><a href="<?=$base_uri?>/event/list.html"><i class="xi-present"></i> 이벤트</a></li>
						<li><a href="<?=$base_uri?>/faq/list.html"><i class="xi-unknown-circle"></i> FAQ</a></li>
						<li><a href="<?=$base_uri?>/page/guide.html"><i class="xi-information-circle"></i> 이용안내</a></li>
						</ul>
					</div>

					<div class="gnb_quick_menu">
						<ul>						
						<li><a href="<?=$base_uri?>/page/tutorial.html"id="btn_open_tutorial"  class="btn_layer_page" target="#layer_page9">튜토리얼보기</a></li>
						<li><a href="<?=$base_uri?>/application/write.html">가맹점등록신청</a></li>
						<li><a href="<?=$base_uri?>/config/setting.html"<? if(!$is_user) { ?> class="btn_only_login"<? } ?>><i class="xi-cog"></i> 설정</a></li>
						</ul>
					</div>
				</div>
				<!-- //gnb -->  
			</div>
		</div>
    </div>

    <div id="container" class="container">
		<div class="main">

			<div id="main_img_area" class="main_detai_img">
				<div class="main_img_area">
					<? for($i = 0 ; $i < sizeof($vs_list) ; $i++) { ?>
					<div>
						<? if($vs_list[$i]['sh_code']) { ?><a href="../shop/view.html?sh_code=<?=$vs_list[$i]['sh_code']?>" class="btn_layer_page" target="#layer_page2"><? } ?>
						<img src="<?=$vs_list[$i]['thumb']?>" alt="<?=$vs_list[$i]['vs_subject']?> thumbnail image" />
						<? if($vs_list[$i]['sh_code']) { ?></a><? } ?>
					</div>
					<? } if(sizeof($vs_list) == 0) { ?><p class="no_data">등록된 메인 비주얼이 없습니다.</p><? } ?>					
				</div>
			</div>

			<div class="main_quick_menu">
				<ul>				
				<li>
					<a href="<?=$base_uri?>/portfolio/list.html"><i class="xi-trophy q_portfolio"></i>포트폴리오</a>
				</li>	
				<li class="right">
					<a href="<?=$base_uri?>/shop/area.html"><i class="xi-magnifier q_search"></i>검색</a>
				</li>
				<li>
					<a href="<?=$base_uri?>/shop/visit_list.html"><i class="xi-shop q_myshop"></i>나의매장</a>
				</li>
				<li class="right">
					<a href="<?=$base_uri?>/reserve/list.html"><i class="xi-calendar-check q_reserve"></i>예약보기</a>
				</li>
				
				</ul>
			</div>

			<!--div id="banner">
				<div class="banner">
					<div><img src="/img/mobile/banner/banner01.png" alt=""></div>
					<div><img src="<?=$img_uri?>/banner/banner02.png" alt=""></div>
				</div>
				<script>
				
				</script>
			</div-->

			<div class="banner_img">
				<a href="<?=$base_uri?>/application/write.html"><img src="/img/mobile/banner/banner01.png" alt=""></a>
			</div>

			<? if(sizeof($rc_list) > 0) { ?>
			<div class="recommend_shop">
				<h2><i class="xi-star"></i> 예약박스 추천</h2>
				<div class="theme">
					<ul>
					<? for($i = 0 ; $i < sizeof($rc_list ) ; $i++) { ?>
					<li>
						<a href="<?=$base_uri?>/shop/recommend_list.html?<?=$rc_pk?>=<?=$rc_list[$i][$rc_pk]?>">
							<div class="info_area">
								<strong><?=$rc_list[$i]['rc_subject']?></strong>
								<em><?=$rc_list[$i]['rc_subject2']?></em>
								<span><?=number_format($rc_list[$i]['cnt_shop'])?>개</span>
							</div>
							<div class="img_area">
								<img src="<?=$rc_list[$i]['thumb']?>" alt="<?=$rc_list[$i]['rc_subject']?> Thumbnail image">
							</div>
						</a>
					</li>
					<? } ?>
					</ul>
				</div>
			</div>
			<? } ?>

			<? if(sizeof($pf_list) > 0) { ?>
			<div class="portfolio">
				<h2><i class="xi-crown"></i> NEW 포트폴리오</h2>
				<div class="best">
					<ul>
					<? for($i = 0 ; $i < sizeof($pf_list) ; $i++) { ?>
					<li>
						<div class="best_list">
							<a href="<?=$base_uri?>/portfolio/view.html?<?=$pf_pk?>=<?=$pf_list[$i][$pf_pk]?>" class="btn_layer_page" target="#layer_page1" title="포트폴리오">
								
								<div class="img_area">
									<? if ($pf_list[$i]['main_img']['thumb'] == '') { ?>
									<img src="http://wbox.inplus21.com/img/mobile/common/img_noimg_296x196.gif" alt="이미지가 없습니다.">
									<? } else { ?>
									<img src="<?=$pf_list[$i]['main_img']['thumb']?>" alt="<?=$pf_list[$i]['pf_subject']?> thumbnail image" />
									<? } ?>

								</div>
								<div class="info_area">
									<span class="ico_good"><i class="xi-crown"></i>Good!</span>
									<span class="writer">by.<strong><?=$pf_list[$i]['pf_name']?></strong></span>
									<span class="tit"><?=$pf_list[$i]['pf_subject']?></span>
									<? if($pf_list[$i]['pf_main_tag']) { ?>
									<span><a href="<?=$base_uri?>/portfolio/search_list.html?sch_type=pf_tags&sch_keyword=<?=$pf_list[$i]['pf_main_tag']?>" class="tag">#<?=$pf_list[$i]['pf_main_tag']?></a></span>
									<? } ?>
								</div>
							</a>
						</div>
					</li>	
					<? } ?>
					</ul>
				</div>				
			</div>
			<? } ?>
		</div>
		<!-- //main -->

	</div>
	<!-- //container -->


