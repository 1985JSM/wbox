<?
if(!defined('_INPLUS_')) { exit; } 

if(!isset($oShop)) {
	include_once(_MODULE_PATH_.'/shop/shop.user.class.php');
	$oShop = new ShopUser();
	$oShop->init();
}
$sigungu_arr = $oShop->countBySingungu($sch_sh_sido);
?>
<? foreach($sigungu_arr as $key => $val) { ?>
<li><a href="../shop/area_list.html?sch_sh_sido=<?=$sch_sh_sido?><? if($key != '전체보기') { ?>&sch_sh_sigungu=<?=$key?><? } ?>"><?=$key?><span class="tot"><?=number_format($val)?></span><i class="fa fa-angle-right"></i></a></li>
<? } ?>