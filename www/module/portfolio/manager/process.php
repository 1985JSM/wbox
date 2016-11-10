<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioManager();
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
else if($mode == 'insert_comment') {
	$result = $oPortfolio->insertComment();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');
	$page = $oPortfolio->get('page');
	$query_string = $oPortfolio->get('query_string');

	$result['code'] = 'insert_ok';
	$result['url'] = './view.html?'.$pk.'='.$uid.'&page='.$page.$query_string;
}
else if($mode == 'reply_comment') {
	$result = $oPortfolio->replyComment();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');
	$page = $oPortfolio->get('page');
	$query_string = $oPortfolio->get('query_string');

	$result['code'] = 'insert_ok';
	$result['url'] = './view.html?'.$pk.'='.$uid.'&page='.$page.$query_string;
}
else if($mode == 'delete_comment') {
	$result = $oPortfolio->deleteComment();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');
	$page = $oPortfolio->get('page');
	$query_string = $oPortfolio->get('query_string');

	$result['code'] = 'delete_ok';
	$result['url'] = './view.html?'.$pk.'='.$uid.'&page='.$page.$query_string;
}
else if($mode == 'delete_reply') {
	$result = $oPortfolio->deleteReply();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');
	$page = $oPortfolio->get('page');
	$query_string = $oPortfolio->get('query_string');

	$result['code'] = 'delete_ok';
	$result['url'] = './view.html?'.$pk.'='.$uid.'&page='.$page.$query_string;
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
