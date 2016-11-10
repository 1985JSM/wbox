<?
if(!defined('_INPLUS_')) { exit; } 

$oPage = new PageFront();
$oPage->init();

if($mode == 'select_sigungu') {
	// 시/군/구
	$sido = urldecode($sido);
	$result = $oPage->selectSigungu($sido);	
	echo $result['content'];
}
else if($mode == 'select_dong') {
	// 읍/면/동
	$sido = urldecode($sido);
	$sigungu = urldecode($sigungu);
	$result = $oPage->selectDong($sido, $sigungu);	
	echo $result['content'];
}
?>
