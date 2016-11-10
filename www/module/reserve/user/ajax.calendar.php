<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveUser();
$oReserve->init();

if(!$sv_ids) {	
	$sv_id_arr = $sv_id;
	if(is_array($sv_id_arr)) {
		$sv_id_arr = array_unique($sv_id_arr);	// 중복 제거
		$sv_id_arr = array_filter($sv_id_arr);	// 빈값 제거
		$sv_id_arr = array_values($sv_id_arr);	// 재정렬

		if(sizeof($sv_id_arr) > 1) {
			$sv_ids = implode(',', $sv_id_arr);
		}
		else {
			$sv_ids = $sv_id_arr[0];
		}	
	}
	else {
		$sv_ids = $sv_id;
	}
}


if(!$sch_date) {
	$sch_date = date('Y-m-d');
}
$cal_arr = makeCalendarArray($sch_date);
?>
<style>
	#layer_page6.open {display:block; top:0; right:0;}
</style>
<div class="location">
	<h2>예약일시선택</h2>
	<button type="button" onclick="closeLayerPage('6')" class="location_close"><i class="xi-close"></i></button>
</div>

<div id="container6" class="container">
	<div class="res_calendar">

		<div class="date_area">
			<a href="../reserve/ajax.calendar.html?sh_code=<?=$sh_code?>&st_id=<?=$st_id?>&sv_ids=<?=$sv_ids?>&sch_date=<?=$cal_arr['prev_date']?>&rs_id=<?=$rs_id?>" class="btn_ajax prev" target="#layer_page6"><i class="xi-caret-left-circle"></i></a>
			<?=$cal_arr['title']?>
			<a href="../reserve/ajax.calendar.html?sh_code=<?=$sh_code?>&st_id=<?=$st_id?>&sv_ids=<?=$sv_ids?>&sch_date=<?=$cal_arr['next_date']?>&rs_id=<?=$rs_id?>" class="btn_ajax next" target="#layer_page6"><i class="xi-caret-right-circle"></i></a>
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
				<? if($arr2['day'] && $arr2['class'] != 'none') { ?><a href="../reserve/ajax.time.html?sh_code=<?=$sh_code?>&st_id=<?=$st_id?>&sv_ids=<?=$sv_ids?>&sch_date=<?=$arr2['date']?>&rs_id=<?=$rs_id?>" class="btn_ajax btn_choose_date <?=$arr2['class']?>" target="#reserve_timetable"><?=$arr2['day']?></a><? }
				else if($arr2['day']) { ?><span><?=$arr2['day']?></span><? }
				else { ?>&nbsp;<? } ?>		
			</td>
			<? } ?>
		</tr>
		<? } ?>	
		</tbody>
		</table>

		<ul id="reserve_timetable" class="time_list">
		<? include_once(_MODULE_PATH_.'/reserve/user/ajax.time.php'); ?>
		</ul>
	</div>

</div>
