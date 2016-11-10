<?
header('Content-Type: text/javascript; charset=utf-8');

$layout = $_GET['la'];
$module = $_GET['md'];

include_once('./'.$layout.'/'.$module.'.js');
?>
