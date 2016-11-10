<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '메시지 충전내역';
?>

<style>

</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_payment">
		<!-- search -->
		<div class="search">
			<form name="" method="" onsubmit="">
			<input type="hidden" name="" value="" />

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

					<input type="text" name="sch_s_date" id="sch_s_date" value="<?=$sch_s_date?>" class="text date" size="12" maxlength="10" title="검색 시작일" />
					~
					<input type="text" name="sch_e_date" id="sch_e_date" value="<?=$sch_e_date?>" class="text date" size="12" maxlength="10" title="검색 종료일" />	
					
					<a href="" class="sButton tiny  btn_quick_date">1일</a>
					<a href="" class="sButton tiny  btn_quick_date">7일</a>
					<a href="" class="sButton tiny  btn_quick_date">30일</a>
					<a href="" class="sButton tiny  btn_quick_date">6개월</a>
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
				Total : <strong>51</strong> 건, 현재 : <strong>1</strong> 페이지
			</div>
			<div class="right">
				<strong>*출력옵션 : </strong>
				<select name="sch_cnt_rows" class="select order_select" title="출력개수">
				<option value="1">1개씩</option><option value="10" selected="selected">10개씩</option><option value="20">20개씩</option><option value="30">30개씩</option><option value="50">50개씩</option><option value="100">100개씩</option></select>
			</div>
		</div>
		<!-- //list_top -->

		<!-- list -->
		<table class="list_table border" summary="결제내역에 관련된 표로써 결제일시, 결제번호, 충전건수, 결제수단, 결제상태, 결제금액, 영수증 등 순으로 출력됩니다.">
		<caption>결제내역</caption>
		<colgroup>
		<col width="14%">
		<col width="14%">
		<col width="15%">
		<col width="14%">
		<col width="14%">
		<col width="*">
		<col width="14%">
		</colgroup>
		<thead>
		<tr>
			<th>결제일시</th>
			<th>결제번호</th>
			<th>충전건수</th>
			<th>결제수단</th>
			<th>결제상태</th>
			<th>결제금액</th>
			<th>영수증</th>
		</tr>	
		</thead>
		<tbody>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>55,500</td>
			<td>신용카드</td>
			<td><span class="success">완료</span></td>
			<td><strong>55,500</strong></td>
			<td><a href="#" class="sButton tiny">전표</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>1,000,000</td>
			<td>계좌이체</td>
			<td><span class="failed">환불</span></td>
			<td><strong>100,000</strong></td>
			<td><a href="#" class="sButton tiny">현금영수증</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>55,500</td>
			<td>신용카드</td>
			<td><span class="success">완료</span></td>
			<td><strong>55,500</strong></td>
			<td><a href="#" class="sButton tiny">전표</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>1,000,000</td>
			<td>계좌이체</td>
			<td><span class="failed">환불</span></td>
			<td><strong>100,000</strong></td>
			<td><a href="#" class="sButton tiny">현금영수증</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>55,500</td>
			<td>신용카드</td>
			<td><span class="success">완료</span></td>
			<td><strong>55,500</strong></td>
			<td><a href="#" class="sButton tiny">전표</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>1,000,000</td>
			<td>계좌이체</td>
			<td><span class="failed">환불</span></td>
			<td><strong>100,000</strong></td>
			<td><a href="#" class="sButton tiny">현금영수증</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>55,500</td>
			<td>신용카드</td>
			<td><span class="success">완료</span></td>
			<td><strong>55,500</strong></td>
			<td><a href="#" class="sButton tiny">전표</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>1,000,000</td>
			<td>계좌이체</td>
			<td><span class="failed">환불</span></td>
			<td><strong>100,000</strong></td>
			<td><a href="#" class="sButton tiny">현금영수증</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>55,500</td>
			<td>신용카드</td>
			<td><span class="success">완료</span></td>
			<td><strong>55,500</strong></td>
			<td><a href="#" class="sButton tiny">전표</a></td>
		</tr>
		<tr>
			<td>2016-06-27 12:30</td>
			<td>201606271234</td>
			<td>1,000,000</td>
			<td>계좌이체</td>
			<td><span class="failed">환불</span></td>
			<td><strong>100,000</strong></td>
			<td><a href="#" class="sButton tiny">현금영수증</a></td>
		</tr>					
		</tbody>
		</table>
		<!-- //list -->

		<!-- pagination -->
		<div class="pagination">
			<ul>
			<li class="begin"><a href="#"></a></li>
			<li class="prev"><a href="#"></a></li>
			<li class="on"><a href="" title="1 페이지">1</a></li>
			<li><a href="" title="2 페이지">2</a></li>
			<li><a href="" title="3 페이지">3</a></li>
			<li><a href="" title="4 페이지">4</a></li>
			<li><a href="" title="5 페이지">5</a></li>
			<li class="next"><a href="#"></a></li>
			<li class="end"><a href="#"></a></li>
			</ul>
		</div>
		<!-- //pagination -->					
	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->