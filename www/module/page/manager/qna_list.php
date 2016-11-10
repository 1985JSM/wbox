<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '1:1문의';
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">

<!-- qna -->
<div id="qna">

	<!-- search -->
	<div class="search">
		<form name="search_form" action="" method="" onsubmit="">
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
		<tr>
			<th>답변여부</th>
			<td>
				<select name="" class="select" title="답변여부">
				<option value="">전체</option>
				<option value="Y">답변완료</option>
				<option value="N">답변대기</option>				
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
			Total : <strong>1</strong> 건, 현재 : <strong>1</strong> 페이지
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
			<th>작성자</th>
			<th>작성일</th>
			<th>답변여부</th>
		</tr>
		</thead>
		<tbody>
		<tr class="list_tr_0">		
			<td>
				<input type="checkbox" name="del_uid[]" value="25" class="list_check" title="선택/해제" />
			</td>
			<td>1</td>
			<td class="subject"><a href="qna_view.html">문의사항 있습니다~</a></td>			
			<td>로드네일</td>
			<td>2016.09.26</td>
			<td><strong class="failed">답변대기</strong></td>
		</tr>
		</tbody>
		</table>	

		<div class="button">	
			<div class="left">
				<button type="submit" class="sButton small" title="선택삭제">선택삭제</button>
			</div>
			<div class="right">
				<a href="qna_write.html" class="sButton small primary" title="문의하기">문의하기</a>	
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
<!-- //qna -->	
	
</div>
<!-- //<?=$module?> -->