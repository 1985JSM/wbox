<?
if(!defined('_INPLUS_')) { exit; } 

if(!$oPortfolio) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.user.class.php');
	$oPortfolio = new PortfolioUser();
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

for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>
	<div class="img_area"><img src="<?=$list[$i]['profile_img']['thumb']?>" alt="profile image" ></div>
	<em><?=$list[$i]['cm_name']?></em>
	<span class="date"><i class="xi-time"></i> <?=$list[$i]['reg_date']?></span>
	<span class="txt"><?=nl2br($list[$i]['cm_content'])?></span>

	<? if($list[$i]['flag_reply']) { ?><a href="#" class="btn_delete btn_gray_line_s">답변</a><? } ?>
	<? if($list[$i]['flag_delete']) { ?><button type="button" onclick="deletePortfolioComment(this, '<?=$list[$i][$comment_pk]?>')" class="btn_gray_line_s">삭제</button><? } ?>

	<? if($list[$i]['re_id'] && $list[$i]['re_content']) { ?>
	<div class="rep_area">
		<strong><i class="xi-comments"></i> <?=$list[$i]['re_name']?></strong>
		<span class="rep_txt"><?=nl2br($list[$i]['re_content'])?></span>
		<span class="rep_data"><i class="xi-time"></i> <?=$list[$i]['re_date']?></span>
		<? if($list[$i]['flag_delete_reply']) { ?><a href="#" class="btn_gray_line_s">삭제</a><? } ?>
	</div>
	<? } ?>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p>등록된 댓글이 없습니다.</p>
</li>	            
<? } ?>