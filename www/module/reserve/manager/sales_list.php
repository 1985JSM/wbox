<?
if(!defined('_INPLUS_')) { exit; }

/* check password */
//$oMember->checkSalesPasswordCookie($this_uri);
//[HTTP_REFERER] => http://wbox.inplus21.com/webmanager/shop/write.html
$referer_uri = $_SERVER['HTTP_REFERER'];
if(!strpos($referer_uri, 'sales_list.html') && !strpos($referer_uri, 'process.html')) {
	movePage('../member/sales_password.html?return_url='.urlencode($this_uri));
}

/* layout size */
$layout_size = 'large';

/* init Class */
$oReserve = new ReserveManager();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

/* list */
$oReserve->set('list_mode', 'sales');
if ($_GET['sch_cnt_rows'] != "") {
	$oReserve->set('cnt_rows', $_GET['sch_cnt_rows']);
}
if ($_GET['sch_s_date'] == "" || $_GET['sch_e_date'] == "") {
	// 검색 조건이 없을 때, 오늘 목록만 출력
	$oReserve->set('sch_date_type', 'rs_date');
	$oReserve->set('sch_s_date', date("Y-m-d"));
	$oReserve->set('sch_e_date', date("Y-m-d"));
	$sch_s_date = date("Y-m-d");
	$sch_e_date = date("Y-m-d");
}
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

// staff
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$st_id_arr = $oStaff->selectStaffByShopCode($member['sh_code']);

// sales
unset($sales);
$sales['U'] = $oReserve->selectSalesReserve($member['sh_code'], 'U', $sch_s_date, $sch_e_date, $sch_st_id);
$sales['S'] = $oReserve->selectSalesReserve($member['sh_code'], 'S', $sch_s_date, $sch_e_date, $sch_st_id);
$sales['M'] = $oReserve->selectSalesReserve($member['sh_code'], 'M', $sch_s_date, $sch_e_date, $sch_st_id);
$sales['TOTAL'] = $oReserve->selectSalesReserve($member['sh_code'], 'TOTAL', $sch_s_date, $sch_e_date, $sch_st_id);

// advance_purchase
if(!isset($oAdvancePurchase)) {
	include_once(_MODULE_PATH_.'/advance_purchase/advance_purchase.manager.class.php');
	$oAdvancePurchase = new AdvancePurchaseManager();
	$oAdvancePurchase->init();
}
$sales['A'] = $oAdvancePurchase->selectSalesAdvance($member['sh_code'], $sch_s_date, $sch_e_date);

// 2016부터 오늘의 년도까지 구함
$start_year_to_print = 2016;
$get_today_year = date("Y"); // 오늘의 년도를 구함
$sch_year_selected = $_GET['sch_year']; // select에서 selected될 항목을 구하는 변수
if ($sch_year_selected == "") {
	$sch_year_selected = $get_today_year;
}

$sch_year_arr = array();
while ($start_year_to_print <= $get_today_year) {
	$sch_year_arr[$start_year_to_print] = $get_today_year . '년';
	$start_year_to_print++;
}

$sch_month_selected = $_GET['sch_month'];
if ($sch_month_selected == "") {
	$sch_month_selected = date("m");
}
$sch_month_arr = array(
	'1'=>'1월',
	'2'=>'2월',
	'3'=>'3월',
	'4'=>'4월',
	'5'=>'5월',
	'6'=>'6월',
	'7'=>'7월',
	'8'=>'8월',
	'9'=>'9월',
	'10'=>'10월',
	'11'=>'11월',
	'12'=>'12월'
);

$sch_cnt_arr = array(
	'1'=>'1개씩',
	'10'=>'10개씩',
	'20'=>'20개씩',
	'30'=>'30개씩',
	'50'=>'50개씩',
	'100'=>'100개씩'
);
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$("input.pm_cash_price").on("blur", function() {
		changeCashPrice(this);		
	});

	$( "select[name=sch_cnt_rows]" ).on("change", function() {
		$(this).closest('form').submit();

	});

	$( "select[name=sch_month]" ).on("change", function() {
		var selectedYear = $("select[name=sch_year]").val();
		var selectedMonth = $(this).val();

		var firstDay_tmp = new Date(selectedYear, selectedMonth -1, 1);
		var lastDay_tmp = new Date(selectedYear, selectedMonth, 0);
		var firstDay = changeDateFormat(firstDay_tmp);
		var lastDay = changeDateFormat(lastDay_tmp);

		$("#sch_s_date").val(firstDay);
		$("#sch_e_date").val(lastDay);
	});
});
function changeDateFormat(d)
{
	var month = d.getMonth();
	var day = d.getDate();
	month = month + 1;

	month = month + "";

	if (month.length == 1)
	{
		month = "0" + month;
	}

	day = day + "";

	if (day.length == 1)
	{
		day = "0" + day;
	}

	return  d.getFullYear() + '-' + month + '-' + day;
}
//]]>
</script>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<form name="search_form" method="get" onsubmit="return submitSearchForm(this)">
		<!-- search -->
		<div class="search">
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
						<th>기간</th>
						<td colspan="3">

							<select name="sch_year" class="select" title="년">
								<?
								printSelectOption($sch_year_arr, $sch_year_selected, 1);
								?>
							</select>
							<select name="sch_month" class="select" title="월">
								<?
								printSelectOption($sch_month_arr, $sch_month_selected, 1);
								?>

							</select>

							<input type="text" name="sch_s_date" id="sch_s_date" value="<?=$sch_s_date?>" class="text date" size="12" maxlength="10" title="검색 시작일" />
							~
							<input type="text" name="sch_e_date" id="sch_e_date" value="<?=$sch_e_date?>" class="text date" size="12" maxlength="10" title="검색 종료일" />



							<a href="./list.html?sch_s_date=<?=$sch_date_arr[0]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[0]?> btn_quick_date">오늘</a>
							<a href="./list.html?sch_s_date=<?=$sch_date_arr[2]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[2]?> btn_quick_date">일주일</a>
						</td>
					</tr>
					<tr>
						<th>담당자</th>
						<td>
							<select name="sch_st_id" class="select" title="검색필드">
								<option value="">전체</option>
								<? printSelectOption($st_id_arr, $sch_st_id, 1); ?>
							</select>
						</td>
					</tr>
					</tbody>
				</table>
			</fieldset>

			<p class="button">
				<button type="submit" class="sButton info" title="검색">검 색</button>
				<a href="sales_list_excel.html?page=1<?=$query_string?>" class="sButton success" title="엑셀다운">엑셀다운</a>
				<a href="?page=1" class="sButton" title="초기화">초기화</a>
			</p>
		</div>
		<!-- //search -->

		<!-- 매출내역 -->
		<div class="sale_info">
			<table class="list_table border sales" border="1">
				<colgroup>
					<col width="*" />
					<col width="240" />
					<col width="240" />
					<col width="200" />
					<col width="200" />
					<col width="200" />
				<thead>
				<tr>
					<th colspan="3">매출금액</th>
					<th colspan="2">할인금액</th>
					<th rowspan="2">선불제 사용 금액</th>
				</tr>
				<tr>
					<th>총 매출 (A+B)</th>
					<th>선불제 등록 (A)</th>
					<th>일반결제 (B)</th>
					<th>일반 할인</th>
					<th>쿠폰 사용</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="total">
						<strong class="total primary"><?=number_format($sales['A']['total_price'] + $sales['S']['total_price'] + $sales['M']['total_price'] + $sales['U']['total_price'])?></strong>원
						<ul class="box">
							<li><strong>건수</strong><span><?=number_format($sales['A']['cnt_total'] + $sales['S']['cnt_total'] + $sales['M']['cnt_total'] + $sales['U']['cnt_total'])?> 건</span></li>
							<li><strong>카드</strong><span><?=number_format($sales['A']['card_price'] + $sales['S']['card_price'] + $sales['M']['card_price'] + $sales['U']['card_price'])?> 원</span></li>
							<li><strong>현금</strong><span><?=number_format($sales['A']['cash_price'] + $sales['S']['cash_price'] + $sales['M']['cash_price'] + $sales['U']['cash_price'])?> 원</span></li>
						</ul>
					</td>
					<td>
						<strong class="total"><?=number_format($sales['A']['total_price'])?></strong>원
						<ul class="box">
							<li><strong>건수</strong><span><?=number_format($sales['A']['cnt_total'])?> 건</span></li>
							<li><strong>카드</strong><span><?=number_format($sales['A']['card_price'])?> 원</span></li>
							<li><strong>현금</strong><span><?=number_format($sales['A']['cash_price'])?> 원</span></li>
						</ul>
					</td>
					<td>
					<strong class="total"><?=number_format($sales['S']['total_price'] + $sales['M']['total_price'])?></strong>원
						<ul class="box">
							<li><strong>건수</strong><span><?=number_format($sales['S']['cnt_total'] + $sales['M']['cnt_total'] + $sales['U']['cnt_total'])?> 건</span></li>
							<li><strong>카드</strong><span><?=number_format($sales['S']['card_price'] + $sales['M']['card_price'] + $sales['U']['card_price'])?> 원</span></li>
							<li><strong>현금</strong><span><?=number_format($sales['S']['cash_price'] + $sales['M']['cash_price'] + $sales['U']['cash_price'])?> 원</span></li>
						</ul>
					</td>
					<td class="sale">
						<strong class="total"><?=number_format($sales['TOTAL']['sum_total_normal_discount'])?></strong>원
						<ul class="box">
							<li><strong>건수</strong><span><?=number_format($sales['TOTAL']['cnt_normal_discount'])?> 건</span></li>
						</ul>
					</td>
					<td class="sale">
						<strong class="total"><?=number_format($sales['TOTAL']['sum_total_coupon_discount'])?></strong>원
						<ul class="box">
							<li><strong>건수</strong><span><?=number_format($sales['TOTAL']['cnt_coupon_discount'])?> 건</span></li>
						</ul>
					</td>
					<td class="prepayment">
						<strong class="total"><?=number_format($sales['TOTAL']['sum_total_advance'])?></strong>원
						<ul class="box">
							<li><strong>건수</strong><span><?=number_format($sales['TOTAL']['cnt_advance'])?> 건</span></li>
						</ul>
					</td>
				</tr>
				</tbody>
			</table>

		</div>

		<!-- //매출내역 -->

		<!-- list_top -->

		<div class="list_top">
			<div class="left">
				Total : <strong><?=number_format($total_cnt)?></strong> 건, 현재 : <strong><?=number_format($page)?></strong> 페이지
			</div>
			<div class="right">
				<span class="info">* 현금 변경 후 저장을 위해서 하단의 현금 수정을 클릭해주세요.</span>
				<strong>*출력옵션 : </strong>
				<select name="sch_cnt_rows" class="select order_select" title="출력개수">
					<?
					printSelectOption($sch_cnt_arr, $oReserve->get('cnt_rows'), 1);
					?>
				</select>
			</div>
		</div>
	</form>
	<!-- //list_top -->

	<!-- list -->
	<div class="list sales_list">

		<!-- list_table -->
		<form name="sales_list_form" action="./process.html" method="post" onsubmit="return submitSalesListForm(this)">
			<input type="hidden" name="mode" value="update_cash" />
			<input type="hidden" name="page" value="<?=$page?>" />
			<input type="hidden" name="query_string" value="<?=$query_string?>" />
			<input type="hidden" name="<?=$pk?>" value="" />

			<div class="">
				<table class="list_table border odd" border="1">
					<colgroup>
						<col width="50" />
						<col width="90" />
						<col width="120" />
						<col width="*" />
						<col width="90" />
						<col width="90" />
						<col width="120" />
						<col width="90" />
						<col width="90" />
						<col width="90" />
						<col width="90" />
						<col width="90" />
						<col width="90" />
						<col width="17" />
					</colgroup>
					<thead>
					<tr>
						<th rowspan="2">No</th>
						<th rowspan="2">이용일자</th>
						<th rowspan="2">이름</th>
						<th rowspan="2">서비스명</th>
						<th rowspan="2">시술금액</th>
						<th rowspan="2">비고</th>
						<th rowspan="2">담당자</th>
						<th rowspan="2">일반할인</th>
						<th rowspan="2">쿠폰사용</th>
						<th rowspan="2">선불제사용</th>
						<th rowspan="2">결제금액</th>
						<th colspan="2">결제수단</th>
						<th rowspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th class="border">카드</th>
						<th>현금</th>
					</tr>
					</thead>
				</table>
			</div>

			<div class="scroll_table">
				<table class="list_table border odd" border="1">
					<colgroup>
						<col width="50" />
						<col width="90" />
						<col width="120" />
						<col width="*" />
						<col width="90" />
						<col width="90" />
						<col width="120" />
						<col width="90" />
						<col width="90" />
						<col width="90" />
						<col width="90" />
						<col width="90" />
						<col width="90" />
					</colgroup>
					<tbody>
					<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
						<tr class="list_tr_<?=$list[$i]['odd']?>">

							<td><?=$list[$i]['no']?></td>
							<td><?=str_replace('-', '.', $list[$i]['rs_date'])?></td>
							<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank"><?=$list[$i]['us_name']?></a></td>
							<?/*<td><?=$list[$i]['txt_rs_type']?></td>*/?>
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
							<td>
								<strong><?=number_format($list[$i]['sv_price'])?></strong>
							</td>
							<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny info" target="#layer_popup" title="관리자메모">비고</a></td>
							<td><?=$list[$i]['st_name']?></td>
							<td><?=getWithoutNull(number_format($list[$i]['pm_sale_price']))?></td>
							<td><?=getWithoutNull(number_format($list[$i]['pm_coupon_price']))?></td>
							<td><?=getWithoutNull(number_format($list[$i]['pm_advance_price']))?></td>
							<td><strong class="primary txt_total_price"><?=number_format($list[$i]['total_price'])?></strong></td>
							<td><?=getWithoutNull(number_format($list[$i]['pm_card_price']))?></td>
							<td>
								<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
								<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
								<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />

								<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
							</td>
						</tr>
					<? } if(sizeof($list) == 0) { printNoData(13); } ?>
					</tbody>
				</table>
				<!-- //list_table -->
			</div>

			<div class="button">
				<div class="left">

				</div>
				<div class="right">
					<button type="submit" class="sButton small primary" title="금액수정">금액수정</button>
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