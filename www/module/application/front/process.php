<?
if(!defined('_INPLUS_')) { exit; } 

$oApplication = new ApplicationFront();
$oApplication->init();

if($mode == 'insert') {
	// 가맹점 등록
	$result = $oApplication->insertData();

	ob_start();
	include_once(_MODULE_PATH_.'/application/front/result.php');
	$content = ob_get_contents();
	ob_end_clean();
	$result['code'] = 'ok';
	$result['content'] = $content;
	echo json_encode($result);
	exit;
}
?>
