<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oBlog = new BlogFront();
$oBlog->init();
$module_name = $oBlog->get('module_name');	// 모듈명

/* list */
$oBlog->set('thumb_width', 100);
$oBlog->set('thumb_height', 100);

$list = $oBlog->selectList();
$total_cnt = $oBlog->get('total_cnt');
$cnt_page = $oBlog->get('cnt_page');

/* search condition */
$sch_type_arr = $oBlog->get('sch_type_arr');
$query_string = $oBlog->get('query_string');

/* pagination */
$page = $oBlog->get('page');
$page_arr = $oBlog->getPageArray();
$pk = $oBlog->get('pk');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	
});
//]]>
</script>

<!-- list_top -->
<div class="list_top">
	<div class="left">
		Total : <strong><?=number_format($total_cnt)?></strong> 건, 현재 : <strong><?=number_format($page)?></strong> 페이지
	</div>
	<div class="right">
		
	</div>
</div>
<!-- //list_top -->

<!-- list -->
<div class="list">
	<ul class="preview">
	<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
	<li>		
		<div class="photo">
			<a href="<?=$list[$i]['bl_url']?>" target="_blank" title="새창"><img src="<?=$list[$i]['thumb']?>" alt="<?=$list[$i]['bl_subject']?> thumbnail image" /></a>
		</div>
		<div class="content">
			<p class="title">
				<a href="<?=$list[$i]['bl_url']?>" target="_blank" title="새창"><?=$list[$i]['bl_subject']?></a>
			</p>
			<p class="content">
				<?=nl2br($list[$i]['bl_content'])?>
			</p>
		</div>			
	</li>
	<? } if(sizeof($list) == 0) { ?><li class="no_data">등록된 SNS 후기가 없습니다.</li><? } ?>
	</ul>
		
	<!-- pagination -->
	<div class="pagination">
		<ul>
		<? printAjaxPagination($page_arr, $query_string, $base_uri.'/blog/list.html', '#layer_content'); ?>
		</ul>
	</div>
	<!-- //pagination -->

</div>
<!-- //list -->