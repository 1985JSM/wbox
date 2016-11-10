<?
if(!defined('_INPLUS_')) { exit; } 

$footer_nav['2'] = true;
$doc_title = '예약관리';
$referer_arr = array(
	'/page/main.html',
	'/reserve/list.html',
	'/reserve/list_by_calendar.html'
);
$back_url = getRefererInArray($referer_arr);

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명
$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
$data = $oReserve->selectDetail($uid);

if(!$data[$pk]) {
	movePage('../reserve/list.html');
	//alert('비정상적인 접근입니다.', '../page/main.html');
}

// 예약 성공률
if($data['rs_type'] == 'U') {
	$cnt_total = $oReserve->countByUserId($data['reg_id'], 'W,P,E,C,B');
	$cnt_ok = $oReserve->countByUserId($data['reg_id'], 'E');
	if($cnt_total > 0) {
		$per_ok = round($cnt_ok * 1000 / $cnt_total) / 10;
	}
}

// user
/*
if($data['rs_type'] == 'U') {
	global $oUser;
	if(!isset($oUser)) {
		include_once(_MODULE_PATH_.'/user/user.class.php');
		$oUser = new User();
		$oUser->init();
	}
	$us_data = $oUser->selectDetail($data['reg_id']);
}
*/

?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$(document).on("click", ".btn_change_state", function(e) {
		changeReserveState(this, "view");
		e.preventDefault();
	});
});
//]]>
</script>

	<div id="container" class="reservation2">

		<div class="res2_view">
			<div class="tit_info">
				<h3>
					<? if($data['rs_type'] != 'U') { ?>
					<span class="ico_reservation">담당자예약</span>
					<? } ?>
					<?=$data['us_name']?>
				</h3>

				<? if($data['rs_type'] == 'U') { ?>
				<ul>
				<li>예약성공률 <strong><?=number_format($cnt_ok)?></strong>건 총 <strong><?=number_format($cnt_total)?></strong>건 중 <strong class="col_orange">(<?=$per_ok?>%)</strong></li>
				<? } ?>
				</ul>
			</div>

			<ul>
			<!--li><span>주 담당자<span class="txt">김태희</span></span></li>
			<li><span>주 서비스<span class="txt">네일케어</span></span></li-->
			<? if($data['us_hp']) { ?>
			<li>
				<a href="tel:<?=$data['us_hp']?>">연락처<span class="txt"><?=$data['us_hp']?></span></a>
			</li>
			<? } ?>
			<li><span>예약서비스<span class="txt"><?=$data['sv_name']?></span></span></li>
			<li><span>예약금액<span class="txt"><?=number_format($data['sv_price'])?>원</span></span></li>
			<li><span>예약시간<span class="txt col_orange"><?=$data['txt_rs_datetime']?></span></span></li>
			<li><span>남은시간<span class="txt col_orange"><?=$data['txt_remain_time']?></span></span></li>	

			<li class="request"><span><?=getWithoutNull($data['rs_memo'], '&nbsp;')?></span></li>


			</ul>

			
			
			<ul>	
			<li><span>예약상태<span id="txt_rs_state" class="txt"><?=$data['txt_rs_state']?></span></span></li>
			<? if($data['rs_state'] == 'W' || $data['rs_state'] == 'P') { ?>
			<li>
            	<span>예약변경</span>
				<div class="btn_area">
				 <a href="../reserve/write.html?<?=$pk?>=<?=$uid?>" class="btn_gray_line_s_none">예약변경</a>
                </div>            	
            </li>
			<? } ?>
			<li>
				<span>상태변경</span>
				<div class="btn_switch2">
					<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$uid?>&rs_state=E" class="btn_change_state<? if($data['rs_state'] == 'E') { ?> on<? } ?>" title="완료">완료</a>
					<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$uid?>&rs_state=C" class="btn_change_state<? if($data['rs_state'] == 'C') { ?> on<? } ?>" title="정상취소">정상취소</a>
					<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$uid?>&rs_state=B" class="btn_change_state<? if($data['rs_state'] == 'B') { ?> on<? } ?>" title="비정상취소">비정상취소</a>
				</div>
				<!-- <div class="btn_area">
				<a href="#" class="btn_gray_line_s btn_res">예약취소/변경</a>
				<a href="#" class="btn_gray_line_s">비정상취소</a>
				</div> -->
			</li>
			<li><span>예약재확인<span class="txt"><?=getWithoutNull($data['txt_cf_datetime'])?></span></span></li>
			<li><span>취소일시<span class="txt"><?=getWithoutNull($data['txt_cc_datetime'])?></span></span></li>
			<!--li class="memo">
				<button class="btn_memo">사유 <i class="fa fa-pencil"></i></button>
				<span><?=getWithoutNull(nl2br($data['cc_memo']))?></span>
			</li-->
			<? /*	
			<li><span>취소사유<span class="txt"><?=getWithoutNull(nl2br($data['cc_memo']))?></span></span></li>
			*/ ?>
			</ul>
		</div>
	</div>
