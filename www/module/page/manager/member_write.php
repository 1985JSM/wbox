<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'small';
$doc_title = '고객관리';
?>


<!-- <?=$module?> -->
<div id="<?=$module?>">

	<div class="write">

		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>

		<!-- 예약박스를 통해 가입한 고객 -->
		<fieldset>
		<legend>등록/수정</legend>	
		<h4>기본사항</h4>
		<p>- 예약박스에서 가입한 고객의 기본 사항은 변경할 수 없습니다.</p>
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>이름</th>
			<td colspan="3">
				홍길동
			</td>
		</tr>		
		</tr>
		<tr>
			<th>이메일</th>
			<td colspan="3">
				smile@inplusweb.com
			</td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td colspan="3">
				01030775530
			</td>
		</tr>
		<tr>
			<th>닉네임</th>
			<td colspan="3">
				닉네임은 열글자까지
			</td>
		</tr>
		<tr>
			<th>지역</th>
			<td>
				울산광역시			
			</td>	
			<th>생년월일/성별</th>
			<td>
				1988년 11월 22일 (양력) / 남자
			</td>
		</tr>
		<tr>
			<th>가입일</th>
			<td colspan="3">
				2016-05-01 16:21:45
			</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<fieldset class="etc">
		<legend>등록/수정</legend>	
		<h4>고객관리정보</h4>
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>담당자</th>
			<td>			
				<select name="sch_type" class="select" title="담당자">
				<option value="">전체</option>
				<option value="">전지현</option>
				<option value="">김태희</option>
				<option value="">김하늘</option>
				</select>	
			</td>
		</tr>
		<tr>
			<th>가맹점등급</th>
			<td>			
				<select name="sch_cnt_rows" class="select order_select" title="가맹점등급">
				<option value="">일반</option>
				<option value="">브론즈</option>
				<option value="">실버</option>
				<option value="">골드</option>
				<option value="">vip</option>
				</select>
				<span class="comment">- 가맹점에서 관리하는 고객 등급입니다.</span>
			</td>
		</tr>
		<tr>
			<th>회원등급</th>
			<td>
				브론즈
				<span class="comment">- 예약박스에서 관리하는 고객 등급입니다. 예약박스에서 관리하는 등급은 변경할 수 없습니다.</span>
			</td>
		</tr>		
		<tr>
			<th>관리자메모</th>
			<td>
				<textarea name="" class="textarea" rows="5" cols="100" title="관리자메모"></textarea>
				<br />
				<span class="comment">- 가맹점에서 관리하는 고객 관리 메모입니다. 관리자 메모는 회원에게 노출되지 않습니다. </span>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>	

		<fieldset class="etc">	
		<h4>이용내역</h4>	
		<table class="list_table border" border="1">
		<colgroup>
		<col width="*" />		
		<col width="105px" />
		<col width="105px" />
		<col width="105px" />
		<col width="120px" />
		<col width="120px" />
		<col width="120px" />
		<col width="120px" />
		</colgroup>
		<thead>
		<tr>
			<th colspan="4">예약내역</th>
			<th colspan="5">결제내역</th>
		  </tr>
        <tr>
			<th>전체</th>
			<th>완료</th>
			<th>정상취소</th>
			<th>비정상취소</th>
			<th>카드</th>
			<th>현금</th>
			<th>할인</th>
			<th>쿠폰</th>
			<th>선불제</th>
		  </tr>
		</thead>
		<tbody>		
		<tr>		
			<td><strong class="primary">25건</strong></td>
			<td><strong>20</strong>건</td>
			<td><strong>3</strong>건</td>
			<td><strong>2</strong>건</td>
			<td><strong class="info">2</strong>회<br />(1,000,000원)</td>
			<td><strong class="info">2</strong>회<br />(1,000,000원)</td>
			<td><strong class="info">1</strong>회<br />(1,000원)</td>
			<td><strong class="info">0</strong>회<br />(-)</td><!-- 금액이 들어가는 경우 (0,000 원) -->
			<td><strong class="info">5</strong>회</td>
		  </tr>
		</tbody>
		</table>
		</fieldset>	


		<fieldset class="etc">	
		<div>
			<!-- list_top -->
			<div class="list_top">
				<div class="left">
					<strong>선불제</strong>
				</div>
				<div class="right">
					<button type="button" onclick="" class="sButton tiny info">선불제 신규 등록</button>				
				</div>
			</div>
			<!-- list_top -->
			<table class="list_table border" border="1">
			<colgroup>
			<col width="100px" />
			<col width="*" />
			<col width="100px" />
			<col width="100px" />		
			<col width="100px" />
			<col width="100px" />
			<col width="100px" />
			</colgroup>
			<thead>
			<tr>
				<th>등록일</th>
				<th>선불제명</th>
				<th>결제</th>
				<th>잔여금액(원)</th>
				<th>잔여이용(회)</th>
				<th>만료기간</th>
				<th>관리</th>
			</tr>
			</thead>
			<tbody>
			<tr>	
				<td>2016.05.26</td>
				<td>정액제 선불 상품명</td>
				<td>현금</td>
				<td><span class="primary">300,000</span></td>
				<td>-</td>
				<td>-</td>
				<td><a href="" class="sButton tiny">삭제</a></td><!-- 삭제를 누르면 alert : 삭제시 매출내역의 해당 선불제 내역이 삭제됩니다. 삭제하시겠습니까? -->
			</tr>
			<tr>		
				<td>2016.05.25</td>
				<td>이용횟수 선불 상품명</td>
				<td>현금</td>
				<td>-</td>
				<td><strong class="primary">3</strong> / 10</td>
				<td>-</td>
				<td><a href="" class="sButton tiny">삭제</a></td>
			</tr>
			<tr>	
				<td>2016.05.24</td>
				<td>기간제 선불 상품</td>
				<td>카드</td>
				<td>-</td>
				<td>-</td>
				<td><span class="primary">2016.05.01</span></td>
				<td><a href="" class="sButton tiny">삭제</a></td>
			</tr>
			</tbody>
			</table>

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
		</fieldset>	

		<fieldset class="etc">	
		<div>
			<h4>예약리스트</h4>
			<table class="list_table border" border="1">
			<colgroup>
			<col width="100px" />
			<col width="350px" />		
			<col width="120px" />
			<col width="80px" />
			<col width="*" />
			<col width="80px" />
			</colgroup>
			<thead>
			<tr>
				<th>예약일</th>
				<th>서비스</th>			
				<th>담당자</th>			
				<th>상태</th>
				<th>요청사항</th>
				<th>상세정보</th>
			</tr>
			</thead>
			<tbody>
			<tr class="list_tr_1">		
				<td>2016-05-28</td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>Basic Nail (60분)</li>
						<li>Basic Nail (60분)</li>
						<li>Basic Nail (60분)</li>
						</ul>
					</div>
				</td>
				<td>지은</td>
				<td class="state_W">신청중</td>
				<td class="content">요청사항내용이 들어갑니다. 고객이 이런 요청사항 내용을 작성하였습니다. 고객이 예약시 작성한 글이 들어가게됩니다.</td>
				<td><a href="" class="sButton tiny">확인</a></td>
			</tr>
			
			<tr class="list_tr_0">		
				<td>2016-05-28</td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>Basic Nail (60분)</li>
						</ul>
					</div>
				</td>
				<td>지은</td>
				<td class="state_E">완료</td>
				<td class="left">-</td>
				<td><a href="" class="sButton tiny">확인</a></td>
			</tr>
			</tbody>
			</table>	

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
		</fieldset>	

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="#" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="삭제">삭제</a><!-- 삭제시 : 고객정보 삭제시 해당 내용 복원이 불가능합니다. 삭제하시겠습니까? -->
			<!-- 삭제는 가맹점이 직접 등록한 회원만 가능 -->
		</p>
		<!-- //예약박스를 통해 가입한 고객 -->


		<!-- 고객등록을 통해 가입한 고객  -->
		<fieldset>
		<legend>등록/수정</legend>	
		<h4>기본사항</h4>
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th class="required">이름</th>
			<td colspan="3">			
				<input type="text" name="" id="" value="" class="text required" size="30" maxlength="20" title="이름" />
			</td>
		</tr>		
		</tr>
		<tr>
			<th>이메일</th>
			<td colspan="3">
				<input type="text" name="" id="" value="" class="text required" size="50" maxlength="50" title="이메일" />
			</td>
		</tr>
		<tr>
			<th class="required">휴대폰</th>
			<td colspan="3">
				<input type="text" name="" id="" value="0102345678" class="text required" size="30" maxlength="20" title="휴대폰" />
			</td>
		</tr>
		<tr>
			<th>닉네임</th>
			<td colspan="3">
				<input type="text" name="" id="" value="닉네임은열글자까지" class="text required" size="20" maxlength="10" title="닉네임" />
			</td>
		</tr>
		<tr>
			<th>지역</th>
			<td>
				<select name="sch_type" class="select" title="지역선택">
				<option value="">울산광역시</option>
				</select>				
			</td>	
			<th>생년월일/성별</th>
			<td>
				<input type="text" name="sch_s_date" id="sch_s_date" value="" class="text date" size="12" maxlength="10" title="생년월일" />
				<select name="sch_type" class="select" title="음력/양력">
				<option value="">양력</option>
				<option value="">음력</option>
				</select>
				<input type="radio" name="" value=""/> <label>남자</label>
				<input type="radio" name="" value=""/> <label>여자</label>
			</td>
		</tr>
		<tr>
			<th>등록일</th>
			<td colspan="3">
				2016-05-01 16:21:45
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<fieldset class="etc">
		<legend>등록/수정</legend>	
		<h4>고객관리정보</h4>
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>담당자</th>
			<td>			
				<select name="sch_type" class="select" title="담당자">
				<option value="">전체</option>
				<option value="">전지현</option>
				<option value="">김태희</option>
				<option value="">김하늘</option>
				</select>	
			</td>
		</tr>
		<tr>
			<th>가맹점등급</th>
			<td>			
				<select name="sch_cnt_rows" class="select order_select" title="가맹점등급">
				<option value="">일반</option>
				<option value="">브론즈</option>
				<option value="">실버</option>
				<option value="">골드</option>
				<option value="">vip</option>
				</select>
				<span class="comment">- 가맹점에서 관리하는 고객 등급입니다.</span>
			</td>
		</tr>
		
		<tr>
			<th>관리자메모</th>
			<td>
				<textarea name="" class="textarea" rows="5" cols="80" title="관리자메모"></textarea>
				<br />
				<span class="comment">- 가맹점에서 관리하는 고객 관리 메모입니다. 관리자 메모는 회원에게 노출되지 않습니다. </span>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>	

		<fieldset class="etc">	
		<h4>이용내역</h4>	
		<table class="list_table border" border="1">
		<colgroup>
		<col width="*" />		
		<col width="105px" />
		<col width="105px" />
		<col width="105px" />
		<col width="120px" />
		<col width="120px" />
		<col width="120px" />
		<col width="120px" />
		</colgroup>
		<thead>
		<tr>
			<th colspan="4">예약내역</th>
			<th colspan="5">결제내역</th>
		  </tr>
        <tr>
			<th>전체</th>
			<th>완료</th>
			<th>정상취소</th>
			<th>비정상취소</th>
			<th>카드</th>
			<th>현금</th>
			<th>할인</th>
			<th>쿠폰</th>
			<th>선불제</th>
		  </tr>
		</thead>
		<tbody>		
		<tr>		
			<td><strong class="primary">25건</strong></td>
			<td><strong>20</strong>건</td>
			<td><strong>3</strong>건</td>
			<td><strong>2</strong>건</td>
			<td><strong class="info">2</strong>회<br />(1,000,000원)</td>
			<td><strong class="info">2</strong>회<br />(1,000,000원)</td>
			<td><strong class="info">1</strong>회<br />(1,000원)</td>
			<td><strong class="info">0</strong>회<br />(-)</td><!-- 금액이 들어가는 경우 (0,000 원) -->
			<td><strong class="info">5</strong>회</td>
		  </tr>
		</tbody>
		</table>
		</fieldset>	


		<fieldset class="etc">	
		<div>
			<!-- list_top -->
			<div class="list_top">
				<div class="left">
					<strong>선불제</strong>
				</div>
				<div class="right">
					<button type="button" onclick="" class="sButton tiny info">선불제 신규 등록</button>				
				</div>
			</div>
			<!-- list_top -->
			<table class="list_table border" border="1">
			<colgroup>
			<col width="100px" />
			<col width="*" />
			<col width="100px" />
			<col width="100px" />		
			<col width="100px" />
			<col width="100px" />
			<col width="100px" />
			</colgroup>
			<thead>
			<tr>
				<th>등록일</th>
				<th>선불제명</th>
				<th>결제</th>
				<th>잔여금액(원)</th>
				<th>잔여이용(회)</th>
				<th>만료기간</th>
				<th>관리</th>
			</tr>
			</thead>
			<tbody>
			<tr>	
				<td>2016.05.26</td>
				<td>정액제 선불 상품명</td>
				<td>현금</td>
				<td><span class="primary">300,000</span></td>
				<td>-</td>
				<td>-</td>
				<td><a href="" class="sButton tiny">삭제</a></td><!-- 삭제를 누르면 alert : 삭제시 매출내역의 해당 선불제 내역이 삭제됩니다. 삭제하시겠습니까? -->
			</tr>
			<tr>		
				<td>2016.05.25</td>
				<td>이용횟수 선불 상품명</td>
				<td>현금</td>
				<td>-</td>
				<td><strong class="primary">3</strong> / 10</td>
				<td>-</td>
				<td><a href="" class="sButton tiny">삭제</a></td>
			</tr>
			<tr>	
				<td>2016.05.24</td>
				<td>기간제 선불 상품</td>
				<td>카드</td>
				<td>-</td>
				<td>-</td>
				<td><span class="primary">2016.05.01</span></td>
				<td><a href="" class="sButton tiny">삭제</a></td>
			</tr>
			</tbody>
			</table>

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
		</fieldset>	

		<fieldset class="etc">	
		<div>
			<h4>예약리스트</h4>
			<table class="list_table border" border="1">
			<colgroup>
			<col width="100px" />
			<col width="350px" />		
			<col width="120px" />
			<col width="80px" />
			<col width="*" />
			<col width="80px" />
			</colgroup>
			<thead>
			<tr>
				<th>예약일</th>
				<th>서비스</th>			
				<th>담당자</th>			
				<th>상태</th>
				<th>요청사항</th>
				<th>상세정보</th>
			</tr>
			</thead>
			<tbody>
			<tr class="list_tr_1">		
				<td>2016-05-28</td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>Basic Nail (60분)</li>
						<li>Basic Nail (60분)</li>
						<li>Basic Nail (60분)</li>
						</ul>
					</div>
				</td>
				<td>지은</td>
				<td class="state_W">신청중</td>
				<td class="content">요청사항내용이 들어갑니다. 고객이 이런 요청사항 내용을 작성하였습니다. 고객이 예약시 작성한 글이 들어가게됩니다.</td>
				<td><a href="" class="sButton tiny">확인</a></td>
			</tr>
			
			<tr class="list_tr_0">		
				<td>2016-05-28</td>
				<td class="no_padding">
					<div class="service_info">
						<ul>
						<li>Basic Nail (60분)</li>
						</ul>
					</div>
				</td>
				<td>지은</td>
				<td class="state_E">완료</td>
				<td class="left">-</td>
				<td><a href="" class="sButton tiny">확인</a></td>
			</tr>
			</tbody>
			</table>	

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
		</fieldset>	

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="#" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="삭제">삭제</a><!-- 삭제시 : 고객정보 삭제시 해당 내용 복원이 불가능합니다. 삭제하시겠습니까? -->
			<!-- 삭제는 가맹점이 직접 등록한 회원만 가능 -->
		</p>
		<!-- //고객등록을 통해 가입한 고객 -->

		</form>
	</div>
</div>
<!-- //<?=$module?> -->

<!-- 선불제 신규등록 팝업 -->
<div id="layer_popup" style="width: 800px; height: 350px; margin-top: -175px; margin-left: -400px; display:none;">
	<div id="layer_header">
		<h1>선불제 신규 등록</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="/img/common/btn_close_layer.gif" alt="X"></button>
	</div>

	<div id="layer_content" style="height: 250px;">
		<form name="" method="" action="">
		<table class="write_table" border="1">
		<colgroup>
		<col width="140">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th>선불제선택</th>
			<td>
				<select name="" class="select order_select" title="서비스선택">
				<option value="">서비스 선택</option>
				<option value="">정액제 선불 상품명</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>결제수단</th>
			<td>
				<select name="" class="select order_select" title="결제수단선택">
				<option value="">카드</option>
				<option value="">현금</option>
				</select>
			</td>
		</tr>
		</tbody>
		</table>

		<p class="button">
			<button type="submit" class="sButton primary">등록</button>
			<a href="#" class="sButton active" title="목록">닫기</a>	
		</p>

		<form>
		
	</div>	
</div>
<!-- //선불제 신규등록 팝업 -->


<!-- 예약리스트 -->
<div id="layer_popup" style="width: 800px; height: 600px; margin-top: -300px; margin-left: -400px; display:block;">
	<div id="layer_header">
		<h1>예약정보</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="/img/common/btn_close_layer.gif" alt="X"></button>
	</div>

	<div id="layer_content" style="height:500px;">
		<p class="primary help">* 예약 상태 및 예약 변경은 <strong>예약캘린더</strong>에서 이용하실 수 있습니다.</p>
		<form name="" method="" action="">
		<table class="write_table" border="1">
		<colgroup>
		<col width="140">
		<col width="*">
		<col width="140">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th>이름(휴대폰)</th>
			<td>홍길동 (01012345678)</td>
			<th>담당자</th>
			<td>아르미 네일아티스트</td>
		</tr>
		<tr>
			<th>서비스</th>
			<td colspan="3">
				<div class="service_info">
					<ul>
					<li>Basic Nail (60분)</li>
					<li>Basic Nail (60분)</li>
					<li>Basic Nail (60분)</li>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			<th>소요시간</th>
			<td>180분</td>
			<th>상태</th>
			<td class="state_W">신청중</td>
		</tr>
		<tr>
			<th>예약일시</th>
			<td>2016-05-27 21:00</td>
			<th>담당자승인</th>
			<td>-</td>
		</tr>
		<tr>
			<th>예약확정</th>
			<td>-</td>
			<th>취소일시</th>
			<td>-</td>
		</tr>
		<tr>
			<th>요청사항</th>
			<td colspan="3">요청사항내용이 들어갑니다. 고객이 이런 요청사항 내용을 작성하였습니다. 고객이 예약시 작성한 글이 들어가게됩니다.</td>
		</tr>
		</tbody>
		</table>

		<p class="button">
			<button type="submit" class="sButton primary">등록</button>
			<a href="#" class="sButton active" title="목록">닫기</a>	
		</p>

		<form>
		
	</div>	
</div>
<!-- //예약리스트 -->