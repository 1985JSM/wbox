<?
if(!defined('_INPLUS_')) { exit; } 

global $oService;
if(!isset($oService)) {
	include_once(_MODULE_PATH_.'/service/service.user.class.php');
	$oService = new ServiceUser();
	$oService->init();
}

if($st_id) {
	$sv_list = $oService->selectServiceByStaffId($st_id);
}
else if($sh_code) {
	$sv_list = $oService->selectServiceByShopCode($sh_code);
}

foreach($sv_list as $key => $arr) { ?>
<li>
	<button type="button" onclick="chooseService(this)">
		<em><?=$arr['sv_name']?> (<?=$arr['sv_time']?>분)</em>
		<div class="txt">일반가 <span class="price01"><?=number_format($arr['sv_normal_price'])?></span>원<br>회원가 <span class="price02"><?=number_format($arr['sv_sale_price'])?></span>원</div>
	</button>
	<input type="hidden" class="sv_id" value="<?=$key?>" />
	<input type="hidden" class="sv_name" value="<?=$arr['sv_name']?> (<?=$arr['sv_time']?>분)" />
	<input type="hidden" class="sv_time" value="<?=$arr['sv_time']?>" />
	<input type="hidden" class="sv_normal_price" value="<?=$arr['sv_normal_price']?>" />
	<input type="hidden" class="sv_sale_price" value="<?=$arr['sv_sale_price']?>" />
</li>
<? } ?> 