<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

/* shop */
$oShop = new ShopFront();
$oShop->init();

$pk = $oShop->get('pk');
$uid = $oShop->get('uid');

// thumb
$oShop->set('thumb_width', '640');
$oShop->set('thumb_height', '380');

// data
$data = $oShop->selectDetail($uid);
$main_img = $data['main_img'];
$sub_img = $data['sub_img'];

// like
$like_type_arr = $oShop->get('like_type_arr');
unset($flag_like);
unset($cnt_like);
foreach($like_type_arr as $key => $val) {
	$cnt_like[$key] = $oShop->countLike($uid, $key);
}

/* favorite */
if(!isset($oFavorite)) {
	include_once(_MODULE_PATH_.'/favorite/favorite.class.php');
	$oFavorite = new Favorite();
	$oFavorite->init();
}
$cnt_favorite = $oFavorite->countByShopCode($uid);

/* reserve */
if(!isset($oReserve)) {
	include_once(_MODULE_PATH_.'/reserve/reserve.class.php');
	$oReserve = new Reserve();
	$oReserve->init();
}
$cnt_reserve = $oReserve->countByShopCode($uid);

/* staff */
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.front.class.php');
	$oStaff = new StaffFront();
	$oStaff->init();
}

$st_pk = $oStaff->get('pk');

// search
$oStaff->set('cnt_rows', 3);
$oStaff->set('sch_a_sh_code', $uid);

// thumb
$oStaff->set('flag_use_thumb', true);
$oStaff->set('thumb_width', '162');
$oStaff->set('thumb_height', '162');

$st_list = $oStaff->selectList();
$cnt_staff = $oStaff->get('total_cnt');

/* service */
if(!isset($oService)) {
	include_once(_MODULE_PATH_.'/service/service.front.class.php');
	$oService = new ServiceFront();
	$oService->init();
}
$oService->set('cnt_rows', 6);
$oService->set('sch_sh_code', $uid);
$oService->set('sch_sh_code', $uid);
$sv_list = $oService->selectList();

/* portfolio */
if(!isset($oPortfolio)) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.front.class.php');
	$oPortfolio = new PortfolioFront();
	$oPortfolio->init();
}
$pf_pk = $oPortfolio->get('pk');
$oPortfolio->set('cnt_rows', 8);
$oPortfolio->set('sch_a_sh_code', $uid);
$pf_list = $oPortfolio->selectList();
$pf_total_cnt = $oPortfolio->get('total_cnt');
if(sizeof($pf_list) == 0) { $portfolio_width = '100%'; }
else { $portfolio_width = (95 * sizeof($pf_list)).'px'; }

/* 디바이스 체크 */
$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($user_agent, 'android') > -1) {
	$is_android = true;
}
else if(strpos($user_agent, 'ipod') > -1 || strpos($user_agent, 'iphone') > -1 || strpos($user_agent, 'ipad') > -1) {
	$is_ios = true;
}
?>
<!doctype html>
<html lang="ko" xml:lang="ko">
<head>
<meta charset="utf-8">
<title><?=$data['sh_name']?> :: 예약박스</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
<meta name="format-detection" content="telephone=no" />
<meta http-equiv="x-rim-auto-match" content="none">

<meta property="og:type" content="website" />
<meta property="og:title" content="<?=$data['sh_name']?> :: 예약박스" />
<meta property="og:description" content="모든 게 가능한 APP 서비스 예약 박스-영화예매보다 쉽고 빠른 예약" />
<meta property="og:image" content="<?=$main_img['thumb']?>" /> 

<link rel="stylesheet" type="text/css" href="http://wbox.inplus21.com/share/css-mobile/styles.css">
<link rel="stylesheet" type="text/css" href="http://wbox.inplus21.com/webuser/page/style.css" />

<script type="text/javascript" src="/share/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/share/js/inplus.util.js"></script>
<script type="text/javascript" src="/share/js/inplus.validate.js"></script>
<script type="text/javascript" src="/share/js/base64.js"></script>
<script type="text/javascript" src="/share/js/md5.js"></script>
<script type="text/javascript" src="/share/js/inplus.cookie.js"></script>
<script type="text/javascript" src="/share/js/inplus.msg.js"></script>
<script type="text/javascript" src="http://wbox.inplus21.com/share/js-mobile/slick.js"></script>
<script type="text/javascript" src="http://wbox.inplus21.com/share/js-mobile/comm.js"></script>
<script type="text/javascript" src="http://apis.daum.net/maps/maps3.js?apikey=33824d6f9bd45f02e95641e682be0335"></script>

<style type="text/css">
div.view_detail{background:#f6f6f6; padding-bottom:0;}
/* 기본정보 */
div.view_detai_img {position:relative; padding-top:60%; overflow:hidden;}
div.view_detai_img  div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.view_detai_img  div.img_area img {top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}
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

/* 지도 */
div.view_detail_address {background:#fff; position:relative; padding:20px 10px}
div.view_detail_address h4{color:#333;font-weight:bold; margin-bottom:15px}
div.view_detail_address div.img_address {background:#000; height:300px;}

/* 퀵메뉴 */
div.quick_menu{bottom:0;}


</style>
<script type="text/javascript">
$(document).ready(function() {
	// 메인배너
	$("#img_area > div.img_area").slick({
		arrows: true,
		infinite: true,
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4000
	});

	var map_container = document.getElementById("map_area");	
	var map_options = {
		center	: new daum.maps.LatLng("<?=$data['sh_lat']?>", "<?=$data['sh_lng']?>"),	// 중심 좌표
		level	: 3	// 확대 레벨
	};
	
	var map = new daum.maps.Map(map_container, map_options);

	// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
	var map_type_control = new daum.maps.MapTypeControl();

	// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
	// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
	map.addControl(map_type_control, daum.maps.ControlPosition.TOPRIGHT);

	// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
	var zoom_control = new daum.maps.ZoomControl();
	map.addControl(zoom_control, daum.maps.ControlPosition.RIGHT);

	// 마커가 표시될 위치입니다 
	var marker_position  = new daum.maps.LatLng("<?=$data['sh_lat']?>", "<?=$data['sh_lng']?>"); 

	// 마커를 생성합니다
	var marker = new daum.maps.Marker({
		position	: marker_position
	});

	// 마커가 지도 위에 표시되도록 설정합니다
	marker.setMap(map);
});
</script>
</head>
<body>
<div class="container">
	<div class="location">
		<h2><?=$data['sh_name']?></h2>
	</div>

	<div class="view_detail">
		<!-- view_detail_info -->
		<div class="view_detail_info">

			<div id="img_area" class="view_detai_img">
				<div class="img_area">
					<div><img src="<?=$main_img['thumb']?>" alt="<?=$data['sh_name']?> 대표이미지" /></div>
					<? for($i = 0; $i < sizeof($sub_img) ; $i++) { ?>
					<div><img src="<?=$sub_img[$i]['thumb']?>" alt="<?=$data['sh_name']?> 서브이미지 <?=$i+1?>" /></div>
					<? } ?>
				</div>
			</div>

			<div class="tit_info">
				<h3><?=$data['sh_name']?></h3>
				<ul>
				<li>예약 <strong><?=number_format($cnt_reserve)?></strong></li>
				<li>즐겨찾기 <strong><?=number_format($cnt_favorite)?></strong></li>
				</ul>			
			</div>

			<div class="detail_caption">
				<ul>
				<li class="info"><em>매장소개</em><span ><?=getWithoutNull($data['sh_memo'])?></span></li>
				<li><em>영업시간</em><?=$data['txt_work_time']?></li>
				<li class="add_info"><em>위치안내</em><span class="col_aqua"><?=$data['txt_addr']?></span></li>
				<li><em>휴무일</em><?=$data['sh_holiday']?></li>
				<li><em>예약취소</em>취소(변경)시 <span class="col_orange"><?=$data['txt_modify_time']?> 전</span>까지 가능</li>
				<li><em>연락처</em><a href="tel:<?=$data['sh_tel']?>" class="col_orange"><?=$data['sh_tel']?></a></li>
				</ul>
			</div>
		</div>
		<!-- //view_detail_info -->
		
		<div class="view_detail_item">
			<h4>담당자정보<span class="col_orange"><?=number_format($cnt_staff)?></span></h4>		
			<ul class="img_list">
			<? for($i = 0 ; $i < sizeof($st_list) ; $i++) { ?>
			<li><div><span class="img_area"><img src="<?=$st_list[$i]['thumb']?>" alt=""></span><?=$st_list[$i]['txt_staff']?></div></li>
			<? } ?>
			</ul>
		</div>
		
		<div class="view_detail_item">
			<h4>서비스안내</h4>
			<ul class="btn_list_orange">
			<? for($i = 0 ; $i < sizeof($sv_list) ; $i++) { ?>
			<li><div><span><?=$sv_list[$i]['sv_name']?></span></div></li>
			<? } ?>
			</ul>
		</div>
		
		<div class="view_detail_item">
			<h4>포트폴리오<span class="col_orange"><?=number_format($pf_total_cnt)?></span></h4>		
			<div class="img_area_scroll">
				<ul class="img_list2" style="width:475px">
				<? for($i = 0 ; $i < sizeof($pf_list) ; $i++) { ?>
				<li><div><img src="<?=$pf_list[$i]['main_img']['thumb']?>" alt="<?=$pf_list[$i]['pf_subject']?> thumbnail image"></div></li>
				<? } if(sizeof($pf_list) == 0) { ?>
				<li class="no_data">
					<p>등록된 포트폴리오가 없습니다.</p>
				</li>
				<? } ?>
				</ul>
			</div>
		</div>
		
		<div class="view_detail_address">
			<h4>위치보기</h4>		
			<div id="map_area" class="img_address">
				지도 영역
			</div>
		</div>
	</div>	
	<!-- //view_detail-->

	<? if($is_android) { ?>
	<div class="quick_menu">
		<div class="quick_menu_area">
			<ul class="quick_list quick_list01">
			<li><div><a href="market://details?id=com.inplusweb.wbox" class="btn_aqua_line">예약박스 다운로드</a></div></li>
			</ul>
		</div>
		<div class="quick_menu_bg"></div>
	</div>
	<? } else if(!$is_ios) { ?>
	<div class="quick_menu">
		<div class="quick_menu_area">
			<ul class="quick_list quick_list01">
			<li><div><a href="https://play.google.com/store/apps/details?id=com.inplusweb.wbox" class="btn_aqua_line">예약박스 플레이스토어</a></div></li>
			</ul>
		</div>
		<div class="quick_menu_bg"></div>
	</div>
	<? } ?>
</div>
<!--
상점명 : <?=$data['sh_name']?><br />
[<a href="market://details?id=com.inplusweb.wbox">다운로드</a>]
-->
</body>
</html>