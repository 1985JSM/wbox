<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();

/*
// shop
global $oShop;
if(!isset($oShop)) {
	include_once(_MODULE_PATH_.'/shop/shop.user.class.php');
	$oShop = new ShopStaff();
	$oShop->init();
}
$sh_data = $oShop->selectDetail($sh_code);
*/
/* calendar */
if(!$sch_date) {
	$sch_date = date('Y-m-d');
}
$cal_arr = makeCalendarArray($sch_date);
?>
<div class="res_calendar">
	<div class="date_area">
		<a href="../reserve/ajax_calendar.html?sh_code=<?=$sh_code?>&st_id=<?=$st_id?>&sv_id=<?=$sv_id?>&sch_date=<?=$cal_arr['prev_date']?>" class="btn_ajax prev" target="#layer_content"><i class="fa fa-angle-left"></i></a>
		<?=$cal_arr['title']?>
		<a href="../reserve/ajax_calendar.html?sh_code=<?=$sh_code?>&st_id=<?=$st_id?>&sv_id=<?=$sv_id?>&sch_date=<?=$cal_arr['next_date']?>" class="btn_ajax next" target="#layer_content"><i class="fa fa-angle-right"></i></a>
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
			<? if($arr2['day'] && $arr2['class'] != 'none') { ?><a href="../reserve/ajax_time.html?sh_code=<?=$sh_code?>&st_id=<?=$st_id?>&sv_id=<?=$sv_id?>&sch_date=<?=$arr2['date']?>" class="btn_ajax btn_choose_date <?=$arr2['class']?>" target="#timetable"><?=$arr2['day']?></a><? }
			else if($arr2['day']) { ?><span><?=$arr2['day']?></span><? }
			else { ?>&nbsp;<? } ?>		
		</td>
		<? } ?>
	</tr>
	<? } ?>	
	</tbody>
	</table>

	<ul id="timetable" class="time_list">
	<? include_once(_MODULE_PATH_.'/reserve/staff/ajax_time.php'); ?>
	</ul>
</div>
