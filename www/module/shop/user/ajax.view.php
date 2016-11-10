<?
if(!defined('_INPLUS_')) { exit; } 

if(!isset($oShop)) {
	$oShop = new ShopUser();
	$oShop->init();
}
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
	$flag_like[$key] = $oShop->checkFlagLike($uid, $key, $member['mb_id']);
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
	include_once(_MODULE_PATH_.'/staff/staff.user.class.php');
	$oStaff = new StaffUser();
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
	include_once(_MODULE_PATH_.'/service/service.user.class.php');
	$oService = new ServiceUser();
	$oService->init();
}
$oService->set('cnt_rows', 6);
$oService->set('sch_sh_code', $uid);
$oService->set('sch_sh_code', $uid);
$sv_list = $oService->selectList();

/* portfolio */
if(!isset($oPortfolio)) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.user.class.php');
	$oPortfolio = new PortfolioUser();
	$oPortfolio->init();
}
$pf_pk = $oPortfolio->get('pk');
$oPortfolio->set('cnt_rows', 8);
$oPortfolio->set('sch_a_sh_code', $uid);
$pf_list = $oPortfolio->selectList();
$pf_total_cnt = $oPortfolio->get('total_cnt');
if(sizeof($pf_list) == 0) { $portfolio_width = '100%'; }
else { $portfolio_width = (95 * sizeof($pf_list)).'px'; }

/* blog */
if(!isset($oBlog)) {
	include_once(_MODULE_PATH_.'/blog/blog.user.class.php');
	$oBlog = new BlogUser();
	$oBlog->init();
}
$oBlog->set('sch_sh_code', $sh_code);
$oBlog->set('cnt_rows', 2);

/*
for($i = 0 ; $i < 100 ; $i++) {
	$arr = array(
		'bl_type'	=> 'M',
		'sh_code'	=> $sh_code,
		'bl_subject' => '페이지네이션 테스트'.$i,
		'bl_content'	=> '테스트'
	);

	dbInsertByArray("tbl_blog", $arr);
}
*/
?>
<script type="text/javascript">
$(document).ready(function() {

	// 가맹점 탭 변경
	$("#shop_tab > li").not(":eq(0)").removeClass("on").end().eq(0).addClass("on");

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
});
</script>

<div class="view_detail">
	<div class="view_detail_info">

		<div id="img_area" class="view_detai_img">
			<div class="img_area">
				<div><? if ($main_img['thumb'] == '') { ?><img src="/img/mobile/common/img_noimg_640x360.gif" alt="이미지가 없습니다."><? } else { ?><img src="<?=$main_img['thumb']?>" alt="<?=$data['sh_name']?> 대표이미지" /><? } ?></div>
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
			<button class="btn_share" onclick="shareBySend('<?=$data['send_info']?>')"><i class="xi-share-alt"></i></button>
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
	<div class="view_detail_item">
		<h4>담당자정보<span class="col_orange"><?=number_format($cnt_staff)?></span></h4>
		<a href="../staff/list.html?sh_code=<?=$uid?>" class="btn_ajax view_more" target="#container2">더보기 <i class="xi-angle-right"></i></a>
		<ul class="img_list">
		<? for($i = 0 ; $i < sizeof($st_list) ; $i++) { ?>
		<li><div><a href="../staff/view.html?<?=$st_pk?>=<?=$st_list[$i][$st_pk]?>" class="btn_layer_page" target="#layer_page3"><span class="img_area"><img src="<?if($st_list[$i]['thumb']==''){?>/img/mobile/common/s_logo2.png<?} else {?><?=$st_list[$i]['thumb']?><?}?>" alt=""></span><?=$st_list[$i]['txt_staff']?></a></div></li>
		<? } ?>
		</ul>
	</div>
	
	<div class="view_detail_item">
		<h4>서비스안내</h4>
		<a href="../service/list.html?sh_code=<?=$uid?>" class="btn_ajax view_more" target="#container2">전체보기 <i class="xi-angle-right"></i></a>
		<ul class="btn_list_orange">
		<? for($i = 0 ; $i < sizeof($sv_list) ; $i++) { ?>
		<li><div><span><?=$sv_list[$i]['sv_name']?></span></div></li>
		<? } ?>
		</ul>
	</div>
	
	<div class="view_detail_item">
		<h4>포트폴리오<span class="col_orange"><?=number_format($pf_total_cnt)?></span></h4>
		<a href="../portfolio/shop_list.html?sh_code=<?=$uid?>" class="btn_ajax view_more" target="#container2">전체보기 <i class="xi-angle-right"></i></a>
		<div class="img_area_scroll">
			<ul class="img_list2" style="width:<?=$portfolio_width?>">
			<? for($i = 0 ; $i < sizeof($pf_list) ; $i++) { ?>
			<li><div><a href="../portfolio/shop_view.html?<?=$pf_pk?>=<?=$pf_list[$i][$pf_pk]?>" class="btn_layer_page" target="#layer_page5" title="<?=$pf_list[$i]['pf_subject']?>"><img src="<?if($pf_list[$i]['main_img']['thumb'] == ''){?>/img/mobile/common/s_logo2.png<?}else{?><?=$pf_list[$i]['main_img']['thumb']?><?}?>" alt="<?=$pf_list[$i]['pf_subject']?> thumbnail image"></a></div></li>
			<? } if(sizeof($pf_list) == 0) { ?>
			<li class="no_data">
				<p>등록된 포트폴리오가 없습니다.</p>
			</li>
			<? } ?>
			</ul>
		</div>
	</div>
	<div class="view_detail_review" id="review">
		<h4>느낌공유</h4>
		<ul class="review_info">
		<? foreach($like_type_arr as $key => $val) { ?>
		<li>
			<div>
				<button type="button" <? if($is_user) { ?>onclick="toggleShopLike(this, '<?=$sh_code?>', '<?=$key?>')"<? } ?> class="<? if(!$is_user) { ?>btn_only_login<? } ?> <? if($flag_like[$key]) { ?>on<? } ?>"><em class="ico0<?=$key?>"><?=$val?></em><span id="cnt_shop_like_<?=$key?>" class="rep"><?=number_format($cnt_like[$key])?></span></button>
			</div>
		</li>
		<? } ?>
		</ul>				
	</div>
	<!-- //view_detail_review -->

	<div class="blog_review ">
		<h4>블로그리뷰</h4>
		<a href="../blog/list.html?sh_code=<?=$uid?>" class="btn_layer_page view_more" target="#layer_page3">전체보기 <i class="xi-angle-right"></i></a>
		<div class="blog_board">
			<ul>
			<?
			include_once(_MODULE_PATH_.'/blog/user/ajax.list.php'); ?>
			</ul>
		</div>
	</div>

</div>