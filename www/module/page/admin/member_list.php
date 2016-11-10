<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'large';
$doc_title = '회원관리';
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
			<th>회원등급</th>
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
			<th>상태</th>
			<td>
				<select name="sch_type" class="select" title="상태">
				<option value="">전체</option>
				<option value="">승인</option>
				<option value="">대기</option>
				<option value="">탈퇴</option>
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
	</div>
	<!-- //search -->

	<!-- list_top -->
	<div class="list_top">
		<div class="left">
			Total : <strong><?=number_format($total_cnt)?></strong> 건, 현재 : <strong><?=number_format($page)?></strong> 페이지
		</div>
		<div class="right">
			<strong>*출력옵션 : </strong>
			<select name="" class="select" title="출력순서">
			<option value="">아이디</option>
			<option value="">닉네임</option>
			<option value="">가입일</option>
			<option value="">최근접속일</option>
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
		</div>
	</div>
	<!-- //list_top -->

	<!-- list -->
	<div class="list">
		<!-- list_table -->
		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="50px" />
		<col width="50px" />
		<col width="120px" />		
		<col width="80px" />
		<col width="150px" />
		<col width="*" />
		<col width="120px" />
		<col width="90px" />
		<col width="90px" />
		<col width="80px" />
		<col width="90px" />
		<col width="80px" />
		<col width="80px" />
		<col width="60px" />
		</colgroup>
		<thead>
		<tr>
			<th><input type="checkbox" id="all_check" title="전체선택" /></th>
			<th>No</th>
			<th>이름</th>
			<th>성별</th>
			<th>닉네임</th>
			<th>이메일</th>
			<th>휴대폰</th>
			<th>지역</th>
			<th>회원등급</th>
			<th>상태</th>
			<th>완료예약/<br />종료예약(건)</th>
			<th>가입일</th>
			<th>최근접속일</th>
			<th>수정</th>
		</tr>
		</thead>
		<tbody>
		
		<tr class="list_tr_0">		
			<td><input type="checkbox" name="del_uid[]" value="" class="list_check" title="선택/해제" /></td>
			<td>1</td>
			<td>홍길동</td>
			<td>남자</td>
			<td>닉네임은최대열글자임</td>
			<td>smile@inplusweb.com</td>
			<td>0102345678</td>
			<td>울산광역시</td>
			<td>브론즈</td>	
			<td>승인</td>	
			<td><strong class="primary">1</strong> / 3</td>
			<td>2016.05.01</td>
			<td>2016.05.03</td>
			<td><a href="/webadmin/page/member_write.html" class="sButton tiny " title="수정">수정</a></td>
		</tr>

		<tr class="list_tr_1">		
			<td colspan="14" class="no_data">검색 결과가 없습니다.</td>
		</tr>
		
		</tbody>
		</table>	
		<!-- //list_table -->

		<div class="button">	
			<div class="left">
				<button type="submit" class="sButton small" title="탈퇴처리">탈퇴처리</button>	<!-- 탈퇴처리시 탈퇴회원관리로 이동 -->
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