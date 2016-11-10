<?php
ob_start();
print_r($_POST);
print_r($_FILES);
$log_data = ob_get_contents();
ob_end_clean();

$log_path = $_SERVER['DOCUMENT_ROOT'].'/data/upload/portfoliotest';
if(!is_dir($log_path)) {
	@mkdir($log_path, 0707);
	@chmod($log_path, 0707);
}
$log_file = $log_path.'/'.date('Y.m.d').'.txt';

global $member;
$mb_id = $member['mb_id'];
if(!$mb_id) { $mb_id = 'guest'; }
$time = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

$content = '';
if(file_exists($log_file)) {
	$content .= file_get_contents($log_file);
}
$content.= '['.$time.']['.$ip.']['.$mb_id.']	'.$log_data."\n";

file_put_contents($log_file, $content);
move_uploaded_file($_FILES['file']['tmp_name'], $log_path . '/' . $_FILES['file']['name']);
?>