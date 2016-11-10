<?
if(!defined('_INPLUS_')) { exit; } 

/* shop */
$oShop = new ShopUser();
$oShop->init();
$pk = $oShop->get('pk');
$uid = $oShop->get('uid');

$sh_data = dbOnce($oShop->get('data_table'), "sh_name, sh_tel", "where $pk = '$uid'", "");
$sh_name = $sh_data['sh_name'];
$sh_tel = $sh_data['sh_tel'];

/* favorite */
if(!isset($oFavorite)) {
	include_once(_MODULE_PATH_.'/favorite/favorite.class.php');
	$oFavorite = new Favorite();
	$oFavorite->init();
}
$chk_favorite = $oFavorite->checkFavoriteByShopCode($uid);

// 쿠키에 저장
$oShop->setVisitCookie($uid);
?>
<style type="text/css">
div.view_detail{background:#f6f6f6}

/* 기본정보 */
div.view_detai_img {position:relative; padding-top:60%; overflow:hidden;}
div.view_detai_img  div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.view_detai_img  div.img_area img {top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}
/*#img_area { position:relative; }
#img_area .slick-slide img { width:100%; }*/
#img_area .slick-prev { overflow:hidden; position:absolute; top:50%; left:10px; width:17px; height:26px; margin-top:-33px; background:url("/img/mobile/btn/btn_img_control.png") no-repeat 0 0; background-size:14px 50px; text-indent:-9999px; -webkit-background-size:17px 52px; border:0; }
#img_area .slick-next { overflow:hidden; position:absolute; top:50%; right:10px; width:17px; height:26px; margin-top:-33px; background:url("/img/mobile/btn/btn_img_control.png") no-repeat 0 -25px; background-size:14px 50px; text-indent:-9999px; -webkit-background-size:17px 52px; border:0;}
#img_area ul.slick-dots { position:absolute; width:100%; bottom:10px; height:10px; padding:0; text-align:center; }
#img_area ul.slick-dots li { display:inline-block; margin-left:10px; }
#img_area ul.slick-dots li:first-child { margin-left:0; }
#img_area ul.slick-dots li button { display:block; overflow:hidden; width:10px; height:10px; border:2px solid #ddd; background:none;  border-radius:10px; text-indent:-9999px; }
#img_area ul.slick-dots li.slick-active button { border:2px solid #f06e58; background:#f06e58; }

div.view_detail_info{ border-bottom:0; margin-bottom:10px; }
div.view_detail_info:after{height:0; background:none; }

div.view_detail_item {border-bottom:0; margin-bottom:10px; }
div.view_detail_item:after {height:0; background:none; }

div.view_detail_review ul.review_info li{float:left;position:relative;width:20%; text-align:center}
div.view_detail_review ul.review_info li div{display:inline-block; position:relative}
div.view_detail_review ul.review_info li div button {background:none; border:0; padding:0; margin:0;}
div.view_detail_review {border-bottom:0; }
div.view_detail_review:after{height:0; background:none; }

div.view_detail_review ul.review_info li em{display:block;width:50px;height:29px; border-radius:50px; background:url(/img/mobile/ico/ico_review.png) no-repeat 50% 0; background-size:25px 250px; text-align:center; line-height:29px; padding-top:21px;font-size:11px; color:#fff; font-weight:bold}
div.view_detail_review ul.review_info li em.ico01{ background-color:#f06e58; background-position:50% 0}
div.view_detail_review ul.review_info li em.ico02{ background-color:#11b8be; background-position:50% -50px}
div.view_detail_review ul.review_info li em.ico03{ background-color:#ffb400; background-position:50% -100px}
div.view_detail_review ul.review_info li em.ico04{ background-color:#3ccbf4; background-position:50% -150px}
div.view_detail_review ul.review_info li em.ico05{ background-color:#9e6eaf; background-position:50% -200px}
div.view_detail_review ul.review_info li span.rep { position:absolute;top:0;right:-5px;height:14px;line-height:14px;font-size:10px; border-radius:7px; text-align:center;padding:0 3px;color:#fff;min-width:16px; background:#858585;}
div.view_detail_review ul.review_info li button.on span.rep {background:#f84e32}

div.blog_review {background:#fff; border-bottom:0; position:relative; margin-bottom:10px; padding:20px 0}
div.blog_review :after{display:block;content:'';width:100%;height:0; background:none; position:absolute;bottom:-2px;left:0}
div.blog_review h4{color:#333;font-weight:bold; padding-left:10px; margin-bottom:15px}
div.blog_review h4 span{font-weight:normal; padding-left:6px}
div.blog_review a.view_more{font-size:12px; position:absolute;top:20px;right:10px;color:#888}

div.blog_board ul li {padding:10px 10px; border-top:1px #f6f6f6 solid;}
div.blog_board ul li:first-child {padding-top:0; border-top:0; }
div.blog_board ul li a {display:block; overflow:hidden; position:relative; padding-left:100px;}
div.blog_board ul li a span.img {position:absolute; left:0; top:0;}
div.blog_board ul li a span.img img {width:90px; width:90px;}
div.blog_board ul li a strong {display:block; overflow:hidden; padding-bottom:4px; text-overflow:ellipsis; white-space:nowrap;}
div.blog_board ul li a span.text {display:block; padding-bottom:6px; font-size:12px; overflow:hidden; max-height:32px;}
div.blog_board ul li a span.date {display:block; font-size:12px; color:#888888;}

/* 서비스 */
ul.service_list > li {margin-bottom:10px; border-radius:10px;}
ul.service_list > li > div {border-left:0; border-right:0; border-bottom:2px solid #b5b5b5; border-radius:4px;}

ul.service_list > li > div div.info_area .tit{width:75%; display:block;font-size:14px; line-height:16px;font-weight:bold; padding-bottom:6px;text-overflow:ellipsis; white-space:nowrap; overflow:hidden}
ul.service_list > li > div div.info_area .price {display:block;font-size:11px; line-height:15px; color:#555;color:#f06e58}
ul.service_list > li > div div.info_area span.basic_price {display:block; font-size:11px; color:#555555;}
ul.service_list > li > div div.info_area span.basic_price em {text-decoration:line-through; }
ul.service_list > li > div div.info_area span.user_price {display:inline-block; font-size:18px; line-height:18px; color:#f06e58; font-weight:bold;}
ul.service_list > li > div div.info_area strong {display:inline-block; padding:2px; font-size:11px; line-height:11px; background:#f06e58; color:#fff;}

ul.service_list > li > div div.info_area span.con{padding-top: 5px; }

/* 담당자 */
ul.duty_list{margin:10px;}
ul.duty_list > li div.staff_list {position:relative; padding-top:60%; overflow:hidden; border-radius:4px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0;}
ul.duty_list > li div div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
ul.duty_list > li div div.img_area > img {position:absolute; top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}
ul.duty_list > li div div.info_area {position:relative; padding:16px 12px 0 12px;height:120px;}
ul.duty_list > li div div.info_area > ul > li.tit{font-size:16px; padding-bottom:10px; color:#333}
ul.duty_list > li div div.info_area > ul > li.service {padding-top:10px;}

ul.duty_list > li ul.duty_list_btn {position:relative;border-bottom:none;}
ul.duty_list > li ul.duty_list_btn > li{float:left;width:50%;border-top:1px solid #f8f8f8}
ul.duty_list > li ul.duty_list_btn > li:first-child a{ border-right:1px solid #f8f8f8}

ul.duty_list > li ul.duty_list_btn > li a {font-size:24px; text-align:center; line-height:34px;}
ul.duty_list > li ul.duty_list_btn > li a.ico_res{ background-image:none; color:#f06e58;}
ul.duty_list > li ul.duty_list_btn > li a.ico_img{ background-image:none}

/* 포트폴리오 */
div.portfolio {padding:10px;}
div.portfolio ul:after {display:block;content:'';clear:both}
div.portfolio ul li {position:relative; width:50%;float:left; margin-top:5px; border-radius:4px;/* border-radius:10px; */  }

/*
div.portfolio ul li div.portfolio_list {position:relative; padding-top:60%; overflow:hidden; margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%;-webkit-transform: translate(50%,50%);
    -ms-transform: translate(50%,50%);
    transform: translate(50%,50%);}
div.portfolio ul li div.portfolio_list div.img_area > img {position:absolute; top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;   -webkit-transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);} */

div.portfolio ul li div.portfolio_list {position:relative; padding-top:57%; overflow:hidden; margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.portfolio ul li div.portfolio_list div.img_area > img {position:absolute; top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}

/*
div.portfolio ul li div.portfolio_list {margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:relative; width:100%; border-bottom:0;}
div.portfolio ul li div.portfolio_list div.img_area > img {width:100%; border-top-right-radius:4px; border-top-left-radius:4px;}
*/

div.portfolio ul li div.portfolio_list div.info_area {position:relative; display:block; height:120px; padding:16px; box-sizing:border-box; text-overflow:ellipsis; white-space:nowrap; overflow:hidden}
div.portfolio ul li div.portfolio_list div.info_area span {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.portfolio ul li div.portfolio_list div.info_area span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.portfolio ul li div.portfolio_list div.info_area span.writer strong {font-weight:normal; color:#70cdd4;}
div.portfolio ul li div.portfolio_list div.info_area span.tit {font-size:16px; padding-bottom:20px; color:#333; }
div.portfolio ul li div.portfolio_list div.info_area a.tag {font-size:14px; color:#f06e58; }

div.portfolio ul li.no_data{width:100%; text-align:center;}
div.portfolio ul li.no_data p{ padding:50px 10px 150px; text-align:center;color:#555;background:url("/img/mobile/sub/no_data.png") no-repeat 50% 100%;background-size:110px 125px;-webkit-background-size:110px 125px}

/* 블로그포스팅 */
div.blog_board_all {padding:20px 0; background:#fff;}
div.blog_board ul li {padding:10px 10px; border-top:1px #f6f6f6 solid;}
div.blog_board ul li:first-child {padding-top:0; border-top:0; }
div.blog_board ul li a {display:block; overflow:hidden; position:relative; height:90px; padding-left:100px;}
div.blog_board ul li a span.img {position:absolute; left:0; top:0; }
div.blog_board ul li a span.img img{width:90px; height:90px;}
div.blog_board ul li a strong {display:block; overflow:hidden; padding-bottom:4px; text-overflow:ellipsis; white-space:nowrap;}
div.blog_board ul li a span.text {display:block; padding-bottom:6px; font-size:12px; overflow:hidden; max-height:32px;}
div.blog_board ul li a span.date {display:block; font-size:12px; color:#888888;}

/* 쿠폰공지 */
div.coupon {margin-bottom:20px; background:#fff;}
div.coupon h4 {padding:10px; font-size:14px; border-bottom:4px solid #f6f6f6; color:#000;}
div.coupon > ul > li {border-bottom:1px solid #f6f6f6}
div.coupon_area a {display:block;padding:20px 10px;}
div.coupon_area div.coupon_info {position:relative;}
div.coupon_area div.coupon_info span.tit {display:block; margin-right:92px; font-size:16px; font-weight:bold; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}
div.coupon_area div.coupon_info span.btn_use {display:block; width:80px; height:24px; margin:10px 0 12px 0;  line-height:24px; font-size:14px; text-align:center; border:1px solid #f06e58; border-radius:24px; color:#f06e58}
div.coupon_area div.coupon_info span.benefit {display:block; position:absolute; top:0; right:0; width:80px; height:80px; line-height:80px; font-weight:bold;text-align:center;  box-sizing:border-box;border-radius:60px; background:#f06e58; color:#fff;}
div.coupon_area div.coupon_info span.benefit i  {display:block; padding-bottom:2px;}
div.coupon_area div.coupon_guide {font-size:12px; color:#888888}
div.coupon_area div.coupon_guide span {display:block;}
div.coupon_area div.coupon_guide ul {margin-top:6px;}
div.coupon_area div.coupon_guide ul li {padding-left:16px; background:url("/img/mobile/ico/ico_belit.png") 6px 6px no-repeat; background-size:3px;}

div.coupon_area.disable div.coupon_info span.btn_use {border-color:#999999; color:#999999; }
div.coupon_area.disable div.coupon_info span.benefit {background-color:#999999; }

div.coupon li.no_data p { padding:15px 10px; text-align:center;color:#888;}
div.coupon li.no_data p i {display:block; margin-bottom:10px; font-size:40px; color:#cccccc }


div.board {margin-bottom:20px; background:#fff;}
div.board h4 {padding:10px; font-size:14px; border-bottom:4px solid #f6f6f6; color:#000;}

div.board ul.board_list li button{ border-bottom:1px solid #f6f6f6; }
div.board ul.board_list {border-bottom:0;}

div.board ul li.on i {-webkit-transform: rotate(180deg);transform: rotate(180deg)}

div.board li.no_data p { padding:15px 10px; border-bottom:0; text-align:center;color:#888;}
div.board li.no_data p i {display:block; margin-bottom:10px; font-size:40px; color:#cccccc }
</style>

<div class="location">
	<h2><?=$sh_name?></h2>
	<button type="button" onclick="closeLayerPage('2')" class="location_prev"><i class="xi-angle-left"></i></button>

	<? if($is_user) { ?>
		<? if($chk_favorite) { ?>
		<button type="button" onclick="toggleFavoriteShop(this, '<?=$uid?>')" class="location_fav on"><i class="xi-star"></i></button>
		<? } else { ?>
		<button type="button" onclick="toggleFavoriteShop(this, '<?=$uid?>')" class="location_fav"><i class="xi-star"></i></button>
		<? } ?>
	<? } else { ?>
		<button type="button" class="location_fav btn_only_login"><i class="xi-star"></i></button>
	<? } ?>
</div>

<div class="tab">
	<ul id="shop_tab" class="tab_list tab_list05">
	<li class="on"><a href="../shop/ajax.view.html?sh_code=<?=$uid?>" class="btn_ajax" target="#container2">기본정보</a></li>
	<li><a href="../service/list.html?sh_code=<?=$uid?>" class="btn_ajax" target="#container2">서비스</a></li>
	<li><a href="../staff/list.html?sh_code=<?=$uid?>" class="btn_ajax" target="#container2">담당자</a></li>
	<li><a href="../notice/shop_list.html?sh_code=<?=$uid?>" class="go_hash btn_ajax" target="#container2">쿠폰/공지</a></li>
	<li><a href="../portfolio/shop_list.html?sh_code=<?=$uid?>" class="btn_ajax" target="#container2">포트폴리오</a></li>
	</ul>
</div>

<div id="container2" class="container">
	<? include_once(_MODULE_PATH_.'/shop/user/ajax.view.php'); ?>	
</div>

<div class="quick_menu">
	<div class="quick_menu_area">
		<ul class="quick_list quick_list03">
		<li><div><button type="button" onclick="openReserveLayer('<?=$uid?>')" class="btn_aqua_line btn_res">예약</button></div></li>
		<li><div><a href="../shop/map.html?sh_code=<?=$uid?>" class="btn_layer_page btn_aqua" target="#layer_page5">위치보기</a></div></li>
		<li><div><a href="tel:<?=$sh_tel?>" class="btn_orange">전화</a></div></li>
		</ul>
	</div>
	<div class="quick_menu_bg"></div>
</div>
       
