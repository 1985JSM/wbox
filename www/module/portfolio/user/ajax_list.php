<?
if(!isset($oPortfolio)) {
	$oPortfolio = new PortfolioUser();
	$oPortfolio->init();
}

/* list */
$list = $oPortfolio->selectList();
$thumb_width = $oPortfolio->get('thumb_width');
$thumb_height = $oPortfolio->get('thumb_height');
$total_cnt = $oPortfolio->get('total_cnt');
$pk = $oPortfolio->get('pk');
$query_string = $oPortfolio->get('query_string');

for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>
	<div>
		<a href="../portfolio/ajax_view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_280x435" target="#layer_popup" title="<?=$list[$i]['pf_subject']?>">
			<div class="img_area"><img src="<?=$list[$i]['thumb']?>" alt=""></div>
			<div class="info_area">
				<span class="tit"><?=$list[$i]['pf_subject']?></span>
				<span class="txt"><?=$list[$i]['pf_name']?></span>
			</div>
		</a>
	</div>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p>등록된 이미지가 없습니다.</p>
</li>
<? } ?>