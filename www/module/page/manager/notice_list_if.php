<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* set URI */
$layout_size = 'small';
$doc_title = '공지사항';
?>

<link rel="stylesheet" type="text/css" href="http://smscore.inplus21.com/common/css/ui.css" />
<style>
div.search {margin-top:10px;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

<!-- notice -->
<div id="notice">

	<!-- search -->
	<div class="search">
		<form name="search_form" action="./list.html" method="get" onsubmit="return submitSearchForm(this)">
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
				<select name="" class="select" title="검색필드">
				<option value="">제목</option>
				<option value="">내용</option>
				<option value="">작성자</option>	
				</select>	
				<input type="text" name="" value="" class="text" size="30" maxlength="30" title="검색어" />				
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
			Total : <strong>3</strong> 건, 현재 : <strong>1</strong> 페이지
		</div>
		<div class="right">
			
		</div>
	</div>
	<!-- //list_top -->

	<!-- list -->
	<div class="list">
		<!-- list_table -->
		<form name="list_form" action="" method="" onsubmit="return submitListForm(this)">
		<input type="hidden" name="" value="" />		
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />

		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50" />
		<col width="50" />
		<col width="*" />		
		<col width="130" />
		</colgroup>
		<thead>
		<tr>
			<th><input type="checkbox" id="all_check" title="전체선택" /></th>
			<th>No</th>
			<th>제목</th>			
			<th>작성일</th>
		</tr>
		</thead>
		<tbody>
		<tr class="list_tr_0">		
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>3</td>
			<td class="subject"><a href="notice_view_if.html">SMS(문자)서비스 안내</a></td>			
			<td>2016.07.28</td>
		</tr>
		<tr class="list_tr_1">		
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>3</td>
			<td class="subject"><a href="notice_view_if.html">클라이언트 2.2.5 버전 출시 안내</a></td>			
			<td>2016.07.28</td>
		</tr>
		<tr class="list_tr_0">		
			<td><input type="checkbox" name="" value="" class="list_check" title="선택/해제" /></td>
			<td>3</td>
			<td class="subject"><a href="notice_view_if.html">2016년 7월 정기 PM 공지</a></td>			
			<td>2016.07.28</td>
		</tr>				
		</tbody>
		</table>	

		<div class="button">	
			<div class="left">
				<button type="" class="sButton small" title="선택삭제">선택삭제</button>
			</div>
			<div class="right">
				<a href="notice_write_if.html" class="sButton small primary" title="등록하기">등록하기</a>	
			</div>
		</div>
		</form>

		<!-- pagination -->
		<div class="pagination">
			<ul>
			<li class="on"><a href="?page=1" title="1 페이지">1</a></li>
			</ul>
		</div>
		<!-- //pagination -->

	</div>
	<!-- //list -->
</div>
<!-- //notice -->	
	
</div>
<!-- //<?=$module?> -->