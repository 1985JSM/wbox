<?
if(!defined('_INPLUS_')) { exit; } 

/* portfolio */
if(!isset($oPortfolio)) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.staff.class.php');
	$oPortfolio = new PortfolioStaff();
	$oPortfolio->init();
}
$oPortfolio->set('thumb_width', '320');
$oPortfolio->set('thumb_height', '190');

/* list */
$list = $oPortfolio->selectList();
$total_cnt = $oPortfolio->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oPortfolio->get('pk');

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
	include(_MODULE_PATH_.'/portfolio/staff/item.inc.php');	
} if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">등록된 포트폴리오가 없습니다.</li>
<? } ?>