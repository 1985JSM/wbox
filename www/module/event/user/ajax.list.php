<?
if(!isset($oEvent)) {
	$oEvent = new EventUser();
	$oEvent->init();
}

/* list */
$oEvent->set('thumb_width', 600);
$oEvent->set('thumb_height', 190);

if($sch_bo_state) {
	$oEvent->set('sch_bo_state', $sch_bo_state);
	if($sch_bo_state == 'Y') {
		$oEvent->set('cnt_rows', 9999);
	}
	else {
		$oEvent->set('cnt_rows', 5);

	}
}

$list = $oEvent->selectList();
$total_cnt = $oEvent->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oEvent->get('pk');

if($this_cnt == 0) {
	$next_page = 0;
}
else {
	$next_page = $page + 1;
}

$json_etc = array(
	'total_cnt'	=> $total_cnt,
	'this_cnt'	=> $this_cnt,
	'next_page'	=> $next_page
);
for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>
	<a href="./view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page1">
		<strong><?=$list[$i]['bo_subject']?></strong>
		<span class="data">기간 <?=$list[$i]['bo_s_date']?> ~ <?=$list[$i]['bo_e_date']?></span>
		<span>
			<img src="<?=$list[$i]['main_img']['thumb']?>" alt="<?=$list[$i]['bo_subject']?> banner image" />
		</span>
	</a>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_data">
	<p><i class="xi-close-circle"></i> 등록된 이벤트가 없습니다.</p>
</li>
<? } ?>