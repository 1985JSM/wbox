<?
if(!isset($oShop)) {
	include_once(_MODULE_PATH_.'/shop/shop.user.class.php');
	$oShop = new ShopUser();
	$oShop->init();
}

$ck_lat = getCookieValue('ck_lat');
$ck_lng = getCookieValue('ck_lng');
if($ck_lat && $ck_lng) {
	/* list */
	$sch_distance = 5000;
	$oShop->set('sch_distance', $sch_distance);
	$oShop->set('cnt_rows', 1);
	$list = $oShop->selectList();
	$total_cnt = $oShop->get('total_cnt');
	?>주변 <i><?=($sch_distance/1000)?>km</i>이내에 <em><?=number_format($total_cnt)?>개</em> 제휴점이 있습니다.<? 
} else { ?>위치를 찾을 수 없습니다.<br>위치를 켜시면 주변 <i>5km</i>이내<br>매장을 찾을 수 있습니다.<? } ?>