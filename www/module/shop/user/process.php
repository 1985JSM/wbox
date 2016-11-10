<?
if(!defined('_INPLUS_')) { exit; } 

$oShop = new ShopUser();
$oShop->init();

if($mode == 'like') {
	$result = $oShop->likeShop($sh_code, $like_type, $member['mb_id']);
}
else if($mode == 'dislike') {
	$result = $oShop->dislikeShop($sh_code, $like_type, $member['mb_id']);
}

echo json_encode($result);
exit;
?>
