<?
if(!defined('_INPLUS_')) { exit; } 

if(!isset($oService)) {
	include_once(_MODULE_PATH_.'/service/service.manager.class.php');
	$oService = new ServiceManager();
	$oService->init();
}

$sv_list = $oService->selectServiceByStaffId($st_id);
$flag_setted = false;
foreach($sv_list as $key => $arr)  { 
	if(!$flag_setted && !$data['sv_id']) { 
		$data['sv_id'] = $sv_id = $key; 
		$flag_setted = true;
	}
	?>
<option value="<?=$key?>"<? if($data['sv_id'] == $key) { ?> selected="selected"<? } ?>><?=$arr['sv_name']?></option>
<? } ?>

