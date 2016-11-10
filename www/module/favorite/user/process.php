<?
if(!defined('_INPLUS_')) { exit; } 

$oFavorite = new FavoriteUser();
$oFavorite->init();

if($mode == 'insert') {
	$result = $oFavorite->insertData();
}
else if($mode == 'insert_by_ajax') {
	$_POST = $_GET;
	$result = $oFavorite->insertData();
	echo json_encode($result);
	exit;
}
if($mode == 'insert') {
	$result = $oFavorite->insertData();
}
else if($mode == 'update') {
	$result = $oFavorite->updateData();
}
else if($mode == 'delete') {
	$result = $oFavorite->deleteData();
}
else if($mode == 'delete_by_ajax') {
	$sh_code = $_GET['sh_code'];
	$result = $oFavorite->deleteDataByShopCode($sh_code);
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
