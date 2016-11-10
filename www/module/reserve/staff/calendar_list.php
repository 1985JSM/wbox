<?
if(!defined('_INPLUS_')) { exit; } 

/* page info */
$back_url = '../page/main.html';
$doc_title = '일정관리';
$footer_nav['3'] = true;

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

/* list */
$pk = $oReserve->get('pk');
$oReserve->set('cnt_rows', 9999);

/* calendar */
if(!$sch_date) {
	$sch_date = date('Y-m-d');
}

$oReserve->set('sch_rs_date', $sch_date);

$flag_no_state = true;
ob_start();
include_once(_MODULE_PATH_.'/reserve/staff/ajax.list.php');
$list_content = ob_get_contents();
ob_end_clean();

$oReserve->set('rs_month', substr($sch_date, 0, 7));
$cal_arr = $oReserve->countMonthlyByShopCode($sch_date, $member['sh_code'], $member['mb_id']);

/* time */
$time_arr = $oReserve->selectTimeTableByStaffId($sch_date, $member['mb_id']);
?>
<style type="text/css">
div.date {background:#f6f6f6}
div.date div.res_calendar {margin:0 0 20px 0; padding:10px; background:#fff;}

div.date > div.res_info {position:relative;padding:20px 0; line-height:1.0em;  background:#fff;}
div.date > div.res_info h3 {margin-bottom:10px; padding:0 10px 10px 10px; border-bottom:4px solid #f6f6f6;}
div.date > div.res_info > ul {}
div.date > div.res_info > ul > li {position:relative; padding:20px 10px; border-bottom:0;  border-bottom:4px solid #f6f6f6;}
div.date > div.res_info > ul > li ul li {position:relative; padding:4px 0 4px 80px;}
div.date > div.res_info > ul > li strong.user_name {display:block; margin-bottom:16px; padding-right:100px; color:#333;} 
div.date > div.res_info > ul > li span.ico_reservation{ border-radius:0;font-size:11px;border:0; font-weight:normal; background:none;color:#f06e58;}


div.date > div.res_info > ul > li ul li em {position:absolute; top:4px; left:0; border-bottom:0; font-size:12px; font-weight:normal;color:#999;}
div.date > div.res_info > ul > li ul li em.state_W {font-size:14px; font-weight:bold; color:#12aec3;} /* 신청중 */
div.date > div.res_info > ul > li ul li em.state_F {font-size:14px; font-weight:bold; color:#9e6eaf;} /* 담당자확정 */
div.date > div.res_info > ul > li ul li em.state_P {font-size:14px; font-weight:bold; color:#f06e58;} /* 진행중 */
div.date > div.res_info > ul > li ul li em.state_E {font-size:14px; font-weight:bold; color:#12aec3;} /* 완료 */
div.date > div.res_info > ul > li ul li em.state_C {font-size:14px; font-weight:bold; color:#888;} /* 정상취소 */
div.date > div.res_info > ul > li ul li em.state_B {font-size:14px; font-weight:bold; color:#f06e58;} /* 비정상취소 */

div.date > div.res_info > ul > li ul li span {position:relative; font-size:12px;}

div.date > div.res_info > ul > li ul li.res_state { min-height:14px;margin-bottom:8px; }
div.date > div.res_info > ul > li ul li.res_state em {font-size:14px;}
div.date > div.res_info > ul > li ul li.res_state span {font-size:11px; }

div.date > div.res_info > ul > li ul li span strong {font-weight:normal;}
div.date > div.res_info > ul > li ul li span.service strong {display:block; padding-top:4px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
div.date > div.res_info > ul > li ul li span.service strong:first-child {padding-top:0; }

div.date > div.res_info > ul > li.no_date {padding:15px 10px; text-align:center;color:#888}

/* 버튼 아이콘 */
div.date > div.res_info > ul > li  div.ico_info {position:absolute; top:10px; right:10px; padding:0;}
div.date > div.res_info > ul > li  div.ico_info ul:after { clear:both; display:block; content:""; }
div.date > div.res_info > ul > li  div.ico_info ul li {float:left; position:relative; top:0; right:0; padding:0; margin:0 0 0 4px; width:44px; height:44px; border-radius:44px; border-bottom:0;  text-align:center; font-size:11px; box-sizing:border-box;  line-height:1.25em; }
div.date > div.res_info > ul > li  div.ico_info ul li.icon_info {padding-top:8px;border:2px solid #ececec; background:#fff; }
div.date > div.res_info > ul > li  div.ico_info ul li.icon_info a {display:block; width:100%; padding:0; color:#555; }
div.date > div.res_info > ul > li  div.ico_info ul li.basic_info { background:#cccccc; color:#fff;  }
div.date > div.res_info > ul > li  div.ico_info ul li.basic_info.on { background:#58585a; }
div.date > div.res_info > ul > li  div.ico_info ul li.basic_info a {display:block; width:100%; padding:8px 0 0 0; color:#fff; }
div.date > div.res_info > ul > li  div.ico_info ul li.basic_info a i {display:block; position:relative; font-size:11px; height:auto; color:#fff; line-height:1.25em; top:0; right:0; }
div.date > div.res_info > ul > li  div.ico_info ul li.icon { padding-top:8px;background:#ff3f1e; color:#fff;  }
div.date > div.res_info > ul > li  div.ico_info ul li.icon i {display:block;}
/* 버튼 아이콘 끝 */
#layer_popup div.layer_res_list div {margin-top:10px;}
#layer_popup div.layer_res_list div:first-child {margin-top:0;}

div.res_calendar {background:#fff; padding:20px 10px; box-sizing:border-box;}
</style>
<script type="text/javascript">
//<![CDATA[

//]]>
</script>

<div class="tab">
	<ul class="tab_list tab_list02">
	<li class="on"><a href="../reserve/calendar_list.html">일정관리</a></li>
	<li><a href="../member/setting.html">설정</a></li>
	</ul>
</div>    

<div id="container" class="container">
	<div class="date">

		<div class="res_calendar staff_calendar">
			<div class="date_area">
				<a href="../reserve/calendar_list.html?sch_date=<?=$cal_arr['prev_date']?>" class="prev"><i class="xi-left-circle"></i></a>
				<?=$cal_arr['title']?>
				<a href="../reserve/calendar_list.html?sch_date=<?=$cal_arr['next_date']?>" class="next"><i class="xi-right-circle"></i></a>
			</div>

			<table id="reserve_calendar">
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
					$arr2['class'] = str_replace('on', '', $arr2['class']);
					if($arr2['date'] == $sch_date) { $arr2['class'] .= ' on'; }
					?>
				<td class="<?=$arr2['class']?>">
					<? if($arr2['day'] && $arr2['class'] != 'none') { ?><a href="../reserve/calendar_list.html?sch_date=<?=$arr2['date']?>" class="<?=$arr2['class']?>"><?=$arr2['day']?><? if($arr2['cnt'][$member['mb_id']]['total'] > 0) { ?><em class="count">(<?=number_format($arr2['cnt'][$member['mb_id']]['normal'])?>/<?=number_format($arr2['cnt'][$member['mb_id']]['total'])?>건)</em><? } ?></a><? }
					else if($arr2['day']) { ?><span><?=$arr2['day']?></span><? }
					else { ?>&nbsp;<? } ?>		
				</td>
				<? } ?>
			</tr>
			<? } ?>
			</tbody>
			</table>

			<ul id="timetable" class="time_list2">
			<? 
			foreach($time_arr as $key => $arr) { 
				$class = '';
				if($arr['flag'] == '4') {
					$class = 'active';
				}
				?>
			<li class="<?=$class?>">
				<? if(!$arr['flag']) { ?><span><?=$key?></span><? } else { ?><a href="../reserve/time_info.html?flag=<?=$arr['flag']?>&msg=<?=$arr['msg']?>&<?=$pk?>=<?=$arr[$pk]?>" class="btn_layer_page" target="#layer_page2" title="<?=$arr['title']?>"><?=$key?></a><? } ?>
			</li>
			<? } ?>
			</ul>
		</div>

		<div class="res_info">
			<h3>이 날의 예약 <strong class="col_orange"><?=number_format($total_cnt)?></strong>건</h3>
			<ul>
			<?=$list_content?>
			</ul>
		</div>

	</div>

</div>