<?
if(!defined('_INPLUS_')) { exit; } 

if(!isset($oService)) {
	include_once(_MODULE_PATH_.'/service/service.manager.class.php');
	$oService = new ServiceManager();
	$oService->init();
}

if(!$sv_id_arr) {
	$sv_id_arr = $sv_id;	
}

if(is_array($sv_id_arr)) {
	$sv_id_arr = array_unique($sv_id_arr);	// 중복 제거
	$sv_id_arr = array_filter($sv_id_arr);	// 빈값 제거
	$sv_id_arr = array_values($sv_id_arr);	// 재정렬
}

if(sizeof($sv_id_arr) > 0) {
	$sv_list = $oService->selectServiceByShopCode($member['sh_code']); ?>
	<ul>
	<? 
	$cnt_selected_service = 0;
	$total_selected_price = 0;
	foreach($sv_id_arr as $key) { 
		if(!$key || !$sv_list[$key]['sv_name']) { continue; }
		$cnt_selected_service += 1;
		$total_selected_price += $sv_list[$key]['sv_sale_price'];
		?>					
	<li>
		<strong class="service_name"><?=$sv_list[$key]['sv_name']?></strong>
		<span class="service_time"><i class="xi-time"></i> 소요시간 <strong><?=$sv_list[$key]['sv_time']?></strong>분 </span>
		<ul>
		<li class="price_sale"><?=number_format($sv_list[$key]['sv_normal_price'])?>원</li>
		<li><strong><?=number_format($sv_list[$key]['sv_sale_price'])?></strong>원</li>
		<li>
			<button type="button" onclick="removeSelectedService(this)"><img src="/img/common/btn_close.gif" alt="닫기" /></button>
			<input type="hidden" name="sv_id[]" value="<?=$key?>" />
		</li>
		</ul>					
		
	</li>
	<? } ?>
	</ul>
<? } ?>

<div class="service_total">
	<ul>
	<li>서비스 <strong><?=number_format($cnt_selected_service)?></strong>개 선택</li>
	<li>총 금액 <strong class="primary"><?=number_format($total_selected_price)?></strong>원</li>
	</ul>				

	<input type="hidden" name="service_price" value="<?=$total_selected_price?>" />
</div>