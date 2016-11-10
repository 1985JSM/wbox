<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = 'FAQ';
?>

<style>
a.blog_link {margin-right:40px;}

</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">


	<!-- search -->
	<div class="search">
		<form name="search_form" action="./list.html" method="get" onsubmit="return submitSearchForm(this)">
		<input type="hidden" name="sch_order_field" value="<?=$sch_order_field?>" />
		<input type="hidden" name="sch_order_direct" value="<?=$sch_order_direct?>" />
		<input type="hidden" name="sch_cnt_rows" value="<?=$sch_cnt_rows?>" />

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
				<option value="">제목</option>
				<option value="">내용</option>
				</select>	
				<input type="text" name="sch_keyword" value="" class="text" size="30" maxlength="30" title="검색어" />				
			</td>
		</tr>
		<tr>
			<th>출력구분</th>
			<td>
				<select name="sch_type" class="select" title="출력구분">
				<option value="">전체</option>
				<option value="">가맹점</option>
				<option value="">담당자</option>
				<option value="">사용자</option>
				<option value="">홈페이지</option>
				</select>					
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
			
		</div>
	</div>
	<!-- //list_top -->

	<!-- list -->
	<div class="list">
		<!-- list_table -->
		<form name="list_form" action="" method="" onsubmit="">
		<input type="hidden" name="" value="" />		
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />

		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50" />
		<col width="50" />
		<col width="*" />
		<col width="130" />
		<col width="130" />
		<col width="130" />
		</colgroup>
		<thead>
		<tr>
			<th><input type="checkbox" id="all_check" title="전체선택" /></th>
			<th>No</th>
			<th>제목</th>
			<th>출력구분</th>
			<th>작성자</th>
			<th>작성일</th>
		</tr>
		</thead>
		<tbody>		
		<tr class="list_tr_0">		
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>1</td>
			<td class="subject">제목이들어갑니다.</a></td>
			<td>가홈페이지</td>
			<td>최고관리자</td>
			<td>2016.06.01</td>
		</tr>
		<tr>
			<td class="no_data" colspan="6">등록 또는 검색된 데이터가 없습니다.</td>
		</tr>
		</tbody>
		</table>	

		<div class="button">	
			<div class="left">
				<button type="submit" class="sButton small" title="선택삭제">선택삭제</button>
			</div>
			<div class="right">
				<a href="#" class="sButton small primary" title="추가하기">추가하기</a>	
			</div>
		</div>
		</form>

		<!-- pagination -->
		<div class="pagination">
			<ul>
			<li class="on"><a href="#" title="1 페이지">1</a></li>
			</ul>
		</div>
		<!-- //pagination -->

	</div>
	<!-- //list -->
</div>
<!-- //<?=$module?> -->