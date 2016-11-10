<?
if(!defined('_INPLUS_')) { exit; } 

/* portfolio */
if(!isset($oPortfolio)) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.user.class.php');
	$oPortfolio = new PortfolioUser();
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

if($sch_a_sh_code || $sch_a_st_id) {
	$view_file = 'shop_view.html';
	$layer_page_no = '5';
}
else {
	$view_file = 'view.html';
	$layer_page_no = '1';
}
for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>			
	<div class="portfolio_list">
		<a href="../portfolio/<?=$view_file?>?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page<?=$layer_page_no?>" title="포트폴리오">
			<div class="img_area">
				<? if ($list[$i]['main_img']['thumb'] == '') { ?>
				<img src="/img/mobile/common/img_noimg_296x196.gif" alt="이미지가 없습니다.">
				<? } else { ?>
				<img src="<?=$list[$i]['main_img']['thumb']?>" alt="<?=$item[$i]['pf_subject']?> thumbnail image" />
				<? } ?>
			</div>
			<div class="info_area">
				<span class="writer">by.<strong><?=$list[$i]['pf_name']?></strong></span>
				<span class="tit"><?=$list[$i]['pf_subject']?></span>
				<? if($list[$i]['pf_main_tag']) { ?>
				<span><a href="../portfolio/search_list.html?sch_type=pf_tags&sch_keyword=<?=$list[$i]['pf_main_tag']?>" class="tag">#<?=$list[$i]['pf_main_tag']?></a></span>
				<? } ?>
			</div>
		</a>
	</div>
</li>	
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">등록된 포트폴리오가 없습니다.</li>
<? } ?>