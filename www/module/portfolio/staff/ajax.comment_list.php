<?
if(!defined('_INPLUS_')) { exit; } 

if(!$oPortfolio) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.staff.class.php');
	$oPortfolio = new PortfolioStaff();
	$oPortfolio->init();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');
}

if(!$page) { $page = '1'; }

$oPortfolio->set('thumb_width', '120');
$oPortfolio->set('thumb_height', '120');
$list = $oPortfolio->selectCommentList($uid, $page);
$total_cnt = $oPortfolio->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oPortfolio->get('pk');

$comment_pk = $oPortfolio->get('comment_pk');

if($this_cnt == 0) {
	$next_page = 0;
}
else {
	$next_page = $page + 1;
}

$json_etc = array(
	'total_cnt'	=> $total_cnt,
	'this_cnt'	=> $this_cnt,
	'next_page'	=> $next_page
);

for($i = 0 ; $i < sizeof($list) ; $i++) { 
	$item = $list[$i];
	include(_MODULE_PATH_.'/portfolio/staff/comment_item.inc.php');	
} if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p>등록된 댓글이 없습니다.</p>
</li>	            
<? } ?>