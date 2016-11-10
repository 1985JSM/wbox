<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* init Class */
if(!isset($oReserve)) {
	$oReserve = new ReserveManager();
	$oReserve->init();
}

if(!$sch_rs_date) { $sch_rs_date = $sch_date; }
$oReserve->set('sch_rs_date', $sch_rs_date);

if($sch_st_id) { $oReserve->set('sch_st_id', $sch_st_id); }
$oReserve->set('cnt_rows', 9999);

$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
if($uid) {
	$list = array(
		'0'	=> $oReserve->selectDetail($uid)
	);
}
else {
	$list = $oReserve->selectList();
}

/* customer */
if(!isset($oCustomer)) {
	include_once(_MODULE_PATH_.'/customer/customer.manager.class.php');
	$oCustomer = new CustomerManager();
	$oCustomer->init();
}
?>
<ul>
<? for($i = 0 ; $i < sizeof($list) ; $i++) {
	$cs_data = $oCustomer->selectDetail($list[$i]['cs_id']);
	?>
<li>
	<div class="dashboard_aside_top">
		<h4>예약정보확인</h4>
		<span class="state<?=$list[$i]['rs_state']?>"><?=$list[$i]['txt_rs_state']?></span>
	</div>

	<ul>
	<li>
		<strong>고객명</strong>
		<span class="name">
			<a href="../customer/view.html?cs_id=<?=$list[$i]['cs_id']?>" target="_blank"><?=$list[$i]['us_name']?></a>
			<a href="../reserve/ajax.dashboard_memo.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_600x300" target="#layer_popup" title="관리자메모"><img src="/img/manager/ico_memo.gif" alt="관리자메모" /></a>
		</span>
	</li>
	<li>
		<strong>등급</strong>
		<span class="level"><?=getWithoutNull($cs_data['txt_cs_level'])?></span>
	</li>
	<li>
		<strong>연락처</strong>
		<span><?=$list[$i]['us_hp']?></span>
	</li>
	<li>
		<strong>담당자</strong>
		<span><?=$list[$i]['st_name']?></span>
	</li>
	<li>
		<strong>서비스</strong>
		<span class="service">
			<? $sv_list = $list[$i]['sv_name_list'];
			for($j = 0 ; $j < sizeof($sv_list) ; $j++) { ?>
			<em><?=$sv_list[$j]?></em>
			<? } ?>
		</span>
	</li>	
	<li>
		<strong>소요시간</strong>
		<span><?=$list[$i]['sv_time']?>분</span>
	</li>	
	<li>
		<strong>예약일시</strong>
		<span class="time"><?=$list[$i]['txt_rs_datetime']?></span>
	</li>
	<? if($list[$i]['rs_state']  == 'A' || $list[$i]['rs_state']  == 'P' || $list[$i]['rs_state']  == 'E') { ?>
	<li>
		<strong>담당자승인</strong>
		<span class="time"><?=getWithoutNull($list[$i]['txt_ac_datetime'])?></span>
	</li>
	<? } ?>
	<? if($list[$i]['rs_state']  == 'P' || $list[$i]['rs_state']  == 'E') { ?>
	<li>
		<strong>예약확정</strong>
		<span class="time"><?=getWithoutNull($list[$i]['txt_cf_datetime'])?></span>
	</li>
	<? } ?>
	<? if($list[$i]['rs_state']  == 'C' || $list[$i]['rs_state']  == 'B') { ?>
	<li>
		<strong>취소일시</strong>
		<span class="time"><?=getWithoutNull($list[$i]['txt_cc_datetime'])?></span>
	</li>
	<? } ?>
	<? if($list[$i]['rs_user_memo']) { ?>
	<li>		
		<strong>요청사항</strong>
		<span class="memo"><?=getWithoutNull($list[$i]['rs_user_memo'])?></span>
	</li>
	<? } ?>
	</ul>
	
	<div class="dashboard_aside_bottom">
		<div class="btn_state<? if($list[$i]['rs_state'] != 'W') { ?> state_after<? } ?>">
			<ul>		
			<? if($list[$i]['rs_state'] == 'W') { ?>
			<li><a href="./ajax.dashboard_accept.html?<?=$pk?>=<?=$list[$i][$pk]?>&list_mode=<?=$list_mode?>&sch_rs_date=<?=$sch_rs_date?>&sch_st_id=<?=$sch_st_id?>" class="btn_ajax size_600x300 approve" target="#layer_popup" title="담당자승인">승인전</a></li>
			<? } ?>
			<li><a href="./ajax.dashboard_reserve.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax state size_800x800" target="#layer_popup" title="예약변경">예약변경</a></li>
			<li>
				<div class="state_area">
					<span><button type="button" onclick="toggleChangeState(this)" class="select">상태변경</button></span>
					<ul>
					<li><button type="button" onclick="changeReserveState('<?=$list[$i][$pk]?>', 'E')">완료</button></li>
					<li><button type="button" onclick="changeReserveState('<?=$list[$i][$pk]?>', 'C')">정상취소</button></li>
					<li><button type="button" onclick="changeReserveState('<?=$list[$i][$pk]?>', 'B')">비정상취소</button></li>
					</ul>					
				</div>
			</li>
			</ul>
		</div>
		<div class="btn_pay"><a href="./ajax.dashboard_payment.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_800x800" target="#layer_popup" title="결제정보">결제</a></div>		
	</div>	
</li>
<? } ?>
</ul>

<form name="change_state_form" method="post" action="./process.html" target="#reserve_list">
<input type="hidden" name="mode" value="update_state" />
<input type="hidden" name="list_mode" value="<?=$list_mode?>" />
<input type="hidden" name="sch_rs_date" value="<?=$sch_rs_date?>" />
<input type="hidden" name="sch_st_id" value="<?=$sch_st_id?>" />

<input type="hidden" name="<?=$pk?>" value="" />
<input type="hidden" name="rs_state" value="" />
</form>
