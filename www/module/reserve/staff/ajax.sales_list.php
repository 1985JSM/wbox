<?
if(!isset($oReserve)) {
	$oReserve = new ReserveStaff();
	$oReserve->init();
}

/* list */
$oReserve->set('list_mode', $list_mode);
$oReserve->set('sch_date_type', $sch_date_type);
$oReserve->set('sch_s_date', $sch_s_date);
$oReserve->set('sch_e_date', $sch_e_date);

# 예약정보 수정 후 출력 화면을 동기화 하기 위해서
$list = $oReserve->selectList();
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
<li>			
	<div class="sales_area">
		<div>
			<p class="data"><?=$list[$i]['rs_date']?></p>
			<p class="service"><strong><?=$list[$i]['txt_rs_type']?></strong> <?=$list[$i]['txt_sv_names']?></p>
		</div>

		<div class="sales_left">
			<ul>
			<li><em>서비스금액</em><?=number_format($list[$i]['sv_price'])?></li>
			<li><em>일반할인</em><?=getWithoutNull(number_format($list[$i]['pm_sale_price']))?></li>
			<li><em>쿠폰사용</em><?=getWithoutNull(number_format($list[$i]['pm_coupon_price']))?></li>
			<li><em>선불제사용</em><?=getWithoutNull(number_format($list[$i]['pm_advance_price']))?></li>
			</ul>
		</div>
		<div class="sales_right">
			<ul>
			<li><em>결제금액</em><strong><?=number_format($list[$i]['total_price'])?></strong></li>
			<li class="icon"><em>카드</em><?=getWithoutNull(number_format($list[$i]['pm_card_price']))?></li>
			<li class="icon"><em>현금</em><?=getWithoutNull(number_format($list[$i]['pm_cash_price']))?></li>
			</ul>
		</div>

	</div>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p>매출 내역이 없습니다.</p>
</li>
<? } ?>
