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

// 월간 예약건수
$cal_arr = $oReserve->countMonthlyByShopCode($sch_date, $member['sh_code'], $sch_st_id, true);
?>

<div class="calendar_frame">

	<div class="monthly_calendar">

		<!-- day_week -->
		<div class="day_week">
			<!-- week_title -->
			<div class="week_title">
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
				</table>
			</div>
			<!-- //week_title -->
		</div>
		<!-- //day_week -->

		<!-- schedule_table -->
		<div class="schedule_table">
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
			
			<tbody>
			<? foreach($cal_arr['date'] as $key => $arr) { ?>
			<tr>
				<? foreach($arr as $key2 => $arr2) { ?>
				<td class="<?=$arr2['class']?>">
					<? if($arr2['day'] && $arr2['class'] != 'none') { ?>						
						<?=$arr2['day']?>	
						<? if(sizeof($arr2['cnt']) > 0) { ?>
						<div class="content">														
							<? 
							ob_start();
							foreach($arr2['cnt'] as $st_id => $arr3) { 

								if(!$arr3['total']) { continue; } 
								if($arr2['prev']) { $state_class = 'stateE'; }
								else { $state_class = 'stateP'; }
								?><li class="<?=$state_class?>"><a href="./ajax.dashboard_aside.html?list_mode=month&sch_rs_date=<?=$arr2['date']?>&sch_st_id=<?=$st_id?>" class="btn_ajax btn_choose_date" target="#reserve_list">(<?=number_format($arr3['normal'])?>/<?=number_format($arr3['total'])?>건) <?=$arr3['name']?></a></li><? }
							$bf_content = ob_get_contents();
							ob_end_clean();

							if($bf_content) { ?>
							<ul>
							<?=$bf_content?>
							</ul>
							<? } ?>							
						</div>
						<? } ?>
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
	<!-- //monthly_calendar -->


</div>
<!-- //month_frame -->