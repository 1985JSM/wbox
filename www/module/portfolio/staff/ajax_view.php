<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();

// thumb
$oPortfolio->set('flag_use_thumb', true);
$oPortfolio->set('thumb_width', '520');
$oPortfolio->set('thumb_width', '');

$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');
$data = $oPortfolio->selectDetail($uid);
?>
<div class="board_view">
	<h3><?=$data['pf_name']?></h3>
	<div class="img_area"><img src="<?=$data['thumb']?>" alt=""></div>
	<p class="txt">
	<?=nl2br($data['pf_content'])?>
	</p>
</div>

<ul class="layer_btn layer_btn2">
<li><div><a href="../portfolio/ajax_write.html?<?=$pk?>=<?=$uid?>" class="btn_ajax size_280x290 btn_orange" target="#layer_popup" title="포트폴리오 수정">수정</a></div></li>
<li><div><a href="../portfolio/process.html?mode=delete&<?=$pk?>=<?=$uid?>" class="btn_delete btn_gray">삭제</a></div></li>
</ul>
	