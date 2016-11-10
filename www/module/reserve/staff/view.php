<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
$data = $oReserve->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.', '../page/main.html');
}

// 예약 성공률
if($data['rs_type'] == 'U') {
	$cnt_total = $oReserve->countByUserId($data['reg_id'], 'W,A,P,E,C,B');
	$cnt_ok = $oReserve->countByUserId($data['reg_id'], 'E');
	if($cnt_total > 0) {
		$per_ok = round($cnt_ok * 1000 / $cnt_total) / 10;
	}
}
?>
<style type="text/css">
div.reservation2 {background:#f6f6f6} /* 리스트와 동일한 css */

div.res2_view div.tit_info{ border-bottom:4px solid #f6f6f6;}
div.res2_view div.tit_info span.ico_reservation{ border-radius:0;font-size:11px;border:0; font-weight:normal; background:none;color:#f06e58;}

div.res2_view > div > h4 {margin-bottom:10px;}

div.res2_view > div.res_info {background:#fff; padding:20px 10px; margin-bottom:20px;}
div.res2_view > div.res_info {position:relative; line-height:1.0em; background:#fff;}
div.res2_view > div.res_info ul li {position:relative;  padding:8px 0 8px 80px; border-bottom:0; }
div.res2_view > div.res_info ul li em {position:absolute; top:8px; left:0; border-bottom:0; font-size:14px; font-weight:normal;color:#999;}
div.res2_view > div.res_info ul li span {position:relative; font-size:14px;}
div.res2_view > div.res_info ul li span strong {font-weight:normal;}
div.res2_view > div.res_info ul li span.service strong {display:block; padding-top:8px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
div.res2_view > div.res_info ul li span.service strong:first-child {padding-top:0; }


div.res2_view > div.res_comment {position:relative; padding:20px 10px 10px; margin-bottom:20px; line-height:1.5em; background:#fff;   color:#555;}
div.res2_view > div.res_comment span.no_date {display:block;color:#999;}

div.res2_view > div.res_state {position:relative; line-height:1.0em;background:#fff; padding:20px 10px; margin-bottom:20px;}
div.res2_view > div.res_state ul li {position:relative;  padding:8px 0 8px 80px; border-bottom:0; }
div.res2_view > div.res_state ul li em {position:absolute; top:8px; left:0; border-bottom:0; font-size:14px; font-weight:normal;color:#999;}
div.res2_view > div.res_state ul li span {position:relative; font-size:14px;}
div.res2_view > div.res_state ul li span strong {font-weight:normal;}
div.res2_view > div.res_state ul li span.service strong {display:block; padding-top:8px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
div.res2_view > div.res_state ul li span.service strong:first-child {padding-top:0; }


div.res2_view > div.res_state span.state_W {font-size:14px; font-weight:bold; color:#12aec3;} /* 신청중 */
div.res2_view > div.res_state span.state_F {font-size:14px; font-weight:bold; color:#9e6eaf;} /* 담당자확정 */
div.res2_view > div.res_state span.state_P {font-size:14px; font-weight:bold; color:#f06e58;} /* 진행중 */
div.res2_view > div.res_state span.state_E {font-size:14px; font-weight:bold; color:#12aec3;} /* 완료 */
div.res2_view > div.res_state span.state_C {font-size:14px; font-weight:bold; color:#888;} /* 정상취소 */
div.res2_view > div.res_state span.state_B {font-size:14px; font-weight:bold; color:#f06e58;}


div.res2_view > div.res_state div.btn_switch2{ position:relative;top:0;right:0;}
div.res2_view > div.res_state div.btn_switch2:after{display:block;content:'';clear:both;}
div.res2_view > div.res_state div.btn_switch2 a{display:block; width:25%;  height:30px; padding:0; margin-left:-1px; float:left; line-height:30px;box-sizing:border-box;  border:1px solid #fff; text-align:center; font-size:12px;  background:#ebebeb; color:#bbb;}
div.res2_view > div.res_state div.btn_switch2 a:first-child{border-radius:2px 0 0 2px;}
div.res2_view > div.res_state div.btn_switch2 a:last-child{border-radius:0px 2px 2px 0px;}
div.res2_view > div.res_state div.btn_switch2 a.on{position:relative; z-index:5; color:#fff; border:1px solid #fff; background:#72ced4; }

div.res2_view > div.btn_area {padding:0 10px 20px 10px; box-sizing:border-box}

/*
div.res2_view > div.res_info > ul { position:relative; margin-bottom:6px; clear:both;display:block; content:''; background:#fff;}
div.res2_view > div.res_info > ul :after{position:absolute; display:block; content:''; width:100%;height:0; background:none; bottom:-1px;left:0}
div.res2_view > div.res_info > ul  > li{ position:relative; }

div.res2_view > div.res_info > ul  > li > a, div.res2_view > div.res_info > ul > li > span{display:block;height:50px; line-height:50px; padding:0 50px 0 10px; background:#fff; border-bottom:1px solid #ececec;text-overflow:ellipsis; white-space:nowrap; overflow:hidden}
div.res2_view > div.res_info > ul  > li.request > span{ overflow:visible; height:auto; padding:10px 10px; line-height:18px;  white-space:normal; }
div.res2_view > div.res_info > ul > li > a i{color:#888; position:absolute;top:0;right:15px; line-height:50px}
div.res2_view > div.res_info > ul > li .txt{ position:absolute; top:0; right:15px; }
div.res2_view > div.res_info > ul > li .txt2{ position:absolute; top:0; right:15px; padding-left:200px; }
*/


/* 버튼 아이콘(리스트와 동일한 css) */
div.reservation2 div.ico_info {position:absolute; top:10px; right:10px; padding:0;}
div.reservation2 div.ico_info ul:after { clear:both; display:block; content:""; }
div.reservation2 div.ico_info ul li {float:left; position:relative; top:0; right:0; padding:0; margin:0 0 0 4px; width:44px; height:44px; border-radius:44px; border-bottom:0;  text-align:center; font-size:11px; box-sizing:border-box;  line-height:1.25em; }
div.reservation2 div.ico_info ul li.icon_info {padding-top:8px;border:2px solid #ececec; background:#fff; }
div.reservation2 div.ico_info ul li.icon_info a {display:block; width:100%; padding:0; color:#555; }
div.reservation2 div.ico_info ul li.basic_info { background:#cccccc; color:#fff;  }
div.reservation2 div.ico_info ul li.basic_info.on { background:#58585a; }
div.reservation2 div.ico_info ul li.basic_info a {display:block; width:100%; padding:8px 0 0 0; color:#fff; }
div.reservation2 div.ico_info ul li.basic_info a i {display:block; position:relative; font-size:11px; height:auto; color:#fff; line-height:1.25em; top:0; right:0; }
div.reservation2 div.ico_info ul li.icon { padding-top:8px;background:#ff3f1e; color:#fff;  }
div.reservation2 div.ico_info ul li.icon i {display:block;}
/* 버튼 아이콘 끝 */
</style>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div class="location">
	<h2>예약정보</h2>
	<button type="button" onclick="closeLayerPage('3')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container3" class="container">

	<div class="reservation2">
		<div class="res2_view rs_id_<?=$uid?>">
			<div class="tit_info">
				<h3>					
					<?=$data['us_name']?>
					<? if($data['rs_type'] != 'U') { ?><span class="ico_reservation">담당자예약</span><? } ?>
				</h3>

				<div class="ico_info">
					<ul>		
					<li class="basic_info<? if($data['rs_pay_memo']) { ?> on<? } ?>"><a href="../reserve/memo.html?<?=$pk?>=<?=$data[$pk]?>" class="btn_layer_page rs_pay_memo" target="#layer_page6"><i class="xi-file-text"></i>메모</a></li>
					<? if($data['flag_approach']) { ?><li class="icon"><i class="xi-check"></i>임박</li><? } ?>
					</ul>
				</div>	

				<? if($data['rs_type'] == 'U') { ?>
				<ul>
				<li>예약성공률 <strong class="col_orange"><?=$per_ok?>%</strong> (총 <strong><?=number_format($cnt_total)?></strong>건 중 완료 <strong><?=number_format($cnt_ok)?></strong>건) </li>
				<? } ?>
				</ul>
			</div>

			<div class="res_info">
				<h4>예약정보</h4>
				<ul>
				<? if($data['us_hp']) { ?>
				<li>
					<a href="tel:<?=$data['us_hp']?>">
					<em>연락처</em>
					<span class="txt"><?=$data['us_hp']?></span>
					</a>
				</li>
				<? } ?>
				<li>
					<em>예약서비스</em>
					<span class="service">		
						<? for($j = 0 ; $j < sizeof($data['sv_name_list']) ; $j++) { ?>
						<strong><?=$data['sv_name_list'][$j]?></strong>
						<? } ?>
					</span>
				</li>
				<li>
					<em>예약금액</em>
					<span><?=number_format($data['sv_price'])?>원</span>
				</li>
				<li>
					<em>예약일시</em>
					<span class="txt col_orange"><?=$data['txt_rs_datetime']?></span>
				</li>
				<li>
					<em>남은시간</em>
					<span class="txt col_orange"><?=$data['txt_remain_time']?></span>
				</li>	
				</ul>
			</div>

			<div class="res_comment">
				<h4>요청사항</h4>
				<span><?=getWithoutNull($data['rs_user_memo'], '요청사항이 없습니다.')?></span>
			</div>

			<div class="res_state">
				<h4>예약상태</h4>
				<ul>
				<li>
					<em>예약상태</em>
					<span class="txt_rs_state txt state_<?=$data['rs_state']?>"><?=$data['txt_rs_state']?></span>
				</li>
				<li>
					<em>담당자승인</em>
					<span class="txt"><?=getWithoutNull($data['txt_ac_datetime'])?></span>
				</li>
				<li>
					<em>예약확정</em>
					<span class="txt"><?=getWithoutNull($data['txt_cf_datetime'])?></span>
				</li>
				<li>
					<em>취소일시</em>
					<span class="txt"><?=getWithoutNull($data['txt_cc_datetime'])?></span>
				</li>
				</ul>

				<div class="btn_switch2">
					<? if($data['flag_accept']) { ?><a href="../reserve/accept.html?<?=$pk?>=<?=$uid?>" class="btn_layer_page rs_accept" target="#layer_page4" title="예약승인">예약승인</a><? } ?>
					<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$uid?>&rs_state=E" class="btn_change_state rs_state_E<? if($data['rs_state'] == 'E') { ?> on<? } ?>" title="완료">완료</a>
					<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$uid?>&rs_state=C" class="btn_change_state rs_state_C<? if($data['rs_state'] == 'C') { ?> on<? } ?>" title="정상취소">정상취소</a>
					<a href="../reserve/process.html?mode=update_state&<?=$pk?>=<?=$uid?>&rs_state=B" class="btn_change_state rs_state_B<? if($data['rs_state'] == 'B') { ?> on<? } ?>" title="비정상취소">비정상취소</a>
				</div>
			</div>

			<div class="btn_area">
				<a href="../reserve/write.html?<?=$pk?>=<?=$uid?>" class="btn_layer_page btn_orange" target="#layer_page5">예약변경</a>
			</div> 
		
		</div>
		
	</div>
	<!-- //res2_view -->
</div>
<!-- //reservation2 -->