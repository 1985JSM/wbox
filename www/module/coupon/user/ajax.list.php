<?
if(!defined('_INPLUS_')) { exit; } 

/* coupon */
if(!isset($oCoupon)) {
	include_once(_MODULE_PATH_.'/coupon/coupon.user.class.php');
	$oCoupon = new CouponUser();
	$oCoupon->init();
}

$oCoupon->set('list_mode', $list_mode);
if($sh_code) { 
	$oCoupon->set('sch_sh_code', $sh_code); 
}
$list = $oCoupon->selectList();
$pk = $oCoupon->get('pk');

for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>
	<div class="coupon_area<? if(!$list[$i]['flag_use']) { ?> disable<? } ?>">
		<a href="../coupon/view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page3">					
			<div class="coupon_info">
				<span class="tit"><?=$list[$i]['cp_name']?></span>
				<span class="btn_use"><? if($list[$i]['flag_use']) { ?>사용하기<? } else { ?>사용불가<? } ?></span>
				<span class="benefit"><?=$list[$i]['txt_cp_img']?></span>
			</div>
			<div class="coupon_guide">
				<span><i class="xi-info-circle"></i> <strong>쿠폰 사용 수</strong> <strong class="col_aqua"><?=number_format($list[$i]['cnt_use'])?></strong> / <?=$list[$i]['txt_cp_quantity']?></span>
				<span><i class="xi-medal"></i>  <strong>사용등급</strong> <?=$list[$i]['txt_cp_levels']?></span>
				<ul>
				<? for($j = 1 ; $j < 4 ; $j++) { if(!$list[$i]['cp_guide'.$j]) { continue; } ?>
				<li><?=$list[$i]['cp_guide'.$j]?></li>
				<? } ?>
				</ul>
			</div>				
		</a>
	</div>
</li>
<? } if(sizeof($list) == 0) { ?>
<li class="no_data">
	<p><i class="xi-close-circle"></i> 등록된 쿠폰이 없습니다.</p>
</li>
<? } ?>