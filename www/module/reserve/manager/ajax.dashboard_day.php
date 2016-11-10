<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
if(!isset($oReserve)) {
	$oReserve = new ReserveManager();
	$oReserve->init();
}

// 전체 예약건수
$rs_state_arr = $oReserve->get('rs_state_arr');

unset($cnt_arr);
$cnt_arr['total'] = 0;
foreach($rs_state_arr as $key => $val) {
	$cnt_arr[$key] = $oReserve->countByShopCode($member['sh_code'], $key);
	$cnt_arr['total'] += $cnt_arr[$key];
}
$json_etc = array(
	'cnt_arr'	=> $cnt_arr
);

// 일간 예약건수
$cal_arr = $oReserve->selectdailyByShopCode($sch_date, $member['sh_code'], true);
$cnt_staff = $cal_arr['cnt_staff'];

$pk = $oReserve->get('pk');

//print_r($cal_arr); exit;
?>

<div class="calendar_frame">
	<div class="day_calendar">

		<!-- day_week -->
		<div class="day_week">
			<!-- week_title -->
			<div class="week_title">
				<table class="day_table staff<?=$cnt_staff?>">				
				<thead>
				<tr>
					<th class="title">구분</th>
					<? for($i = 0 ; $i < sizeof($cal_arr['staff']) ; $i++) { ?>
					<th class="<?=$cal_arr['staff'][$i]['class']?>"><strong><?=$cal_arr['staff'][$i]['st_name']?></strong></th>
					<? } ?>
				</tr>
				</thead>
				</table>
			</div>
			<!-- //week_title -->
		</div>
		<!-- //day_week -->

		<!-- schedule_table -->
		<div class="schedule_table">
			<table class="day_table staff<?=$cnt_staff?>">
			<tbody>
			<? foreach($cal_arr['staff'][0]['time'] as $key => $arr) { ?>
			<tr>
				<? for($i = 0 ; $i < 7 ; $i++) { $time_arr = $cal_arr['staff'][$i]['time'][$key]; ?>

				<? if($i == 0) { ?><td><?=$time_arr['txt_time']?></td><? } ?>	
				<td class="<?=$cal_arr['staff'][$i]['class']?>">
					<? if($time_arr['cnt_cell'] > 0) { ?>
					<div class="time_cell state<?=$time_arr['rs_state']?>" style="height:<?=$time_arr['cnt_cell']*40-1?>px">
						<a href="./ajax.dashboard_aside.html?list_mode=day&sch_rs_date=<?=$sch_date?>&<?=$pk?>=<?=$time_arr[$pk]?>" class="btn_ajax" style="line-height:<?=$time_arr['cnt_cell']*40-1?>px" target="#reserve_list"><?=$time_arr['us_name']?></a>
					</div>
					<!-- 스타일 예제 
					<div class="time_cell stateB" style="100%; z-index:900">
						<a href="#" class="btn_ajax" style="height:80px; z-index:850" target="#reserve_list">홍길동</a>
					</div>
					//스타일 예제 -->
					<? } else { ?>&nbsp;<? } ?>
				</td>	
				<? } ?>
			</tr>
			<? } ?>
			</tbody>
			</table>
		</div>
		<!-- //schedule_table -->

	</div>
</div>