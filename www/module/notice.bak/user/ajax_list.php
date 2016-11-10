<?
if(!isset($oNotice)) {
	$oNotice = new NoticeUser();
	$oNotice->init();
}

/* list */
$list = $oNotice->selectList();
$thumb_width = $oNotice->get('thumb_width');
$thumb_height = $oNotice->get('thumb_height');
$total_cnt = $oNotice->get('total_cnt');
$pk = $oNotice->get('pk');
$query_string = $oNotice->get('query_string');

for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>
	<button type="button" onclick="toggleArticle(this)">
		<strong><?=$list[$i]['nt_subject']?></strong>
		<span class="data"><?=$list[$i]['reg_date']?></span>
		<i class="xi-angle-down"></i>
	</button>
	<div class="cont">
	<?=nl2br($list[$i]['nt_content'])?>
	<? if($list[$i]['thumb']) { ?><img src="<?=$list[$i]['thumb']?>" /><? } ?>
	</div>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p>등록된 공지사항이 없습니다.</p>
</li>
<? } ?>