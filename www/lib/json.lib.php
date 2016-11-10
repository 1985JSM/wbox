<?
if(!defined('_INPLUS_')) { exit; }

function setJsonData($name, $data) {

	global $oMember;
	if(!isset($oMember)) {
		$oMember = new Member();
		$oMember->init();
	}
	
	$member = $oMember->getLoginMember();
	$cs_uid = $member['cs_uid'];

	$json_dir_path = _JSON_PATH_.'/'.$cs_uid;
	if(!is_dir($json_dir_path)) {
		@mkdir($json_dir_path, 0707);
		@chmod($json_dir_path, 0707);
	}

	$json_file_path = $json_dir_path.'/'.$name;

	$str_data = json_encode($data);
	file_put_contents($json_file_path, $str_data);
	@chmod($json_file_path, 0707);
}

function getJsonData($name) {

	global $oMember;
	if(!isset($oMember)) {
		$oMember = new Member();
		$oMember->init();
	}
	
	$member = $oMember->getLoginMember();
	$cs_uid = $member['cs_uid'];

	$json_dir_path = _JSON_PATH_.'/'.$cs_uid;
	if(!is_dir($json_dir_path)) {
		@mkdir($json_dir_path, 0707);
		@chmod($json_dir_path, 0707);
	}

	unset($data);
	$json_file_path = $json_dir_path.'/'.$name;
	if(file_exists($json_file_path)) {
		$data = json_decode(file_get_contents($json_file_path), true);
	}

	return $data;
}

function deleteJsonData($name) {

	global $oMember;
	if(!isset($oMember)) {
		$oMember = new Member();
		$oMember->init();
	}
	
	$member = $oMember->getLoginMember();
	$cs_uid = $member['cs_uid'];

	$json_dir_path = _JSON_PATH_.'/'.$cs_uid;
	if(!is_dir($json_dir_path)) {
		@mkdir($json_dir_path, 0707);
		@chmod($json_dir_path, 0707);
	}

	$json_file_path = $json_dir_path.'/'.$name;
	if(file_exists($json_file_path)) {
		@unlink($json_file_path);
	}
}
function array_to_json( $array ){

	if( !is_array( $array ) ){
		return false;
	}

	$associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
	if( $associative ){

		$construct = array();
		foreach( $array as $key => $value ){

			// We first copy each key/value pair into a staging array,
			// formatting each key and value properly as we go.

			// Format the key:
			if( is_numeric($key) ){
				$key = "key_$key";
			}
			$key = '"'.addslashes($key).'"';

			// Format the value:
			if( is_array( $value )){
				$value = array_to_json( $value );
			} else if( !is_numeric( $value ) || is_string( $value ) ){
				$value = '"'.addslashes($value).'"';
			}

			// Add to staging array:
			$construct[] = "$key: $value";
		}

		// Then we collapse the staging array into the JSON form:
		$result = "{ " . implode( ", ", $construct ) . " }";

	} else { // If the array is a vector (not associative):

		$construct = array();
		foreach( $array as $value ){

			// Format the value:
			if( is_array( $value )){
				$value = array_to_json( $value );
			} else if( !is_numeric( $value ) || is_string( $value ) ){
				$value = '"'.addslashes($value).'"';
			}

			// Add to staging array:
			$construct[] = $value;
		}

		// Then we collapse the staging array into the JSON form:
		$result = "[ " . implode( ", ", $construct ) . " ]";
	}

	return $result;
}
?>