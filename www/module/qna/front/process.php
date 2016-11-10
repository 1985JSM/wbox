<?
if(!defined('_INPLUS_')) { exit; } 

$oQna = new QnaFront();
$oQna->init();

if($mode == 'insert') {
	$result = $oQna->insertData();

	$result['code'] = 'ok';
	echo json_encode($result);
	exit;
}
?>
