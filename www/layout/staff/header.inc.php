<?
if(!defined('_INPLUS_')) { exit; }

if(!$back_type) { $back_type = 'prev'; }
if(!$back_url) { $back_url = '#'; }

if($back_type == 'prev') {
	$fa_back_class = 'xi-angle-left';
}
else if($back_type == 'close') {
	$fa_back_class = 'xi-close';
}

if($flag_use_info) {

	if(!isset($oShop)) {
		include_once(_MODULE_PATH_.'/shop/shop.staff.class.php');
		$oShop = new ShopStaff();
		$oShop->init();
	}
	$sh_data = $oShop->selectDetail($member['sh_code']);

	if(!isset($oReserve)) {
		include_once(_MODULE_PATH_.'/reserve/reserve.staff.class.php');
		$oReserve = new ReserveStaff();
		$oReserve->init();
	}
	$rs_data = array(
		'cnt_wait'	=> $oReserve->countByStaffId($member['mb_id'], 'W,P'),
		'cnt_total'	=> $oReserve->countByStaffId($member['mb_id'], 'W,P,E,C,B')
	);
}
?>
</head>
<body>
<div id="wrap" class="wrap">

	<? if(!$is_main) { ?>
	<div class="location">
    	<h2><?=$doc_title?></h2>
		<a href="<?=$back_url?>" id="btn_back" class="btn_go_back location_<?=$back_type?>"><i class="xi-angle-left"></i></a>
    </div>
	<? } ?>
