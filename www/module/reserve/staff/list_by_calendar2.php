<?
if(!defined('_INPLUS_')) { exit; } 

$footer_nav['3'] = true;
$doc_title = '일정관리';

/* init Class */
$oReserve = new ReserveStaff();
$list_mode = $_GET['list_mode'];
if(!$list_mode) { $list_mode = 'wait'; }
if($list_mode == 'wait') {
	$oReserve->set('order_direct', 'asc');
}
$oReserve->set('list_mode', $list_mode);

$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>
<style type="text/css">
div.date {background:#f6f6f6}
div.date div.res_calendar {margin:0 0 20px 0; padding:10px; background:#fff;}

div.date > div.res_info {position:relative;padding:20px 0; line-height:1.0em;  background:#fff;}
div.date > div.res_info h3 {margin-bottom:10px; padding:0 10px 10px 10px; border-bottom:4px solid #f6f6f6;}
div.date > div.res_info > ul {}
div.date > div.res_info > ul > li {position:relative; padding:20px 10px; border-bottom:0;  border-bottom:4px solid #f6f6f6;}
div.date > div.res_info > ul > li ul li {position:relative; padding:4px 0 4px 80px;}
div.date > div.res_info > ul > li strong.user_name {display:block; margin-bottom:16px; padding-right:100px; color:#333;} 
div.date > div.res_info > ul > li span.ico_reservation{ border-radius:0;font-size:11px;border:0; font-weight:normal; background:none;color:#f06e58;}


div.date > div.res_info > ul > li ul li em {position:absolute; top:4px; left:0; border-bottom:0; font-size:12px; font-weight:normal;color:#999;}
div.date > div.res_info > ul > li ul li em.state_W {font-size:14px; font-weight:bold; color:#12aec3;} /* 신청중 */
div.date > div.res_info > ul > li ul li em.state_F {font-size:14px; font-weight:bold; color:#9e6eaf;} /* 담당자확정 */
div.date > div.res_info > ul > li ul li em.state_P {font-size:14px; font-weight:bold; color:#f06e58;} /* 진행중 */
div.date > div.res_info > ul > li ul li em.state_E {font-size:14px; font-weight:bold; color:#12aec3;} /* 완료 */
div.date > div.res_info > ul > li ul li em.state_C {font-size:14px; font-weight:bold; color:#888;} /* 정상취소 */
div.date > div.res_info > ul > li ul li em.state_B {font-size:14px; font-weight:bold; color:#f06e58;} /* 비정상취소 */

div.date > div.res_info > ul > li ul li span {position:relative; font-size:12px;}

div.date > div.res_info > ul > li ul li.res_state { min-height:14px;margin-bottom:8px; }
div.date > div.res_info > ul > li ul li.res_state em {font-size:14px;}
div.date > div.res_info > ul > li ul li.res_state span {font-size:11px; }

div.date > div.res_info > ul > li ul li span strong {font-weight:normal;}
div.date > div.res_info > ul > li ul li span.service strong {display:block; padding-top:4px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
div.date > div.res_info > ul > li ul li span.service strong:first-child {padding-top:0; }

div.date > div.res_info > ul > li.no_date {padding:15px 10px; text-align:center;color:#888}

/* 버튼 아이콘 */
div.date > div.res_info > ul > li  div.ico_info {position:absolute; top:10px; right:10px; padding:0;}
div.date > div.res_info > ul > li  div.ico_info ul:after { clear:both; display:block; content:""; }
div.date > div.res_info > ul > li  div.ico_info ul li {float:left; position:relative; top:0; right:0; padding:0; margin:0 0 0 4px; width:44px; height:44px; border-radius:44px; border-bottom:0;  text-align:center; font-size:11px; box-sizing:border-box;  line-height:1.25em; }
div.date > div.res_info > ul > li  div.ico_info ul li.icon_info {padding-top:8px;border:2px solid #ececec; background:#fff; }
div.date > div.res_info > ul > li  div.ico_info ul li.icon_info a {display:block; width:100%; padding:0; color:#555; }
div.date > div.res_info > ul > li  div.ico_info ul li.basic_info { background:#cccccc; color:#fff;  }
div.date > div.res_info > ul > li  div.ico_info ul li.basic_info.on { background:#58585a; }
div.date > div.res_info > ul > li  div.ico_info ul li.basic_info a {display:block; width:100%; padding:8px 0 0 0; color:#fff; }
div.date > div.res_info > ul > li  div.ico_info ul li.basic_info a i {display:block; position:relative; font-size:11px; height:auto; color:#fff; line-height:1.25em; top:0; right:0; }
div.date > div.res_info > ul > li  div.ico_info ul li.icon { padding-top:8px;background:#ff3f1e; color:#fff;  }
div.date > div.res_info > ul > li  div.ico_info ul li.icon i {display:block;}
/* 버튼 아이콘 끝 */

#layer_popup div.layer_res_list div {margin-top:10px;}
#layer_popup div.layer_res_list div:first-child {margin-top:0;}

</style>

	<div class="tab">
    	<ul class="tab_list tab_list02">
        <li class="on"><a href="../reserve/list_by_calendar.html">일정관리</a></li>
        <li><a href="../member/setting.html">설정</a></li>
        </ul>
    </div>    
    
	<div id="container" class="container">
		<div class="date">
			<? include_once(_MODULE_PATH_.'/reserve/staff/ajax_calendar2.php'); ?>			

			<div class="res_info">
				<h3>이 날의 예약 <strong class="col_orange">2</strong>건</h3>
				<ul>
				<li>
					<a href="#" target="_self">

						<strong class="user_name">
							김은지
							<span class="ico_reservation">담당자예약</span>
						</strong>

						<ul>
						<li class="res_state">
							<em class="txt_rs_state state_W">신청중</em>
						</li>
						<li>
							<em><i class="xi-calendar"></i> 예약일시</em>
							<span><strong class="col_orange">2016년 05월 28일 (토) 11:30</strong></span>
						</li>
						<li>
							<em><i class="xi-calendar"></i> 신청일시</em>
							<span><strong>2016-05-14 21:04:11</strong></span>
						</li>
						<li>
							<em><i class="xi-check-circleout"></i> 서비스</em>
							<span class="service">
								<strong>서비스명</strong>
								<strong>서비스가 2종류일때는 이렇게 들어가게됩니다.</strong>
							</span>
						</li>		
						</ul>
					</a>
					<div class="ico_info">
						<ul>		
						<li class="icon_info"><a href="" target="_self">기본<br />정보</a></li>		
						<li class="basic_info on"><a href="" target="_self"><i class="xi-file-text"></i>메모</a></li>	<!-- 입력한 메모가 있는 경우에는 on으로 활성화된다 -->
						<li class="icon"><i class="xi-check"></i>임박</li>
						</ul>
					</div>
				</li>
				<li class="no_date">예약이 없습니다.</li>
				</ul>
			</div>
		</div>
	</div>

<!-- 시간 선택시 뜨는 레이어 팝업 -->
<div id="layer_popup" style="width: 290px; height: 190px; margin-top: -95px; margin-left: -145px; display: block;">
	<h2>예약정보</h2>
	<button type="button" onclick="closeLayerPopup()" id="btn_close_layer"><i class="xi-close"></i></button>
	
	
	
</div>
<!-- //시간 선택시 뜨는 레이어 팝업 -->