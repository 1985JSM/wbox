<?
if(!defined('_INPLUS_')) { exit; }

# 구글맵 > 지오코드 API키
//define('_GEOCODE_KEY_', 'AIzaSyCQlXUtrZSToW5D43K2Mkfpfs46pisst8I');

# 다음 로컬 API
define('_DAUM_SERVER_KEY_', '37066dc42d98117b5e471d6abeec4416');
define('_DAUM_CLIENT_KEY_', '33824d6f9bd45f02e95641e682be0335');

function selectSido() {

	$sido_arr = array(
		'서울'	=> '서울특별시',
		'부산'	=> '부산광역시',
		'대구'	=> '대구광역시',
		'인천'	=> '인천광역시',
		'광주'	=> '광주광역시',
		'대전'	=> '대전광역시',
		'울산'	=> '울산광역시',
//		'세종'	=> '세종특별자치시',
		'경기'	=> '경기도',
		'강원'	=> '강원도',
		'충북'	=> '충청북도',
		'충남'	=> '충청남도',
		'전북'	=> '전라북도',
		'전남'	=> '전라남도',
		'경북'	=> '경상북도',
		'경남'	=> '경상남도',
		'제주'	=> '제주특별자치도'
	);

	return $sido_arr;
}

function selectSigungu($sido_name) {

	$list = dbSelect("tbl_dong", "distinct(sigungu_name) as sigungu_name", "where sido_name = '$sido_name'", "order by sigungu_name asc", "");
	unset($sigungu_arr);
	for($i = 0 ; $i < sizeof($list) ; $i++) {
		$sigungu_name = $list[$i]['sigungu_name'];
		$sigungu_arr[$sigungu_name] = $sigungu_name;
	}

	return $sigungu_arr;
}

function selectDong($sido_name, $sigungu_name) {
	$list = dbSelect("tbl_dong", "distinct(dong_name) as dong_name", "where sido_name = '$sido_name' and sigungu_name = '$sigungu_name'", "order by dong_name asc", "");
	unset($dong_arr);
	for($i = 0 ; $i < sizeof($list) ; $i++) {
		$dong_name = $list[$i]['dong_name'];
		$dong_arr[$dong_name] = $dong_name;
	}

	return $dong_arr;
}

function checkDong($sido_name, $sigungu_name, $dong_name) {
	$cnt = dbCount("tbl_dong", "where sido_name = '$sido_name' and sigungu_name = '$sigungu_name' and dong_name = '$dong_name'");
	return $cnt;
}

function searchDong($dong_name) {
	$list = dbSelect("tbl_dong", "*", "where dong_name like '%".$dong_name."%'", "order by sido_name asc, sigungu_name asc, dong_name asc", "");

	return $list;
}

/*
- 아래는 구글 지오코더이며, 일 요청건수가 2,500건이라 다음 지오코더로 전환
function getGeocodeFromAddr($addr, $sensor = false) {

	$url = 'https://maps.googleapis.com/maps/api/geocode/json?sensor='.$sensor.'&language=ko&address='.urlencode($addr);
	$url.= '&key='._GEOCODE_KEY_;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec ($ch);
	curl_close ($ch);

	// 로그 기록
	if(defined('_FLAG_LOG_') && _FLAG_LOG_) { 

		if(!is_dir(_LOG_PATH_)) {
			@mkdir(_LOG_PATH_, 0707);
			@chmod(_LOG_PATH_, 0707);
		}
		$log_file = _LOG_PATH_.'/geocode.txt';

		global $member;
		$mb_id = $member['mb_id'];
		if(!$mb_id) { $mb_id = 'guest'; }
		$time = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

		$content = '';
		if(file_exists($log_file)) {
			$content .= file_get_contents($log_file);
		}
		$content.= '['.$time.']['.$ip.']['.$mb_id.']	'.$url."\n".$result."\n";

		file_put_contents($log_file, $content);
	}


	$result = json_decode($result, 1);

	if(sizeof($result['results']) > 0) {
		$geocode = array(
			'lat'	=> $result['results'][0]['geometry']['location']['lat'],
			'lng'	=> $result['results'][0]['geometry']['location']['lng']
		);
	}
	else {
		$geocode = array(
			'lat'	=> 1,
			'lng'	=> 1
		);
	}

	return $geocode;
}

function getAddrFromGeocode($lat, $lng, $sensor = false) {

	$url = 'https://maps.googleapis.com/maps/api/geocode/json?sensor='.$sensor.'&language=ko&latlng='.$lat.','.$lng;
	$url.= '&key='._GEOCODE_KEY_;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec ($ch);
	curl_close ($ch);

	// 로그 기록
	if(defined('_FLAG_LOG_') && _FLAG_LOG_) { 

		if(!is_dir(_LOG_PATH_)) {
			@mkdir(_LOG_PATH_, 0707);
			@chmod(_LOG_PATH_, 0707);
		}
		$log_file = _LOG_PATH_.'/geocode.txt';

		global $member;
		$mb_id = $member['mb_id'];
		if(!$mb_id) { $mb_id = 'guest'; }
		$time = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

		$content = '';
		if(file_exists($log_file)) {
			$content .= file_get_contents($log_file);
		}
		$content.= '['.$time.']['.$ip.']['.$mb_id.']	'.$url."\n".$result."\n";

		file_put_contents($log_file, $content);
	}

	$result = json_decode($result, 1);
	$list = $result['results'];

	return $list;
}
*/

function getGeocodeFromAddr($addr) {

	$url = 'https://apis.daum.net/local/geo/addr2coord?output=json';
	$url.= '&apikey='._DAUM_SERVER_KEY_;
	$url.= '&q='.urlencode($addr);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($result, 1);
	$result = $result['channel'];

	if($result['result']) {
		$geocode = array(
			'lat'	=> $result['item'][0]['lat'],
			'lng'	=> $result['item'][0]['lng']
		);
	}
	else {
		$geocode = array(
			'lat'	=> 1,
			'lng'	=> 1
		);
	}

	return $geocode;
}

function getAddrFromGeocode($lat, $lng) {

	$url = 'https://apis.daum.net/local/geo/coord2addr?inputCoordSystem=WGS84&output=json';
	$url.= '&apikey='._DAUM_SERVER_KEY_;
	$url.= '&longitude='.$lng.'&latitude='.$lat;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($result, 1);

	// 로그 기록
	if(defined('_FLAG_LOG_') && _FLAG_LOG_) { 
		
		global $member;
		$mb_id = $member['mb_id'];
		if(!$mb_id) { $mb_id = 'guest'; }

		$date = date('Y.m.d');
		$time = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

		$addr = $result['fullName'];

		if(!is_dir(_LOG_PATH_)) {
			@mkdir(_LOG_PATH_, 0707);
			@chmod(_LOG_PATH_, 0707);
		}
		$log_file = _LOG_PATH_.'/geocode_'.$date.'.txt';		

		$content = '';
		if(file_exists($log_file)) {
			$content .= file_get_contents($log_file);
		}
		$content.= '['.$time.']['.$ip.']['.$mb_id.']'."	$lat	$lng	$addr\n";

		file_put_contents($log_file, $content);
	}

	return $result;
}
?>