<?
if(!defined('_INPLUS_')) { exit; } 

$oCoupon = new CouponUser();
$oCoupon->init();
$pk = $oCoupon->get('pk');
$uid = $oCoupon->get('uid');

// data
$data = $oCoupon->selectDetail($uid);
//$data['flag_use'] = $oCoupon->checkFlagUse($data, $member['mb_id']);
?>
<style type="text/css">
div.coupon_detail {display:block;padding:20px 10px;}
div.coupon_detail div.coupon_info {position:relative;}
div.coupon_detail div.coupon_info span.tit {display:block; padding:92px 0 20px 0; font-size:18px; font-weight:bold; text-align:center;}
div.coupon_detail div.coupon_info span.benefit {display:block; position:absolute; top:0; right:50%; margin-right:-40px; width:80px; height:80px; line-height:80px; font-weight:bold;text-align:center;  box-sizing:border-box;border-radius:60px; background:#f06e58; color:#fff;}
div.coupon_detail div.coupon_info span.benefit i  {display:block; padding-bottom:2px;}
div.coupon_detail div.coupon_guide {margin-bottom:20px;font-size:12px; color:#888888;}
div.coupon_detail div.coupon_guide span {display:block;}
div.coupon_detail div.coupon_guide ul {margin-top:6px;}
div.coupon_detail div.coupon_guide ul li {padding-left:16px; background:url("/img/mobile/ico/ico_belit.png") 6px 6px no-repeat; background-size:3px;}

div.coupon_area.disable div.coupon_info span.btn_use {border-color:#999999; color:#999999; }
div.coupon_area.disable div.coupon_info span.benefit {background-color:#999999; }

div.coupon_detail.disable div.coupon_info span.benefit {background-color:#999999; }
div.coupon_detail.disable button.btn_orange {background-color:#888; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>

<div class="location">
	<h2>쿠폰사용</h2>
	<button type="button" onclick="closeLayerPage('3')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container3" class="container">

	<div class="view_detail">

		<div class="coupon_detail<? if(!$data['flag_use']) { ?> disable<? } ?>">
			<div class="coupon_info">
				<span class="benefit"><?=$data['txt_cp_img']?></span>
				<span class="tit"><?=$data['cp_name']?></span>
			</div>

			<div class="coupon_guide">				
				<span><i class="xi-info-circle"></i> <strong>쿠폰 사용 수</strong> <strong class="col_aqua"><?=number_format($data['cnt_use'])?></strong> / <?=$data['txt_cp_quantity']?></span>
				<span><i class="xi-medal"></i>  <strong>사용등급</strong> <?=getWithoutNull($data['txt_cp_levels'])?></span>
				<span class="col_orange"><i class="xi-check-circleout"></i> <strong>직원이 쿠폰을 확인할 수 있도록 보여주세요.</strong></span>
				<ul>
				<? for($i = 1 ; $i < 4 ; $i++) { if(!$data['cp_guide'.$i]) { continue; } ?>
				<li><?=$data['cp_guide'.$i]?></li>
				<? } ?>
				</ul>
			</div>

			<form name="use_coupon_form" method="post" action="../coupon/process.html" onsubmit="return submitUseCouponForm(this)" target="#layer_page3">
			<input type="hidden" name="flag_json" value="1" />
			<input type="hidden" name="mode" value="use_coupon" />
			<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

			<? if($data['flag_use']) { ?><button type="submit" class="btn_orange">쿠폰사용하기</button><? } else { ?><button type="button" onclick="alert('이미 사용한 쿠폰입니다.')" class="btn_orange">쿠폰사용불가</button><? } ?>	
			</form>
			
		</div>	

	</div>   

</div>
