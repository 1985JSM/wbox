<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();

if($mode == 'insert') {
	$result = $oPortfolio->insertData();
	$pk =$oPortfolio->get('pk');
	$uid = $result[$pk];
	$item = $oPortfolio->selectDetail($uid);

	movePage('./list.html');
	exit;

	ob_start();
	include_once(_MODULE_PATH_.'/portfolio/staff/item.inc.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();
}
else if($mode == 'update') {
	$result = $oPortfolio->updateData();

	$pk =$oPortfolio->get('pk');
	$uid = $result[$pk];
	$item = $oPortfolio->selectDetail($uid);

	movePage('./list.html');
	exit;

	ob_start();
	include_once(_MODULE_PATH_.'/portfolio/staff/item.inc.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();
}
else if($mode == 'delete') {
	$result = $oPortfolio->deleteData();
	movePage($result['url']);
	exit;
}
else if($mode == 'insert_comment') {
	$result = $oPortfolio->insertComment();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');

	ob_start();
	include_once(_MODULE_PATH_.'/portfolio/staff/ajax.comment_list.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();
}
else if($mode == 'delete_comment') {

	$result = $oPortfolio->deleteComment();
}
else if($mode == 'reply_comment') {
	$result = $oPortfolio->replyComment();

	$comment_pk = $oPortfolio->get('comment_pk');
	$cm_id = ($_POST[$comment_pk]) ? $_POST[$comment_pk] : $_GET[$comment_pk];
	$result[$comment_pk] = $cm_id;

	ob_start();

	$item = $oPortfolio->selectCommentDetail($cm_id);
	include_once(_MODULE_PATH_.'/portfolio/staff/comment_item.inc.php');

	$result['content'] = ob_get_contents();
	ob_end_clean();	
}
else if($mode == 'delete_reply') {
	$result = $oPortfolio->deleteReply();	

	$result['code'] = 'ok';
}

echo json_encode($result);
exit;
/*
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
*/
?>
