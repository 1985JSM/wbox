<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oBlog = new BlogAdmin();
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

<!-- <?=$module?> -->
<div id="<?=$module?>">

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
				<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><img src="<?=$list[$i]['thumb']?>" alt="<?=$list[$i]['bl_subject']?> thumbnail image" /></a>
			</div>
			<div class="content">
				<p class="title">
					<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['bl_subject']?></a>
					<a href="<?=$list[$i]['bl_url']?>" class="sButton tiny info blog_link" target="_blank" title="새창">연결URL</a>
					<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny" title="수정">수정</a>	
				</p>
				<p class="content">
					<?=nl2br($list[$i]['bl_content'])?>
				</p>
			</div>			
		</li>
		<? } if(sizeof($list) == 0) { ?><li class="no_data">등록된 블로그 포스팅이 없습니다.</li><? } ?>
		</ul>

		<div class="button">	
			<div class="left">
				
			</div>
			<div class="right">
				<a href="./write.html?page=<?=$page?><?=$query_string?>" class="sButton small primary" title="추가하기">추가하기</a>	
			</div>
		</div>
		</form>

		<!-- pagination -->
		<div class="pagination">
			<ul>
			<? printPagination($page_arr, $query_string); ?>
			</ul>
		</div>
		<!-- //pagination -->

	</div>
	<!-- //list -->
</div>
<!-- //<?=$module?> -->