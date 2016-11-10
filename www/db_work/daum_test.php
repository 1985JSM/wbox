<?
exit;
define('_INPLUS_', 1);
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/addr.lib.php');
$arr = getAddrFromGeocode('35.5945549', '129.2635040');
print_r($arr);

?>

