<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioAdmin();
$oPortfolio->init();

if($mode == 'insert') {
	$result = $oPortfolio->insertData();
}
else if($mode == 'update') {
	$result = $oPortfolio->updateData();
}
else if($mode == 'delete') {
	$result = $oPortfolio->deleteData();
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
