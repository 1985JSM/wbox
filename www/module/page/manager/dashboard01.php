<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* init Class */
$oPage = new PageManager();
$oPage->init();
$module_name = $oPage->get('module_name');	// 모듈명
?>
<style type="text/css">
/* layout */
html, body { background:gray; }
#dashboard_wrap { position:relative; z-index:0; padding:10px; min-width:1200px; }
#dashboard_header { position:relative; z-index:30; height:50px; padding:15px 30px; line-height:50px; background:yellow; *zoom:1; border-radius:5px; }
#dashboard_header:after { clear:both; display:block; content:""; }
#dashboard_container { position:relative; z-index:0; margin-top:10px; *zoom:1; }
#dashboard_container:after { clear:both; display:block; content:""; }
#dashboard_footer { position:relative; z-index:20; height:60px; margin-top:10px; background:#fff; border:1px solid black; border-radius:5px; }

/* header */
#dashboard_header > h1 { float:left; }
#dashboard_header > h1 > a { display:block; text-indent:-5000px; background:url("./img/h1_logo.gif") 0 0 no-repeat; }
#dashboard_header > #dashboard_util { position:relative; float:right; padding-right:200px; text-align:right;  }
#dashboard_header > #dashboard_util > ul { }
#dashboard_header > #dashboard_util > ul > li { display:inline-block; padding-left:10px; background:url("./img/bl_util.gif") 0 0 no-repeat; color:black; }
#dashboard_header > #dashboard_util > ul > li:first-child { padding-left:25px; background:url("./img/ico_total.gif") 0 0 no-repeat; font-weight:bold; }
#dashboard_header > #dashboard_util > a { position:absolute; top:0; right:0; }

/* aside */
#dashboard_aside { float:right; width:270px; }
#dashboard_aside > ul {}
#dashboard_aside > ul > li { margin-bottom:10px; background:#fff; border:1px solid black; border-radius:5px; }
#dashboard_aside > ul > li > div.dashboard_aside_top { height:50px; line-height:50px; padding:0 20px 0 30px; background:gray; border-bottom:1px solid black; *zoom:1; }
#dashboard_aside > ul > li > div.dashboard_aside_top:after { clear:both; display:block; content:""; }
#dashboard_aside > ul > li > div.dashboard_aside_top > h4 { float:left; padding-left:20px; background:url("./img/ico_person.gif") 0 0 no-repeat; font-weight:bold; color:black; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span { display:block; float:right; padding-left:20px; background:url("./img/ico_clock.gif") 0 0 no-repeat; text-align:right; font-weight:bold; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state01 { color:red; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state02 { color:red; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state03 { color:red; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state04 { color:red; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state05 { color:red; }

#dashboard_aside > ul > li > ul { padding:20px 30px; }
#dashboard_aside > ul > li > ul > li { line-height:2em; color:black; }
#dashboard_aside > ul > li > ul > li > strong { display:inline-block; width:80px; }
#dashboard_aside > ul > li > ul > li > span {}
#dashboard_aside > ul > li > ul > li > span.name { font-weight:bold; }
#dashboard_aside > ul > li > ul > li > span.time { font-weight:bold; }

#dashboard_aside > ul > li > div.dashboard_aside_bottom { height:65px; line-height:65px; border-top:1px dashed gray; text-align:center; }

/* content */
#dashboard_content { margin-right:280px; background:#fff; border:1px solid black; }
#dashboard_content > div.dashboard_content_top { height:50px; padding:0 20px; line-height:50px; border-bottom:1px dashed gray; *zoom:1; }
#dashboard_content > div.dashboard_content_top:after { clear:both; display:block; content:""; }
#dashboard_content > div.dashboard_content_top > div.dashboard_date { float:left; }
#dashboard_content > div.dashboard_content_top > div.dashboard_search { float:right; text-align:right; }

#dashboard_content > div.dashboard_content_sub_top { height:60px; padding:0 20px; line-height:60px; *zoom:1; }
#dashboard_content > div.dashboard_content_sub_top:after { clear:both; display:block; content:""; }
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_type { float:left; }
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_state { float:right; }

/* dashboard_calendar */
#dashboard_calendar { position:relative; z-index:0; }
#dashboard_calendar table.month_table { border-collapse:collapse; table-layout:fixed; border:0; border-top:1px solid black; }
#dashboard_calendar table.month_table tr th { height:40px; line-height:40px; text-align:center; border:0; border-left:1px solid black; background:gray; font-weight:bold; }
#dashboard_calendar table.month_table tr th:first-child { border-left:0; }
#dashboard_calendar table.month_table tr td { height:100px; padding:20px; overflow:hidden; background:#fff; border:0; border-left:1px solid black; border-top:1px solid black; font-weight:bold; }
#dashboard_calendar table.month_table tr > td:first-child { border-left:0; }
#dashboard_calendar table.month_table tr .sun { color:red!important; }
#dashboard_calendar table.month_table tr .sat { color:blue!important; }

/* footer */
#dashboard_footer > p { line-height:60px; padding:0 60px; background:url("./img/ico_monitor.gif") 0 0  no-repeat; color:black; }
#dashboard_footer > p > strong { font-weight:bold; }
</style>
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
			<li>총 : 258건</li>
			<li>총 : 258건</li>
			<li>총 : 258건</li>
			<li>총 : 258건</li>
			<li>총 : 258건</li>
			</ul>

			<a href="#"><img src="" alt="예약등록/비회원" /></a>

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
					<span class="state">대기</span>
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
					<button type="button">예약변경</button>
					<button type="button">예약취소</button>
					<button type="button">예약대기</button>
				</div>
			</li>
			<li>
				<div class="dashboard_aside_top">
					<h4>예약정보확인</h4>
					<span class="state">대기</span>
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
					<button type="button">예약변경</button>
					<button type="button">예약취소</button>
					<button type="button">예약대기</button>
				</div>
			</li>
			<li>
				<div class="dashboard_aside_top">
					<h4>예약정보확인</h4>
					<span class="state">대기</span>
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
					<button type="button">예약변경</button>
					<button type="button">예약취소</button>
					<button type="button">예약대기</button>
				</div>
			</li>
			<li>
				<div class="dashboard_aside_top">
					<h4>예약정보확인</h4>
					<span class="state">대기</span>
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
					<button type="button">예약변경</button>
					<button type="button">예약취소</button>
					<button type="button">예약대기</button>
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
					<a href="">이전달</a>
					<strong>2015.11</strong>
					<a href="">다음달</a>
				</div>

				<div class="dashboard_search">
					<select class="select">
					<option value="">전화번호</option>
					</select>

					<input type="text" class="text" />
					<button type="submit">검색</button>

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
					<a href="">월간</a>
					<a href="">주간</a>
				</div>

				<div class="dashboard_state">
					<span>대기</span>
					<span>진행</span>
					<span>완료</span>
					<span>정상취소</span>
					<span>비정상취소</span>
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
					<td>5</td>
					<td>6</td>
					<td class="sat">7</td>
				</tr>
				<tr>
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
				<tr>
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

			</div>
			<!-- //dashboard_calendar -->

		</div>
		<!-- //dashboard_content -->

	</div>
	<!-- //dashboard_container -->

	<!-- dashboard_footer -->
	<div id="dashboard_footer">
		<p>본 사이트는 <strong>xxxx 해상도</strong>에 최적화 되어 있습니다.</p>
	</div>
	<!-- //dashboard_footer -->

</div>
</body>
</html>