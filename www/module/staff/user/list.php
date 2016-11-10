<?
if(!defined('_INPLUS_')) { exit; } 

$oStaff = new StaffUser();
$oStaff->init();
$oStaff->set('cnt_rows', 9999);
$pk = $oStaff->get('pk');

// thumb
$oStaff->set('flag_use_thumb', true);
$oStaff->set('thumb_width', '320');
$oStaff->set('thumb_height', '190');
$oStaff->set('sch_a_sh_code', $sh_code);

$list = $oStaff->selectList();

?>
<script type="text/javascript">
$(document).ready(function() {

	// 가맹점 탭 변경
	$("#shop_tab > li").not(":eq(2)").removeClass("on").end().eq(2).addClass("on");
});
</script>

<div class="view_detail">
	<ul class="duty_list">
	<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
	<li>
		<div class="staff_list">
			<a href="../staff/view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page3">
				<div class="img_area"><img src="<?if($list[$i]['thumb']==''){?>/img/mobile/common/img_noimg_296x196.gif<?} else {?><?=$list[$i]['thumb']?><?}?>" alt="<?=$list[$i]['st_name']?> thumbnail image"></div>
				<div class="info_area">					
					<ul>
					<li class="tit"><?=$list[$i]['txt_staff']?></li>
					<li><i class="xi-time"></i> 근무시간 <span class="time"><?=$list[$i]['s_work']?>~<?=$list[$i]['e_work']?><span></li>
					<li><i class="xi-time"></i> 휴식시간 <?=$list[$i]['s_break']?>~<?=$list[$i]['e_break']?></li>
					<li class="service"><?=$list[$i]['txt_sv_code']?></li>						
					</ul>
				</div>
			</a>
			<ul class="duty_list_btn">
			<li><a href="../reserve/write.html?reserve_type=staff&sh_code=<?=$sh_code?>&st_id=<?=$list[$i]['mb_id']?>" class="<? if($is_user) { ?>btn_layer_page<? } else { ?>btn_only_login<? } ?> ico_res" target="#layer_page5"><i class="xi-calendar-add"></i><span class="hidden">예약하기</span></a></li>
			<li><a href="../portfolio/staff_list.html?sh_code=<?=$sh_code?>&sch_a_st_id=<?=$list[$i]['mb_id']?>" class="btn_layer_page ico_img" target="#layer_page4"><i class="xi-images"></i><span class="hidden">포트폴리오보기</span></a></li>
			</ul>
		</div>
	</li>
	<? } ?>
	</ul>
</div>


	