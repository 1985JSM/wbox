<?
if(!defined('_INPLUS_')) { exit; } 

$oStaff = new StaffUser();
$oStaff->init();

if($mode == 'like') {
	$result = $oStaff->likeStaff($st_id, $member['mb_id']);
}
else if($mode == 'dislike') {
	$result = $oStaff->dislikeStaff($st_id, $member['mb_id']);
}

echo json_encode($result);
exit;
?>
