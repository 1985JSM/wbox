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

<? if($flag_use_footer_nav) { ?>
<div class="nav02">
	<ul>
	<li class="nav01<?if($footer_nav['1']){?> on<?}?>"><a href="<?=$base_uri?>/page/main.html"><span>홈</span></a></li>
	<li class="nav02<?if($footer_nav['2']){?> on<?}?>"><a href="<?=$base_uri?>/reserve/wait_list.html"><span>예약관리</span></a></li>
	<li class="nav03<?if($footer_nav['3']){?> on<?}?>"><a href="<?=$base_uri?>/reserve/calendar_list.html"><span>일정관리</span></a></li>
	<li class="nav04<?if($footer_nav['4']){?> on<?}?>"><a href="<?=$base_uri?>/reserve/sales_list.html"><span>매출내역</span></a></li>
	<li class="nav05<?if($footer_nav['5']){?> on<?}?>"><a href="<?=$base_uri?>/portfolio/list.html"><span>포트폴리오</span></a></li>
	</ul>
</div>
<? } ?>

<!-- 레이어 부분 -->
<div id="layer_back"></div>
<div id="layer_popup">
	<h2>레이어 제목</h2>
	<button type="button" onclick="closeLayerPopup()" id="btn_close_layer"><i class="xi-close"></i></button>
	<div id="layer_content">
		레이어 내용
	</div>       
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