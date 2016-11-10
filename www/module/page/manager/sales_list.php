<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'normal';
$doc_title = '매출내역';
?>

<style type="text/css">
div.sale_info {margin-bottom:30px;}
</style>



<!-- <?=$module?> -->
<div id="<?=$module?>">


	<!-- search -->
	<div class="search">
		<form name="search_form" method="get" onsubmit="return submitSearchForm(this)">
		<input type="hidden" name="sch_order_field" value="<?=$sch_order_field?>" />
		<input type="hidden" name="sch_order_direct" value="<?=$sch_order_direct?>" />
		<input type="hidden" name="sch_cnt_rows" value="<?=$sch_cnt_rows?>" />
		<input type="hidden" name="sch_date_type" value="a.rs_date" />

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
			<th>기간</th>
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
			<th>담당자</th>
			<td>
				<select name="sch_type" class="select" title="담당자">
				<option value="">전체</option>
				<option value="">전지현 원장</option>
				<option value="">김태희</option>
				<option value="">김하늘 수습 디자이너</option>
				</select>	
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

	<!-- 매출내역 -->
	<div class="sale_info">
		<table class="list_table border" border="1">
		<colgroup>
		<col width="200px" />
		<col width="200px" />		
		<col width="200px" />
		<col width="200px" />
		<col width="200px" />
		<col width="*" />
		</colgroup>
		<thead>
		<tr>
			<th>구분</th>
			<th>건수</th>
			<th>총 현금금액</th>
			<th>총 카드금액</th>
			<th>총 할인금액</th>
			<th>총 매출액</th>
		</tr>
		</thead>
		<tfoot>
		<tr>
			<th>합계</th>
			<th>352</th>
			<th>1,100,000원</th>
			<th>1,100,000원</th>
			<th>1,05,000원</th>
			<th><strong class="primary">1,000,000원</strong></th>
		</tr>
		</tfoot>
		<tbody>		
		<tr>		
			<td><strong>일반고객</strong></td>
			<td>50</td>
			<td>50,000</td>
			<td>50,000</td>
			<td>50,000</td>
			<td><span class="primary">100,000</span></td>			
		</tr>
		<tr>		
			<td><strong>예약고객</strong></td>
			<td>300</td>
			<td>1,000,000</td>
			<td>1,000,000</td>
			<td>1,000,000</td>
			<td><span class="primary">100,000</span></td>			
		</tr>
		<tr>		
			<td><strong>선불제</strong></td>
			<td>2</td>
			<td>50,000</td>
			<td>50,000</td>
			<td>-</td>
			<td><span class="primary">100,000</span></td>			
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
		<!--div class="right">
			<strong>*출력옵션 : </strong>
			<select name="" class="select" title="출력순서">
			<option value="">아이디</option>
			<option value="">닉네임</option>		
			</select>

			<select name="" class="select" title="정렬방법">
			<option value="">오름차순</option>
			<option value="">내림차순</option>		
			</select>

			<select name="sch_cnt_rows" class="select order_select" title="출력개수">
			<option value="1">1개씩</option>
			<option value="10" selected="selected">10개씩</option>
			<option value="20">20개씩</option>
			<option value="30">30개씩</option>
			<option value="50">50개씩</option>
			<option value="100">100개씩</option>			
			</select>
		</div-->
	</div>
	<!-- //list_top -->

	<!-- list -->
	<div class="list">
		<!-- list_table -->
		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50px" />
		<col width="90px" />		
		<col width="90px" />
		<col width="*" />
		<col width="90px" />
		<col width="90px" />
		<col width="90px" />
		<col width="90px" />
		<col width="90px" />
		<col width="90px" />
		<col width="90px" />
		<col width="90px" />
		</colgroup>
		<thead>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">이용일자</th>
			<th rowspan="2">구분</th>
			<th rowspan="2">서비스명</th>
			<th rowspan="2">서비스금액</th>
			<th rowspan="2">담당자</th>
			<th rowspan="2">일반할인</th>
			<th rowspan="2">쿠폰사용</th>
			<th rowspan="2">선불제사용</th>			
			<th rowspan="2">실제결제<br />금액</th>
			<th colspan="2">실제결제금액 결제수단</th>
		  </tr>
        <tr>	
			<th class="border">카드</th>
			<th>현금</th>
		</tr>
		</thead>
		<tbody>
		
		<tr class="list_tr_0">		
			<td>1</td>
			<td>2015.05.01</td>
			<td>일반고객</td>
			<td class="no_padding">
				<div class="service_info">
					<ul>
					<li>서비스명</li>
					<li>베이직 네일아트</li>
					<li>여성클리닉 케라틴케어(극손상모발용)</li>					
					</ul>
				</div>		
			</td>
			<td><strong>37,000원</strong></td>
			<td>전지현</td>			
			<td>10,000</td>
			<td>-</td>
			<td>2,000원</td>
            <td><strong class="primary">34,000원</strong></td>
			<td>30,000원</td>
			<td>4,000원</td>
		</tr>
		<tr class="list_tr_1">		
			<td>1</td>
			<td>2015.05.01</td>
			<td>선불제</td>
			<td class="no_padding">
				<div class="service_info">
					<ul>
					<li>네일아트10회 이용권</li>					
					</ul>
				</div>		
			</td>
			<td><strong>120,000원</strong></td>
			<td>-</td>			
			<td>-</td>
			<td>-</td>
			<td>-</td>
            <td><strong class="primary">120,000원</strong></td>
			<td>120,000원</td>
			<td>-</td>
		</tr>
		<tr>
			<td colspan="12" class="no_data">검색 결과가 없습니다.</td>
		</tr>
		</tbody>
		</table>	
		<!-- //list_table -->

		<div class="button">	
			<div class="left">
				
			</div>
			<div class="right">
					
			</div>
		</div>
	

		<!-- pagination -->
		<div class="pagination">
			<ul>
			<li class="arrow begin"><a href="?page=1" title="처음 페이지"><i class="xi-angle-double-left"></i></a></li>
			<li class="arrow prev"><a href="?page=1" title="이전 페이지"><i class="xi-angle-left"></i></a></li>
			<li class="on"><a href="?page=1" title="1 페이지">1</a></li>
			<li><a href="?page=2" title="2 페이지">2</a></li>
			<li><a href="?page=3" title="3 페이지">3</a></li>
			<li><a href="?page=4" title="4 페이지">4</a></li>
			<li><a href="?page=5" title="5 페이지">5</a></li>
			<li class="arrow next"><a href="?page=6" title="다음 페이지"><i class="xi-angle-right"></i></a></li>
			<li class="arrow end"><a href="?page=9" title="끝 페이지"><i class="xi-angle-double-right"></i></a></li>
			</ul>
		</div>
		<!-- //pagination -->

	</div>
	<!-- //list -->
</div>
<!-- //<?=$module?> -->