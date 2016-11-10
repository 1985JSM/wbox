<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'large';
$doc_title = '매출내역';
?>

<style>
div.sale_info {margin-bottom:30px;}
table.sales > tbody > tr > td {padding:14px 0}
table.sales > tbody > tr > td.total {background:#e7faff}
table.sales > tbody > tr > td.sale {background:#ffffdc; color:#999;}
table.sales > tbody > tr > td.prepayment {background:#fde9d9; color:#999;}
table.sales > tbody > tr > td > strong.total {font-size:14px;font-weight:bold;}
table.sales > tbody > tr > td > ul.box {padding:10px 20px; margin-top:10px; border-top:1px dotted #A9A9A9;}
table.sales > tbody > tr > td > ul:after {display:block; content:""; clear:both;}
table.sales > tbody > tr > td > ul.box li:after {display:block; content:""; clear:both;}
table.sales > tbody > tr > td > ul.box li {position:relative; display:block; }
table.sales > tbody > tr > td > ul.box strong {float:left; color:#6e6e6e;}
table.sales > tbody > tr > td > ul.box span {float:right; color:#6e6e6e;}

table.sales > tbody > tr > td.sale > ul.box {height:55px;}
table.sales > tbody > tr > td.sale > ul.box li strong {}

table.sales > tbody > tr > td.prepayment > ul.box {height:55px;}

div.scroll_table {}
div.scroll_table {height:auto; max-height:550px; overflow-x:hidden; overflow-y:scroll;}
div.scroll_table table.list_table {border-top:0;}

</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">


	<!-- search -->
	<div class="search">
		<form name="search_form" method="get" onsubmit="return submitSearchForm(this)">
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
			
				<select name="" class="select" title="">
				<option value="">2016년</option>			
				</select>
				<select name="" class="select" title="">
				<option value="">10월</option>			
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
			<a href="?page=1" class="sButton success" title="엑셀다운">엑셀다운</a>
			<a href="?page=1" class="sButton" title="초기화">초기화</a>
		</p>
		</form>
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
				<strong class="total primary">2,000,000</strong>원
				<ul class="box">
				<li><strong>건수</strong><span>0 건</span></li>
				<li><strong>카드</strong><span>0 원</span></li>
				<li><strong>현금</strong><span>0 원</span></li>
				</ul>   
			</td>
			<td>
				<strong class="total">2,000,000</strong>원
				<ul class="box">
				<li><strong>건수</strong><span>0 건</span></li>
				<li><strong>카드</strong><span>0 원</span></li>
				<li><strong>현금</strong><span>0 원</span></li>
				</ul>   
			</td>
			<td>
				<strong class="total">2,000,000</strong>원
				<ul class="box">
				<li><strong>건수</strong><span>0 건</span></li>
				<li><strong>카드</strong><span>0 원</span></li>
				<li><strong>현금</strong><span>0 원</span></li>
				</ul>   
			</td>
			<td class="sale">
				<strong class="total">2,000,000</strong>원
				<ul class="box">
				<li><strong>건수</strong><span>0 건</span></li>
				</ul>   
			</td>
			<td class="sale">
				<strong class="total">2,000,000</strong>원
				<ul class="box">
				<li><strong>건수</strong><span>0 건</span></li>
				</ul>   
			</td>
			<td class="prepayment">
				<strong class="total">2,000,000</strong>원
				<ul class="box">
				<li><strong>건수</strong><span>0 건</span></li>
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
			<option value="1">1개씩</option>
			<option value="10" selected="selected">10개씩</option>
			<option value="20">20개씩</option>
			<option value="30">30개씩</option>
			<option value="50">50개씩</option>
			<option value="100">100개씩</option>			
			</select>
		</div>
	</div>
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
			<tr class="list_tr_0">		
				<td>10</td>
				<td>2016.09.12</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">홍길동</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>젤네일 (90분)</li>
						<li>발마사지 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny info" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>김장미실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>

			<tr class="list_tr_1">		
				<td>9</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">김영희</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>기본네일 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny info" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>김장미실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>
			<tr class="list_tr_0">		
				<td>8</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">김철수</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>발마사지 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny info" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>오해영 실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>

			<tr class="list_tr_1">		
				<td>7</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">정희정</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>발마사지 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny disabled" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>김장미실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>
			<tr class="list_tr_0">		
				<td>6</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">김혜진</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>기본네일 (30분)</li>
						<li>발마사지 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny info" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>오해영 실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>

			<tr class="list_tr_1">		
				<td>5</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">이성희</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>기본네일 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny disabled" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>김장미실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>
			<tr class="list_tr_0">		
				<td>4</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">김태희</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>기본네일 (30분)</li>
						<li>발마사지 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny info" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>김장미실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>

			<tr class="list_tr_1">		
				<td>3</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">전지현</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>발마사지 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny disabled" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>오해영 실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>
			<tr class="list_tr_0">		
				<td>2</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">김하늘</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>기본네일 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny info" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>김장미실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>

			<tr class="list_tr_1">		
				<td>1</td>
				<td>2016.09.06</td>
				<td><a href="http://wbox.inplus21.com/webmanager/customer/view.html?cs_id=400&page=1" target="_blank">홍길동</a></td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>기본네일 (30분)</li>
						<li>발마사지 (30분)</li>
						</ul>
					</div>		
				</td>
				<td>
					<strong>100,000</strong>					
				</td>
				<td><a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300 sButton tiny disabled" target="#layer_popup" title="관리자메모">비고</a></td>
				<td>김장미실장</td>			
				<td>1,000</td>
				<td>1,000</td>
				<td>-</td>
				<td><strong class="primary txt_total_price">97,000</strong></td>
				<td>90,000</td>
				<td>
					<input type="hidden" name="<?=$pk?>[]" value="<?=$list[$i][$pk]?>" />
					<input type="hidden" name="pm_card_price[]" class="pm_card_price" value="<?=$list[$i]['pm_card_price']?>" />
					<input type="hidden" name="total_price[]" class="total_price" value="<?=$list[$i]['total_price']?>" />
					
					<input type="text" name="pm_cash_price[]" value="<?=number_format($list[$i]['pm_cash_price'])?>" class="text money pm_cash_price" size="10" title="현금결제금액" />
				</td>		
			</tr>
			
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