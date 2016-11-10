<?
if(!defined('_INPLUS_')) { exit; } 

$oCoupon = new CouponUser();
$oCoupon->init();

if($mode == 'use_coupon') {

	$uid = $oCoupon->get('uid');
	
	$result = $oCoupon->useCoupon($uid, $member['mb_id']);

	ob_start();
	include_once(_MODULE_PATH_.'/coupon/user/view.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();
}

echo json_encode($result);
exit;
?>
