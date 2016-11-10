<?
if(!defined('_INPLUS_')) { exit; } 

$oReserve = new ReserveManager();
$oReserve->init();

if($mode == 'insert') {
	$result = $oReserve->insertData();

	ob_start();
	$sch_date = $rs_date;
	include_once(_MODULE_PATH_.'/reserve/manager/ajax.dashboard_aside.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();
}
else if($mode == 'update') {

	$result = $oReserve->updateData();

	ob_start();
	$sch_date = $rs_date;
	include_once(_MODULE_PATH_.'/reserve/manager/ajax.dashboard_aside.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();
}
else if($mode == 'update_state') {
	$result = $oReserve->updateState();

	ob_start();
	include_once(_MODULE_PATH_.'/reserve/manager/ajax.dashboard_aside.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();
}
else if($mode == 'update_payment') {
	$result = $oReserve->updatePayment();
}
else if($mode == 'update_memo') {
	$result = $oReserve->updateMemo();
}
else if($mode == 'update_cash') {
	$result = $oReserve->updateCashPrice();
	alertCode($result['code'], $result['url']);
}
/*
if($mode == 'insert' || $mode == 'ajax_insert') {
	$result = $oReserve->insertData();
	$result['url'] = './list_by_wait.html';	

	if($mode == 'ajax_insert') {

		$result = array(
			'code'	=> 'ok',
			'url'	=> './ajax.dashboard_list.html?sch_rs_date='.$_POST['rs_date']
		);

		echo json_encode($result);
		exit;
	}
}
else if($mode == 'update' || $mode == 'ajax_update') {
	$result = $oReserve->updateData();
	if($mode == 'ajax_update') {

		$result = array(
			'code'	=> 'ok',
			'url'	=> './ajax.dashboard_list.html?sch_rs_date='.$_POST['rs_date']
		);

		echo json_encode($result);
		exit;
	}
}
else if($mode == 'update_state') {
	$result = $oReserve->updateState();
	echo json_encode($result);
	exit;
}
*/
echo json_encode($result);
exit;
/*
if($result['url']) {
	if($result['msg']) { alert($result['msg'], $result['url']); }
	else if($result['code']) { alertCode($result['code'], $result['url']); }
	else { movePage($result['url']); }
	exit;
}

if($result['msg']) {
	alert($result['msg']);
	exit;
}
*/

?>
