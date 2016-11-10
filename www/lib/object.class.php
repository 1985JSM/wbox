<?
if(!defined('_INPLUS_')) { exit; } 

Class Object
{
	protected $values = array();

	/* get/set */
	public function get($key) {
		return $this->values[$key];
	}

	public function set($key, $val) {
		$this->values[$key] = $val;
	}
	
	public function del($key) {
		unset($this->values[$key]);
	}

	/* parameter controll */
	protected function getParameters($str, $method = '') {
		$key_arr = explode(',', $str);
		unset($arr);
		
		for($i = 0 ; $i < sizeof($key_arr) ; $i++) {
			$key = $key_arr[$i];
			$val = ($method == 'post') ? $_POST[$key] : $_GET[$key];

			$arr[$key] = $val;
		}

		return $arr;
	}
}
?>