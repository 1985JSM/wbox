<?
if(!defined('_INPLUS_')) { exit; } 

global $oStaff;
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.user.class.php');
	$oStaff = new StaffUser();
	$oStaff->init();
}

if($reserve_type == 'staff') {
	$st_list = $oStaff->selectStaffByShopCode($sh_code);
}
else if($reserve_type == 'service') {
	$sv_id_arr = $sv_id;
	$st_list = $oStaff->selectStaffByShopCode($sh_code, $sv_id_arr);
}
?>
<option value="">담당자를 선택해주세요.</option>
<? foreach($st_list as $key => $val) { ?>
<option value="<?=$key?>"<? if($key == $st_id) { ?> selected="selected"<? } ?>><?=$val?></option>
<? } ?>      