<?
if(!isset($oRerserve)) {
	$oReserve = new ReserveStaff();
	$oReserve->init();
	$pk = $oReserve->get('pk');
}

/* list */
if(!$list_mode) {
	$list_mode = $_GET['list_mode'];
}
$oReserve->set('list_mode', $list_mode);

if(!$sch_order_direct) {
	$sch_order_direct = 'desc';
}
$oReserve->set('order_direct', $sch_order_direct);

if(!$sch_order_field) {
	$oReserve->set('order_field', $sch_order_field);
}
$list = $oReserve->selectList();

$order_direct = $oReserve->get('order_direct');
for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>
	<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>">
		<span class="tit">
			<? if($list[$i]['rs_type'] != 'U') { ?>
			<span class="ico_reservation">담당자예약</span>
			<? } ?>
			<?=$list[$i]['us_name']?>			
		</span>		
		<span class="txt"><?=$list[$i]['txt_rs_datetime']?></span>
		<span class="txt">신청일시 : <?=$list[$i]['reg_time']?></span>
		<span class="txt">
			<span class="col_blue"><?=$list[$i]['sv_name']?></span>
			 | <span class="txt_rs_state state_<?=$list[$i]['rs_state']?>"><?=$list[$i]['txt_rs_state']?></span>
		</span>
		<? if($list[$i]['flag_approach'] && $list_mode == 'wait') { ?>
		<span class="icon">임박</span>
		<? } else  {?>
		<i class="fa fa-angle-right"></i>
		<? } ?>
	</a>
	<div class="btn_switch2">
		<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$list[$i][$pk]?>&rs_state=E" class="btn_change_state<? if($list[$i]['rs_state'] == 'E') { ?> on<? } ?>" title="완료">완료</a>
		<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$list[$i][$pk]?>&rs_state=C" class="btn_change_state<? if($list[$i]['rs_state'] == 'C') { ?> on<? } ?>" title="정상취소">정상취소</a>
		<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$list[$i][$pk]?>&rs_state=B" class="btn_change_state<? if($list[$i]['rs_state'] == 'B') { ?> on<? } ?>" title="비정상취소">비정상취소</a>
	</div>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<? if($list_mode == 'wait') { ?><p>진행중인 예약이 없습니다.</p><? } ?>
	<? if($list_mode == 'end') { ?><p>종료된 예약이 없습니다.</p><? } ?>
</li>
<? } ?>