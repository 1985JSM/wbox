<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '설정';
$footer_nav['1'] = true;
$back_url = '../page/main.html';

if($member['flag_use_push'] != 'N') {
	$flipswitch_class = 'on';
}
?>
<script type="text/javascript">
$(document).ready(function() {
	callNative("checkAppVersion/setConfigVersion");
});
</script>

<div id="container" class="containear">
	<div class="setting">

		<ul class="setting_list">		
		<li>			
			<h4>버전정보</h4>
			<div>
				<span class="version"></span>
			</div>
		</li>
		<li>
			<a href="../page/clause.html">
				<h4>이용약관</h4>
				<div><i class="xi-angle-right"></i></div>
			</a>
		</li>
		<li>        	
			<button type="button" onclick="togglePushSwitch(this)">
				<h4>알림설정</h4>
				<div class="flipswitch <?=$flipswitch_class?>">	
					<p>
						<span class="off">OFF</span>
						<span class="icon"></span>
						<span class="on">ON</span>
					</p>
				</div>
			</button>
		</li>
		<? /*
		<li>
			<button type="button" onclick="openGpsConfig()">
				<h4>위치설정</h4>
				<div><i class="fa fa-chevron-right"></i></div>
			</button>
		</li>
		*/ ?>
		</ul>
	</div>
</div>
