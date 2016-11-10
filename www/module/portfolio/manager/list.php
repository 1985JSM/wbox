<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oPortfolio = new PortfolioManager();
$oPortfolio->init();
$module_name = $oPortfolio->get('module_name');	// 모듈명

/* list */
$list = $oPortfolio->selectList();
$total_cnt = $oPortfolio->get('total_cnt');
$cnt_page = $oPortfolio->get('cnt_page');

/* search condition */
$sch_type_arr = $oPortfolio->get('sch_type_arr');
$query_string = $oPortfolio->get('query_string');

/* pagination */
$page = $oPortfolio->get('page');
$page_arr = $oPortfolio->getPageArray();
$pk = $oPortfolio->get('pk');

/* thumb */
$thumb_width = $oPortfolio->get('thumb_width');
$thumb_height = $oPortfolio->get('thumb_height');
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
		<li>		
			<div class="photo">
				<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><img src="<?=$list[$i]['main_img']['thumb']?>" width="<?=$thumb_width?>" height="<?=$thumb_width?>" /></a>
			</div>

			<div class="content">
				<p class="title">
					<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>">[<?=$list[$i]['pf_name']?>] <?=$list[$i]['pf_subject']?> (좋아요:<?=number_format($list[$i]['cnt_like'])?>, 댓글:<?=number_format($list[$i]['cnt_comment'])?>)</a>

					<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny" title="상세보기">상세보기</a>						
				</p>				

				<p class="content">
					<?=nl2br($list[$i]['pf_content'])?>
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