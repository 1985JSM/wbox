<?
if(!defined('_INPLUS_')) { exit; } 

/* recommend */
if(!isset($oRecommend)) {
	include_once(_MODULE_PATH_.'/recommend/recommend.admin.class.php');
	$oRecommend = new RecommendAdmin();
	$oRecommend->init();
}
$rc_pk = $oRecommend->get('pk');
$rc_id = $oRecommend->get('uid');
$sh_code_arr = $oRecommend->selectShopCodeArray($uid);

/* shop */
if(!isset($oShop)) {
	include_once(_MODULE_PATH_.'/shop/shop.admin.class.php');
	$oShop = new ShopAdmin();
	$oShop->init();
}

$oShop->set('list_mode', 'recommend');
$oShop->set('cnt_rows', 9999);
$oShop->set('sh_code_arr', $sh_code_arr);

/* list */
$sh_list = $oShop->selectList();
$sh_pk = $oShop->get('pk');

for($i = 0 ; $i < sizeof($sh_list) ; $i++) { ?>
<tr>
	<td><?=number_format($i+1)?></td>
	<td><?=$sh_list[$i]['sh_name']?></td>
	<td><a href="../recommend/process.html?mode=delete_shop&<?=$rc_pk?>=<?=$rc_id?>&sh_code=<?=$sh_list[$i][$sh_pk]?>" class="btn_ajax sButton tiny" target="#shop_tbody">삭제</a></td>
</tr>
<? } if(sizeof($sh_list) == 0) { printNoData(3, '추천 가맹점이 없습니다.'); } ?>