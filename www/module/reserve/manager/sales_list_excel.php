<?
if(!defined('_INPLUS_')) { exit; }
$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;
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
$oReserve->set('cnt_rows', 9999999);
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
$title = date("Ymd").'매출내역';
$title = iconv('utf-8', 'euc-kr', $title);
header( "Content-type: application/vnd.ms-excel" );
header( "Content-charset: euc-kr" );
header( "Content-Disposition: attachment; filename=".$title.".xls");
header( "Content-Description: PHP4 Generated Data" );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ko" />
	<title>판매현황</title>
	<style type="text/css">
		<!--
		.style1 {
			color: #FF3300;
			font-weight: bold;
		}
		-->
	</style>
</head>
<body>

<table border="1">
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
		<col width="*" />
	</colgroup>
	<tr>
		<td colspan="3" bgcolor="#92cddc">&nbsp;</td>
		<th bgcolor="#92cddc">총 금액</th>
		<th bgcolor="#92cddc">건수</th>
		<th bgcolor="#92cddc">카드</th>
		<th bgcolor="#92cddc">현금</th>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<th colspan="3" align="left" bgcolor="#dbeef3">총 매출 (A+B)</th>
		<td class="style1"><?=number_format($sales['A']['total_price'] + $sales['S']['total_price'] + $sales['M']['total_price'] + $sales['U']['total_price'])?></td>
		<td class="style1"><?=number_format($sales['A']['cnt_total'] + $sales['S']['cnt_total'] + $sales['M']['cnt_total'] + $sales['U']['cnt_total'])?></td>
		<td class="style1"><?=number_format($sales['A']['card_price'] + $sales['S']['card_price'] + $sales['M']['card_price'] + $sales['U']['card_price'])?></td>
		<td class="style1"><?=number_format($sales['A']['cash_price'] + $sales['S']['cash_price'] + $sales['M']['cash_price'] + $sales['U']['cash_price'])?></td>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<th colspan="3" align="left" bgcolor="#dbeef3">선불제등록(A)</th>
		<td><?=number_format($sales['A']['total_price'])?></td>
		<td><?=number_format($sales['A']['cnt_total'])?></td>
		<td><?=number_format($sales['A']['card_price'])?></td>
		<td><?=number_format($sales['A']['cash_price'])?></td>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<th colspan="3" align="left" bgcolor="#dbeef3">일반결제(B)</th>
		<td><?=number_format($sales['S']['total_price'] + $sales['M']['total_price'])?></td>
		<td><?=number_format($sales['S']['cnt_total'] + $sales['M']['cnt_total'] + $sales['U']['cnt_total'])?></td>
		<td><?=number_format($sales['S']['card_price'] + $sales['M']['card_price'] + $sales['U']['card_price'])?></td>
		<td><?=number_format($sales['S']['cash_price'] + $sales['M']['cash_price'] + $sales['U']['cash_price'])?></td>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<th colspan="3" align="left" bgcolor="#ffffdc">일반할인</th>
		<td bgcolor="#ffffdc"><?=number_format($sales['TOTAL']['sum_total_normal_discount'])?></td>
		<td bgcolor="#ffffdc"><?=number_format($sales['TOTAL']['cnt_normal_discount'])?></td>
		<td bgcolor="#ffffdc">-</td>
		<td bgcolor="#ffffdc">-</td>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<th colspan="3" align="left" bgcolor="#ffffdc">쿠폰사용</th>
		<td bgcolor="#ffffdc"><?=number_format($sales['TOTAL']['sum_total_coupon_discount'])?></td>
		<td bgcolor="#ffffdc"><?=number_format($sales['TOTAL']['cnt_coupon_discount'])?></td>
		<td bgcolor="#ffffdc">-</td>
		<td bgcolor="#ffffdc">-</td>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<th colspan="3" align="left" bgcolor="#fde9d9">선불제사용금액</th>
		<td bgcolor="#fde9d9"><?=number_format($sales['TOTAL']['sum_total_advance'])?></td>
		<td bgcolor="#fde9d9"><?=number_format($sales['TOTAL']['cnt_advance'])?></td>
		<td bgcolor="#fde9d9">-</td>
		<td bgcolor="#fde9d9">-</td>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="13">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#92cddc">No</td>
		<td align="center" bgcolor="#92cddc">이용일자</td>
		<td align="center" bgcolor="#92cddc">이름</td>
		<td align="center" bgcolor="#92cddc">서비스명</td>
		<td align="center" bgcolor="#92cddc">시술금액</td>
		<td align="center" bgcolor="#92cddc">담당자</td>
		<td align="center" bgcolor="#92cddc">일반할인</td>
		<td align="center" bgcolor="#92cddc">쿠폰사용</td>
		<td align="center" bgcolor="#92cddc">선불제사용</td>
		<td align="center" bgcolor="#92cddc">결제금액</td>
		<td align="center" bgcolor="#92cddc">카드</td>
		<td align="center" bgcolor="#92cddc">현금</td>
		<td align="center" bgcolor="#92cddc">비고</td>
	</tr>
	<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr>
			<td align="center" bgcolor="#dbeef3"><?=$list[$i]['no']?></td>
			<td align="center"><?=str_replace('-', '.', $list[$i]['rs_date'])?></td>
			<td align="center">홍길동</td>
			<td>
				<table border="1">
					<?
					$sv_name_list = $list[$i]['sv_name_list'];
					for($j = 0 ; $j < sizeof($sv_name_list) ; $j++) { ?>
						<tr><td><?=$sv_name_list[$j]?></td></tr>
					<? } ?>
				</table>
			</td>
			<td>
				<strong><?=number_format($list[$i]['sv_price'])?></strong>
			</td>
			<td align="center"><?=$list[$i]['st_name']?></td>
			<td><?=getWithoutNull(number_format($list[$i]['pm_sale_price']))?></td>
			<td><?=getWithoutNull(number_format($list[$i]['pm_coupon_price']))?></td>
			<td><?=getWithoutNull(number_format($list[$i]['pm_advance_price']))?></td>
			<td class="style1"><?=number_format($list[$i]['total_price'])?></td>
			<td><?=getWithoutNull(number_format($list[$i]['pm_card_price']))?></td>
			<td><?=number_format($list[$i]['pm_cash_price'])?></td>
			<td bgcolor="#f2f2f2"><?=$list[$i]['rs_pay_memo']?></td>
		</tr>
	<? } if(sizeof($list) == 0) { printNoData(12); } ?>
</table>


</body>
</html>