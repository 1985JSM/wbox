<?
if(!defined('_INPLUS_')) { exit; } 

if(!$is_user) {
	alert('로그인 후 이용할 수 있습니다.', '../member/login.html');
}

/* init Class */
$oReserve = new ReserveUser();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

/* insert or update */
$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
if($uid) {
	$data = $oReserve->selectDetail($uid);	
}

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
?>
<style style="text/css">
div.reservation {background:#f6f6f6;}
div.reservation > form > div { position:relative; margin-bottom:20px; padding:20px 10px; background:#fff; }
div.reservation > form > div > span.tit {display:block; padding-bottom:10px; font-weight:bold; color:#333;}
div.reservation > form > div > select {width:100%;}

div.reservation div.reservation_title { display:block; overflow:hidden; height:65px; padding:0 10px 0 120px;  line-height:65px;  border-bottom:0; font-weight:bold; font-size:16px; background:#333; color:#fff; white-space:nowrap; text-overflow:ellipsis;}
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
div.reservation div.reservation_service div.service_total ul:after { clear:both; display:block; content:"";  }
div.reservation div.reservation_service div.service_total ul li {float:right; padding:0; margin:0; background:#fff;}
div.reservation div.reservation_service div.service_total ul li:first-child {float:left; padding-top:2px;font-size:12px; color:#999999; margin:0;}
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

<div class="location">
	<h2><?=$doc_title?></h2>
	<button type="button" onclick="closeLayerPage('5')" class="location_prev"><i class="xi-angle-left"></i></button>
</div>

<div id="container5" class="container">
	
	<div class="reservation">

		<form name="reserve_form" method="post" action="./process.html" onsubmit="return submitReserveForm(this)" target="#layer_page6">
		<input type="hidden" name="flag_json" value="1" />
		<input type="hidden" name="mode" value="<?=$mode?>" />
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

		<input type="hidden" name="reserve_type" value="<?=$reserve_type?>" />

		<input type="hidden" name="sh_code" value="<?=$sh_code?>" />
		<input type="hidden" name="rs_date" value="<?=$data['rs_date']?>" />
		<input type="hidden" name="rs_time" value="<?=$data['rs_time']?>" />

		<input type="hidden" name="sch_date" value="<?=$sch_date?>" />

		<div class="reservation_title">
			<div class="img_area"><img src="<?=$sh_data['main_img']['thumb']?>" alt="매장대표 이미지" /></div>
			<span><?=$sh_data['sh_name']?></span>
		</div>

		<? ob_start(); ?>
		<!-- reservation_staff -->
		<div class="reservation_staff">
			<span class="tit"><i class="xi-user"></i> 담당자</span>
			<select name="st_id" id="reserve_st_id" class="required" title="담당자">				
			<? include_once(_MODULE_PATH_.'/staff/user/ajax.option.php'); ?>
			</select>
		</div>
		<!-- //reservation_staff -->
		<?
		$staff_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		?>
		<!-- reservation_service -->
		<div class="reservation_service">
			<span class="tit"><i class="xi-check-circleout"></i> 서비스</span>

			<select name="sv_id[]" id="reserve_sv_id" title="서비스">
			<? include_once(_MODULE_PATH_.'/service/user/ajax.option.php'); ?>
			</select>

			<div id="selected_service" class="service_select">
			<? include_once(_MODULE_PATH_.'/service/user/ajax.selected.php'); ?>				
			</div>						
		</div>
		<!-- //reservation_service -->
		<?
		$service_content = ob_get_contents();
		ob_end_clean();

		if($reserve_type == 'staff') {
			echo $staff_content;
			echo $service_content;
		}
		else if($reserve_type == 'service') {
			echo $service_content;
			echo $staff_content;
		}
		?>

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
</div>