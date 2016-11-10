<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
include dirname(__FILE__)."/api.class.php";

//sms182713
$api = new gabiaSmsApi('mela8909','9df130d6dd3a3db020b011b94038c224');
$ref_key = date('Y-m-d H:i:s');
$chk = $api->sms_send('01077283681', '01077283681', '문자내용', $reg_key, '');
//echo "chk : $chk ";
// == gabiaSmsApi::$RESULT_OK
?>

