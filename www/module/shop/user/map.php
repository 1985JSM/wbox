<?
if(!defined('_INPLUS_')) { exit; } 

/* shop */
$oShop = new ShopUser();
$oShop->init();
$pk = $oShop->get('pk');
$uid = $oShop->get('uid');

// data
$data = $oShop->selectDetail($uid);
?>
<style type="text/css">
#layer_page5.open {display:-webkit-inline-box; top:0; right:0;}
</style>
<script type="text/javascript">
$(document).ready(function() {

	var map_container = document.getElementById("container5");	
	var map_options = {
		center	: new daum.maps.LatLng("<?=$data['sh_lat']?>", "<?=$data['sh_lng']?>"),	// 중심 좌표
		level	: 3	// 확대 레벨
	};
	
	var map = new daum.maps.Map(map_container, map_options);

	// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
	var map_type_control = new daum.maps.MapTypeControl();

	// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
	// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
	map.addControl(map_type_control, daum.maps.ControlPosition.TOPRIGHT);

	// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
	var zoom_control = new daum.maps.ZoomControl();
	map.addControl(zoom_control, daum.maps.ControlPosition.RIGHT);

	// 마커가 표시될 위치입니다 
	var marker_position  = new daum.maps.LatLng("<?=$data['sh_lat']?>", "<?=$data['sh_lng']?>"); 

	// 마커를 생성합니다
	var marker = new daum.maps.Marker({
		position	: marker_position
	});

	// 마커가 지도 위에 표시되도록 설정합니다
	marker.setMap(map);
});
</script>

<div class="location">
	<h2><?=$data['sh_name']?></h2>
	<button type="button" onclick="closeLayerPage('5')" class="location_close"><i class="xi-close"></i></button>
</div>

<div class="geo">
	<p class="current"><i class="xi-marker-circle"></i> <?=$data['txt_addr']?></p>
</div>

<div id="container5" class="container address">

</div>
