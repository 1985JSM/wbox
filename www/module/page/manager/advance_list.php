<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '선불제관리';
?>



<!-- <?=$module?> -->
<div id="<?=$module?>">


	<!-- search -->
	<!--div class="search">
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
			<th>가입일</th>
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
			<th>가맹점등급</th>
			<td>
				<select name="sch_type" class="select" title="등급 검색">
				<option value="">전체</option>
				<option value="">일반</option>
				<option value="">브론즈</option>
				<option value="">실버</option>
				<option value="">골드</option>
				<option value="">브론즈</option>
				</select>	
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
		<tr>
			<th>검색어</th>
			<td>
				<select name="sch_type" class="select" title="검색필드">
				<option value="a.mb_name">이름</option>
				<option value="a.mb_email">이메일</option>
				<option value="a.mb_hp">휴대폰</option>
				</select>	
				<input type="text" name="sch_keyword" value="" class="text" size="30" maxlength="30" title="검색어" />				
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
	</div-->
	<!-- //search -->

	<!-- list_top -->
	<div class="list_top">
		<div class="left">
			Total : <strong><?=number_format($total_cnt)?></strong> 건, 현재 : <strong><?=number_format($page)?></strong> 페이지
		</div>
		<div class="right">
			<!--strong>*출력옵션 : </strong>
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
			</select-->
		</div>
	</div>
	<!-- //list_top -->

	<!-- list -->
	<!--div class="list">
		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50px" />
		<col width="250px" />		
		<col width="100px" />
		<col width="100px" />
		<col width="*" />
		<col width="60px" />
		</colgroup>
		<thead>
		<tr>
			<th>No</th>
			<th>서비스명</th>
			<th>구분</th>
			<th>금액</th>
			<th>메모</th>
			<th>수정</th>
		</tr>
		</thead>
		<tbody>
		<tr class="list_tr_1">		
			<td>3</td>
			<td class="subject">선불제서비스이름이들어갑니다.</td>
			<td class="info">정기권<br />(<strong class="info">3개월</strong>)</td>
			<td>300,000원</td>
			<td class="content">300,000원을 250,000원에 판매, 이 상품에 네일, 패디를 제외한 다른 서비스는 미포함사항입니다.</td>
			<td><a href="/webmanager/page/member_write.html" class="sButton tiny " title="수정">수정</a></td>
		</tr>
		<tr class="list_tr_0">		
			<td>2</td>
			<td class="subject">선불제서비스이름이들어갑니다.</td>
			<td class="info">정액권<br />(<strong class="info">250,000원</strong>)</td>
			<td>300,000원</td>
			<td class="content">300,000원을 250,000원에 판매, 이 상품에 네일, 패디를 제외한 다른 서비스는 미포함사항입니다.</td>
			<td><a href="/webmanager/page/member_write.html" class="sButton tiny " title="수정">수정</a></td>
		</tr>
		<tr class="list_tr_1">		
			<td>1</td>
			<td class="subject">선불제서비스이름이들어갑니다.</td>
			<td class="info">이용권<br />(<strong class="info">10회</strong>)</td>
			<td>300,000원</td>
			<td class="content">300,000원을 250,000원에 판매, 이 상품에 네일, 패디를 제외한 다른 서비스는 미포함사항입니다.</td>
			<td><a href="/webmanager/page/member_write.html" class="sButton tiny " title="수정">수정</a></td>
		</tr>
		<tr>
			<td colspan="6" class="no_data">검색 결과가 없습니다.</td>
		</tr>
		</tbody>
		</table>	

		<div class="button">	
			<div class="left">
				
			</div>
			<div class="right">
				<a href="/webmanager/page/member_write.html" class="sButton small primary" title="추가하기">추가하기</a>	
			</div>
		</div>
	

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

	</div-->
	<!-- //list -->

	<!-- list -->
	<div class="list">
		<!-- list_table -->
		<form name="list_form" action="./process.html" method="post" onSubmit="return submitListForm(this)">
		<input type="hidden" name="mode" value="delete" />
		<input type="hidden" name="page" value="1" />
		<input type="hidden" name="query_string" value="" />
		<input type="hidden" name="sv_id" value="" />
		<ul class="preview advance">
		<li>			
			<div class="content">
			<p class="title"> <a href="#">선불제서비스이름이들어갑니다.</a> <a href="#" class="sButton tiny" title="수정">수정</a> </p>
			<strong class="info">정액권(300,000원)</strong></p>
			<strong class="failed">판매금액 250,000원</strong> </p>
			<p class="content">300,000원을 250,000원에 판매, 이 상품에 네일, 패디를 제외한 다른 서비스는 미포함사항입니다.</p>
			</div>
		</li>
		<li>			
			<div class="content">
			<p class="title"> <a href="#">선불제서비스이름이들어갑니다.</a> <a href="#" class="sButton tiny" title="수정">수정</a> </p>
			<strong class="info">이용권(6개월)</strong></p>
			<strong class="failed">판매금액 300,000원</strong> </p>
			<p class="content">300,000원을 250,000원에 판매, 이 상품에 네일, 패디를 제외한 다른 서비스는 미포함사항입니다.</p>
			</div>
		</li>
		<li>			
			<div class="content">
			<p class="title"> <a href="#">선불제서비스이름이들어갑니다.</a> <a href="#" class="sButton tiny" title="수정">수정</a> </p>
			<strong class="info">정기권(6개월)</strong></p>
			<strong class="failed">판매금액 250,000원</strong> </p>
			<p class="content">300,000원을 250,000원에 판매, 이 상품에 네일, 패디를 제외한 다른 서비스는 미포함사항입니다.</p>
			</div>
		</li>
		</ul>

		<div class="button">
			<div class="left"> </div>
			<div class="right"> <a href="/webmanager/page/member_write.html" class="sButton small primary" title="추가하기">추가하기</a> </div>
		</div>
		</form>

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