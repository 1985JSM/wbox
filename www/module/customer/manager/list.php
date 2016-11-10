<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
$layout_size = 'normal';

/* init Class */
$oCustomer = new CustomerManager();
$oCustomer->init();
$module_name = $oCustomer->get('module_name');	// 모듈명

/* list */
$list = $oCustomer->selectList();
$total_cnt = $oCustomer->get('total_cnt');
$cnt_page = $oCustomer->get('cnt_page');

/* search condition */
$sch_type_arr = $oCustomer->get('sch_type_arr');
$query_string = $oCustomer->get('query_string');

/* pagination */
$page = $oCustomer->get('page');
$page_arr = $oCustomer->getPageArray();
$pk = $oCustomer->get('pk');

/* code */
$cs_level_arr = $oCustomer->get('cs_level_arr');

/* staff */
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$st_id_arr = $oStaff->selectStaffByShopCode($member['sh_code']);

/* 최근 기간 */
$sch_date_arr = $oCustomer->get('sch_date_arr');
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
		<input type="hidden" name="sch_date_type" value="reg_time" />

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
			<th>가입일</th>
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
			<th>등급/담당자</th>
			<td>
				<select name="sch_cs_level" class="select" title="가맹점등급">
				<option value="">가맹점등급</option>
				<? printSelectOption($cs_level_arr, $sch_cs_level, 1); ?>
				</select>	

				<select name="sch_st_id" class="select" title="담당자">
				<option value="">담당자</option>
				<? printSelectOption($st_id_arr, $sch_st_id, 1); ?>
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
			<a href="./excel.html?page=1<?=$query_string?>" target="_blank" class="sButton success" title="엑셀다운">엑셀다운</a>
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
			<? printSelectOption($oCustomer->get('cnt_rows_arr'), $oCustomer->get('cnt_rows'), 1); ?>
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
		<col width="100" />		
		<col width="50" />
		<col width="130" />
		<col width="*" />
		<col width="100" />
		<col width="80" />
		<col width="150" />
		<col width="90" />
		<col width="80" />
		<col width="80" />
		</colgroup>
		<thead>
		<tr>
			<th>No</th>
			<th>이름</th>
			<th>성별</th>
			<th>닉네임</th>
			<th>이메일</th>
			<th>휴대폰</th>
			<th>가맹점등급</th>
			<th>담당자</th>
			<th>완료예약/<br />종료예약(건)</th>
			<th>가입일</th>
			<th>수정</th>
		</tr>
		</thead>
		<tbody>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr class="list_tr_<?=$list[$i]['odd']?>">		
			<td><?=$list[$i]['no']?></td>
			<td><a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['cs_name']?></a></td>
			<td><?=$list[$i]['txt_cs_gender']?></td>
			<td><?=$list[$i]['cs_nick']?></td>
			<td><?=$list[$i]['cs_email']?></td>
			<td><?=$list[$i]['cs_hp']?></td>
			<td><?=$list[$i]['txt_cs_level']?></td>
			<td><?=$st_id_arr[$list[$i]['st_id']]?></td>
			<td><strong class="primary"><?=number_format($list[$i]['cnt_finish_reserve'])?></strong> / <?=number_format($list[$i]['cnt_total_reserve'])?></td>
			<td><?=$list[$i]['reg_date']?></td>
			<td>
				<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny" title="상세보기">상세보기</a>
			</td>	
		</tr>
		<? } if(sizeof($list) == 0) { printNoData(11); } ?>
		</tbody>
		</table>	
		<!-- //list_table -->

		<div class="button">	
			<div class="left">
				
			</div>
			<div class="right">
				<a href="./write.html?page=<?=$page?><?=$query_string?>" class="sButton small primary" title="고객등록">고객등록</a>
				<a href="./write_plural.html?page=<?=$page?><?=$query_string?>" class="sButton small primary" title="일괄등록">일괄등록</a>
			</div>
		</div>

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