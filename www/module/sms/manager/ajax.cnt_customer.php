<?
if(!defined('_INPLUS_')) { exit; }
$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oSms = new SmsManager();

$data = array();
if ($cnt_customer_mode == 'level') {
	$data = array(
		'sch_cs_level'=>$sch_cs_level
	);
} else if ($cnt_customer_mode == 'reservation') {
	$data = $chk_selected_num;
}

$result = $oSms->getCustomerCnt($cnt_customer_mode, $data);

echo json_encode($result);
?>