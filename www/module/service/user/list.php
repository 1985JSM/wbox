<?
if(!defined('_INPLUS_')) { exit; } 

$oService = new ServiceUser();
$oService->init();
$oService->set('cnt_rows', 9999);

// thumb
$oService->set('flag_use_thumb', true);
$oService->set('thumb_width', '220');
$oService->set('thumb_height', '144');
$oService->set('sch_sh_code', $sh_code);

$list = $oService->selectList();
?>
<script type="text/javascript">
$(document).ready(function() {

	// 가맹점 탭 변경
	$("#shop_tab > li").not(":eq(1)").removeClass("on").end().eq(1).addClass("on");
});
</script>

<div class="view_detail">
	<ul class="service_list">
	<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
	<li>
		<div>
			<div class="img_area"><img src="<?=$list[$i]['thumb']?>" alt=""></div>
			<div class="info_area">
				<span class="tit"><?=$list[$i]['sv_name']?></span>
				<span class="basic_price">
					일반가 <em><?=number_format($list[$i]['sv_normal_price'])?></em>원
				</span>
				<span class="user_price">										
					<?=number_format($list[$i]['sv_sale_price'])?>원
					<strong>회원가</strong>
				</span>
				<span class="time"><i class="xi-time"></i> <?=$list[$i]['sv_time']?>분</span>
				<span class="con"><?=nl2br($list[$i]['sv_content'])?></span>
				<button type="button" onclick="toggleMoreService(this)" class="btn_view_con">더보기 <i class="xi-angle-down"></i></button>
				<button type="button" onclick="toggleMoreService(this)" class="btn_close_con">접기 <i class="xi-angle-up"></i></button>
			</div>
			<a href="../reserve/write.html?reserve_type=service&sh_code=<?=$sh_code?>&sv_id[]=<?=$list[$i]['sv_id']?>" class="<? if($is_user) { ?>btn_layer_page<? } else { ?>btn_only_login<? } ?> btn_res" target="#layer_page5"><span class="ico_res"><i class="xi-calendar-add"></i> 예약하기</span></a>
		</div>
	</li>
	<? } ?>
	</ul>
</div>

	
        
