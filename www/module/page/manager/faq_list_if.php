<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* set URI */
$layout_size = 'small';
$doc_title = 'FAQ';
?>

<link rel="stylesheet" type="text/css" href="http://smscore.inplus21.com/common/css/ui.css" />
<style>
div.search {margin-top:10px;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

<!-- faq -->
<div id="faq">

	<!-- search -->
	<div class="search">
		<form name="search_form" action="./list.html" method="get" onsubmit="return submitSearchForm(this)">

		<fieldset>
		<legend><i class="xi-magnifier"></i> 검색조건</legend>
		<table class="search_table" border="1">
		<caption>검색조건</caption>
		<colgroup>
		<col width="90" />
		<col width="*" />
		</colgroup>
		<tbody>			
		<tr>
			<th>검색어</th>
			<td>
				<select name="" class="select" title="검색필드">
				<option value="">제목</option>
				<option value="">내용</option>
				<option value="">작성자</option>				
				</select>	
				<input type="text" name="" value="" class="text" size="30" maxlength="30" title="검색어" />				
			</td>
		</tr>	
		<tr>
			<th>분류</th>
			<td>
				<select name="sch_bo_category" class="select" title="분류">
				<option value="">전체</option>
				<option value="01">카테고리1</option>
				<option value="02">카테고리2</option>
				<option value="03">카테고리3</option>
				<option value="04">카테고리4</option>
				<option value="05">카테고리5</option>
				</select>	
			</td>
		</tr>	
		</tbody>
		</table>
		</fieldset>

		<p class="button">		
			<button type="" class="sButton info" title="검색">검 색</button>
			<a href="./list.html" class="sButton" title="초기화">초기화</a>
		</p>
		</form>
	</div>
	<!-- //search -->

	<!-- list_top -->
	<div class="list_top">
		<div class="left">
			Total : <strong>3</strong> 건, 현재 : <strong>1</strong> 페이지
		</div>
		<div class="right">
			
		</div>
	</div>
	<!-- //list_top -->

	<!-- list -->
	<div class="list">

		<form name="list_form" action="" method="" onsubmit="return submitListForm(this)">
		<input type="hidden" name=""	value="" />		
		<input type="hidden" name=""	value="" />
		<input type="hidden" name=""	value="" />

		<!-- list_table -->		
		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="30" />		
		<col width="50" />
		<col width="150" />	
		<col width="*" />
		<col width="100" />						
		<col width="80" />				
		</colgroup>
		<thead>
		<tr>
			<th><input type="checkbox" id="all_check" title="전체선택" /></th>
			<th>No</th>			
			<th>분류</th>	
			<th>제목</th>		
			<th>작성일</th>			
			<th>조회수</th>			
		</tr>
		</thead>
		<tbody>
		<tr class="list_tr_0">	
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>6</td>	
			<td>카테고리1</td>	
			<td class="subject"><a href="faq_view_if.html">크롬에서 상품(콘텐츠) 상세보기 팝업의 내용이 깨져 보여요!</a></td>	
			<td>2016.08.09</td>
			<td>61</td>
		</tr>
		<tr class="list_tr_1">	
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>5</td>	
			<td>카테고리2</td>	
			<td class="subject"><a href="faq_view_if.html">콘텐츠에 사용된 폰트는 어떻게 사용할 수 있나요?</a></td>	
			<td>2016.08.09</td>
			<td>66</td>
		</tr>
		<tr class="list_tr_0">	
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>4</td>	
			<td>카테고리1</td>	
			<td class="subject"><a href="faq_view_if.html">크롬에서 상품(콘텐츠) 상세보기 팝업의 내용이 깨져 보여요!</a></td>	
			<td>2016.08.09</td>
			<td>61</td>
		</tr>
		<tr class="list_tr_1">	
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>3</td>	
			<td>카테고리2</td>	
			<td class="subject"><a href="faq_view_if.html">콘텐츠에 사용된 폰트는 어떻게 사용할 수 있나요?</a></td>	
			<td>2016.08.09</td>
			<td>66</td>
		</tr>
		<tr class="list_tr_0">	
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>2</td>	
			<td>카테고리1</td>	
			<td class="subject"><a href="faq_view_if.html">크롬에서 상품(콘텐츠) 상세보기 팝업의 내용이 깨져 보여요!</a></td>	
			<td>2016.08.09</td>
			<td>61</td>
		</tr>
		<tr class="list_tr_1">	
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>1</td>	
			<td>카테고리2</td>	
			<td class="subject"><a href="faq_view_if.html">콘텐츠에 사용된 폰트는 어떻게 사용할 수 있나요?</a></td>	
			<td>2016.08.09</td>
			<td>66</td>
		</tr>				
		</tbody>
		</table>	

		<div class="button">	
			<div class="left">
				<button type="" class="sButton small" id="btn_delete">선택삭제</button>		
			</div>
			<div class="right">
				<a href="faq_write_if.html" class="sButton small primary" title="등록하기">등록하기</a>	
			</div>
		</div>

		</form>
		
		<!-- pagination -->
		<div class="pagination">
			<ul>
			<li class="on"><a href="?page=1" title="1 페이지">1</a></li>
			<li><a href="?page=2" title="2 페이지">2</a></li>
			</ul>
		</div>
		<!-- //pagination -->

	</div>
	<!-- //list -->

	<form name="category_form" method="" action="">
	<input type="hidden" name="" value="" />
	<input type="hidden" name="" value="" />
	<input type="hidden" name="" value="" />
	<input type="hidden" name="" value="" />
	</form>
</div>
<!-- //faq -->	
	
</div>
<!-- //<?=$module?> -->