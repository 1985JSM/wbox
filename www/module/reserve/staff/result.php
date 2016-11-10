<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();
$uid = $oReserve->get('uid');

$data = $oReserve->selectDetail($uid);
$module_name = $oReserve->get('module_name');	// 모듈명

$sv_name_list = $data['sv_name_list'];
?>
<style type="text/css">
div.reservation3 {background:#f6f6f6}
div.reservation3 div.res3_view p.reservation_success {line-height:80px; font-size:18px; border-bottom:4px solid #f6f6f6; background-position:50% 30px;  }
div.reservation3 div.res3_view div {border-bottom:4px solid #f6f6f6;}
div.reservation3 div.res3_info {padding:10px 10px;}

div.reservation3 div.res3_view div.res3_info {position:relative; line-height:1.0em; background:#fff;}
div.reservation3 div.res3_view div.res3_info ul li {position:relative;  padding:8px 0 8px 100px; border-bottom:0; }
div.reservation3 div.res3_view div.res3_info ul li em {position:absolute; top:8px; left:0; border-bottom:0; font-size:14px; font-weight:normal;color:#999;}
div.reservation3 div.res3_view div.res3_info ul li span {position:relative; font-size:14px;}
div.reservation3 div.res3_view div.res3_info ul li span strong {font-weight:normal;}
div.reservation3 div.res3_view div.res3_info ul li span.service strong {display:block; padding-top:8px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
div.reservation3 div.res3_view div.res3_info ul li span.service strong:first-child {padding-top:0; }

div.reservation3 div.res3_comment {position:relative; line-height:1.5em; background:#fff; padding:10px 10px 10px 10px;  color:#555;}
div.reservation3 div.res3_comment p {padding-bottom:10px; font-size:14px; font-weight:normal; color:#999;}
div.reservation3 div.res3_comment span.no_date {display:block;color:#999;}
</style>

<div class="location">
	<h2>예약완료</h2>
	<button type="button" onclick="closeLayerPage('5')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container5" class="container">
	<div class="reservation3">
		<div class="res3_view">
			<p class="reservation_success"><strong class="col_orange">예약</strong>이 완료되었습니다.</p>		
			
			<div class="res3_info">
				<ul>
				<li>
					<em><i class="xi-shop"></i> 이용매장</em>
					<span><?=$data['sh_name']?></span>
				</li>
				<li>
					<em><i class="xi-user"></i> 담당자</em>
					<span><?=$data['st_name']?></span>
				</li>
				<li>
					<em><i class="xi-check-circleout"></i> 서비스</em>
					<span class="service">
						<? for($i = 0 ; $i < sizeof($sv_name_list) ; $i++) { ?>
						<strong><?=$sv_name_list[$i]?></strong>
						<? } ?>
					</span>
				</li>
				<li>
					<em><i class="xi-won"></i> 예약금액</em>
					<span><?=number_format($data['sv_price'])?>원</span>
				</li>
				<li>
					<em><i class="xi-calendar"></i> 예약일시</em>
					<span><strong class="col_orange"><?=$data['txt_rs_datetime']?></strong></span>
				</li>
				</ul>
			</div>

			<div class="res3_comment">
				<p><i class="xi-comment"></i> 요청사항</p>
				<?=nl2br(getWithoutNull($data['rs_user_memo'], '<span class="no_date">요청하신 내용이 없습니다.</span>'))?>					
			</div>

		</div>

		<ul class="res3_view_btn">
		<li><a href="../page/main.html" class="btn_gray">홈으로</a></li>
		<li><a href="../reserve/wait_list.html" class="btn_orange">예약관리</a></li>
		</ul>
	</div>
</div>
