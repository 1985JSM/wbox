<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
//$content_size = 'full';

/* init Class */
$oApplication = new ApplicationAdmin();
$oApplication->init();
$module_name = $oApplication->get('module_name');	// 모듈명

/* list */
$list = $oApplication->selectList();
$total_cnt = $oApplication->get('total_cnt');
$cnt_page = $oApplication->get('cnt_page');

/* search condition */
$sch_type_arr = $oApplication->get('sch_type_arr');
$query_string = $oApplication->get('query_string');

/* pagination */
$page = $oApplication->get('page');
$page_arr = $oApplication->getPageArray();
$pk = $oApplication->get('pk');

/* 최근 기간 */
$sch_date_arr = $oApplication->get('sch_date_arr');
unset($sch_date_class);
for($i = 0 ; $i < sizeof($sch_date_arr) ; $i++) {
	if($sch_s_date == $sch_date_arr[$i] && $sch_e_date == $sch_date_arr[0]) {
		$sch_date_class[$i] = 'active';
	}
}
if(!$sch_s_date && !$sch_e_date) { $sch_date_class[$i] = 'active'; }
?>
<script type="text/javascript">
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
</script>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- search -->
	<div class="search">
		<form name="search_form" action="./list.html" method="get" onsubmit="return submitSearchForm(this)">
		<input type="hidden" name="sch_order_field" value="reg_time" />
		<input type="hidden" name="sch_order_direct" value="<?=$sch_order_direct?>" />
		<input type="hidden" name="sch_cnt_rows" value="<?=$sch_cnt_rows?>" />
		<input type="hidden" name="sch_date_type" value="reg_time" />

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
			<th>신청기간</th>
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
			<th>진행여부</th>
			<td>
				<select name="sch_ap_state" class="select" title="전체">
				<option value="">전체</option>
				<? printSelectOption($oApplication->get('ap_state_arr'), $sch_ap_state, 1); ?>
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
			<select name="sch_order_direct" class="select order_select" title="정렬순서">
			<? printSelectOption($oApplication->get('order_direct_arr'), $sch_order_direct, 1); ?>
			</select>

			<select name="sch_cnt_rows" class="select order_select" title="출력개수">
			<? printSelectOption($oApplication->get('cnt_rows_arr'), $oApplication->get('cnt_rows'), 1); ?>
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
		<col width="50px" />
		<col width="90px" />
		<col width="*" />
		<col width="90px" />

		<col width="*" />
		<col width="100px" />
		<col width="90px" />		
		<col width="100px" />
		</colgroup>
		<thead>
		<tr>
			<th><input type="checkbox" id="all_check" title="전체선택" /></th>
			<th>No</th>
			<th>신청자</th>
			<th>업체명</th>
			<th>신청일</th>
			<th>주소</th>
			<th>연락처</th>
			<th>진행여부</th>
			<th>상세보기</th>
		</tr>
		</thead>
		<tbody>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr class="list_tr_<?=$list[$i]['odd']?>">		
			<td><input type="checkbox" name="del_uid[]" value="<?=$list[$i][$pk]?>" class="list_check" title="선택/해제" /></td>
			<td><?=$list[$i]['no']?></td>
			<td><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['ap_name']?></a></td>
			<td><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['ap_shop_name']?></a></td>
			<td><?=$list[$i]['reg_date']?></td>
			<td><?=$list[$i]['txt_addr']?></td>
			<td><?=$list[$i]['ap_tel']?></td>
			<td class="<?=$list[$i]['state_class']?>"><?=$list[$i]['txt_ap_state']?></td>			
			<td><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<? } if(sizeof($list) == 0) { printNoData(9); } ?>
		</tbody>
		</table>	

		<div class="button">	
			<div class="left">
				<button type="submit" class="sButton small" title="선택삭제">선택삭제</button>
			</div>
			<div class="right">
				<a href="./write.html?page=<?=$page?><?=$query_string?>" class="sButton small confirm" title="추가하기">추가하기</a>	
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