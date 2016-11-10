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
<link rel="stylesheet" type="text/css" href="/share/css/dashboard_tablet.css" />
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

		
		<!--h1><a href="./dashboard.html">예약박스</a></h1-->

		<!--div id="dashboard_util">
			<ul>
			<li>총 : <span id="cnt_reserve_total">71</span>건</li>
						<li>신청중 : <span id="cnt_reserve_W">0</span>건</li>
						<li>담당자승인 : <span id="cnt_reserve_A">0</span>건</li>
						<li>진행중 : <span id="cnt_reserve_P">0</span>건</li>
						<li>완료 : <span id="cnt_reserve_E">34</span>건</li>
						<li>정상취소 : <span id="cnt_reserve_C">8</span>건</li>
						<li>비정상취소 : <span id="cnt_reserve_B">29</span>건</li>
						</ul>
			<a href="../customer/ajax.dashboard_list.html?list_mode=month&sch_rs_date=2016-10-06&sch_st_id=" class="btn_ajax size_800x700 btn_reserve" target="#layer_popup" title="고객검색"><img src="/img/manager/btn_reserve.gif" alt="예약등록/비회원" /></a>
			<button type="button" onclick="refreshDashboard()" class="btn_referesh"><img src="/img/manager/btn_referesh.gif" alt="결제" /></button>
		</div-->
	</div>
	<!-- //dashboard_header -->

	<!-- dashboard_container -->
	<div id="dashboard_container">
		
		<!-- dashboard_content -->
		<div id="dashboard_content">			
			<div id="dashboard_content_fix">

				<div id="content_calender">

					<!-- dashboard_content_top -->
					<div class="dashboard_content_top">

						<div class="dashboard_date">							
							<a href="./dashboard.html?list_mode=month&sch_date=2016-09-01&sch_st_id=" class="btn_prev_month"><img src="/img/manager/btn_prev.gif" alt="이전기간"/></a>
							<strong>2016.10</strong>							<a href="./dashboard.html?list_mode=month&sch_date=2016-11-01&sch_st_id=" class="btn_next_month"><img src="/img/manager/btn_next.gif" alt="다음기간"/></a>							
						</div>

						<div class="dashboard_type">
							<!--a href="./dashboard_day.html" class="day">일간</a-->
							<a href="./dashboard.html?list_mode=day&sch_date=2016-10-06&sch_st_id=" class="day">일간</a>
							<a href="./dashboard.html?list_mode=week&sch_date=2016-10-06&sch_st_id=" class="week">주간</a>
							<a href="./dashboard.html?list_mode=month&sch_date=2016-10-06&sch_st_id=" class="month on">월간</a>							
						</div>

						<div class="dashboard_search">
							<form name="search_reserve_form" method="get" action="./ajax.dashboard_list.html" class="size_800x700" target="#layer_popup" onsubmit="return submitSearchReserveForm(this)" title="예약현황">
							<input type="hidden" name="flag_json" value="1" />
							<input type="hidden" name="list_mode" value="month" />
							<select name="sch_type" class="select" title="검색구분">
							<option value="us_name">예약자명</option><option value="us_hp">예약자휴대폰</option>							</select>

							<input type="text" name="sch_keyword" value="" class="text required" maxlength="30" title="검색어" />
							<button type="submit" class="search"><img src="/img/manager/btn_all_search.gif" alt="검색"/> </button>

														<select id="staff_select" class="select">
							<option value="">전체일정보기</option>							<option value="QG10Q0AC7D46">오해영 실장</option><option value="QH08K3GF4F94">김장미 실장</option>					
							</select>
														</form>
						</div>
					</div>
					<!-- //dashboard_content_top -->

					<!-- dashboard_calendar -->
					<div id="dashboard_calendar">
						
<div class="calendar_frame">

	<div class="monthly_calendar">

		<!-- day_week -->
		<div class="day_week">
			<!-- week_title -->
			<div class="week_title">
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
										<th class="sun"><strong>09.04</strong> (일)</th>
										<th class=""><strong>09.05</strong> (월)</th>
										<th class=""><strong>09.06</strong> (화)</th>
										<th class=""><strong>09.07</strong> (수)</th>
										<th class=""><strong>09.08</strong> (목)</th>
										<th class=""><strong>09.09</strong> (금)</th>
										<th class="sat"><strong>09.10</strong> (토)</th>
									</tr>
				</thead>
				</table>
			</div>
			<!-- //week_title -->
		</div>
		<!-- //day_week -->


		<!-- schedule_table -->
		<div class="schedule_table">
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
			
			<tbody>
						<tr>
				
				<td>AM 00:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 00:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 01:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 01:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 02:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 02:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 03:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 03:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 04:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 04:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 05:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 05:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 06:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 06:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 07:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 07:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 08:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 08:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 09:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 09:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 10:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 11:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>AM 11:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 12:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 12:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 13:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 13:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 14:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 14:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 15:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
										<div class="time_cell stateE" style="height:39px">
						<a href="./ajax.dashboard_aside.html?list_mode=week&sch_rs_date=2016-09-07&rs_id=365" class="btn_ajax" style="line-height:39px" target="#reserve_list">김혜수</a>
					</div>
					<!-- 스타일 예제 
					<div class="time_cell stateB" style="100%; z-index:900">
						<a href="#" class="btn_ajax" style="height:80px; z-index:850" target="#reserve_list">홍길동</a>
					</div>
					//스타일 예제 -->


					

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 15:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 16:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 16:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 17:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 17:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 18:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 18:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 19:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 19:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 20:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 20:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 21:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 21:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 22:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 22:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 23:00</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						<tr>
				
				<td>PM 23:30</td>	
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
				
					
				<td>
					&nbsp;

				</td>	
							</tr>
						</tbody>
			</table>
		</div>
		<!-- //schedule_table -->
	
	</div>
	<!-- //monthly_calendar -->


</div>
<!-- //month_frame -->				
					</div>
					<!-- //dashboard_calendar -->
				</div>
				<!-- //content_calender -->
			</div>
			<!-- //dashboard_content_fix -->
		</div>
		<!-- //dashboard_content -->

		<!--div id="dashboard_aside">
			<div  id="reserve_list" class="aside_container">				
							
			</div>
		</div-->

	</div>
	<!-- //dashboard_container -->


</div>
</body>
</html>