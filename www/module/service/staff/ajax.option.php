<?
if(!defined('_INPLUS_')) { exit; } 

global $oService;
if(!isset($oService)) {
	include_once(_MODULE_PATH_.'/service/service.staff.class.php');
	$oService = new ServiceStaff();
	$oService->init();
}

$sv_list = $oService->selectServiceByStaffId($member['mb_id']);
?>
<option value="">서비스를 선택해주세요.</option>
<? foreach($sv_list as $key => $arr) { ?>
<option value="<?=$key?>"><?=$arr['sv_name']?></option>
<? } ?>
