<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
//$content_size = 'full';

/* init Class */
$oStaff = new StaffAdmin();
$oStaff->init();
$module_name = $oStaff->get('module_name');	// 모듈명

/* list */
$list = $oStaff->selectList();
$total_cnt = $oStaff->get('total_cnt');
$cnt_page = $oStaff->get('cnt_page');

/* search condition */
$sch_type_arr = $oStaff->get('sch_type_arr');
$query_string = $oStaff->get('query_string');

/* pagination */
$page = $oStaff->get('page');
$page_arr = $oStaff->getPageArray();
$pk = $oStaff->get('pk');

/* thumb */
$thumb_width = $oStaff->get('thumb_width');
$thumb_height = $oStaff->get('thumb_height');
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
				<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><img src="<?=$list[$i]['thumb']?>" width="<?=$thumb_width?>" height="<?=$thumb_width?>" /></a>
			</div>

			<div class="content">	
				<p class="title">	
					<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['sh_name']?> &gt; <?=$list[$i]['txt_staff']?></a>

					<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny">상세보기</a>
				</p>

				<p class="content">
					<strong>연락처 : <?=$list[$i]['mb_hp']?></strong><br />
					<span>근무시간 : <?=$list[$i]['s_work']?> ~ <?=$list[$i]['e_work']?></span><br />
					<span class="info">서비스 : <?=$list[$i]['txt_sv_code']?></span>
				</p>
			</div>
		</li>
		<? } if(sizeof($list) == 0) { ?><li class="no_data">등록 또는 검색된 데이터가 없습니다.</li> <? } ?>

		</ul>

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