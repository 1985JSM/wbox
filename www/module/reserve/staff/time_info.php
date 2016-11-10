<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');

$flag = $_GET['flag'];
if($flag == '1')		{ $doc_title = '근무종료'; }
else if($flag == '2')	{ $doc_title = '휴식시간'; }
else if($flag == '3')	{ $doc_title = '휴무일정'; }
else if($flag == '4')	{ $doc_title = '예약정보'; }

$msg = $_GET['msg'];
$msg_arr = explode('|', $msg);
?>
<style type="text/css">
div.layer_res_list {padding:20px 10px; background:#fff; box-sizing:border-box;}
div.layer_res_list div {margin-bottom:20px;}
div.layer_res_list li{padding-left:10px;position:relative;color:#555;line-height:15px;font-size:12px; margin-bottom:10px}
div.layer_res_list li:after{display:block;content:'';width:3px;height:3px; background:#555; position:absolute;top:5px;left:0}
div > ul.layer_btn > li {}
</style>

<div class="location">
	<h2><?=$doc_title?></h2>
	<button type="button" onclick="closeLayerPage('2')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container2" class="container">

	<div class="layer_res_list">
		<div>
			<ul class="layer_list">
			<? for($i= 0 ; $i < sizeof($msg_arr) ; $i++) { ?>
			<li><?=$msg_arr[$i]?></li>
			<? } ?>
			</ul>
			
			<div class="layer_btn">
				<? if($rs_id) { ?>
				<a href="../reserve/view.html?<?=$pk?>=<?=$uid?>" class="btn_layer_page btn_orange" target="#layer_page3">예약상세보기</a>
				<? } else { ?>
				<button type="button" class="btn_orange" onclick="closeLayerPage('2')">닫기</button>
				<? } ?>
			</div>
		</div>
	</div> 

</div>
<!-- //container -->