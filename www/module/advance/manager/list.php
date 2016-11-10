<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oAdvance = new AdvanceManager();
$oAdvance->init();
$module_name = $oAdvance->get('module_name');	// 모듈명

/* list */
$list = $oAdvance->selectList();
$total_cnt = $oAdvance->get('total_cnt');
$cnt_page = $oAdvance->get('cnt_page');

/* search condition */
$sch_type_arr = $oAdvance->get('sch_type_arr');
$query_string = $oAdvance->get('query_string');

/* pagination */
$page = $oAdvance->get('page');
$page_arr = $oAdvance->getPageArray();
$pk = $oAdvance->get('pk');
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

		<ul class="preview advance">
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<li>			
			<div class="content">
				<p class="title">
					<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['ad_name']?></a> 
					<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny" title="수정">수정</a> 
				</p>
				<strong class="info"><?=$list[$i]['txt_ad_option']?></strong></p>
				<strong class="failed">판매금액 <?=number_format($list[$i]['ad_price'])?>원</strong> </p>
				<p class="content"><?=nl2br($list[$i]['ad_content'])?></p>
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