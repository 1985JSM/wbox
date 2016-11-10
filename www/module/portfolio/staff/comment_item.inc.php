<?
if(!defined('_INPLUS_')) { exit; } 

if(!$oPortfolio) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.staff.class.php');
	$oPortfolio = new PortfolioStaff();
	$oPortfolio->init();

	$pk = $oPortfolio->get('pk');
	$uid = $oPortfolio->get('uid');

	$comment_pk = $oPortfolio->get('comment_pk');
}

?>

<li class="cm_id_<?=$item[$comment_pk]?>">
	<div class="img_area"><img src="<?=$item['profile_img']['thumb']?>" alt="profile image" ></div>
	<em><?=$item['cm_name']?></em>
	<span class="date"><i class="xi-time"></i> <?=$item['reg_date']?></span>
	<span class="txt"><?=nl2br($item['cm_content'])?></span>



	<? if($item['flag_reply']) { ?><a href="../portfolio/reply_comment.html?<?=$comment_pk?>=<?=$item[$comment_pk]?>" class="btn_layer_page btn_gray_line_s reply" target="#layer_page6">답변</a><? } ?>
	<? if($item['flag_delete']) { ?><button type="button" onclick="deletePortfolioComment(this, '<?=$item[$comment_pk]?>')" class="btn_gray_line_s">삭제</button><? } ?>

	<? if($item['re_id'] && $item['re_content']) { ?>
	<div class="rep_area">
		<strong><i class="xi-comments"></i> <?=$item['re_name']?></strong>
		<span class="rep_txt"><?=nl2br($item['re_content'])?></span>
		<span class="rep_data"><i class="xi-time"></i> <?=$item['re_date']?></span>
		<? if($item['flag_delete_reply']) { ?><button type="button" onclick="deletePortfolioReply(this, '<?=$item[$comment_pk]?>')" class="btn_gray_line_s">삭제</button><? } ?>
	</div>
	<? } ?>
</li>

