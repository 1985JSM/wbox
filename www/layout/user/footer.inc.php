<? if(!defined('_INPLUS_')) { exit; } ?>
	
</div>

<div id="layer_page1" class="wrap">
		 
</div>

<div id="layer_page2" class="wrap">
		   
</div>

<div id="layer_page3" class="wrap">
		  
</div>

<div id="layer_page4" class="wrap">
		 
</div>

<div id="layer_page5" class="wrap">
		  
</div>

<div id="layer_page6" class="wrap">
		  
</div>

<div id="layer_page9" class="wrap">
		  
</div>

<? if($flag_use_footer_nav) {

	if($is_user) {
		$my_shop_link = 'favorite_list';
	}
	else {
		$my_shop_link = 'visit_list';
	}
?>
<div class="nav">
	<ul>
	<li class="nav01<?if($footer_nav['1']){?> on<?}?>"><a href="<?=$base_uri?>/page/main.html"><span>홈</span></a></li>
	<li class="nav02<?if($footer_nav['2']){?> on<?}?>"><a href="<?=$base_uri?>/portfolio/list.html"><span>포트폴리오</span></a></li>
	<li class="nav03<?if($footer_nav['3']){?> on<?}?>"><a href="<?=$base_uri?>/shop/area.html"><span>검색</span></a></li>
	<li class="nav04<?if($footer_nav['4']){?> on<?}?>"><a href="<?=$base_uri?>/shop/<?=$my_shop_link?>.html"><span>나의매장</span></a></li>
	<li class="nav05<?if($footer_nav['5']){?> on<?}?>"><a href="<?=$base_uri?>/reserve/list.html"><span>예약보기</span></a></li>	
	</ul>
</div>	
<? } ?>

<!-- Layer -->
<div id="layer_back"></div>
<div id="layer_popup">
	<h2>레이어 제목</h2>
	<button type="button" onclick="closeLayerPopup()" id="btn_close_layer"><i class="xi-close"></i></button>
	<div id="layer_content">
		레이어 내용
	</div>       
</div>

<div id="layer_reserve">
	<h2>예약시 유의사항</h2>
	<p>예약변경 및 취소 없이 방문을 하지 않을 경우, <em>포인트 차감등의 패널티</em>가 주어집니다. </p>
	<p class="info2">예약변경 및 취소 가능시간은 업체마다 다를 수 있으니 <em>업체정보를 확인</em>하시길 바랍니다. </p>
	
	<ul>
	<li><a href="../reserve/write.html?reserve_type=staff&sh_code=<?=$sh_code?>" class="btn_layer_page btn_reserve_by_staff" target="#layer_page5">담당자로 예약하기</a></li>
	<li><a href="../reserve/write.html?reserve_type=service&sh_code=<?=$sh_code?>" class="btn_layer_page btn_reserve_by_service" target="#layer_page5">서비스로 예약하기</a></li>
	</ul>
	<button type="button" onclick="closeReserveLayer()">취소</button>
</div>

<div id="bridge_container" style="position:absolute; top:-10px; left:-10px; width:5px; height:5px; overflow:hidden;">
	<iframe name="native_bridge" id="native_bridge" frameborder="0"></iframe>
</div>

<input type="hidden" id="layer_no" value="0" />

<div id="loader" class="loading">
	<span></span>
	<div></div>
</div>
</body>
</html>