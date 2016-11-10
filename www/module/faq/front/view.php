<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oFaq = new FaqFront();
$oFaq->init();
$module_name = $oFaq->get('module_name');	// 모듈명

/* search condition */
$query_string = $oFaq->get('query_string');
$page = $oFaq->get('page');

/* insert or update */
$pk = $oFaq->get('pk');
$uid = $oFaq->get('uid');
$data = $oFaq->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.');
}

$file_list = $data['file_list'];
$max_file = $oFaq->get('max_file');

$sr_list = $oFaq->selectSurroundList($uid);
$prev = $sr_list['prev'];
$next = $sr_list['next'];
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div class="board_view">
<dl>
<dt><?=$data['bo_subject']?></dt>
<dd>			
	<span><em>작성일</em><?=$data['reg_date']?></span>
</dd>							
<dd class="cont">
	<div>
		<!-- 게시판 내용 -->
		<p><?=nl2br($data['bo_content'])?></p>
		<!-- //게시판 내용 -->
	</div>
</dd>				
</dl>

<!-- view_paging -->
<div class="view_paging">
	<dl class="prev">
	<dt>이전글</dt>
	<dd>
		<? if($prev[$pk]) { ?>
		<a href="<?=$base_uri?>/faq/view.html?<?=$pk?>=<?=$prev[$pk]?>&page=<?=$page?><?=$query_string?>" class="btn_ajax" target="#layer_content"><?=$prev['bo_subject']?></a>
		<? } else { ?>이전글이 없습니다.<? } ?>
	</dd>
	</dl>
	<dl class="next">
	<dt>다음글</dt>
	<dd>
		<? if($next[$pk]) { ?>
		<a href="<?=$base_uri?>/faq/view.html?<?=$pk?>=<?=$next[$pk]?>&page=<?=$page?><?=$query_string?>" class="btn_ajax" target="#layer_content"><?=$next['bo_subject']?></a>
		<? } else { ?>다음글이 없습니다.<? } ?>
	</dd>
	</dl>
</div>
<!-- //view_paging -->

<!-- button -->
<div class="button">
	<div class="left">					
	</div>
	<div class="right">
		<a href="<?=$base_uri?>/faq/list.html?page=<?=$page?><?=$query_string?>" class="btn_ajax sButton active" target="#layer_content" title="목록">목록</a>
	</div>
</div>
<!-- //button -->

</div>
<!-- //공지사항 쓰기-->