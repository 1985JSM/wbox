<?
if(!defined('_INPLUS_')) { exit; }

define('_SHORT_API_KEY_', 'AIzaSyAjvoPJYKm4yEKQJMddmfroYDcm8wnP3o8');

function getShortUrl($long_url) {

	$url = 'https://www.googleapis.com/urlshortener/v1/url?key='._SHORT_API_KEY_;

	$arr = array(
		'longUrl'	=> $long_url
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
//	curl_setopt($ch, CURLOPT_SSLVERSION,3);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($result, 1);

	return $result;
}
?>