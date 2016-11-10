<?
if(!isset($oReserve)) {
	$oReserve = new ReserveStaff();
	$oReserve->init();
}

/* list */
$oReserve->set('list_mode', $list_mode);
$oReserve->set('order_field', $sch_order_field);
$oReserve->set('order_direct', $sch_order_direct);

# 예약정보 수정 후 출력 화면을 동기화 하기 위해서
if($post_data) {
	$list = array(
		'0'	=> $post_data
	);	
}
else {
	$list = $oReserve->selectList();
}
$total_cnt = $oReserve->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oReserve->get('pk');

if($this_cnt == 0) {
	$next_page = 0;
}
else {
	$next_page = $page + 1;
}

$json_etc = array(
	'total_cnt'	=> $total_cnt,
	'this_cnt'	=> $this_cnt,
	'next_page'	=> $next_page
);
for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li class="rs_id_<?=$list[$i][$pk]?>">
	<a href="../reserve/view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page3">

		<strong class="user_name">
			<?=$list[$i]['us_name']?>
			<? if($list[$i]['rs_type'] != 'U') { ?><span class="ico_reservation">담당자예약</span><? } ?>
		</strong>

		<ul class="res_info">
		<li class="res_state">
			<em class="txt_rs_state state_<?=$list[$i]['rs_state']?>"><?=$list[$i]['txt_rs_state']?></em>
			<? if(!$flag_no_state && $list[$i]['flag_accept']) { ?><span><i class="xi-info-circle"></i> 예약승인은 아래 <strong class="col_orange">예약승인</strong> 버튼을 클릭해주세요</span><? } ?>
		</li>
		<li>
			<em><i class="xi-calendar"></i> 예약일시</em>
			<span><strong class="col_orange"><?=$list[$i]['txt_rs_datetime']?></strong></span>
		</li>
		<li>
			<em><i class="xi-calendar"></i> 신청일시</em>
			<span><strong> <?=substr($list[$i]['reg_time'], 0, 16)?></strong></span>
		</li>
		<li>
			<em><i class="xi-check-circleout"></i> 서비스</em>
			<span class="service">
				<? for($j = 0 ; $j < sizeof($list[$i]['sv_name_list']) ; $j++) { ?>
				<strong><?=$list[$i]['sv_name_list'][$j]?></strong>
				<? } ?>
			</span>
		</li>		
		</ul>
	</a> 

	<div class="ico_info">
		<ul>		
		<li class="icon_info"><a href="../customer/view.html?cs_id=<?=$list[$i]['cs_id']?>" class="btn_layer_page" target="#layer_page6">고객<br />정보</a></li>		
		<li class="basic_info<? if($list[$i]['rs_pay_memo']) { ?> on<? } ?>"><a href="../reserve/memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="rs_pay_memo btn_layer_page" target="#layer_page6"><i class="xi-file-text"></i>메모</a></li>
		<? if($list[$i]['flag_approach']) { ?><li class="icon"><i class="xi-check"></i>임박</li><? } ?>
		</ul>
	</div>	

	<? if(!$flag_no_state) { ?>
	<div class="btn_switch2">
		<? if($list[$i]['flag_accept']) { ?><a href="../reserve/accept.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page rs_accept" target="#layer_page4" title="예약승인">예약승인</a><? } ?>
		<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$list[$i][$pk]?>&rs_state=E" class="btn_change_state rs_state_E<? if($list[$i]['rs_state'] == 'E') { ?> on<? } ?>" title="완료">완료</a>
		<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$list[$i][$pk]?>&rs_state=C" class="btn_change_state rs_state_C<? if($list[$i]['rs_state'] == 'C') { ?> on<? } ?>" title="정상취소">정상취소</a>
		<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$list[$i][$pk]?>&rs_state=B" class="btn_change_state rs_state_B<? if($list[$i]['rs_state'] == 'B') { ?> on<? } ?>" title="비정상취소">비정상취소</a>
	</div>
	<? } ?>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p>예약 내역이 없습니다.</p>
</li>
<? } ?>
