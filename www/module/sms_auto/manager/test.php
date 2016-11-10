<?php
include_once(_MODULE_PATH_.'/sms_auto/sms_auto.class.php');
$oSmsAuto = new SmsAuto($member['sh_code']);
print_r($oSmsAuto->get('report_data'));

//print_r($oSms->enrollSms('completeReservationDefault', $data));




