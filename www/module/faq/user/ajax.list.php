<?
if(!isset($oFaq)) {
	$oFaq = new FaqUser();
	$oFaq->init();
}

/* list */
$oFaq->set('list_mode', $list_mode);
$list = $oFaq->selectList();
$total_cnt = $oFaq->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oFaq->get('pk');

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
	<button type="button" onclick="toggleArticle(this)">
		<strong><?=$list[$i]['bo_subject']?></strong>
		<span class="data"><?=$list[$i]['reg_date']?></span>
		<i class="xi-angle-down"></i>
	</button>
	<div class="cont">
	<?=nl2br($list[$i]['bo_content'])?>
	<? if($list[$i]['thumb']) { ?><img src="<?=$list[$i]['thumb']?>" /><? } ?>
	</div>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p><i class="xi-close-circle"></i> 등록된 게시물이 없습니다.</p>
</li>
<? } ?>