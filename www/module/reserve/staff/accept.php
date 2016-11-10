<?
if(!defined('_INPLUS_')) { exit; } 

$oReserve = new ReserveStaff();
$oReserve->init();

/* insert or update */
$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
$data = $oReserve->selectDetail($uid);
?>
<style type="text/css">
div.approval {position:relative; padding:20px 10px; background:#fff;}
div.approval em {position:absolute; top:30px; left:10px; border-bottom:0; font-size:14px; font-weight:bold;color:#999;}
div.approval div.btn_switch3 {display:block; margin-bottom:20px; float:right;}
div.approval div.btn_switch3:after {display:block;content:'';clear:both;}

div.approval div.btn_switch3 button {display:block; float:left; height:30px; padding:0 10px; line-height:30px; color:#bbb; border:1px solid #fff; text-align:center; background:#ebebeb; cursor:pointer;}
div.approval div.btn_switch3.rs_state_A button.ok {color:#fff; border:1px solid #fff; background:#72ced4;}
div.approval div.btn_switch3.rs_state_C button.cancel {color:#fff; border:1px solid #fff; background:#72ced4;}

div.approval div.btn_switch3 button:first-child {border-radius:2px 0 0 2px;}
div.approval div.btn_switch3 button:last-child {border-radius:0px 2px 2px 0px;}

div.approval p {display:block; clear:both; margin-bottom:20px; font-size:12px;}

div.approval ul.layer_btn2 {display:block; width:100%; clear:both;}
div.approval ul.layer_btn2:after {display:block;content:'';clear:both;}

div.approval ul.layer_btn2 li { width:49%; float:right; }
div.approval ul.layer_btn2 li:first-child {float:left; }
</style>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div class="location">
	<h2>예약승인</h2>
	<button type="button" onclick="closeLayerPage('4')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container4" class="container">

	<div class="approval">

		<form name="accept_form" method="post" action="../reserve/process.html" onsubmit="return submitAcceptForm(this)">
		<input type="hidden" name="flag_json" value="1" />
		<input type="hidden" name="mode" value="update_state" />
		<input type="hidden" name="rs_state" value="A" />
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

		<em>승인여부</em>
		<div class="btn_switch3 rs_state_A">
			<button type="button" onclick="toggleReserveAccept(this, 'A')" class="ok" title="예약승인">예약승인</button>
			<button type="button" onclick="toggleReserveAccept(this, 'C')" class="cancel" title="예약취소">예약취소</button>
		</div>
		<p class="col_orange">예약승인 후 변경은 불가능합니다. 신중히 선택바랍니다.</p>
			
		<ul class="layer_btn2">
		<li><button type="submit" class="btn_orange">확인</button></li>
		<li><button type="button" class="btn_gray" onclick="closeLayerPage('4')">취소</button></li>	
		</ul>
	</div>  
</div>