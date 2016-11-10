<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '푸시메세지 관리';
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
			<th>고객등급</th>
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
	</div-->
	<!-- //search -->

	<!-- list_top -->
	<div class="list_top">
		<div class="left">
			Total : <strong><?=number_format($total_cnt)?></strong> 건
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
		<col width="100" />		
		<col width="150" />
		<col width="300" />
		<col width="*" />
		</colgroup>
		<thead>
		<tr>
			<th>수신자</th>
			<th>구분</th>
			<th>설명</th>
			<th>메세지</th>
			
		</tr>
		</thead>
		<tbody>
		<tr class="list_tr_1">	
			<td>담당자</td>
			<td>예약경과 안내</td>
			<td class="content">사용자가 예약한 일시가 지나간 경우 사용자의 상태변경을 위해 담당자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>

		<tr class="list_tr_0">	
			<td>사용자</td>
			<td>예약변경 안내</td>
			<td class="content">담당자가 예약을 변경한 경우 사용자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>

		<tr class="list_tr_1">		
			<td>사용자</td>
			<td>정상취소 안내</td>
			<td class="content">담당자 또는 가맹점관리자가 사용자 예약을 정상 취소하는 경우 사용자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>

		<tr class="list_tr_0">		
			<td>사용자</td>
			<td>자동취소 안내</td>
			<td class="content">예약일시에 매장을 방문하지 않아 비정상으로 예약이 취소된 경우 사용자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>

		<tr class="list_tr_1">		
			<td>담당자</td>
			<td>예약취소 안내</td>
			<td class="content">사용자가 예약을 취소하는 경우 담당자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>

		<tr class="list_tr_0">		
			<td>담당자</td>
			<td>예약확정 안내</td>
			<td class="content">담당자가 승인해준 예약을 사용자가 예약진행을 하는 경우 담당자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>

		<tr class="list_tr_1">		
			<td>사용자</td>
			<td>예약불가 안내</td>
			<td class="content">사용자의 예약을 담당자가 예약불가를 하는 경우 사용자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>
	
		<tr class="list_tr_0">	
			<td>사용자</td>
			<td>담당자승인 안내</td>
			<td class="content">사용자의 예약을 담당자가 예약확정을 하는 경우 사용자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>

		<tr class="list_tr_1">		
			<td>담당자</td>
			<td>예약신청 안내</td>
			<td class="content">사용자가 예약신청을 하는 경우 담당자에게 발송되는 메세지</td>
			<td><textarea name="" class="textarea" rows="2" cols="60" title="푸쉬메세지"></textarea></td>
		</tr>
		
		</tbody>
		</table>	
		<!-- //list_table -->

		<p class="button">
			<button type="submit" class="sButton primary">저장</button>
		</p>
	

		<!-- pagination -->
		<!--div class="pagination">
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
		</div-->
		<!-- //pagination -->

	</div>
	<!-- //list -->
</div>
<!-- //<?=$module?> -->