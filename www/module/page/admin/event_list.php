<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '이벤트';
?>


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
		<col width="90" />
		<col width="*" />
		<col width="90" />
		<col width="*" />
		</colgroup>
		<tbody>				
		<tr>
			<th>검색어</th>
			<td>
				<select name="sch_type" class="select" title="검색필드">
				<option value="">이름</option>
				<option value="">이메일</option>
				<option value="">휴대폰</option>
				</select>	
				<input type="text" name="sch_keyword" value="" class="text" size="30" maxlength="30" title="검색어" />				
			</td>
		</tr>
		<tr>
			<th>진행여부</th>
			<td>
				<select name="sch_type" class="select" title="검색필드">
				<option value="">전체</option>
				<option value="">진행</option>
				<option value="">종료</option>
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

	<!-- list_top -->
	<div class="list_top">
		<div class="left">
			Total : <strong><?=number_format($total_cnt)?></strong> 건, 현재 : <strong><?=number_format($page)?></strong> 페이지
		</div>
		<div class="right">
		</div>
	</div>
	<!-- //list_top -->

	<!-- list -->
	<div class="list">
		<!-- list_table -->
		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50" />
		<col width="260" />
		<col width="*" />
		<col width="100" />		
		<col width="100" />
		<col width="80" />
		<col width="80" />
		</colgroup>
		<thead>
		<tr>
			<th>no</th>
			<th>이미지</th>
			<th>제목</th>
			<th>시작일</th>
			<th>종료일</th>
			<th>상태</th>
			<th>수정</th>
		</tr>
		</thead>
		<tbody>
		
		<tr class="list_tr_0">		
			<td>1</td>
			<td><img src="/img/mobile/sub/img_event_list.jpg" width="240" height="64" alt="메인이미지샘플" /></td>
			<td class="subject"><a href="#">예약박스와 함께하는 즐거운 이벤트</a></td>
			<td>2016.05.01</td>
			<td>2016.05.30</td>
			<td>종료</td>
			<td><a href="/webadmin/page/mainvisual_write.html" class="sButton tiny " title="수정">수정</a></td>
		</tr>

		<tr class="list_tr_1">		
			<td colspan="7" class="no_data">등록한 내용이 없습니다.</td>
		</tr>
		
		</tbody>
		</table>	
		<!-- //list_table -->

		<div class="button">	
			<div class="left">
			
			</div>
			<div class="right">
				<button type="submit" class="sButton primary" title="추가하기">추가하기</button>
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