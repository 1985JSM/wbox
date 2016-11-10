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
#dashboard_header { position:relative; z-index:30; height:50px; padding:15px 30px; line-height:50px; background-color:#fedc19; *zoom:1; border-radius:5px; }
#dashboard_header:after { clear:both; display:block; content:""; }
#dashboard_container { position:relative; z-index:0; margin-top:10px; *zoom:1; }
#dashboard_container:after { clear:both; display:block; content:""; }
#dashboard_footer { position:relative; z-index:20; height:60px; margin-top:10px; background:#fff; border:1px solid #969696; border-radius:5px; }

/* header */
#dashboard_header > h1 { float:left; }
#dashboard_header > h1 > a { display:block; margin:7px 0 0 0;  width:111px; height:38px; text-indent:-5000px; background:url("/img/manager/h1_logo.png") 0 0 no-repeat; }
#dashboard_header > #dashboard_util { position:relative; float:right; padding-right:200px; text-align:right;  }
#dashboard_header > #dashboard_util > ul > li { display:inline-block; padding-left:10px; background:url("/img/manager/bl_util.gif") 2px 20px no-repeat; color:black; }
#dashboard_header > #dashboard_util > ul > li:first-child { padding-left:25px; background:url("/img/manager/ico_total.gif") 0 20px no-repeat; font-weight:bold; }
#dashboard_header > #dashboard_util > a { position:absolute; top:0; right:0;}

/* aside */
#dashboard_aside { float:right; width:270px; }
#dashboard_aside > ul {}
#dashboard_aside > ul > li { margin-bottom:10px; background:#fff; border:1px solid #969696; border-radius:5px; }
#dashboard_aside > ul > li > div.dashboard_aside_top { height:50px; line-height:50px; padding:0 20px 0 30px; background-color:#fcfcfc; border-bottom:1px solid #c8c8c8; *zoom:1; }
#dashboard_aside > ul > li > div.dashboard_aside_top:after { clear:both; display:block; content:""; }
#dashboard_aside > ul > li > div.dashboard_aside_top > h4 { float:left; padding-left:20px; background:url("/img/manager/ico_person.gif") 0 18px no-repeat; font-weight:bold; color:black; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span { display:block; float:right; padding-left:20px; background:url("/img/manager/ico_clock.gif") 0 19px no-repeat; text-align:right; font-weight:bold; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state01 { color:#1a9ab1; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state02 { color:#894c9e; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state03 { color:#f68a1f; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state04 { color:#6e6e6e; }
#dashboard_aside > ul > li > div.dashboard_aside_top > span.state05 { color:#538fd4; }

#dashboard_aside > ul > li > ul { padding:20px 30px; }
#dashboard_aside > ul > li > ul > li { line-height:2em; color:black; background:url("/img/manager/bl_dot.gif") 0 10px no-repeat; padding:0 0 0 8px;}
#dashboard_aside > ul > li > ul > li > strong { display:inline-block; width:80px; }
#dashboard_aside > ul > li > ul > li > span {}
#dashboard_aside > ul > li > ul > li > span.name { font-weight:bold; }
#dashboard_aside > ul > li > ul > li > span.time { font-weight:bold; }

#dashboard_aside > ul > li > div.dashboard_aside_bottom { height:65px; line-height:65px; border-top:1px dashed #dcdcdc; text-align:center; }
#dashboard_aside > ul > li > div.dashboard_aside_bottom button.state { z-index:40; background-color: #fcfcfc; border-radius: 5px; height:25px; line-height:25px;border:solid 1px #c8c8c8; position:relative;}
#dashboard_aside > ul > li > div.dashboard_aside_bottom button.state01 { z-index:40; background-color: #1a9ab1; border-radius: 5px; height:25px; line-height:25px;border:solid 1px #128397; position:relative; color:#fff; width:68px;}
#dashboard_aside > ul > li > div.dashboard_aside_bottom button.state02 {z-index:40; background-color: #894c9e; border-radius: 5px; height:25px; line-height:25px;border:solid 1px #6e3881; position:relative; color:#fff; width:68px;}
#dashboard_aside > ul > li > div.dashboard_aside_bottom button.state03 {z-index:40; background-color: #f68a1f; border-radius: 5px; height:25px; line-height:25px;border:solid 1px #d6700b; position:relative; color:#fff; width:68px;}
#dashboard_aside > ul > li > div.dashboard_aside_bottom button.state04 {z-index:40; background-color: #6e6e6e; border-radius: 5px; height:25px; line-height:25px;border:solid 1px #646464; position:relative; color:#fff; width:68px;}
#dashboard_aside > ul > li > div.dashboard_aside_bottom button.state05 {z-index:40; background-color: #538fd4; border-radius: 5px; height:25px; line-height:25px;border:solid 1px #3770b1; position:relative; color:#fff;}

/* content */
#dashboard_content { margin-right:280px; background:#fff; border:1px solid black; }
#dashboard_content > div.dashboard_content_top { height:50px; padding:0 20px; line-height:50px; border-bottom:1px dashed gray; *zoom:1; }
#dashboard_content > div.dashboard_content_top:after { clear:both; display:block; content:""; }
#dashboard_content > div.dashboard_content_top > div.dashboard_date { position:relative; float:left; height:50px; line-height:50px; }
#dashboard_content > div.dashboard_content_top > div.dashboard_date a { position:absolute; top:14px; }
#dashboard_content > div.dashboard_content_top > div.dashboard_date a.btn_prev_month { left:0; }
#dashboard_content > div.dashboard_content_top > div.dashboard_date a.btn_next_month { right:0; }
#dashboard_content > div.dashboard_content_top > div.dashboard_date strong { display:block; padding:0 30px; color:#3c3c3c; font-size:20px; font-weight:600; }
#dashboard_content > div.dashboard_content_top > div.dashboard_notice { padding-left:10px; float:left;}
#dashboard_content > div.dashboard_content_top > div.dashboard_search { float:right; text-align:right; }
#dashboard_content > div.dashboard_content_top > div.dashboard_search button.search { position: absolute; top:20px; right:424px; border: 0 none; background:none; cursor: pointer;}

#dashboard_content > div.dashboard_content_sub_top { height:60px; padding:0 20px; line-height:60px; *zoom:1; }
#dashboard_content > div.dashboard_content_sub_top:after { clear:both; display:block; content:""; }
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_type { float:left; line-height:20px; padding-top:15px; position:absolute; top:55px; left:20px;}
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_type a {z-index:40; display: inline-block; float:left; background-color: #ffffff; border-radius: 5px; border:solid 1px #969696; color:#3c3c3c; padding:4px 22px;}
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_type a.on{z-index:40; display: inline-block; float:left; background-color: #4e2e2e; border-radius: 5px; border:solid 1px #281313; color:#fff; padding:4px 22px;}
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_type a.month { border-bottom-right-radius: 0;  border-top-right-radius: 0; }
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_type a.week {border-bottom-left-radius: 0;  border-left: 0 none;  border-top-left-radius: 0;}

#dashboard_content > div.dashboard_content_sub_top > div.dashboard_state { float:right; }
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_state span.state01 { z-index:40; background-color: #1a9ab1; border-radius: 5px; border:solid 1px #128397; color:#fff; padding:4px 22px;}
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_state span.state02 {z-index:40; background-color: #894c9e; border-radius: 5px; border:solid 1px #6e3881; color:#fff; padding:4px 22px;}
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_state span.state03 {z-index:40; background-color: #f68a1f; border-radius: 5px; border:solid 1px #d6700b; color:#fff; padding:4px 22px;}
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_state span.state04 {z-index:40; background-color: #6e6e6e; border-radius: 5px; border:solid 1px #646464; color:#fff; padding:4px 12px;}
#dashboard_content > div.dashboard_content_sub_top > div.dashboard_state span.state05 {z-index:40; background-color: #538fd4; border-radius: 5px; border:solid 1px #3770b1; color:#fff; padding:4px 8px;}

/* dashboard_calendar */
#dashboard_calendar { position:relative; z-index:0; }

#dashboard_calendar table.month_table { border-collapse:collapse; table-layout:fixed; border:0; border-top:1px solid #969696; margin-bottom:100px; }
#dashboard_calendar table.month_table tr th { height:39px; line-height:40px; text-align:center; border:0; border-left:1px solid #dcdcdc; background-color:#fafafa; font-weight:bold; }
#dashboard_calendar table.month_table tr th:first-child { border-left:0; }
#dashboard_calendar table.month_table tr td { height:99px; padding:20px; overflow:hidden; background:#fff; border:0; border-left:1px solid #dcdcdc; border-top:1px solid #dcdcdc; font-weight:bold; }
#dashboard_calendar table.month_table tr > td:first-child { border-left:0; }
#dashboard_calendar table.month_table tr .sun { color:red!important; }
#dashboard_calendar table.month_table tr .sat { color:blue!important; }
#dashboard_calendar table.month_table tr .today { background:#fffbe1; border:solid 1px #969696;}
#dashboard_calendar table.month_table tr .sel { background:#e1f3ff; border:solid 1px #969696;}
#dashboard_calendar table.month_table tbody tr.bg_col td { background:#fafafa!important;}
#dashboard_calendar table.month_table tbody tr div { position: relative; top:-15px; left:15px; width:100px;}
#dashboard_calendar table.month_table tbody tr div ul li.state01 {z-index:40; display: inline-block; background-color: #1a9ab1; border-radius: 5px; border:solid 1px #128397; color:#fff; padding:4px 22px; margin-bottom:5px; font-weight:normal;}
#dashboard_calendar table.month_table tbody tr div ul li.state02 {z-index:40; display: inline-block; background-color: #894c9e; border-radius: 5px; border:solid 1px #6e3881; color:#fff; padding:4px 22px; margin-bottom:5px; font-weight:normal;}
#dashboard_calendar table.month_table tbody tr div ul li.state03 {z-index:40; display: inline-block; background-color: #f68a1f; border-radius: 5px; border:solid 1px #d6700b; color:#fff; padding:4px 22px; margin-bottom:5px; font-weight:normal;}
#dashboard_calendar table.month_table tbody tr div ul li.state04 {z-index:40; display: inline-block; background-color: #6e6e6e; border-radius: 5px; border:solid 1px #646464; color:#fff; padding:4px 12px; margin-bottom:5px; font-weight:normal;}
#dashboard_calendar table.month_table tbody tr div ul li.state05 {z-index:40; display: inline-block; background-color: #538fd4; border-radius: 5px; border:solid 1px #3770b1; color:#fff; padding:4px 8px; margin-bottom:5px; font-weight:normal;}



#dashboard_calendar table.week_table { border-collapse:collapse; table-layout:fixed; border:0; border-top:1px solid #969696; }
#dashboard_calendar table.week_table tr th, #dashboard_calendar table.week_table tr td { height:39px; line-height:39px; text-align:center; font-weight:bold; border:0; border-left:1px solid #dcdcdc; }
#dashboard_calendar table.week_table tr th { background:#fafafa; }
#dashboard_calendar table.week_table tr th:first-child { border-left:0; }
#dashboard_calendar table.week_table tr td { background:#fff; border-top:1px solid #dcdcdc; }
#dashboard_calendar table.week_table tr > td:first-child { border-left:0; }
#dashboard_calendar table.week_table tr td.title { color:black; }
#dashboard_calendar table.week_table tr .sun { color:red!important; }
#dashboard_calendar table.week_table tr .sat { color:blue!important; }

/* time_sell */
#dashboard_calendar table.week_table tr td div.time_sell { position:absolute; z-index:100; width:12.5%; height:120px; background:green; }
#dashboard_calendar table.week_table tr td div.time_sell01 { position:absolute; z-index:100; width:12.5%; height:120px; background:#e2f5f7; }
#dashboard_calendar table.week_table tr td div.time_sell02 { position:absolute; z-index:100; width:12.5%; height:120px; background:#f9f0fc; }
#dashboard_calendar table.week_table tr td div.time_sell03 { position:absolute; z-index:100; width:12.5%; height:120px; background:#fbf3ea; }
#dashboard_calendar table.week_table tr td div.time_sell04 { position:absolute; z-index:100; width:12.5%; height:120px; background:#f0f0f0; }
#dashboard_calendar table.week_table tr td div.time_sell05 { position:absolute; z-index:100; width:12.5%; height:120px; background:#e2e7f7; }
/* footer */
#dashboard_footer > p { line-height:60px; padding:0 60px; background:url("/img/manager/ico_monitor.gif") 30px 25px  no-repeat; color:black; }
#dashboard_footer > p > strong { font-weight:bold; }


/*popup*/
#layer_back { background-color: #000; display: none; height: 100%; left: 0; opacity: 0.5; position: fixed; top: 0; width: 100%; z-index: 990;}
#layer_popup { background-color: #fff; border: 1px solid #000; display: none; height: 600px; left: 50%; margin: -300px 0 0 -300px; position: fixed; top: 50%; width: 600px; z-index: 995;}
#layer_header { background-color: #fedc19; height: 80px; position: relative; width: 100%;}
#layer_header > h1 { color: #3c3c3c; font-size: 1.79em; font-weight: bold; line-height: 50px;  margin-left: 40px; padding-top:28px;  width: 80%;}
#layer_header > button {border: 0 none; cursor: pointer; height: 27px; margin: 0; padding: 0; position: absolute; right: 40px; top: 25px; width: 27px; z-index: 996;}
#layer_content {height: 800px; margin-bottom: 0; overflow-y: auto; padding: 50px 20px 30px;}
#layer_content div.search { text-align:center; margin:0 0 0 0;}
#layer_content h2{ padding:40px 0 15px 0;}
#layer_content h2 strong { color:#3c3c3c; font-weight:600;}
#layer_content table.write_table tr td button.state {background-color: #fcfcfc; border: 1px solid #c8c8c8; border-radius: 5px; height: 25px; position: relative; z-index: 40; display:inline-block; padding:0 15px; color:#6e6e6e;}
</style>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>
</head>
<body>
<!-- 가맹점 예약등록 (조회) 팝업-->
<div id="layer_back" style="display: block;"><span id="transmark" style="display: none; width: 0px; height: 0px;"></span></div>
<div id="layer_popup" style="width: 700px; height: 600px; margin-top: -375px; margin-left: -350px; display: block;">
	<div id="layer_header">
		<h1><img src="/img/manager/h1_popup1.gif" alt="가맹점 예약등록 (조회)"/></h1>
		<button title="닫기" onClick="closeLayerPopup()" type="button"><img alt="X" src="/img/common/btn_close_layer.gif"></button>
	</div>

	<div id="layer_content" style="height:500px;">
		<table border="1" class="write_table">
		<colgroup>
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<td>
				<div class="search">
				<select class="select">
				<option value="">전화번호</option>
				<option value="">성명</option>
				</select>
				<input name="text" type="text" class="text" title="검색어를 입력하세요." />
				<img alt="조회" src="/img/manager/btn_lookup.gif">
				<img alt="미등록고객예약" src="/img/manager/btn_unregist.gif">
			</div>
			</td>
		</tr>
		</tbody>
		</table>
		
		<h2>[검색결과] <strong>5</strong>건</h2>
		<table border="1" class="write_table">
		<colgroup>
		<col width="*">
		<col width="105">
		</colgroup>
		<tbody>
		<tr>
			<td><strong>김지유</strong> / 010-0000-0000 / 2015-12-02 / 시간표시 / 대기</td>
			<td><button class="state" type="button">선택</button></td>
		</tr>
		<tr>
			<td><strong>김민서</strong> / 010-0000-0000 / 2015-12-02 / 시간표시 / 대기</td>
			<td><button class="state" type="button">선택</button></td>
		</tr>
		<tr>
			<td>김은지 / 010-0000-0000 / 2015-12-02 / 시간표시 / 대기</td>
			<td><button class="state" type="button">선택</button></td>
		</tr>
		<tr>
			<td>김예슬 / 010-0000-0000 / 2015-12-02 / 시간표시 / 대기</td>
			<td><button class="state" type="button">선택</button></td>
		</tr>
		<tr>
			<td>김창걸 / 010-0000-0000 / 2015-12-02 / 시간표시 / 대기</td>
			<td><button class="state" type="button">선택</button></td>
		</tr>

		</tbody>
		</table>
	</div>	
</div>
<!-- //가맹점 예약등록 (조회) 팝업-->
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
								<li class="state02">진행</li>
								<li class="state03">완료</li>
								<li class="state04">정상취소</li>
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
						<div class="time_sell">예약??</div>					
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
						<div class="time_sell01">대기 : 홍길동(1)</div>					
						<div class="time_sell02">진행 : 박수진(2)</div>					
						<div class="time_sell03">완료 : 이호수(3)</div>					
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
					<td>
						<div class="time_sell04">정상취소 : 조영원(5)</div>					
						<div class="time_sell05">비정상취소: 최승훈(2)</div>					
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
	<!-- //dashboard_footer -->
</div>

</body>
</html>