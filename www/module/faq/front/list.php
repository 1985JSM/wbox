<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oFaq = new FaqFront();
$oFaq->init();
$module_name = $oFaq->get('module_name');	// 모듈명

/* list */
$list = $oFaq->selectList();
$total_cnt = $oFaq->get('total_cnt');
$cnt_page = $oFaq->get('cnt_page');

/* search condition */
$sch_type_arr = $oFaq->get('sch_type_arr');
$query_string = $oFaq->get('query_string');

/* pagination */
$page = $oFaq->get('page');
$page_arr = $oFaq->getPageArray();
$pk = $oFaq->get('pk');
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<!-- list_top -->
<div class="list_top">
	<div class="left">
		Total : <strong><?=number_format($total_cnt)?></strong> 건, 현재 : <strong><?=number_format($page)?></strong> 페이지
	</div>
	<div class="faq_right">
		<!-- search -->
		<div class="popup_search">
			<form name="search_form" action="<?=$base_uri?>/faq/list.html" method="get" onsubmit="return submitSearchForm(this)" target="#layer_content">
			<input type="hidden" name="flag_json" value="1" />
			<fieldset>
			<select name="sch_type" class="select" title="검색필드">
			<? printSelectOption($sch_type_arr, $sch_type, 1); ?>
			</select>	
			<input type="text" name="sch_keyword" class="text required" value="<?=$sch_keyword?>" size="30" maxlength="30" title="검색어" />
			<button type="submit" class="sButton small info">검 색</button>
			</fieldset>
			</form>
		</div>
		<!-- //search -->
	</div>
</div>
<!-- //list_top -->

<!-- list -->
<div class="list">

	<!-- list_table -->
	<table class="list_table odd" border="1">
	<colgroup>
	<col width="50" />
	<col width="*" />
	<col width="100" />
	</colgroup>
	<thead>
	<tr>
		<th>No</th>
		<th>제목</th>
		<th>작성일</th>
	</tr>
	</thead>
	<tbody>
	<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
	<tr class="list_tr_<?=$list[$i]['odd']?>">				
		<td><?=$list[$i]['no']?></td>
		<td class="subject"><a href="<?=$base_uri?>/faq/view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="btn_ajax" target="#layer_content"><?=$list[$i]['bo_subject']?></a></td>			
		<td><?=$list[$i]['reg_date']?></td>

	</tr>
	<? } if(sizeof($list) == 0) { printNoData(3); } ?>
	</tbody>
	</table>	

	<!-- pagination -->
	<div class="pagination">
		<ul>
		<? printAjaxPagination($page_arr, $query_string, $base_uri.'/faq/list.html', '#layer_content'); ?>
		</ul>
	</div>
	<!-- //pagination -->
</div>
<!-- //list -->
