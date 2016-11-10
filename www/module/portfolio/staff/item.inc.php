<?
if(!defined('_INPLUS_')) { exit; } 

if(!$oPortfolio) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.staff.class.php');
	$oPortfolio = new PortfolioStaff();
	$oPortfolio->init();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');
}
?>
<li class="pf_id_<?=$item[$pk]?>">			
	<div class="portfolio_list">
		<a href="../portfolio/view.html?<?=$pk?>=<?=$item[$pk]?>" class="btn_layer_page" target="#layer_page1" title="포트폴리오">
			<div class="img_area">
				<? if ($item['main_img']['thumb'] == '') { ?>
				<img src="http://wbox.inplus21.com/img/mobile/common/img_noimg_296x196.gif" alt="이미지가 없습니다.">
				<? } else { ?>
				<img src="<?=$item['main_img']['thumb']?>" alt="<?=$item['pf_subject']?> thumbnail image" />
				<? } ?>
			</div>
			<div class="info_area">
				<span class="writer">by.<strong><?=$item['pf_name']?></strong></span>
				<span class="tit"><?=$item['pf_subject']?></span>
				<? if($item['pf_main_tag']) { ?>
				<span class="tag">#<?=$item['pf_main_tag']?></span>
				<? } ?>
			</div>
		</a>
	</div>
</li>	

