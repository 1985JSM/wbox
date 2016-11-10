<?
if(!defined('_INPLUS_')) { exit; } 

/* blog */
if(!isset($oBlog)) {
	include_once(_MODULE_PATH_.'/blog/blog.user.class.php');
	$oBlog = new BlogUser();
	$oBlog->init();
}

/* list */
$list = $oBlog->selectList();
$total_cnt = $oBlog->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oBlog->get('pk');

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
	<a href="<?=$list[$i]['bl_url']?>" target="_blank" title="새창">
		<span class="img"><img src="<?=$list[$i]['thumb']?>" alt="<?=$list[$i]['bl_subject']?> thumbnail image" /></span>
		<strong><?=$list[$i]['bl_subject']?></strong>
		<span class="text"><?=$list[$i]['bl_content']?></span>
		<span class="date"><?=$list[$i]['reg_date']?></span>
	</a>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">등록된 블로그 포스팅이 없습니다.</li>
<? } ?>