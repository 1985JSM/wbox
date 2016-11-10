<?
if(!defined('_INPLUS_')) { exit; } 

$rs_id = $_GET['rs_id'];
$msg = $_GET['msg'];
$arr = explode('|', $msg);
?>

<ul class="layer_list">
<? for($i= 0 ; $i < sizeof($arr) ; $i++) { ?>
<li><?=$arr[$i]?></li>
<? } ?>
</ul>

<ul class="layer_btn">
<li>
	<div>
		<? if($rs_id) { ?>
		<a href="../reserve/view.html?rs_id=<?=$rs_id?>" class="btn_orange">예약상세보기</a>
		<? } else { ?>
		<button type="button" class="btn_orange" onclick="closeLayerPopup()">닫기</button>
		<? } ?>
	</div>
</li>
</ul>
