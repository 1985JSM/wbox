<?
define('_INPLUS_', true);
include_once('./common.php');

$mode = $_POST['mode'];
$name = $_POST['name'];

/*
$str_data = 'eyJtZW1vIjoi7ZmY7J6QIO2KueydtOyCrO2VrVxu7ZmY7J6QIO2KueydtOyCrO2VrVxu7ZmY7J6QIO2KueydtOyCrO2VrVxuIn0=';
$str_data = base64_decode($str_data);
echo $str_data;
$data = json_decode($str_data, true);

print_r($data);
exit;
*/

if($mode == 'set') {
	$str_data = $_POST['str_data'];

	/*
	$str_data = str_replace('\"', '"', $str_data);
	$str_data = str_replace('\\\\"', '\"', $str_data);
	*/

	$str_data = base64_decode($str_data);
	$data = json_decode($str_data, true);

	setJsonData($name, $data);
}
else if($mode == 'get') {
	$data = getJsonData($name);
	$str_data = json_encode($data);
	$str_data = base64_encode($str_data);
	echo $str_data;
}
?>