<?
if(!defined('_INPLUS_')) { exit; } 

$oAlliance = new AllianceFront();
$oAlliance->init();

if($mode == 'insert') {
	$result = $oAlliance->insertData();

	$result['code'] = 'ok';
	echo json_encode($result);
	exit;
}
?>
