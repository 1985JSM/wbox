<?
if(!defined('_INPLUS_')) { exit; } 

global $oService;
if(!isset($oService)) {
	include_once(_MODULE_PATH_.'/service/service.user.class.php');
	$oService = new ServiceUser();
	$oService->init();
}

if($reserve_type == 'staff') {
	$sv_list = $oService->selectServiceByStaffId($st_id);
}
else if($reserve_type == 'service') {
	$sv_list = $oService->selectServiceByShopCode($sh_code);
}

// 서비스시간 : $arr['sv_time']
// 서비스가격 : $arr['sv_sale_price']
?>
<option value="">서비스를 선택해주세요.</option>
<? foreach($sv_list as $key => $arr) { ?>
<option value="<?=$key?>"><?=$arr['sv_name']?></option>
<? } ?>
