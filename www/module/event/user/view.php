<?
if(!defined('_INPLUS_')) { exit; } 

/* staff */
$oEvent = new EventUser();
$oEvent->init();
$pk = $oEvent->get('pk');
$uid = $oEvent->get('uid');

// thumb
$oEvent->set('flag_use_thumb', true);
$oEvent->set('thumb_width', 640);
$oEvent->set('thumb_height', 0);

// data
$data = $oEvent->selectDetail($uid);
$sub_img = $data['sub_img'];
?>
<style type="text/css">
div.event_board_view > div {background:#fff;}
div.event_board_view > div > img {width:100%;  max-width:640px; }
div.event_board_view > div.event_info {background:none; padding:15px 10px;}
div.event_board_view > div.event_info ul li {padding-left:16px;  font-size:12px; background:url("/img/mobile/ico/ico_belit.png") 6px 6px no-repeat; background-size:3px; color:#999;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>

<div class="location">
	<h2>이벤트</h2>
	<button type="button" onclick="closeLayerPage('1')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container1" class="container">

	<div class="board">
		<div class="event_board_view">
			<? if($sub_img) { ?>
			<div>
				<img src="<?=$sub_img['thumb']?>" alt="<?=$data['bo_subject']?> sub image"/>
			</div>
			<? } ?>

			<div class="event_info">
				<?=nl2br($data['bo_content'])?>
			</div>
			
		</div>
	</div>

</div>
