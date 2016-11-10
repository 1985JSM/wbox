<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

/* insert or update */
$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
if($uid) {
	$data = $oReserve->selectDetail($uid);	
}

$sh_code = $member['sh_code'];
$st_id = $member['mb_id'];
$txt_st_name = $member['txt_staff'];

// shop
global $oShop;
if(!isset($oShop)) {
	include_once(_MODULE_PATH_.'/shop/shop.user.class.php');
	$oShop = new ShopUser();
	$oShop->init();
}
$sh_data = $oShop->selectDetail($sh_code);

// default
if($data[$pk]) {
	$mode = 'update';	
	$sv_id = $data['sv_id'];
	
	$txt_sv_name = $data['sv_name'];
	$txt_rs_date = $data['txt_rs_datetime'];

	$txt_confirm = '변경하기';
	$back_url = '../reserve/list.html';
	$doc_title = '예약변경';
}
else {
	$mode = 'insert';

	$txt_sv_name = '서비스 선택';
	$txt_rs_date = '날짜/시간 선택';

	$txt_confirm = '예약하기';	
	$doc_title = '예약하기';

	$referer_arr = array(
		'/shop/view.html',
		'/shop/my_list.html',
		'/shop/list_by_location.html',
		'/shop/list_by_sigungu.html',
		'/search/list.html',
		'/shop/list_from_search.htm',
		'/staff/list_from_search.htm',		
	);
	$back_url = getRefererInArray($referer_arr);
}

if($mode == 'update' && $data['rs_state'] != 'W' && $data['rs_state'] != 'P') {
	alert('진행중인 예약건만 수정 가능합니다.');
}
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	var mode = "<?=$mode?>";
	var st_id = "<?=$st_id?>";
	var sv_id = "<?=$sv_id?>";

	if(mode == "update") {

	}
	else if(st_id && reserve_type == "staff") {
		var obj_staff = $("#staff_list").find("input.st_id");
		for(var i = 0 ; i < obj_staff.length ; i++) {
			if(obj_staff.eq(i).val() == st_id) {
				chooseStaff(obj_staff.eq(i).parent("li").find("button"));
			}
		}
	}	
	else if(sv_id && reserve_type == "service") {
		var obj_service = $("#service_list").find("input.sv_id");
		for(var i = 0 ; i < obj_service.length ; i++) {
			if(obj_service.eq(i).val() == sv_id) {
				chooseService(obj_service.eq(i).parent("li").find("button"));
			}
		}
	}
});

var reserve_type = "<?=$reserve_type?>";
//]]>
</script>
<style style="text/css">
div.reservation {background:#f6f6f6;}
div.reservation > form > div { position:relative; margin-bottom:20px; padding:20px 10px; background:#fff; }
div.reservation > form > div > span.tit {display:block; padding-bottom:10px; font-weight:bold; color:#333;}
div.reservation > form > div > select {width:100%;}

div.reservation_user {position:relative; margin-bottom:6px; background:#fff; padding:15px 10px; }
div.reservation_user:after{}
div.reservation_user ul:after{display:block;content:'';clear:both}
div.reservation_user ul li {float:left;display:block;width:80%; }
div.reservation_user ul li:last-child {width:20%}
div.reservation_user ul li:first-child {}
div.reservation_user ul li input.input_txt{border:1px solid #ccc;border-radius:3px; height:40px; line-height:40px; font-size:14px;color:#555;width:100%; text-indent:10px;box-sizing:border-box}
div.reservation_user ul li div {margin-right:5px;}
div.reservation_user ul li.btn a.btn_gray_s {width:20%}


div.reservation_userinfo {position:relative; margin-bottom:6px; background:#fff; padding:15px 10px; }
div.reservation_userinfo:after{}
div.reservation_userinfo > div {padding-bottom:10px;}
div.reservation_userinfo > div:last-child {padding-bottom:0;}
div.reservation_userinfo ul:after{display:block;content:'';clear:both}
div.reservation_userinfo ul li {float:left;display:block; width:50%}
div.reservation_userinfo ul li:first-child {}
div.reservation_userinfo ul li input.input_txt{border:1px solid #ccc;border-radius:3px; height:40px; line-height:40px; font-size:14px;color:#555;width:100%; text-indent:10px;box-sizing:border-box}
div.reservation_userinfo ul li input.readonly{background:#f6f6f6}

div.reservation_userinfo ul li div {margin-right:5px;}


div.reservation div.reservation_title { overflow:hidden; height:65px; padding:0 10px 0 120px;  line-height:65px;  border-bottom:0; font-weight:bold; font-size:16px; background:#333; color:#fff; white-space:nowrap; text-overflow:ellipsis;}
div.reservation div.reservation_title div.img_area {display:block; position:absolute; top:0; left:0; width:110px; height:65px;}
div.reservation div.reservation_title div.img_area img {width:110px; height:65px;}

div.reservation div.reservation_staff {}

div.reservation div.reservation_service div.service_select ul li {position:relative; padding:14px 10px; margin-bottom:10px; background:#f6f6f6;}
div.reservation div.reservation_service div.service_select ul li:first-child {margin-top:10px; }
div.reservation div.reservation_service div.service_select ul li strong.service_name {display:block;overflow:hidden; padding-bottom:0px; white-space:nowrap; text-overflow:ellipsis;}
div.reservation div.reservation_service div.service_select ul li span.service_time {color:#555; font-size:12px;}
div.reservation div.reservation_service div.service_select ul li ul {position:absolute; right:10px; bottom:14px; }
div.reservation div.reservation_service div.service_select ul li ul:after { clear:both; display:block; content:""; }
div.reservation div.reservation_service div.service_select ul li ul li {float:left; padding:0 0 0 4px; margin-bottom:0;}
div.reservation div.reservation_service div.service_select ul li ul li:first-child {margin-top:0; }
div.reservation div.reservation_service div.service_select ul li ul li.price_sale {padding-top:2px; font-size:12px; text-decoration:line-through; color:#999999;}
div.reservation div.reservation_service div.service_select ul li ul li strong {color:#333;}
div.reservation div.reservation_service div.service_select ul li ul li button, div.reservation div.reservation_service div.service_select ul li ul li a {display:block; width:16px; height:16px; padding:0; margin:0; border:0; font-size:16px; background:none;}
div.reservation div.reservation_service div.service_total {}
div.reservation div.reservation_service div.service_total ul:after { clear:both; display:block; content:""; }
div.reservation div.reservation_service div.service_total ul li {float:right;  background:#fff;  margin-bottom:0; padding:0; }
div.reservation div.reservation_service div.service_total ul li:first-child {float:left; padding-top:2px; margin-top:0; font-size:12px; color:#999999 }
div.reservation div.reservation_service div.service_total ul li strong {font-size:16px;}
div.reservation div.reservation_service div.service_total ul li:first-child strong {color:#555; font-size:12px;}

div.reservation div.reservation_time {padding:0}
div.reservation div.reservation_time {display:block; padding:0 10px; height:60px; line-height:60px; font-size:14px; border:0; font-weight:bold; color:#000; }
div.reservation div.reservation_time.on a {display:block; height:60px; line-height:60px; color:#000; }
div.reservation div.reservation_time a strong {position:absolute; right:10px; color:#999; font-weight:normal; }
div.reservation div.reservation_time.on a strong {color:#333;}

div.reservation div.reservation_comment div.layer_textarea{padding:10px;border:1px solid #ccc; border-radius:2px; margin-bottom:5px}
div.reservation div.reservation_comment div.layer_textarea textarea{ border:0; width:100%; height:50px}

#layer_popup2 {display:block; position:fixed; top:0;left:0; width:100%; height:100%; z-index:50; border-radius:2px; overflow:hidden; overflow-y:scroll; z-index:500; background:#fff}
#layer_popup2 h2{height:40px; line-height:40px; background:#ffea00; text-align:center;font-size:18px;color:#333;font-weight:bold}
#layer_popup2 #btn_close_layer {display:block;font-size:24px; line-height:40px; height:40px; position:absolute;top:0;right:0;color:#333;padding:0 10px; margin:0; background:none; border:0}
#layer_popup2 #layer_content{ height:100%; margin-bottom:0; overflow-y:auto;  background:#fff; padding:20px 0;}
#layer_popup2 #layer_content h3 {padding-bottom:10px;}

#layer_popup2 div.reservation_user_select form {padding:0 10px;}
#layer_popup2 div.reservation_user_select select{position:relative;width:100%}
#layer_popup2 div.reservation_user_select div.list_search_form {position:relative; height:38px; margin-bottom:10px; padding:0 35px 0 10px; border:1px solid #ccc; border-radius:2px}
#layer_popup2 div.reservation_user_select div.list_search_form input{width:100%;height:38px; line-height:38px;color:#555; border:0}
#layer_popup2 div.reservation_user_select div.list_search_form button.btn_search { position:absolute;top:0;right:0; padding:0 10px; height:40px;line-height:40px; background:none; border:0;}

#layer_popup2 div.reservation_user_select div.list_serch_user {border-top:20px #f6f6f6 solid;}
#layer_popup2 div.reservation_user_select div.list_serch_user ul > li {position:relative; padding:0 14px; height:60px; line-height:60px; border-bottom:solid 4px #f6f6f6;}
#layer_popup2 div.reservation_user_select div.list_serch_user ul > li > a {display:block; color:#212121;}
#layer_popup2 div.reservation_user_select div.list_serch_user ul > li em {color:#7d7d7d; position: absolute; top:0; right:80px; text-align:right;}
#layer_popup2 div.reservation_user_select div.list_serch_user ul > li span > button, #layer_popup2 div.reservation_user_select div.list_serch_user ul > li span > a {position: absolute; top:10px; right:14px; display:block; height:40px; line-height:40px; text-align:center;color:#fff !important; font-weight:bold; background:#888; border-radius:2px; border:0; padding:0 10px; width:auto;}
div.car_number ul > li > a > span.active {  width:20%; text-align:right; color:#7d7d7d;}
#layer_popup2 div.reservation_user_select div.list_serch_user ul > li.no_date {text-align:center; line-height:18px; height:auto;padding:40px;}
#layer_popup2 div.reservation_user_select div.list_serch_user ul > li.no_date p {margin-bottom:20px;}
</style>
<!-- //예약박스 2차 -->

	<div id="container" class="container">
		
		<div class="reservation" >	
			<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this)">
			<input type="hidden" name="mode" value="<?=$mode?>" />
			<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

			<input type="hidden" name="sh_code" value="<?=$sh_code?>" />
			<input type="hidden" name="sh_name" value="<?=$sh_data['sh_name']?>" />

			<input type="hidden" name="st_id" value="<?=$st_id?>" />
			<input type="hidden" name="st_name" value="<?=$txt_st_name?>" />

			<input type="hidden" name="sv_id" value="<?=$data['sv_id']?>" />
			<input type="hidden" name="sv_name" value="<?=$data['sv_name']?>" />
			<input type="hidden" name="sv_time" value="<?=$data['sv_time']?>" />
			<input type="hidden" name="sv_price" value="<?=$data['sv_price']?>" />

			<input type="hidden" name="rs_date" value="<?=$data['rs_date']?>" />
			<input type="hidden" name="rs_time" value="<?=$data['rs_time']?>" />

			<!--div class="reservation_user">
				<span class="tit"><i class="xi-user-check"></i> 예약자 검색</span>
				<ul>
				<li><div><input type="text" name="us_name" class="input_txt required" value="<?=$data['us_name']?>" placeholder="예약자명" title="이름"></div></li>
				<li><div><input type="text" name="us_hp" class="input_txt required" value="<?=$data['us_hp']?>" placeholder="예약자 휴대폰" title="휴대폰"></div></li>
				<li><a href="#" class="btn_gray_s">검색</a></li>
				</ul>
			</div-->

			<div class="reservation_user">
				<span class="tit"><i class="xi-user-check"></i> 예약자 검색</span>
				<ul>
				<li><div><input type="text" name="us_name" class="input_txt required" value="<?=$data['us_name']?>" placeholder="이름/휴대폰 검색해주세요" title="이름"></div></li>        
				<li><a href="#" class="btn_gray_s">검색</a></li>
				</ul>
			</div>

			<div class="reservation_userinfo">
				<span class="tit"><i class="xi-user-info"></i> 예약자 정보</span>
				<div>
					<ul>
					<li><div><input type="text" name="us_name" class="input_txt required readonly" value="<?=$data['us_name']?>" placeholder="예약자명" title="이름"></div></li>
					<li><div><input type="text" name="us_hp" class="input_txt required readonly" value="<?=$data['us_hp']?>" placeholder="예약자 휴대폰" title="휴대폰"></div></li>
					</ul>
				</div>
				<div>
					<ul>
					<li><div><input type="text" name="us_name" class="input_txt required" value="<?=$data['us_name']?>" placeholder="비회원 예약자명" title="이름"></div></li>
					<li><div><input type="text" name="us_hp" class="input_txt required" value="<?=$data['us_hp']?>" placeholder="비회원 예약자 휴대폰" title="휴대폰"></div></li>
					</ul>
				</div>
			</div>

			<!-- reservation_service -->
			<div class="reservation_service">
				<span class="tit"><i class="xi-check-circleout"></i> 서비스</span>

				<select title="서비스" class="required" id="" name="">
				<option value="">서비스를 선택해주세요.</option>
				<option value="">홍길동</option>
				</select>

				<div class="service_select">
					<ul>
					<li>
						<strong class="service_name">서비스명이들어가게됩니다. 서비스명이 길면은 이렇게 나옵니다.</strong>
						<span class="service_time"><i class="xi-time"></i> 소요시간 <strong>90</strong>분 </span>
						<ul>
						<li class="price_sale">35,000원</li>
						<li><strong>13,000</strong>원</li>
						<li><button><i class="xi-close-circle"></i></button></li>
						</ul>					
					</li>
					<li>
						<strong class="service_name">네일아트</strong>
						<span class="service_time"><i class="xi-time"></i> 소요시간 <strong>90</strong>분 </span>
						<ul>
						<li class="price_sale">35,000원</li>
						<li><strong>13,000</strong>원</li>
						<li><a href="#"><i class="xi-close-circle"></i></button></a>
						</ul>					
					</li>
					</ul>

					<div class="service_total">
						<ul>
						<li>서비스 <strong>2</strong>개 선택</li>
						<li>총 금액 <strong class="col_orange">16,000</strong>원</li>
						</ul>				
					</div>
				</div>

							
			</div>
			<!-- //reservation_service -->
		
			<!--ul id="service_list" class="res_list2">
			<li<? if($mode == 'insert') { ?> class="on"<? } ?>>
				<button type="button" onclick="toggleReserveOptions(this)"><strong><?=$txt_sv_name?></strong> <span></span><i class="fa fa-angle-down"></i></button>
				<ul<? if($mode == 'insert') { ?> style="display:block"<? } ?>>
				<? include_once(_MODULE_PATH_.'/service/staff/ajax_list3.php'); ?>
				</ul>
			</li>
			</ul-->

			<div id="time_list" class="reservation_time on"><!-- 활성화시 class="on" 추가 -->
				<a id="btn_open_calendar" class="btn_ajax size_280x435 btn_date" target="#layer_popup" title="예약일시 선택">
				<span class="tit"><i class="xi-calendar"></i> 예약일시</span>
				<strong><?=$txt_rs_date?> <i class="xi-angle-right"></i></strong>
				</a>
			</div>
			
			<!--ul id="time_list" class="res_list3">
			<li class="on">
				<a id="btn_open_calendar" class="btn_ajax size_280x435 btn_date" target="#layer_popup" title="날짜/시간 선택"><strong><?=$txt_rs_date?></strong><i class="fa fa-angle-right"></i></a>
			</li>
			</ul-->

			<div class="reservation_comment">
				<span class="tit"><i class="xi-comment"></i> 요청사항</span>
				<div class="layer_textarea"><textarea name="rs_memo" title="요청사항" class="" placeholder="요청사항을 입력해주세요.(150자 이내)" maxlength="150"><?=$data['rs_memo']?></textarea></div>
			</div>

			<!--ul class="res_form">	
			<li><span class="tit">요청사항</span></li>
			<li><div class="layer_textarea"><textarea name="rs_memo" title="요구사항" class="" placeholder="요청사항을 입력해주세요.(150자 이내)" maxlength="150"><?=$data['rs_memo']?></textarea></div>
			</li>
			</ul-->

			<ul class="res_btn">
			<li><a href="<?=$back_url?>" class="btn_gray">취소</a></li>
			<li><button type="submit" class="btn_orange"><?=$txt_confirm?></button></li>
			</ul>

			</form>
		</div>
    </div>


<!-- 시간 선택시 뜨는 레이어 팝업(레이어팝업2) -->
<div id="layer_popup2" style="display: none;">
	<h2>예약자 검색</h2>
	<button type="button" onclick="closeLayerPopup()" id="btn_close_layer"><i class="xi-close"></i></button>
	<div id="layer_content" class="reservation_user_select" >
		<form> <!-- 검색버튼 누르면 검색결과값이 들어간상태로 검색됨 -->
		<div class="list_search_form">			
			<div class="list_search_input"><input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="input_txt" placeholder="이름/휴대폰 검색해주세요" /></div>
			<button type="submit" class="btn_search"><i class="xi-magnifier"></i></button>
		</div>
		</form>

		<div class="list_serch_user">
			<ul>
			<li>
				<a href="#">
				<span>김은지</span>
				<em>1123456789</em>
				<span><button type="button" class="btn_gray_s" onclick="">선택</button></span>
				</a>
			</li>
			<li>
				<span><strong>김은지</strong></span>
				<em>1123456789</em>
				<span><button type="button" class="btn_gray_s" onclick="">선택</button></span>
			</li>
			<li>
				<span><strong>김은지</strong></span>
				<em>1123456789</em>
				<span><a href="#" class="btn_gray_s" onclick="">선택</a></span>
			</li>
			<li class="no_date">
				<p>검색결과가 없습니다.<br />
				해당 정보로 예약을 원하시는 경우 <br />
				아래 예약하기 버튼을 클릭하여 예약을 해주세요.</p>
				<a href="" class="btn_orange">비회원 예약하기</a>
			</li>
			</ul>
		</div>
		
	</div>       
</div>
<!-- //시간 선택시 뜨는 레이어 팝업 -->


