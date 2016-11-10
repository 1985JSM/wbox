<?
if(!defined('_INPLUS_')) { exit; }
$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

if(!isset($oCustomer)) {
	include_once(_MODULE_PATH_ . '/customer/customer.manager.class.php');
	$oCustomer = new CustomerManager();
	$oCustomer->init();
}
/* list */
$list = $oCustomer->selectList();

// 필요한 정보만 보내기
$tmp_no = count($list);
if ($tmp_no > 0) {
	foreach ($list as $key => $value) {
		echo '<tr>';
		echo '<td><input id="" title="" type="checkbox"></td>';
		echo '<td>' . ($tmp_no - $key) . '</td>';
		echo '<td>' . $value['cs_name'] . '</td>';
		echo '<td>' . $value['txt_cs_gender'] . '</td>';
		if ($value['flag_receive_sms'] == 'Y') {
			$tmp_flag_receive_sms = '<span class="info">(수신)</span>';
		} else if ($value['flag_receive_sms'] == 'N') {
			$tmp_flag_receive_sms = '<span class="primary">(거부)</span>';
		} else {
			$tmp_flag_receive_sms = '<span>(미정)</span>';
		}
		echo '<td>' . $value['cs_hp'] . ' ' . $tmp_flag_receive_sms . '</span></td>';
		echo '<td>' . $value['txt_cs_level'] . '</td>';
		echo '<td>' . $value['txt_st_id'] . '</td>';
		echo '<td style="display: none;">'. $value['cs_id'] . '</td>';
	}
} else {
	echo '<tr><td colspan="7">검색결과가 없습니다.</td></tr>';
}

?>