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

// default
if($data[$pk]) {

	$mode = 'update';	

	$doc_title = '예약변경';
	$txt_confirm = '변경하기';

	$st_id = $data['st_id'];
	$sv_id_arr = $data['sv_id_arr'];

	$txt_rs_date = $data['txt_rs_datetime'];
}
else {
	$mode = 'insert';

	$doc_title = '예약하기';
	$txt_confirm = '예약하기';
	$txt_rs_date = '선택해주세요';
}

/*
if($mode == 'update' && $data['rs_state'] != 'W' && $data['rs_state'] != 'P') {
	alert('진행중인 예약건만 수정 가능합니다.');
}
*/
?>
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

div.reservation p.text_info{padding-top:5px;color:#888;font-size:12px; line-height:15px}

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
div.reservation div.reservation_time button {display:block; width:100%; padding:0 10px; height:60px; line-height:60px; font-size:14px; text-align:left; border:0; font-weight:bold; color:#000; background:#fff; }
div.reservation div.reservation_time.on a {display:block; height:60px; line-height:60px; color:#000; }
div.reservation div.reservation_time a strong, div.reservation div.reservation_time button strong {position:absolute; right:10px; color:#999; font-weight:normal; }
div.reservation div.reservation_time.on a strong {color:#333;}

div.reservation div.reservation_comment div.layer_textarea{padding:10px;border:1px solid #ccc; border-radius:2px; margin-bottom:5px}
div.reservation div.reservation_comment div.layer_textarea textarea{ border:0; width:100%; height:50px}

#layer_page5.open {display:block; top:0; right:0;}
#layer_page6 {display:none;}

</style>
<script type="text/javascript">
	<?/*
//<![CDATA[
/*
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
*/
//]]>*/?>
</script>

<div class="location">
	<h2><?=$doc_title?></h2>
	<button type="button" onclick="closeLayerPage('5')" class="location_prev"><i class="xi-angle-left"></i></button>
</div>

<div id="container5" class="container">
	
	<div class="reservation">

		<form name="search_customer_form" method="get" action="<?=$base_uri?>/customer/list.html" onsubmit="return submitSearchCustomerForm(this)" target="#layer_page6">
		<input type="hidden" name="flag_json" value="1" />
		<input type="hidden" name="sch_type" value="all" />

		<div class="reservation_user">
			<span class="tit"><i class="xi-user-check"></i> 고객 검색</span>
			<ul>
			<li><div><input type="text" name="sch_keyword" id="sch_keyword" class="input_txt required" value="" placeholder="이름/휴대폰 검색해주세요" title="이름 또는 휴대폰"></div></li>
			<li><button type="submit" class="btn_gray_s">검색</button></li>
			</ul>
			<p class="text_info"><i class="xi-info-circle"></i> 기존 고객이라면, 예약자 정보를 검색해주세요.</p>
		</div>
		</form>

		<form name="reserve_form" method="post" action="./process.html" onsubmit="return submitReserveForm(this)" target="#layer_page6">
		<input type="hidden" name="flag_json" value="1" />
		<input type="hidden" name="mode" value="<?=$mode?>" />
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

		<input type="hidden" name="reserve_type" value="staff" />

		<input type="hidden" name="cs_id" value="<?=$data['cs_id']?>" />
		<input type="hidden" name="us_id" value="<?=$data['us_id']?>" />

		<input type="hidden" name="st_id" value="<?=$member['mb_id']?>" />

		<input type="hidden" name="sh_code" value="<?=$sh_code?>" />
		<input type="hidden" name="rs_date" value="<?=$data['rs_date']?>" />
		<input type="hidden" name="rs_time" value="<?=$data['rs_time']?>" />

		<input type="hidden" name="rs_state" value="<?=$data['rs_state']?>" />

		<input type="hidden" name="sch_date" value="<?=$sch_date?>" />

		<div class="reservation_userinfo">
			<span class="tit"><i class="xi-user-info"></i> 예약자 정보</span>
			<div>
				<ul>
				<li><div><input type="text" name="us_name" class="input_txt required" value="<?=$data['us_name']?>" placeholder="예약자명" title="예약자명"></div></li>
	            <li><div><input type="text" name="us_hp" class="input_txt required" value="<?=$data['us_hp']?>" placeholder="예약자 휴대폰" title="예약자 휴대폰"></div></li>
				</ul>
				<p class="text_info"><i class="xi-info-circle"></i> 첫 등록 고객이라면, 예약자 정보를 직접 입력해주세요.</p>
			</div>
		</div>

		<!-- reservation_service -->
		<div class="reservation_service">
			<span class="tit"><i class="xi-check-circleout"></i> 서비스</span>

			<select name="sv_id[]" id="reserve_sv_id" title="서비스">
			<? include_once(_MODULE_PATH_.'/service/staff/ajax.option.php'); ?>
			</select>

			<div id="selected_service" class="service_select">
			<? include_once(_MODULE_PATH_.'/service/staff/ajax.selected.php'); ?>				
			</div>									
		</div>
		<!-- //reservation_service -->

		<!-- reservation_time -->
		<div id="reserve_time" class="reservation_time on">
			<button type="button" onclick="openCalendar()" class="btn_date">
				<span class="tit"><i class="xi-calendar"></i> 예약일시</span>
				<strong><?=$txt_rs_date?> <i class="xi-angle-right"></i></strong>
			</button>
		</div>
		<!-- //reservation_time -->

		<div class="reservation_comment">
			<span class="tit"><i class="xi-comment"></i> 요청사항</span>
			<div class="layer_textarea"><textarea name="rs_user_memo" title="요청사항" placeholder="요청사항을 입력해주세요.(150자 이내)" maxlength="150"><?=$data['rs_user_memo']?></textarea></div>
		</div>
		
		<ul class="res_btn">
		<li><button type="button" onclick="closeLayerPage('5')" class="btn_gray">취소</button></li>
		<li><button type="submit" class="btn_orange"><?=$txt_confirm?></button></li>
		</ul>		

		</form>
    </div>