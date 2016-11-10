<?
if(!defined('_INPLUS_')) { exit; } 

if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$staff_list = $oStaff->selectStaffByShopCode($member['sh_code']);
$flag_setted = false;
foreach($staff_list as $key => $val)  { 
	if(!$flag_setted && !$data['st_id']) { 
		$data['st_id'] = $st_id = $key; 
		$flag_setted = true;
	}
	?>
<option value="<?=$key?>"<? if($data['st_id'] == $key) { ?> selected="selected"<? } ?>><?=$val?></option>
<? } ?>

