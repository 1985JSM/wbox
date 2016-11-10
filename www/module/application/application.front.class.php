<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/application/application.class.php');

Class ApplicationFront extends Application
{	
	protected function postInsert($arr) {

		$arr = parent::postInsert($arr);

		$pk = $this->get('pk');
		$uid = $arr[$pk];

		$this->set('uid', $uid);

		return $arr;

	}

}
?>
