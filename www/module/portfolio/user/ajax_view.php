<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioUser();
$oPortfolio->init();

// thumb
$oPortfolio->set('flag_use_thumb', true);
$oPortfolio->set('thumb_width', '520');
$oPortfolio->set('thumb_width', '');

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
	