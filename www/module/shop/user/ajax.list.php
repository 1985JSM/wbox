<?
if(!defined('_INPLUS_')) { exit; } 

if(!isset($oShop)) {
	$oShop = new ShopUser();
	$oShop->init();
}

/* list */
$oShop->set('list_mode', $list_mode);
if($list_mode == 'recommend') {
	// 추천샵	
	$oShop->set('sh_code_arr', $sh_code_arr);
}

$list = $oShop->selectList();
$total_cnt = $oShop->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oShop->get('pk');

if($this_cnt == 0) {
	$next_page = 0;
}
else {
	$next_page = $page + 1;
}

$json_etc = array(
	'total_cnt'	=> $total_cnt,
	'this_cnt'	=> $this_cnt,
	'next_page'	=> $next_page
);

for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>
	<div>
		<a href="../shop/view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page2">
			<div class="img_area"><?if ($list[$i]['main_img']['thumb'] == '') {?><img src="http://wbox.inplus21.com/img/mobile/common/img_noimg_296x196.gif" alt="이미지가 없습니다."><? } else { ?><img src="<?=$list[$i]['main_img']['thumb']?>" alt=""><? } ?></div>
			<div class="info_area">
				<ul>
				<li class="tit"><?=$list[$i]['sh_name']?></li>
				<li class="addr"><?=$list[$i]['txt_addr']?></li>
				<li class="time"><i class="xi-time"></i> <?=$list[$i]['txt_work_time']?></li>
				</ul>
			</div>
		</a>
		<ul class="shop_list_btn">
		<li><button type="button" onclick="openReserveLayer('<?=$list[$i][$pk]?>')" class="ico_res"><i class="xi-calendar-add"></i><span class="hidden">예약하기</span></button></li>
		<li><a href="tel:<?=$list[$i]['sh_tel']?>" class="ico_tel"><i class="xi-phone"></i><span class="hidden">전화걸기</span></a></li>
		</ul>
	</div>
</li>		
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p>매장이 없습니다.</p>
</li>
<? } ?>