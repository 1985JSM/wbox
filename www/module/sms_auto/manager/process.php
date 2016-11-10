<?
if(!defined('_INPLUS_')) { exit; }

$oSmsAuto = new SmsAutoManager($member['sh_code']);

$result = $oSmsAuto->updateData();
if ($result['code'] == 'update_ok') {
	alert('변경되었습니다', $result['url']);
	exit;
}

?>