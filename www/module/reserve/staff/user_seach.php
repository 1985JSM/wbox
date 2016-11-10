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
div.reservation_user_select { background:#fff;}
div.reservation_user_select form {padding:20px 10px;}
div.reservation_user_select select{position:relative;width:100%}
div.reservation_user_select div.list_search_form {position:relative; height:38px; margin-bottom:10px; padding:0 35px 0 10px; border:1px solid #ccc; border-radius:2px;}
div.reservation_user_select div.list_search_form input{width:100%;height:38px; line-height:38px;color:#555; border:0}
div.reservation_user_select div.list_search_form button.btn_search { position:absolute;top:0;right:0; padding:0 10px; height:40px;line-height:40px; background:none; border:0;}

div.reservation_user_select div.list_serch_user {border-top:20px #f6f6f6 solid;}
div.reservation_user_select div.list_serch_user ul > li {position:relative; padding:0 14px; height:60px; line-height:60px; border-bottom:solid 4px #f6f6f6;}
div.reservation_user_select div.list_serch_user ul > li > a {display:block; color:#212121;}
div.reservation_user_select div.list_serch_user ul > li em {color:#7d7d7d; position: absolute; top:0; right:80px; text-align:right;}
div.reservation_user_select div.list_serch_user ul > li span > button, #layer_popup2 div.reservation_user_select div.list_serch_user ul > li span > a {position: absolute; top:10px; right:14px; display:block; height:40px; line-height:40px; text-align:center;color:#fff !important; font-weight:bold; background:#888; border-radius:2px; border:0; padding:0 10px; width:auto;}
div.car_number ul > li > a > span.active {  width:20%; text-align:right; color:#7d7d7d;}
div.reservation_user_select div.list_serch_user ul > li.no_date {text-align:center; line-height:18px; height:auto;padding:40px;}
div.reservation_user_select div.list_serch_user ul > li.no_date p {margin-bottom:20px;}
</style>
<!-- //예약박스 2차 -->

<div id="container" class="container">

	<div  class="reservation_user_select" >
		<form> <!-- 검색버튼 누르면 검색결과값이 들어간상태로 검색됨 -->
		<div class="list_search_form">			
			<div class="list_search_input"><input type="text" name="" value="" class="input_txt" placeholder="이름/휴대폰 검색해주세요" /></div>
			<button type="button" class="btn_search"><i class="xi-magnifier"></i></button>
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
				<span>김은지</span>
				<em>1123456789</em>
				<span><button type="button" class="btn_gray_s" onclick="">선택</button></span>
			</li>
			<li class="no_date">
				<p>검색결과가 없습니다.<br />
				해당 정보로 예약을 원하시는 경우 <br />
				아래 예약하기 버튼을 클릭하여 예약을 해주세요.</p>
				<a href="" class="btn_orange">비회원 예약하기</a>
			</li>
			</ul>
		</div>
		</form>

	</div>
</div>