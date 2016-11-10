<?
if(!defined('_INPLUS_')) { exit; }
$oSms = new SmsManager();

echo '<pre>';
$data = $oSms->getCustomerBy('staff');

foreach ($data as $key => $value) {
	echo $value['cs_name'] . '<br />';
}
echo '</pre>';
?>