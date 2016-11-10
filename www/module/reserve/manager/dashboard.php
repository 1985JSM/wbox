<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* init Class */
$oReserve = new ReserveManager();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

if(!$list_mode) { $list_mode = 'month'; }
if(!$sch_date) { $sch_date = date('Y-m-d'); }

/* search condition */
$sch_type_arr = $oReserve->get('sch_type_arr');
//$query_string = $oReserve->get('query_string');

// 담당자
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$staff_list = $oStaff->selectStaffByShopCode($member['sh_code']);

if($list_mode == 'week' && !$sch_st_id) {
	foreach($staff_list as $key => $val) {
		$sch_st_id = $key;
		break;
	}
}

// 모드별 집계
ob_start();
include_once(_MODULE_PATH_.'/reserve/manager/ajax.dashboard_'.$list_mode.'.php'); 
$list_content = ob_get_contents();
ob_end_clean();

?>
<link rel="stylesheet" type="text/css" href="/share/css/dashboard.css" />
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$(document).on("click", "a.btn_choose_date", function(e) {
		// 날짜 선택
		chooseReserveDate(this);
	}).on("change", "#staff_select", function(e) {
		// 담당자 선택
		chooseStaffId(this);		
	}).on("click", "a.btn_choose_reserve", function(e) {
		// 예약정보 선택
		chooseReserveInfo();		
	}).on("click", "input.pay_method", function(e) {
		//// 결제수단 선택
		//choosePayMethod(this);		
	}).on("focusout", "input.pay_price", function(e) {
		// 결제금액 합산
		sumTotalPrice();		
	}).on("change", "#reserve_st_id", function(e) {
		// 담당자 선택
		chooseStaff(this);
	}).on("click", "#reserve_sv_id", function(e) {
		// 서비스 클릭
		if(!checkChooseStaff(this)) {
			e.preventDefault();
		}
	}).on("change", "#reserve_sv_id", function(e) {
		// 서비스 선택
		chooseService(this);
	}).on("click", "a.btn_choose_date", function(e) {
		// 예약 캘린더
		$("#reserve_calendar").find("td").removeClass("on");
		$(this).parent("td").addClass("on");
	});
});
//]]>
</script>

</head>
<body>

<div id="dashboard_wrap">

	<!-- dashboard_header -->
	<div id="dashboard_header">
		<h1><a href="./dashboard.html">예약박스</a></h1>

		<div id="dashboard_util">
			<ul>
			<li>총 : <span id="cnt_reserve_total"><?=number_format($cnt_arr['total'])?></span>건</li>
			<? foreach($rs_state_arr as $key => $val) { ?>
			<li><?=$val?> : <span id="cnt_reserve_<?=$key?>"><?=number_format($cnt_arr[$key])?></span>건</li>
			<? } ?>
			</ul>
			<a href="../customer/ajax.dashboard_list.html?list_mode=<?=$list_mode?>&sch_rs_date=<?=$sch_date?>&sch_st_id=<?=$sch_st_id?>" class="btn_ajax size_800x700 btn_reserve" target="#layer_popup" title="고객검색"><img src="/img/manager/btn_reserve.gif" alt="예약등록/비회원" /></a>
			<button type="button" onclick="refreshDashboard()" class="btn_referesh"><img src="/img/manager/btn_referesh.gif" alt="결제" /></button>
		</div>
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
							<a href="./dashboard.html?list_mode=<?=$list_mode?>&sch_date=<?=$cal_arr['prev_date']?>&sch_st_id=<?=$sch_st_id?>" class="btn_prev_month"><img src="/img/manager/btn_prev.gif" alt="이전기간"/></a>
							<? if($list_mode != 'week') { ?><strong><?=$cal_arr['title']?></strong><? } else { ?><span><?=$cal_arr['title']?></span><? } ?>
							<a href="./dashboard.html?list_mode=<?=$list_mode?>&sch_date=<?=$cal_arr['next_date']?>&sch_st_id=<?=$sch_st_id?>" class="btn_next_month"><img src="/img/manager/btn_next.gif" alt="다음기간"/></a>							
						</div>

						<div class="dashboard_type">
							<!--a href="./dashboard_day.html" class="day">일간</a-->
							<a href="./dashboard.html?list_mode=day&sch_date=<?=$sch_date?>&sch_st_id=<?=$sch_st_id?>" class="day<? if($list_mode == 'day') { ?> on<? } ?>">일간</a>
							<a href="./dashboard.html?list_mode=week&sch_date=<?=$sch_date?>&sch_st_id=<?=$sch_st_id?>" class="week<? if($list_mode == 'week') { ?> on<? } ?>">주간</a>
							<a href="./dashboard.html?list_mode=month&sch_date=<?=$sch_date?>&sch_st_id=<?=$sch_st_id?>" class="month<? if($list_mode == 'month') { ?> on<? } ?>">월간</a>							
						</div>

						<div class="dashboard_search">
							<form name="search_reserve_form" method="get" action="./ajax.dashboard_list.html" class="size_800x700" target="#layer_popup" onsubmit="return submitSearchReserveForm(this)" title="예약현황">
							<input type="hidden" name="flag_json" value="1" />
							<input type="hidden" name="list_mode" value="<?=$list_mode?>" />
							<select name="sch_type" class="select" title="검색구분">
							<? printSelectOption($sch_type_arr, $sch_type, 1); ?>
							</select>

							<input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="text required" maxlength="30" title="검색어" />
							<button type="submit" class="search"><img src="/img/manager/btn_all_search.gif" alt="검색"/> </button>

							<? if($list_mode != 'day') { ?>
							<select id="staff_select" class="select">
							<? if($list_mode == 'month') { ?><option value="">전체일정보기</option><? } ?>
							<? printSelectOption($staff_list, $sch_st_id, 1); ?>					
							</select>
							<? } ?>
							</form>
						</div>
					</div>
					<!-- //dashboard_content_top -->

					<!-- dashboard_calendar -->
					<div id="dashboard_calendar">
						<?=$list_content?>				
					</div>
					<!-- //dashboard_calendar -->
				</div>
				<!-- //content_calender -->
			</div>
			<!-- //dashboard_content_fix -->
		</div>
		<!-- //dashboard_content -->

		<div id="dashboard_aside">
			<div  id="reserve_list" class="aside_container">				
				<? /*include_once(_MODULE_PATH_.'/reserve/manager/ajax.dashboard_list2.php'); */?>			
			</div>
		</div>

	</div>
	<!-- //dashboard_container -->

</div>

<form name="dashboard_form" method="get" action="./ajax.dashboard_<?=$list_mode?>.html" target="#dashboard_calendar">
<input type="hidden" name="flag_json" value="1" />
<input type="hidden" name="list_mode" value="<?=$list_mode?>" />
<input type="hidden" name="sch_date" value="<?=$sch_date?>" />
<input type="hidden" name="sch_st_id" value="<?=$sch_st_id?>" />
</form>

<div id="layer_back"></div>
<div id="layer_popup">
	<div id="layer_header">
		<h1>레이어 제목</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="/img/common/btn_close_layer.gif" alt="X"></button>
	</div>

	<div id="layer_content">

	</div>	
</div>

<!-- ajax_loader -->
<!--div id="ajax_loader">
	<div class="bg"></div>
	<div class="loader">
		<img src="/img/common/loading.gif" alt="Loading" />
	</div>
</div-->
<!-- //ajax_loder -->


<!-- 비회원예약팝업 -->
<? /*
<div id="layer_popup" style="width: 1000px; height: 800px; margin-top: -400px; margin-left: -500px; display: block;">
	<div id="layer_header">
		<h1>예약하기</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="/img/common/btn_close_layer.gif" alt="X"></button>
	</div>

	<div id="layer_content" style="height:700px;">
		<div class="reserve_write">
				
			<form name="" method="" action="" onsubmit="" target="">

			<div class="reserve_info_write">
							
				<!-- customer -->
				<h2>예약정보입력</h2>
				<div class="reservation_userinfo">
					<span class="tit">고객명</span>
					<input type="text" name="us_name" class="text required" value="" size="20" maxlength="10" title="고객명">
				</div>

				<div class="reservation_staff">
					<span class="tit">휴대폰</span>
					<input type="text" name="us_hp" class="text required" value="" size="20" maxlength="15" title="휴대폰">
				</div>
				<!-- //customer -->
				
				<!-- reservation_staff -->
				<div class="reservation_staff">
					<span class="tit">담당자</span>
					<select class="select"  title="담당자">
						<option value="">담당자를 선택해주세요</option>
						<option value="">박은경 원장</option>
						<option value="">애나 디자이너</option>
						<option value="">지은</option>	
					</select>
					
				</div>
				<!-- //reservation_staff -->
				

				<!-- reservation_service -->
				<div class="reservation_service">
					<span class="tit">서비스</span>
					<select class="select"  title="서비스">
					<option value="">서비스를 선택해주세요.</option>
					</select>

					<div id="selected_service" class="service_select">	
						<ul>						
						<li>
							<strong class="service_name">Basic Pedcure</strong>
							<span class="service_time"><i class="xi-time"></i> 소요시간 <strong>60</strong>분 </span>
							<ul>
							<li class="price_sale">50,000원</li>
							<li><strong>40,000</strong>원</li>
							<li>
								<button type="button" onclick="removeSelectedService(this)"><img src="/img/common/btn_close.gif" alt="닫기"></button>
								<input type="hidden" name="sv_id[]" value="16">
							</li>
							</ul>
						</li>
						</ul>

						<div class="service_total">
							<ul>
							<li>서비스 <strong>1</strong>개 선택</li>
							<li>총 금액 <strong class="primary">40,000</strong>원</li>
							</ul>				
						</div>
					</div>											
				</div>
				<!-- //reservation_service -->


				<!-- reservation_time -->
				<div id="reserve_time" class="reservation_time open"><!-- open 추가시 캘린더 열림  -->
					<button type="button" onclick="toggleCalendar()" class="btn_date">
						<span class="tit">예약일시</span>
						<strong>예약시간을 선택해주세요</strong>
					</button>
				
					<div id="reserve_datetime" class="res_calendar">
					  <!--div class="location">
						<h2>예약일시선택</h2>
						<button type="button" onclick="closeLayerPage('6')" class="location_close"><i class="xi-close"></i></a>	
					</div-->
					  <div id="container6" class="container">
						<div class="res_calendar">
						  <div class="date_area"> <a href="#" class="btn_ajax prev" target="_self"> &lt; </a> 2016.06 <a href="#" class="btn_ajax next" target="_self"> &gt; </a> </div>
						  <table id="reserve_calendar">
							<caption>
							날짜/시간 선택
							</caption>
							<thead>
							  <tr>
								<th scope="col">일</th>
								<th scope="col">월</th>
								<th scope="col">화</th>
								<th scope="col">수</th>
								<th scope="col">목</th>
								<th scope="col">금</th>
								<th scope="col">토</th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
								<td class="">&nbsp;</td>
								<td class="">&nbsp;</td>
								<td class="">&nbsp;</td>
								<td class="none"><span>01</span> </td>
								<td class="none"><span>02</span> </td>
								<td class="none"><span>03</span> </td>
								<td class="none"><span>04</span> </td>
							  </tr>
							  <tr>
								<td class="none"><span>05</span> </td>
								<td class="none"><span>06</span> </td>
								<td class="none"><span>07</span> </td>
								<td class="none"><span>08</span> </td>
								<td class="none"><span>09</span> </td>
								<td class="none"><span>10</span> </td>
								<td class="none"><span>11</span> </td>
							  </tr>
							  <tr>
								<td class="none"><span>12</span> </td>
								<td class="none"><span>13</span> </td>
								<td class="none"><span>14</span> </td>
								<td class="none"><span>15</span> </td>
								<td class="none"><span>16</span> </td>
								<td class="none"><span>17</span> </td>
								<td class="none"><span>18</span> </td>
							  </tr>
							  <tr>
								<td class="none"><span>19</span> </td>
								<td class="none"><span>20</span> </td>
								<td class="none"><span>21</span> </td>
								<td class="none"><span>22</span> </td>
								<td class="today on"><a href="../reserve/ajax.time.html?sh_code=PL05N3AE0A01&amp;st_id=PL05N4HB0H41&amp;sv_ids=16&amp;sch_date=2016-06-23" class="btn_ajax btn_choose_date today on" target="#reserve_timetable">23</a> </td>
								<td class=""><a href="../reserve/ajax.time.html?sh_code=PL05N3AE0A01&amp;st_id=PL05N4HB0H41&amp;sv_ids=16&amp;sch_date=2016-06-24" class="btn_ajax btn_choose_date " target="#reserve_timetable">24</a> </td>
								<td class="sat"><a href="../reserve/ajax.time.html?sh_code=PL05N3AE0A01&amp;st_id=PL05N4HB0H41&amp;sv_ids=16&amp;sch_date=2016-06-25" class="btn_ajax btn_choose_date sat" target="#reserve_timetable">25</a> </td>
							  </tr>
							  <tr>
								<td class="sun"><a href="../reserve/ajax.time.html?sh_code=PL05N3AE0A01&amp;st_id=PL05N4HB0H41&amp;sv_ids=16&amp;sch_date=2016-06-26" class="btn_ajax btn_choose_date sun" target="#reserve_timetable">26</a> </td>
								<td class=""><a href="../reserve/ajax.time.html?sh_code=PL05N3AE0A01&amp;st_id=PL05N4HB0H41&amp;sv_ids=16&amp;sch_date=2016-06-27" class="btn_ajax btn_choose_date " target="#reserve_timetable">27</a> </td>
								<td class=""><a href="../reserve/ajax.time.html?sh_code=PL05N3AE0A01&amp;st_id=PL05N4HB0H41&amp;sv_ids=16&amp;sch_date=2016-06-28" class="btn_ajax btn_choose_date " target="#reserve_timetable">28</a> </td>
								<td class=""><a href="../reserve/ajax.time.html?sh_code=PL05N3AE0A01&amp;st_id=PL05N4HB0H41&amp;sv_ids=16&amp;sch_date=2016-06-29" class="btn_ajax btn_choose_date " target="#reserve_timetable">29</a> </td>
								<td class=""><a href="../reserve/ajax.time.html?sh_code=PL05N3AE0A01&amp;st_id=PL05N4HB0H41&amp;sv_ids=16&amp;sch_date=2016-06-30" class="btn_ajax btn_choose_date " target="#reserve_timetable">30</a> </td>
								<td class="none">&nbsp;</td>
								<td class="none">&nbsp;</td>
							  </tr>
							</tbody>
						  </table>
						  <ul id="reserve_timetable" class="time_list">
							<li> <span>10:00</span></li>
							<li> <span>10:30</span></li>
							<li> <span>11:00</span></li>
							<li> <span>11:30</span></li>
							<li> <span>12:00</span></li>
							<li> <span>12:30</span></li>
							<li> <span>13:00</span></li>
							<li> <span>13:30</span></li>
							<li> <span>14:00</span></li>
							<li> <span>14:30</span></li>
							<li> <span>15:00</span></li>
							<li> <span>15:30</span></li>
							<li> <span>16:00</span></li>
							<li> <span>16:30</span></li>
							<li> <span>17:00</span></li>
							<li> <span>17:30</span></li>
							<li> <span>18:00</span></li>
							<li> <span>18:30</span></li>
							<li> <span>19:00</span></li>
							<li> <span>19:30</span></li>
							<li> <span>20:00</span></li>
							<li> <span>20:30</span></li>
						  </ul>
						</div>
					  </div>
					</div>

				</div>
				<!-- //reservation_time -->

				<div class="reservation_comment">
					<span class="tit hidden">요청사항</span>
					<div class="layer_textarea"><textarea name="rs_user_memo" title="요청사항" placeholder="요청사항을 입력해주세요.(150자 이내)" maxlength="150"></textarea></div>
				</div>
			</div>

			<div class="pay_info_write">
			
				<fieldset>	
				<legend>할인정보</legend>	
				<h2>할인정보</h2>
				<table class="write_table" border="1">
				<caption>할인정보</caption>
				<colgroup>
				<col width="100">
				<col width="*">
				</colgroup>
				<tbody>
				<!--tr>
					<th>시술금액</th>
					<td><strong>40,000원</strong></td>
				</tr>	
				<tr-->
					<th>일반할인</th>
					<td class="td_use_sale">
					<input type="text" name="pm_sale_price" value="0" class="text money pay_price" size="20" maxlength="10" title="일반할인금액"> 원
					</td>
				</tr>
				<tr>
					<th>쿠폰사용</th>
					<td class="td_use_coupon">
						<div class="selector" style="width: 205px;"><span style="width: 180px; -webkit-user-select: none;">쿠폰선택</span><select name="cp_id" class="select" title="쿠폰종류">
						<option value="">쿠폰선택</option>
						<option value="1">예약박스 회원 전용 할인쿠폰</option><option value="2">유니스텔라 VIP 쿠폰</option>			</select></div>
						<input type="text" name="pm_coupon_price" value="0" class="text money pay_price" size="20" maxlength="10" title="쿠폰사용금액"> 원
					</td>
				</tr>
				<tr>
					<th>선불제</th>
					<td class="td_use_advance">
						<div>
							<div class="selector" style="width: 115px;"><span style="width: 90px; -webkit-user-select: none;">선불제선택</span><select name="ad_pc_id" class="select" title="선불제상품">
							<option value="">선불제선택</option>
							<option value="1">10회 이용권</option><option value="2">20만원 정액권</option>				</select></div>
							<input type="text" name="pm_advance_price" value="0" class="text money pay_price" size="20" maxlength="10" title="선불제사용금액"> 원 				
						</div>			
					</td>
				</tr>	
				<tr>
					<th>합계</th>
					<td>
						<strong>30,000원</strong>
					</td>
				</tr>
				</tbody>
				</table>
				</fieldset>

				<fieldset class="etc">	
				<legend>결제정보</legend>	
				<h2>결제정보</h2>
				<table class="write_table" border="1">
				<caption>결제정보</caption>
				<colgroup>
				<col width="100">
				<col width="*">
				</colgroup>
				<tbody>		
				<tr>
					<th>카드결제</th>
					<td class="td_use_card">
						<input type="text" name="pm_card_price" value="0" class="text money pay_price" size="20" maxlength="10" title="카드결제금액"> 원 
					</td>					
				</tr>	
				<tr>
					<th>현금결제</th>
					<td class="td_use_cash">
						<input type="text" name="pm_cash_price" value="0" class="text money pay_price" size="20" maxlength="10" title="현금결제금액"> 원
					</td>
				</tr>
				<tr>
					<th>매출액</th>
					<td>
						<strong class="primary"><span id="txt_total_price">0</span>원</strong>
					</td>
				</tr>
				<tr>
					<th>비고</th>
					<td>
						<textarea name="rs_pay_memo" class="textarea" rows="2" cols="40" title="비고"></textarea>
					</td>
				</tr>	
				</tbody>
				</table>
				</fieldset>

			</div>

			<div class="res_btn">
				<button type="submit"><img src="/img/manager/btn_nomember.gif" alt="확인" /></button>
				<button type="button" onclick="closeLayerPopup()"><img src="/img/manager/btn_cancel.gif" alt="취소" /></button>
			</div>		
			
			</form>
		</div>
	</div>	
</div>
<!-- //비회원예약팝업 -->
*/?>

</body>
</html>