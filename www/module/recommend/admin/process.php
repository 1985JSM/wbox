<?
if(!defined('_INPLUS_')) { exit; } 

$oRecommend = new RecommendAdmin();
$oRecommend->init();

if($mode == 'insert') {
	$result = $oRecommend->insertData();
}
else if($mode == 'update') {
	$result = $oRecommend->updateData();
}
else if($mode == 'delete') {
	$result = $oRecommend->deleteData();
}
else if($mode == 'change_order') {
	$uid = $oRecommend->get('uid');
	$result = $oRecommend->changeOrder($uid, $direction);

	echo json_encode($result);
	exit;
}
else if($mode == 'add_shop') {
	$uid = $oRecommend->get('uid');
	$result = $oRecommend->addShop($uid, $sh_code);

	ob_start();
	include_once(_MODULE_PATH_.'/shop/admin/ajax.recommend_list.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();

	echo json_encode($result);
	exit;
}
else if($mode == 'delete_shop') {
	$uid = $oRecommend->get('uid');
	$result = $oRecommend->deleteShop($uid, $sh_code);

	ob_start();
	include_once(_MODULE_PATH_.'/shop/admin/ajax.recommend_list.php');
	$result['content'] = ob_get_contents();
	ob_end_clean();

	echo json_encode($result);
	exit;
}

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
?>
