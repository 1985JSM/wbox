<?
if(!defined('_INPLUS_')) { exit; } 

if(!isset($oService)) {
	include_once(_MODULE_PATH_.'/service/service.manager.class.php');
	$oService = new ServiceManager();
	$oService->init();
}

$sv_list = $oService->selectServiceByStaffId($st_id);
?>
<option value="">서비스를 선택해주세요.</option>
<? foreach($sv_list as $key => $arr) { ?>
<option value="<?=$key?>"><?=$arr['sv_name']?></option>
<? } ?>
