<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oService = new ServiceManager();
$oService->init();
$module_name = $oService->get('module_name');	// 모듈명
$oService->set('cnt_rows', 9999);

/* list */
$list = $oService->selectList();
$total_cnt = $oService->get('total_cnt');
$cnt_page = $oService->get('cnt_page');

/* search condition */
$sch_type_arr = $oService->get('sch_type_arr');
$query_string = $oService->get('query_string');

/* pagination */
$page = $oService->get('page');
$page_arr = $oService->getPageArray();

$pk = $oService->get('pk');

/* thumb */
$thumb_width = $oService->get('thumb_width');
$thumb_height = $oService->get('thumb_height');
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
		<!-- list_table -->
		<form name="list_form" action="./process.html" method="post" onsubmit="return submitListForm(this)">
		<input type="hidden" name="mode" value="delete" />		
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		<input type="hidden" name="<?=$pk?>" value="" />

		<ul class="preview">
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<li class="list_li">

			<div class="order">
				<button type="button" onclick="changeOrder('up', this)" class="up" title="위로"></button>
				<button type="button" onclick="changeOrder('down', this)" class="down" title="아래로"></button>
				<input type="hidden" name="<?=$pk?>" value="<?=$list[$i][$pk]?>" />
			</div>

			<div class="photo">
				<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><img src="<?=$list[$i]['thumb']?>" width="<?=$thumb_width?>" height="<?=$thumb_width?>" /></a>
			</div>

			<div class="content">
				<p class="title">											
					<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['sv_name']?> (<?=$list[$i]['txt_sv_time']?>)</a>

					<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny" title="수정">수정</a>						
				</p>
				<p class="price">
					<span class="info">일반가 <?=number_format($list[$i]['sv_normal_price'])?>원</span><br />
					<strong class="failed">할인가 <?=number_format($list[$i]['sv_sale_price'])?>원</strong>
				</p>
				<p class="content">
					<?=nl2br($list[$i]['sv_content'])?>
				</p>
			</div>			
		</li>
		<? } if(sizeof($list) == 0) { ?><li class="no_data">등록 또는 검색된 데이터가 없습니다.</li> <? } ?>
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