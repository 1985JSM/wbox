<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/application/application.class.php');

Class ApplicationUser extends Application
{	
	protected function postInsert($arr) {

		$arr = parent::postInsert($arr);

		$pk = $this->get('pk');
		$uid = $arr[$pk];

		$this->result['url'] = './result.html?'.$pk.'='.$uid;

		return $arr;

	}

}
?>
