<?
if(!defined('_INPLUS_')) { exit; } 

if(!$is_user) {
	alert('로그인 후 이용할 수 있습니다.', '../member/login.html');
}

/* page info */
//$back_type = 'hidden';
$back_url = '../page/main.html';
$doc_title = '예약보기';
$footer_nav['5'] = true;

/* init Class */
$oReserve = new ReserveUser();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

/* list */
$pk = $oReserve->get('pk');
$oReserve->set('cnt_rows', 9999);
$oReserve->set('order_direct', 'asc');

/* calendar */
if(!$sch_date) {
	$sch_date = date('Y-m-d');
}
$oReserve->set('rs_month', substr($sch_date, 0, 7));
$cal_arr = $oReserve->selectCalendarByUserId($sch_date, $member['mb_id'], false);

$oReserve->set('list_mode', 'wait');
$wait_list = $oReserve->selectList();

//print_R($wait_list);

$oReserve->set('list_mode', 'end');
$end_list = $oReserve->selectList();

unset($date_arr);
?>
<style type="text/css">
div.reservation {background:#f6f6f6;}
div.reservation div.res_calendar {padding:10px; margin-bottom:20px; background:#fff;}

div.res_calendar table {margin-bottom:0;}
div.res_calendar table td span { display:block; height:30px; line-height:30px; color:#555; text-align:center; }
div.res_calendar table td.none span { color:#bbb; }
div.res_calendar table td.today span {}

div.res_calendar table td a.res_day { border-radius:30px; background:#12aec3; color:#fff; }
div.res_calendar table td.none a.res_day { background:#fff; border:1px solid #12aec3; box-sizing:border-box; color:#12aec3;}
div.res_calendar table td.today a.res_day {font-weight:bold; color:#ffea00; }

div.res_calendar div.res_calendar_state {padding:10px 10px; }
div.res_calendar div.res_calendar_state ul:after { clear:both; display:block; content:""; }
div.res_calendar div.res_calendar_state ul li {float:left; font-size:11px; margin-right:8px; line-height:10px; color:#999 }
div.res_calendar div.res_calendar_state ul li span {display:inline-block; width:10px; height:10px; border-radius:10px; background:#000; }
div.res_calendar div.res_calendar_state ul li span.s_res_day { background:#12aec3;}
div.res_calendar div.res_calendar_state ul li span.s_none { background:#fff;  border:1px solid #12aec3; box-sizing:border-box;}

div.reservation div.res_view_list h4 {padding:0 10px 8px 10px;}
div.reservation div.res_view_list p {padding:0 10px 10px 10px; font-size:11px; }

div.res_view_list {margin-bottom:20px}
div.res_view_list:after{height:0;}
div.res_view_list li{ margin-bottom:4px; border:0;}
div.res_view_list li.on{border-top:1px solid #999999; border-bottom:1px solid #999999; background:#ffffdc;}

div.res_view_list li strong.shop_name {display:block; margin-bottom:16px; padding-right:100px; color:#333;} 

div.res_view_list li ul.res_info {position:relative; line-height:1.0em;}
div.res_view_list li ul.res_info li {padding:4px 0 4px 80px; border-bottom:0; margin:0; background:transparent}
div.res_view_list li ul.res_info li em {position:absolute; top:4px; left:0; border-bottom:0; font-size:12px; font-weight:normal;color:#999;}
div.res_view_list li ul.res_info li em.state_W { color:#12aec3;} /* 신청중 */
div.res_view_list li ul.res_info li em.state_A { color:#9e6eaf;} /* 담당자확정 */
div.res_view_list li ul.res_info li em.state_P { color:#f06e58;} /* 진행중 */
div.res_view_list li ul.res_info li em.state_E { color:#12aec3;} /* 완료 */
div.res_view_list li ul.res_info li em.state_C { color:#888;} /* 정상취소 */
div.res_view_list li ul.res_info li em.state_B { color:#f06e58;} /* 비정상취소 */

div.res_view_list li ul.res_info li span {position:relative; font-size:12px;}

div.res_view_list li ul.res_info li.res_state { min-height:14px;margin-bottom:8px; }
div.res_view_list li ul.res_info li.res_state em {font-size:14px; font-weight:bold}
div.res_view_list li ul.res_info li.res_state span {font-size:11px; }

div.res_view_list li ul.res_info li span strong {font-weight:normal;}
div.res_view_list li ul.res_info li span.service strong {display:block; padding-top:4px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
div.res_view_list li ul.res_info li span.service strong:first-child {padding-top:0; }

div.res_view_list li div.ico_info {position:absolute; top:10px; right:10px; padding:0;}
div.res_view_list li div.ico_info ul:after { clear:both; display:block; content:""; }
div.res_view_list li div.ico_info ul li {float:left; padding:0; margin-left:4px; width:44px; height:44px; border-radius:44px; text-align:center; font-size:11px; box-sizing:border-box}
div.res_view_list li div.ico_info ul li.icon_info {padding-top:8px;border:2px solid #ececec; line-height:1.25em; background:#fff; }
div.res_view_list li div.ico_info ul li.icon_info a {display:block; width:100%; height:100%;  }
div.res_view_list li div.ico_info ul li.icon { position:relative; top:0; right:0;  margin-top:0; padding-top:8px; width:44px;height:44px; border-radius:44px; line-height:1.25em; border-bottom:0;}
div.res_view_list li div.ico_info ul li.icon i {display:block;}

a.btn_fix {
  -webkit-animation-name: btn_fix;
  -webkit-animation-duration: 1.5s;
  -webkit-animation-iteration-count: infinite;
}

@-webkit-keyframes btn_fix {
  from { background-color: #9e6eaf; -webkit-box-shadow: 0 0 1px #9e6eaf; border-color:#9e6eaf; color:#fff;}
  50% { background-color: #f06e58; -webkit-box-shadow: 0 0 2px #f06e58; border-color:#f06e58;  color:#fff;}
  to { background-color: #9e6eaf; -webkit-box-shadow: 0 0 1px #9e6eaf;  border-color:#9e6eaf; color:#fff;}
}

div.res_view_list li.no_data p { padding:15px 10px; text-align:center;color:#888}
div.res_view_list li.no_data p i {display:block; margin-bottom:10px; font-size:40px; color:#cccccc }
</style>
<script type="text/javascript">
$(document).ready(function() {	
	$("a.btn_link_date").on("click", function() {
		var li_class = $(this).attr("title");
		$("div.res_view_list > ul > li").not("." + li_class).removeClass("on").end().filter("." + li_class).addClass("on");
	});

});
</script>
<div id="container" class="container">

	<div class="reservation">

		<!-- reserve_calendar -->
		<div id="reserve_calendar">
			<!-- 달력 영역 -->
			<div class="res_calendar">
				<div class="date_area">
					<a href="../reserve/list.html?sch_date=<?=$cal_arr['prev_date']?>" class="prev"><i class="xi-left-circle"></i></a>
					<?=$cal_arr['title']?>
					<a href="../reserve/list.html?sch_date=<?=$cal_arr['next_date']?>" class="next"><i class="xi-right-circle"></i></a>
				</div>

				<table>
				<caption>날짜/시간 선택</caption>
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
				<? foreach($cal_arr['date'] as $key => $arr) { ?>
				<tr>
					<? foreach($arr as $key2 => $arr2) { 
						$span_class = '';
						//if($arr2['cnt']['total'] > 0) { $span_class = 'res_day'; } ?>
					<td class="<?=$arr2['class']?>">
						<? if($arr2['day']) { ?>
						<? if($arr2['cnt']['total'] > 0) { ?><a href="#date-<?=$arr2['date']?>" class="btn_link_date res_day" title="date-<?=$arr2['date']?>"><? } else { ?><span><? } ?>
						<?=$arr2['day']?>
						<? if($arr2['cnt']['total'] > 0) { ?></a><? } else { ?></span><? } ?>
						<? } else { ?>&nbsp;<? } ?>
					</td>
					<? } ?>
				</tr>
				<? } ?>			
				</tbody>
				</table>

				<div class="res_calendar_state">
					<ul>
					<li><span class="s_res_day"></span> 진행중예약</li>
					<li><span class="s_none"></span> 지난 예약</li>
					</ul>
				</div>
			</div>
			<!-- //달력 영역 -->
		</div>
		<!-- //reserve_calendar -->

		<!-- reserve_wait_list -->
		<div id="reserve_wait_list" class="res_view_list">

			<h4><i class="xi-calendar-check"></i> 이달의 진행 중 예약 <span class="col_orange"><?=number_format(sizeof($wait_list))?></span>건</h4>	
			<ul>
			<? for($i = 0 ; $i < sizeof($wait_list) ; $i++) { 
				$rs_date = $wait_list[$i]['rs_date'];
				$li_id = '';
				$li_class = 'date-'.$rs_date;
				if(!$date_arr[$rs_date]) {
					$data_arr[$rs_date] = 1;
					$li_id = $li_class;
				}				
			?>
			<li id="<?=$li_id?>" class="<?=$li_class?>">
				<strong class="shop_name"><?=$wait_list[$i]['sh_name']?></strong>				
				
				<ul class="res_info">
				<li class="res_state">
					<em class="state_<?=$wait_list[$i]['rs_state']?>"><?=$wait_list[$i]['txt_rs_state']?></em>
					<? if($wait_list[$i]['flag_process']) { ?><span><i class="xi-info-circle"></i> 예약진행은 아래 <strong class="col_orange">예약확정</strong> 버튼을 눌러주세요</span><? } ?>
				</li>
				<li>
					<em><i class="xi-calendar"></i> 예약일시</em>
					<span><?=$wait_list[$i]['txt_rs_datetime']?></span>
				</li>
				<li>
					<em><i class="xi-user"></i> 담당자</em>
					<span><?=$wait_list[$i]['st_name']?></span>
				</li>
				<li>
					<em><i class="xi-close"></i> 예약취소</em>
					<span>취소(변경)시 <strong class="col_orange"><?=$wait_list[$i]['txt_modify_time']?> 전</strong>까지 가능</span>
				</li>
				<li>
					<em><i class="xi-check-circleout"></i> 서비스</em>
					<span class="service">
						<? for($j = 0 ; $j < sizeof($wait_list[$i]['sv_name_list']) ; $j++) { ?>
						<strong><?=$wait_list[$i]['sv_name_list'][$j]?></strong>
						<? } ?>
					</span>
				</li>
				<li>
					<em><i class="xi-comment"></i> 요청사항</em>
					<span><?=getWithoutNull($wait_list[$i]['rs_user_memo'])?></span>
				</li>
				</ul>

				<div class="res_view_btn">
					<? if($wait_list[$i]['flag_modify']) { ?>
					<a href="../reserve/write.html?<?=$pk?>=<?=$wait_list[$i][$pk]?>&sh_code=<?=$wait_list[$i]['sh_code']?>&reserve_type=staff&sch_date=<?=$sch_date?>" class="btn_layer_page btn_gray_line_s" target="#layer_page5">예약변경</a>
					<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$wait_list[$i][$pk]?>&rs_state=C&sch_date=<?=$sch_date?>" class="btn_confirm btn_change btn_gray_line_s" title="예약취소">예약취소</a>
					<? } ?>
					<? if($wait_list[$i]['flag_process']) { ?><a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$wait_list[$i][$pk]?>&rs_state=P&sch_date=<?=$sch_date?>" class="btn_confirm btn_change btn_gray_line_s btn_next_rev btn_fix" title="예약진행">예약확정</a><? } ?>				
				</div>

				<div class="ico_info">
					<ul>
					<li class="icon_info"><a href="../shop/view.html?sh_code=<?=$wait_list[$i]['sh_code']?>" class="btn_layer_page" target="#layer_page2">매장<br />정보</a></li>					
					<? if($wait_list[$i]['flag_approach']) { ?><li class="icon"><i class="xi-check"></i>임박</li><? } ?>
					</ul>
				</div>	
			</li>
			<? } if(sizeof($wait_list) == 0) {?>
			<li class="no_data">
				<p><i class="xi-close-circle"></i> 이달의 진행중인 예약이 없습니다.</p>
			</li>
			<? } ?>
			</ul>	
		</div>
		<!-- //reserve_wait_list -->

		<!-- reserve_end_list -->
		<div id="reserve_end_list" class="res_view_list">
			<h4><i class="xi-calendar-cancel"></i> 이달의 종료된 예약</h4>
			<ul>
			<? for($i = 0 ; $i < sizeof($end_list) ; $i++) { 
				$rs_date = $end_list[$i]['rs_date'];
				$li_id = '';
				$li_class = 'date-'.$rs_date;
				if(!$date_arr[$rs_date]) {
					$data_arr[$rs_date] = 1;
					$li_id = $li_class;
				}				
			?>
			<li id="<?=$li_id?>" class="<?=$li_class?>">
				<strong class="shop_name"><?=$end_list[$i]['sh_name']?></strong>				
				<ul class="res_info">
				<li class="res_state">
					<em class="state_<?=$end_list[$i]['rs_state']?>"><?=$end_list[$i]['txt_rs_state']?></em>
				</li>
				<li>
					<em><i class="xi-calendar"></i> 예약일시</em>
					<span><?=$end_list[$i]['txt_rs_datetime']?></span>
				</li>
				<li>
					<em><i class="xi-user"></i> 담당자</em>
					<span><?=$end_list[$i]['st_name']?></span>
				</li>
				<? if($end_list[$i]['rs_state'] == 'C' || $end_list[$i]['rs_state'] == 'B') { ?>
				<li>
					<em><i class="xi-close"></i> 예약취소</em>
					<span><?=getWithoutNull($end_list[$i]['txt_cc_datetime'])?></span>
				</li>
				<? } ?>
				<li>
					<em><i class="xi-check-circleout"></i> 서비스</em>
					<span class="service">
						<? for($j = 0 ; $j < sizeof($end_list[$i]['sv_name_list']) ; $j++) { ?>
						<strong><?=$end_list[$i]['sv_name_list'][$j]?></strong>
						<? } ?>
					</span>
				</li>
				<li>
					<em><i class="xi-comment"></i> 요청사항</em>
					<span><?=getWithoutNull($end_list[$i]['rs_user_memo'], '-')?></span>
				</li>
				</ul>

				<div class="ico_info">
					<ul>
					<li class="icon_info"><a href="../shop/view.html?sh_code=<?=$end_list[$i]['sh_code']?>" class="btn_layer_page" target="#layer_page2">매장<br />정보</a></li>					
					</ul>
				</div>	
			</li>
			<? } if(sizeof($end_list) == 0) { ?>
			<li class="no_data">
				<p><i class="xi-close-circle"></i> 이달의 종료된 예약이 없습니다.</p>
			</li>
			<? } ?>
			</ul>
		</div>
		<!-- //reserve_end_list -->
	</div>
</div>
