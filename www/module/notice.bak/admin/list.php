<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oNotice = new NoticeAdmin();
$oNotice->init();
$module_name = $oNotice->get('module_name');	// 모듈명

/* list */
$list = $oNotice->selectList();
$total_cnt = $oNotice->get('total_cnt');
$cnt_page = $oNotice->get('cnt_page');

/* search condition */
$sch_type_arr = $oNotice->get('sch_type_arr');
$query_string = $oNotice->get('query_string');

/* pagination */
$page = $oNotice->get('page');
$page_arr = $oNotice->getPageArray();
$pk = $oNotice->get('pk');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	
});
//]]>
</script>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- search -->
	<div class="search">
		<form name="search_form" action="./list.html" method="get" onsubmit="return submitSearchForm(this)">
		<input type="hidden" name="sch_order_field" value="<?=$sch_order_field?>" />
		<input type="hidden" name="sch_order_direct" value="<?=$sch_order_direct?>" />
		<input type="hidden" name="sch_cnt_rows" value="<?=$sch_cnt_rows?>" />

		<fieldset>
		<legend>검색조건</legend>
		<table class="search_table" border="1">
		<caption>검색조건</caption>
		<colgroup>
		<col width="90" />
		<col width="*" />
		<col width="90" />
		<col width="*" />
		</colgroup>
		<tbody>		
		<tr>
			<th>검색어</th>
			<td>
				<select name="sch_type" class="select" title="검색필드">
				<? printSelectOption($sch_type_arr, $sch_type, 1); ?>
				</select>	
				<input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="text" size="30" maxlength="30" title="검색어" />				
			</td>
		</tr>	
		<tr>
			<th>출력구분</th>
			<td>
				<select name="sch_type" class="select" title="출력구분">
				<option value="">전체</option>
				<option value="">가맹점</option>
				<option value="">담당자</option>
				<option value="">사용자</option>
				<option value="">홈페이지</option>
				</select>					
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">		
			<button type="submit" class="sButton info" title="검색">검 색</button>
			<a href="./list.html" class="sButton" title="초기화">초기화</a>
		</p>
		</form>
	</div>
	<!-- //search -->

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

		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50" />
		<col width="50" />
		<col width="*" />
		<col width="130" />
		<col width="130" />
		<col width="130" />
		</colgroup>
		<thead>
		<tr>
			<th><input type="checkbox" id="all_check" title="전체선택" /></th>
			<th>No</th>
			<th>제목</th>
			<th>출력구분</th>
			<th>작성자</th>
			<th>작성일</th>
		</tr>
		</thead>
		<tbody>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr class="list_tr_<?=$list[$i]['odd']?>">		
			<td><input type="checkbox" name="del_uid[]" value="<?=$list[$i][$pk]?>" class="list_check" title="선택/해제" /></td>
			<td><?=$list[$i]['no']?></td>
			<td class="subject"><a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['nt_subject']?></a></td>
			<td>가맹점</td>
			<td><?=$list[$i]['nt_name']?></td>
			<td><?=$list[$i]['reg_date']?></td>

		</tr>
		<? } if(sizeof($list) == 0) { printNoData(6); } ?>
		</tbody>
		</table>	

		<div class="button">	
			<div class="left">
				<button type="submit" class="sButton small" title="선택삭제">선택삭제</button>
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