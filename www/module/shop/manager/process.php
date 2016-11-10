<?
if(!defined('_INPLUS_')) { exit; } 

$oShop = new ShopManager();
$oShop->init();

if($mode == 'update') {	
	$result = $oShop->updateData();
}
else if($mode == 'select_sigungu') {
	// 시/군/구
	$sh_sido = urldecode($sh_sido);
	$result = $oShop->selectShopSigungu($sh_sido);	
	echo $result['content'];
}
else if($mode == 'select_dong') {
	// 읍/면/동
	$sh_sido = urldecode($sh_sido);
	$sh_sigungu = urldecode($sh_sigungu);

	echo "sh_sido : $sh_sido\n";
	echo "sh_sigungu : $sh_sigungu\n";
	$result = $oShop->selectShopDong($sh_sido, $sh_sigungu);	
	echo $result['content'];
}


if($result['url']) {
	if($result['msg']) { alert($result['msg'], $result['url']); }
	else if($result['code']) { alertCode($result['code'], $result['url']); }
	else { movePage($result['url']); }
	exit;
}

if($result['msg']) {
	alert($result['msg']);
	exit;
}
?>
