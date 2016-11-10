<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioUser();
$oPortfolio->init();

if($mode == 'like') {
	$result = $oPortfolio->likePortfolio($pf_id, $member['mb_id']);
}
else if($mode == 'dislike') {
	$result = $oPortfolio->dislikePortfolio($pf_id, $member['mb_id']);
}
else if($mode == 'insert_comment') {
	$result = $oPortfolio->insertComment();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');

	ob_start();
	include_once(_MODULE_PATH_.'/portfolio/user/ajax.comment_list.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();
}
else if($mode == 'delete_comment') {

	$result = $oPortfolio->deleteComment();

}

echo json_encode($result);
exit;
?>
