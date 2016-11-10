<?
if(!defined('_INPLUS_')) { exit; } 

$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

/* list */
$list = $oReserve->selectList();
$total_cnt = $oReserve->get('total_cnt');
$cnt_page = $oReserve->get('cnt_page');

/* search condition */
$sch_type_arr = $oReserve->get('sch_type_arr');
$query_string = $oReserve->get('query_string');

/* pagination */
$page = $oReserve->get('page');
$page_arr = $oReserve->getPageArray();
$pk = $oReserve->get('pk');

/* 최근 기간 */
$sch_date_arr = $oReserve->get('sch_date_arr');
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
		<form name="search_form" method="get" onsubmit="return submitSearchForm(this)">
		<input type="hidden" name="sch_order_field" value="<?=$sch_order_field?>" />
		<input type="hidden" name="sch_order_direct" value="<?=$sch_order_direct?>" />
		<input type="hidden" name="sch_cnt_rows" value="<?=$sch_cnt_rows?>" />
		<input type="hidden" name="sch_date_type" value="rs_date" />

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
			<th>예약일</th>
			<td colspan="3">								
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
			<a href="?page=1" class="sButton" title="초기화">초기화</a>
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
			<select name="sch_cnt_rows" class="select order_select" title="출력개수">
			<? printSelectOption($oReserve->get('cnt_rows_arr'), $oReserve->get('cnt_rows'), 1); ?>
			</select>
		</div>
	</div>
	<!-- //list_top -->

	<!-- list -->
	<div class="list">
		<!-- list_table -->
		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50" />
		<col width="200" />		
		<col width="130" />		
		<col width="*" />
		<col width="150" />
		<col width="200" />
		<col width="130" />
		</colgroup>
		<thead>
		<tr>
			<th>No</th>
			<th>가맹점명</th>
			<th>예약자명</th>
			<th>서비스</th>			
			<th>담당자</th>
			<th>예약일시</th>
			<th>상태</th>
		</tr>
		</thead>
		<tbody>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr class="list_tr_<?=$list[$i]['odd']?>">		
			<td><?=$list[$i]['no']?></td>
			<td><strong><?=$list[$i]['sh_name']?></strong></td>
			<td><strong><?=$list[$i]['us_name']?></strong></td>
			<td class="no_padding">
				<div class="service_info">
					<ul>
					<?
					$sv_name_list = $list[$i]['sv_name_list'];
					for($j = 0 ; $j < sizeof($sv_name_list) ; $j++) { ?>
					<li><?=$sv_name_list[$j]?></li>
					<? } ?>
					</ul>
				</div>
			</td>

			<td><?=$list[$i]['st_name']?></td>
			<td><?=$list[$i]['txt_rs_datetime']?></td>
			<td class="state_<?=$list[$i]['rs_state']?>"><?=$list[$i]['txt_rs_state']?></td>			
		</tr>
		<? } if(sizeof($list) == 0) { printNoData(7); } ?>
		</tbody>
		</table>	
		<!-- //list_table -->

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