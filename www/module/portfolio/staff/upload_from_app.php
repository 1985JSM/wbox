<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();
$result = $oPortfolio->uploadFileFromApp();
echo json_encode($result);
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
