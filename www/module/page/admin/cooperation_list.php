<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'normal';
$doc_title = '제휴문의';
?>

<style>
a.blog_link {margin-right:40px;}

</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">


	<!-- search -->
	<div class="search">
		<form name="" action="" method="" onsubmit="">
		<input type="hidden" name="" value="" />		
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />

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
			<th>작성일</th>
			<td colspan="3">
				<input type="text" name="sch_s_date" id="sch_s_date" value="" class="text date" size="12" maxlength="10" title="검색 시작일" />
				~
				<input type="text" name="sch_e_date" id="sch_e_date" value="" class="text date" size="12" maxlength="10" title="검색 종료일" />						

				<a href="#" class="sButton tiny btn_quick_date">1일</a>
				<a href="#" class="sButton tiny btn_quick_date">3일</a>
				<a href="#" class="sButton tiny btn_quick_date">7일</a>
				<a href="#" class="sButton tiny btn_quick_date">1개월</a>
				<a href="#" class="sButton tiny active btn_quick_date">전체</a>
			</td>
		</tr>
		<tr>
			<th>검색어</th>
			<td>
				<select name="" class="select" title="검색필드">
				<option value="">이름</option>
				<option value="">업체명</option>
				<option value="">주소</option>
				<option value="">이메일</option>
				<option value="">연락처</option>				
				</select>	
				<input type="text" name="sch_keyword" value="" class="text" size="30" maxlength="30" title="검색어" />
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
			Total : <strong>10</strong> 건, 현재 : <strong>1</strong> 페이지
		</div>
		<div class="right">
			<strong>*출력옵션 : </strong>
			<select name="" class="select order_select" title="정렬순서">
			<option value="">작성일순</option>
			<option value="">작성일역순</option>			
			</select>

			<select name="" class="select order_select" title="출력개수">
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
	<div class="list">
		<!-- list_table -->
		<form name="" action="" method="" onsubmit="">
		<input type="hidden" name="" value="" />		
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />

		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50" />
		<col width="50" />
		<col width="90" />		
		<col width="100" />
		<col width="200" />		
		<col width="200" />
		<col width="*" />
		<col width="90" />		
		<col width="80" />
		</colgroup>
		<thead>
		<tr>
			<th><input type="checkbox" id="all_check" title="전체선택" /></th>
			<th>No</th>
			<th>이름</th>
			<th>연락처</th>
			<th>이메일</th>
			<th>업체명</th>			
			<th>주소</th>			
			<th>작성일</th>
			<th>상세보기</th>
		</tr>
		</thead>
		<tbody>
		<tr class="list_tr_0">		
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>10</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>		
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_1">		
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>9</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>		
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_0">		
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>8</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>	
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_1">
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>7</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>	
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_0">	
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>6</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>			
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_1">	
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>5</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>	
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_0">
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>4</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>	
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_1">	
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>3</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>			
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_0">	
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>2</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>			
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr class="list_tr_1">	
			<td><input type="checkbox" name="" value="" class="" title="선택/해제" /></td>
			<td>1</td>
			<td><a href="#">김은지</a></td>
			<td>01085029990</td>
			<td>smile@inplusweb.com</td>
			<td><a href="#">유니스텔라</a></td>			
			<td>부산광역시 해운대구 우동 마린시티 1로 127 아라트리움 202호</td>		
			<td>2016.05.10</td>			
			<td><a href="#" class="sButton tiny" title="상세보기">상세보기</a></td>
		</tr>
		<tr>
			<td class="no_data" colspan="8">등록 또는 검색된 데이터가 없습니다.</td>
		</tr>
		</tbody>
		</table>	

		<div class="button">	
			<div class="left">
				<button type="submit" class="sButton small" title="선택삭제">선택삭제</button>
			</div>
			<div class="right">
				<a href="./write.html?page=1" class="sButton small confirm" title="추가하기">추가하기</a>	
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
<!-- //<?=$module?> -->