<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* init Class */
$oPage = new PageManager();
$oPage->init();
$module_name = $oPage->get('module_name');	// 모듈명
?>

<link rel="stylesheet" type="text/css" href="/share/css/dashboard.css" />
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>
</head>
<body>

<div id="dashboard_wrap">

	<!-- dashboard_header -->
	<div id="dashboard_header">
		<h1><a href="#">예약박스</a></h1>

		<div id="dashboard_util">
			<ul>
			<li>총 : 258건</li>
			<li>대기 : 258건</li>
			<li>완료 : 258건</li>
			<li>비정상 : 258건</li>
			<li>비회원 : 258건</li>
			<li>비회원 : 258건</li>
			</ul>

			<a href="#"><img src="/img/manager/btn_reserve.gif" alt="예약등록/비회원" /></a>

		</div>

	</div>
	<!-- //dashboard_header -->

	<!-- dashboard_container -->
	<div id="dashboard_container">

		<!-- dashboard_aside -->
		<div id="dashboard_aside">
			<ul>
			<li>
				<div class="dashboard_aside_top">
					<h4>예약정보확인</h4>
					<span class="state01">대기</span>
				</div>

				<ul>
				<li>
					<strong>고객명</strong>
					<span class="name">홍길동</span>
				</li>
				<li>
					<strong>연락처</strong>
					<span>010-1234-5678</span>
				</li>
				<li>
					<strong>담당자</strong>
					<span>진선미 원장</span>
				</li>
				<li>
					<strong>서비스</strong>
					<span>네일케어</span>
				</li>
				<li>
					<strong>예약일시</strong>
					<span class="time">2015.08.07 14:00</span>
				</li>
				<li>
					<strong>소요시간</strong>
					<span>60분</span>
				</li>
				</ul>

				<div class="dashboard_aside_bottom">
					<button type="button" class="state">예약변경</button>
					<button type="button" class="state">예약취소</button>
					<button type="button" class="state01">대기</button>
				</div>
			</li>
			<li>
				<div class="dashboard_aside_top">
					<h4>예약정보확인</h4>
					<span class="state02">완료</span>
				</div>

				<ul>
				<li>
					<strong>고객명</strong>
					<span class="name">홍길동</span>
				</li>
				<li>
					<strong>연락처</strong>
					<span>010-1234-5678</span>
				</li>
				<li>
					<strong>담당자</strong>
					<span>진선미 원장</span>
				</li>
				<li>
					<strong>서비스</strong>
					<span>네일케어</span>
				</li>
				<li>
					<strong>예약일시</strong>
					<span class="time">2015.08.07 14:00</span>
				</li>
				<li>
					<strong>소요시간</strong>
					<span>60분</span>
				</li>
				</ul>

				<div class="dashboard_aside_bottom">
					<button type="button" class="state">예약변경</button>
					<button type="button" class="state02">완료</button>
					<button type="button" class="state03">비정상</button>
				</div>
			</li>
			<li>
				<div class="dashboard_aside_top">
					<h4>예약정보확인</h4>
					<span class="state03">비정상</span>
				</div>

				<ul>
				<li>
					<strong>고객명</strong>
					<span class="name">홍길동</span>
				</li>
				<li>
					<strong>연락처</strong>
					<span>010-1234-5678</span>
				</li>
				<li>
					<strong>담당자</strong>
					<span>진선미 원장</span>
				</li>
				<li>
					<strong>서비스</strong>
					<span>네일케어</span>
				</li>
				<li>
					<strong>예약일시</strong>
					<span class="time">2015.08.07 14:00</span>
				</li>
				<li>
					<strong>소요시간</strong>
					<span>60분</span>
				</li>
				</ul>

				<div class="dashboard_aside_bottom">
					<button type="button" class="state">예약변경</button>
					<button type="button" class="state">예약취소</button>
					<button type="button" class="state04">비회원</button>
				</div>
			</li>
			<li>
				<div class="dashboard_aside_top">
					<h4>예약정보확인</h4>
					<span class="state04">비회원</span>
				</div>

				<ul>
				<li>
					<strong>고객명</strong>
					<span class="name">홍길동</span>
				</li>
				<li>
					<strong>연락처</strong>
					<span>010-1234-5678</span>
				</li>
				<li>
					<strong>담당자</strong>
					<span>진선미 원장</span>
				</li>
				<li>
					<strong>서비스</strong>
					<span>네일케어</span>
				</li>
				<li>
					<strong>예약일시</strong>
					<span class="time">2015.08.07 14:00</span>
				</li>
				<li>
					<strong>소요시간</strong>
					<span>60분</span>
				</li>
				</ul>

				<div class="dashboard_aside_bottom">
					<button type="button" class="state">예약변경</button>
					<button type="button" class="state">예약취소</button>
					<button type="button" class="state05">비정상취소</button>
				</div>
			</li>
			</ul>
		</div>
		<!-- //dashboard_aside -->

		<!-- dashboard_content -->
		<div id="dashboard_content">

			<!-- dashboard_content_top -->
			<div class="dashboard_content_top">
				<div class="dashboard_date">
					<a href="" class="btn_prev_month"><img src="/img/manager/btn_prev.gif" alt="이전달"/></a>
					<strong>2015.11</strong>
					<a href="" class="btn_next_month"><img src="/img/manager/btn_next.gif" alt="다음달"/></a>
				</div>
				<!-- 주간일때 보여지는부분입니다 -->
				<div class="dashboard_notice">
					<a href="" >2015년 11월01일 ~ 11월07일 주간예약내역</a>
					<a href="" ><img src="/img/manager/btn_prev01.gif" alt="이전글"/></a><a href="" ><img src="/img/manager/btn_next01.gif" alt="다음글"/></a>				
				</div>
				<!-- //주간일때 보여지는부분입니다 -->
				<div class="dashboard_search">
					<select class="select">
					<option value="">전화번호</option>
					<option value="">성명</option>
					</select>
					<input name="text" type="text" class="text" title="검색어를 입력하세요." />
					<button type="submit" class="search"><img src="/img/manager/btn_all_search.gif" alt="검색"/> </button>
					<select class="select">
					<option value="">전체일정보기</option>
					<option value="">담당자별보기</option>					
					</select>
				</div>
			</div>
			<!-- //dashboard_content_top -->

			<!-- dashboard_content_top -->
			<div class="dashboard_content_sub_top">
				<div class="dashboard_type">
					<a href="" class="month on">월간</a>
					<a href="" class="week">주간</a>
				</div>

				<div class="dashboard_state">
					<span class="state01">대기</span> 예약대기수
					<span class="state02">진행</span> 정상 종료된 예약
					<span class="state03">완료</span> 비정상 종료된 예약
					<span class="state04">정상취소</span> 비회원 예약건
					<span class="state05">비정상취소</span> 예약대기수
				</div>
			</div>
			<!-- //dashboard_content_top -->

			<!-- dashboard_calendar -->
			<div id="dashboard_calendar">
				<table class="month_table">
				<colgroup>
				<col width="*" />
				<col width="14.28%" />
				<col width="14.28%" />
				<col width="14.28%" />
				<col width="14.28%" />
				<col width="14.28%" />
				<col width="14.28%" />
				</colgroup>
				<thead>
				<tr>
					<th class="sun">일</th>
					<th>월</th>
					<th>화</th>
					<th>수</th>
					<th>목</th>
					<th>금</th>
					<th class="sat">토</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="sun">1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td class="sel">5</td>
					<td class="today">6 
						<div class="content">
							<ul>
								<li class="state02"><a href="#">진행</a></li>
								<li class="state03"><a href="#">완료</a></li>
								<li class="state04"><a href="#">정상취소</a></li>
							</ul>
						</div>
					<td class="sat">7</td>
				</tr>
				<tr class="bg_col">
					<td class="sun">8</td>
					<td>9</td>
					<td>10</td>
					<td>11</td>
					<td>12</td>
					<td>13</td>
					<td class="sat">14</td>
				</tr>
				<tr>
					<td class="sun">15</td>
					<td>16</td>
					<td>17</td>
					<td>18</td>
					<td>19</td>
					<td>20</td>
					<td class="sat">21</td>
				</tr>
				<tr class="bg_color">
					<td class="sun">22</td>
					<td>23</td>
					<td>24</td>
					<td>25</td>
					<td>26</td>
					<td>27</td>
					<td class="sat">28</td>
				</tr>
				<tr>
					<td class="sun">29</td>
					<td>30</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td class="sat">&nbsp;</td>
				</tr>
				</tbody>
				</table>

				<table class="week_table">
				<colgroup>
				<col width="12.5%" />
				<col width="12.5%" />
				<col width="12.5%" />
				<col width="12.5%" />
				<col width="12.5%" />
				<col width="12.5%" />
				<col width="12.5%" />
				<col width="12.5%" />
				</colgroup>
				<thead>
				<tr>
					<th class="title">구분</th>
					<th class="sun">일</th>
					<th>월</th>
					<th>화</th>
					<th>수</th>
					<th>목</th>
					<th>금</th>
					<th class="sat">토</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<div class="time_sell bgc">전지현</div>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<div class="time_sell bge">김태희</div>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>
						<div class="time_sell bgp">김영희</div>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>
						<div class="time_sell bgw">조영원</div>					
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>
									
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>
						<div class="time_sell bgb">홍길동</div>	
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>AM 09:00</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				</tbody>
				</table>

			</div>
			<!-- //dashboard_calendar -->

		</div>
		<!-- //dashboard_content -->

	</div>
	<!-- //dashboard_container -->

	<!-- dashboard_footer -->
	<div id="dashboard_footer">
		<p>본 사이트는 <strong>최소 1300 해상도</strong>에 최적화 되어 있습니다.</p>
	</div>
	<!-- //dashboard_footer -->

</div>
</body>
</html>