<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();

/* calendar */
if(!$sch_date) {
	$sch_date = date('Y-m-d');
}

//$cal_arr = $oReserve->selectCalendarByStaffId($sch_date, $member['mb_id']);
$cal_arr = $oReserve->countMonthlyByShopCode($sch_date, $member['mb_id']);

//$cal_arr = makeCalendarArray($sch_date, true);
//$time_arr = $oReserve->selectTimaTableByStaffId($sch_date, $member['mb_id']);
//print_R($cal_arr);
?>

<style>
div.res_calendar {background:#fff; padding:20px 10px; box-sizing:border-box;}
</style>

<div class="res_calendar staff_calendar">
	<div class="date_area">
		<a href="../reserve/ajax_calendar2.html?sch_date=<?=$cal_arr['prev_date']?>" class="btn_ajax prev" target="#container"><i class="xi-caret-left-circle"></i></a>
		<?=$cal_arr['title']?>
		<a href="../reserve/ajax_calendar2.html?sch_date=<?=$cal_arr['next_date']?>" class="btn_ajax next" target="#container"><i class="xi-caret-right-circle"></i></a>
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
		<? foreach($arr as $key2 => $arr2) { ?>
		<td class="<?=$arr2['class']?>">
			<? if($arr2['day'] && $arr2['class'] != 'none') { ?><a href="../reserve/ajax_time2.html?sch_date=<?=$arr2['date']?>" class="btn_ajax btn_choose_date <?=$arr2['class']?>" target="#timetable"><?=$arr2['day']?><? if($arr2['cnt']['normal'] > 0) { ?><em class="count">(<?=number_format($arr2['cnt']['normal'])?>건)</em><? } ?></a><? }
			else if($arr2['day']) { ?><span><?=$arr2['day']?></span><? }
			else { ?>&nbsp;<? } ?>		
		</td>
		<? } ?>
	</tr>
	<? } ?>	
	</tbody>
	</table>

	<ul id="timetable" class="time_list2">
	<? include_once(_MODULE_PATH_.'/reserve/staff/ajax_time2.php'); ?>
	</ul>
</div>
