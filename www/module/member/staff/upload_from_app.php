<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oMember = new MemberStaff();
$oMember->init();

$mb_id = $_POST['uid'];
if($mb_id) {	
	$result = $oMember->uploadFileFromApp($mb_id);
	echo json_encode($result);
}

/*
ob_start();
print_r($_POST);
print_r($_FILES);
$content = ob_get_contents();
ob_end_clean();

$arr = array(
	'content'	=> $content,
	'time'		=> date('Y-m-d H:i:s')
);

dbInsertByArray("tbl_test", $arr);
*/
?>
