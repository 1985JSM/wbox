<?
if(!isset($oQna)) {
	$oQna = new QnaUser();
	$oQna->init();
}

/* list */
$oQna->set('list_mode', $list_mode);
$list = $oQna->selectList();
$total_cnt = $oQna->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oQna->get('pk');

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
<li <? if($list[$i]['bo_state'] == 'Y') { ?>class="answer"<? } ?>>
	<button type="button" onclick="toggleArticle(this)">
		<strong><?=$list[$i]['bo_subject']?></strong>
		<span class="icon_answer"><?=$list[$i]['txt_bo_state']?></span>
		<span class="data"><?=$list[$i]['reg_date']?></span>
		<i class="xi-angle-down"></i>
	</button>
	<div class="cont">
		<?=nl2br($list[$i]['bo_content'])?>
		<? if($list[$i]['bo_state'] == 'Y') { ?>
		<div class="answer_area">
			<i class="xi-reply-l"></i><span class="icon_reply">답변내용</span><span class="data"><?=$list[$i]['re_date']?></span>
			<p class="answer_view">
				<?=nl2br($list[$i]['bo_answer'])?>
			</p>
		</div>
		<? } ?>
	</div>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p><i class="xi-close-circle"></i> 등록된 게시물이 없습니다.</p>
</li>
<? } ?>