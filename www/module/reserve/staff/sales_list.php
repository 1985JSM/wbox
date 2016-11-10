<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '매출내역';
$footer_nav['4'] = true;
$back_url = '';

$oReserve = new ReserveStaff();
$oReserve->init();

$sch_date_type = 'rs_date';
if(!$sch_s_date || !$sch_e_date) { 
	$e_time = time();
	$sch_e_date = date('Y-m-d', $e_time);

	$s_time = strtotime('-7 day', $e_time);
	$sch_s_date = date('Y-m-d', $s_time);
}

// sales
unset($sales);
$sales['U'] = $oReserve->selectSalesReserve($member['sh_code'], 'U', $sch_s_date, $sch_e_date, $member['mb_id']);
$sales['S'] = $oReserve->selectSalesReserve($member['sh_code'], 'S', $sch_s_date, $sch_e_date, $member['mb_id']);
$sales['M'] = $oReserve->selectSalesReserve($member['sh_code'], 'M', $sch_s_date, $sch_e_date, $member['mb_id']);

$list_mode = 'sales';
?>
<style type="text/css">
div.sales_day {background:#fff;  padding:20px 10px; margin-bottom:20px; }
div.sales_day span.tit {font-weight:bold;}
div.sales_day div ul:after {content:''; display:block; clear:both;}
div.sales_day div ul li {float:right; width:50%;}
div.sales_day div ul li:first-child  {float:left; width:49%;}
div.sales_day div input.date{border:1px solid #ccc;border-radius:3px; height:40px; line-height:40px; font-size:14px;color:#555;width:100%; text-indent:10px;box-sizing:border-box; background:url("/img/mobile/bg/bg_calendar_date.png") right 0 no-repeat; background-size:40px;}
div.sales_day div input.readonly{background:#f6f6f6}
div.btn_area {margin-top:10px;}

div.sales_total {background:#fff; margin-bottom:20px;}
div.sales_total table.sales_table { width:100%; margin:0; border:0; }
div.sales_total table.sales_table tr th, table.sales_table tr td { text-align:center; vertical-align:middle; border:0;  word-break:break-all; font-size:12px;  }
div.sales_total table.sales_table tr th { font-weight:bold;  color:#999999}
div.sales_total table.sales_table thead tr th { background:#444444; color:#fff; padding:4px 0}
div.sales_total table.sales_table tr th {}
div.sales_total table.sales_table tr td { color:#6e6e6e; }
div.sales_total table.sales_table tr td.money { padding-right:15px; text-align:right; }
div.sales_total table.sales_table tr td.content { padding:0 15px; text-align:left; font-size:11px; color:#6e6e6e; }
div.sales_total table.sales_table tr td.no_data { padding:25px 0; }
div.sales_total table.sales_table tr td a { font-weight:bold; color:#3d3d3d; }
div.sales_total table.sales_table tr td strong { font-weight:bold; color:#3d3d3d; }
div.sales_total table.sales_table tfoot {border-top:solid 2px #f6f6f6; }
div.sales_total table.sales_table tfoot tr th, table tfoot tr td { background:#fff; font-weight:bold; }
div.sales_total table.sales_table tfoot tr td {color:#f06e58;}

div.sales_list {background:#fff; font-size:12px;box-sizing:border-box; }
div.sales_list > ul > li {padding:0 10px;  border-bottom:solid 4px #f6f6f6;  }
div.sales_area {position:relative;  padding:20px 0 }
div.sales_area p.data {position:absolute; top:20px; }
div.sales_area p.service {text-align:right; padding-bottom:10px; padding-left:80px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}

div.sales_list div.sales_area:after { clear:both; display:block; content:""; }
div.sales_left {width:50%; float:left; box-sizing: border-box; border-right:1px #ebebeb solid}
div.sales_left ul li {position:relative; padding-right:20px; text-align:right; line-height:18px;}
div.sales_left ul li em {position:absolute; top:0; left:0; line-height:18px;color:#999999; }
div.sales_right {width:50%; float:right;  box-sizing: border-box;}
div.sales_right ul li {position:relative;  padding-left:20px; text-align:right; line-height:18px;}
div.sales_right ul li.icon {line-height:20px;}
div.sales_right ul li:first-child {padding-bottom:8px; }
div.sales_right ul li em {position:absolute; top:0; left:20px; line-height:18px;color:#999999; }
div.sales_right ul li.icon em {padding:0 4px; border-radius:10px; background:#58585a; color:#fff; }

div.sales_right ul li strong {font-size:14px; color:#f06e58;}

li.no_data {line-height:60px; text-align:center; }
</style>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.sales_page_form, function() { 
		
		});
	});
});
//]]>
</script>

<div id="container" class="container">
	<div class="sales">
		<div class="sales_day">
			<form name="search_form" method="get" action="../reserve/sales_list.html" onsubmit="return submitSearchForm(this)">
			<input type="hidden" name="sch_date_type" value="<?=$sch_date_type?>" />
			<span class="tit"><i class="xi-calendar"></i> 검색일자</span>
			<div>
				<ul>
				<li><div><input type="date" name="sch_s_date" class="date required" value="<?=$sch_s_date?>" placeholder="날짜선택" title="검색시작일" /></div></li>
				<li><div><input type="date" name="sch_e_date" class="date required" value="<?=$sch_e_date?>" placeholder="날짜선택" title="검색시작일" /></div></li>
				</ul>
			</div>
			<div class="btn_area">
				<button type="submit" class="btn_orange">검색</button>
			</div>
			</form>
		</div>

		<div class="sales_total">
			<table class="sales_table" border="1">
			<colgroup>
			<col width="25%">
			<col width="25%">
			<col width="25%">
			<col width="25%">
			</colgroup>
			<thead>
			<tr>
				<th>구분</th>
				<th>일반고객</th>			
				<th>예약고객</th>
				<th>합계</th>	
			</tr>
			</thead>		
			<tbody>		
			<tr>		
				<th>건수</th>
				<td><?=getWithoutNull(number_format($sales['S']['cnt_total'] + $sales['M']['cnt_total']))?></td>			
				<td><?=getWithoutNull(number_format($sales['U']['cnt_total']))?></td>
				<td><?=getWithoutNull(number_format($sales['S']['cnt_total'] + $sales['M']['cnt_total'] + $sales['U']['cnt_total'] + $sales['A']['cnt_total']))?></td>
			</tr>
			<tr>		
				<th>카드</th>
				<td class="money"><?=getWithoutNull(number_format($sales['S']['card_price'] + $sales['M']['card_price']))?></td>			
				<td class="money"><?=getWithoutNull(number_format($sales['U']['card_price']))?></td>
				<td class="money"><?=getWithoutNull(number_format($sales['S']['card_price'] + $sales['M']['card_price'] + $sales['U']['card_price'] + $sales['A']['card_price']))?></td>
			</tr>
			<tr>		
				<th>현금</th>
				<td class="money"><?=getWithoutNull(number_format($sales['S']['cash_price'] + $sales['M']['cash_price']))?></td>			
				<td class="money"><?=getWithoutNull(number_format($sales['U']['cash_price']))?></td>
				<td class="money"><?=getWithoutNull(number_format($sales['S']['cash_price'] + $sales['M']['cash_price'] + $sales['U']['cash_price'] + $sales['A']['cash_price']))?></td>
			</tr>
			<tr>		
				<th>할인</th>
				<td class="money"><?=getWithoutNull(number_format($sales['S']['sale_price'] + $sales['M']['sale_price']))?></td>			
				<td class="money"><?=getWithoutNull(number_format($sales['U']['sale_price']))?></td>
				<td class="money"><?=getWithoutNull(number_format($sales['S']['sale_price'] + $sales['M']['sale_price'] + $sales['U']['sale_price'] + $sales['A']['sale_price']))?></td>
			</tr>
			</tbody>
			<tfoot>
			<tr>		
				<th>매출액</th>
				<td class="money"><?=getWithoutNull(number_format($sales['S']['total_price'] + $sales['M']['total_price']))?></td>			
				<td class="money"><?=getWithoutNull(number_format($sales['U']['total_price']))?></td>
				<td class="money"><?=getWithoutNull(number_format($sales['S']['total_price'] + $sales['M']['total_price'] + $sales['U']['total_price'] + $sales['A']['total_price']))?></td>
			</tr>
			</tfoot>
			</table>
		</div>

		<div class="sales_list">
			<h4></h4>
			<ul id="sales_list">
			<? include_once(_MODULE_PATH_.'/reserve/staff/ajax.sales_list.php'); ?>
			</ul>

		</div>

	</div>

</div>

<form name="sales_page_form" method="get" action="../reserve/ajax.sales_list.html" target="#sales_list">
<input type="hidden" name="flag_json"			value="1" />
<input type="hidden" name="is_load"				value="" />
<input type="hidden" name="page"				value="2" />
<input type="hidden" name="list_mode"			value="<?=$list_mode?>" />
<input type="hidden" name="sch_date_type"		value="<?=$sch_date_type?>" />
<input type="hidden" name="sch_s_date"			value="<?=$sch_s_date?>" />
<input type="hidden" name="sch_e_date"			value="<?=$sch_e_date?>" />
</form>
