<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
//$content_size = 'full';

/* init Class */
$oShop = new ShopAdmin();
$oShop->init();
$module_name = $oShop->get('module_name');	// 모듈명

/* list */
$list = $oShop->selectList();
$total_cnt = $oShop->get('total_cnt');
$cnt_page = $oShop->get('cnt_page');

/* search condition */
$sch_type_arr = $oShop->get('sch_type_arr');
$query_string = $oShop->get('query_string');

/* pagination */
$page = $oShop->get('page');
$page_arr = $oShop->getPageArray();
$pk = $oShop->get('pk');

/* 최근 기간 */
$sch_date_arr = $oShop->get('sch_date_arr');
unset($sch_date_class);
for($i = 0 ; $i < sizeof($sch_date_arr) ; $i++) {
	if($sch_s_date == $sch_date_arr[$i] && $sch_e_date == $sch_date_arr[0]) {
		$sch_date_class[$i] = 'active';
	}
}
if(!$sch_s_date && !$sch_e_date) { $sch_date_class[$i] = 'active'; }
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	/* 출력옵션 */
	$("select.order_select").on("change", function() {

		var f = document.search_form;
		var name = $(this).attr("name");
		var value = $(this).val();

		$("input[name='" + name + "']", f).attr("value", value).val(value);
		if(f.onsubmit()) {
			f.submit();
		}
	});
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
		<col width="90px" />
		<col width="*" />
		<col width="90px" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>등록일시</th>
			<td colspan="3">				
				<select name="sch_date_type" class="select" title="조회일구분">
				<? printSelectOption($oShop->get('sch_date_type_arr'), $sch_date_type, 1); ?>
				</select>

				<input type="text" name="sch_s_date" id="sch_s_date" value="<?=$sch_s_date?>" class="text date" size="12" maxlength="10" title="검색 시작일" />
				~
				<input type="text" name="sch_e_date" id="sch_e_date" value="<?=$sch_e_date?>" class="text date" size="12" maxlength="10" title="검색 종료일" />	
				
				<a href="./list.html?sch_s_date=<?=$sch_date_arr[0]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[0]?> btn_quick_date">1일</a>
				<a href="./list.html?sch_s_date=<?=$sch_date_arr[1]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[1]?> btn_quick_date">3일</a>
				<a href="./list.html?sch_s_date=<?=$sch_date_arr[2]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[2]?> btn_quick_date">7일</a>
				<a href="./list.html?sch_s_date=<?=$sch_date_arr[3]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[3]?> btn_quick_date">1개월</a>
				<a href="./list.html" class="sButton tiny <?=$sch_date_class[4]?> btn_quick_date">전체</a>
			</td>
		</tr>
		<tr>
			<th>검색옵션</th>
			<td>
				<select name="sch_mb_level" class="select" title="권한등급">
				<option value="">권한등급</option>
				<? printSelectOption($oShop->get('mb_level_arr'), $sch_mb_level, 1); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>검색어</th>
			<td>
				<select name="sch_type" class="select" title="검색필드">
				<? printSelectOption($sch_type_arr, $sch_type, 1); ?>
				</select>	
				<input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="text" size="30" maxlength="30" title="검색어" />				
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
			<strong>*출력옵션 : </strong>
			<select name="sch_order_field" class="select order_select" title="정렬기준">
			<? printSelectOption($oShop->get('order_field_arr'), $sch_order_field, 1); ?>
			</select>

			<select name="sch_order_direct" class="select order_select" title="정렬순서">
			<? printSelectOption($oShop->get('order_direct_arr'), $sch_order_direct, 1); ?>
			</select>

			<select name="sch_cnt_rows" class="select order_select" title="출력개수">
			<? printSelectOption($oShop->get('cnt_rows_arr'), $oShop->get('cnt_rows'), 1); ?>
			</select>
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
		<col width="50px" />
		<col width="*" />
		<col width="*" />
		<col width="100px" />
		<col width="80px" />
		</colgroup>
		<thead>
		<tr>
			<th>No</th>
			<th>상호</th>
			<th>위치</th>
			<th>신청일</th>
			<th>상세보기</th>
		</tr>
		</thead>
		<tbody>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr class="list_tr_<?=$list[$i]['odd']?>">		
			<td><?=$list[$i]['no']?></td>
			<td><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['sh_name']?></a></td>
			<td><?=getWithoutNull($list[$i]['txt_addr'])?></td>
			<td><?=getWithoutNull($list[$i]['reg_date'])?></td>
			<td><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny " title="상세보기">상세보기</a></td>
		</tr>
		<? } if(sizeof($list) == 0) { printNoData(6); } ?>
		</tbody>
		</table>	

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