<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/favorite/favorite.class.php');

Class FavoriteUser extends Favorite
{	
	/* init */
	public function init() {

		parent::init();
	}	

	/* delete data by shop code */
	public function deleteDataByShopCode($sh_code) {
		global $member;
		$mb_id = $member['mb_id'];

		dbDelete($this->get('data_table'), "where sh_code = '$sh_code' and reg_id = '$mb_id'");
		
		$this->result['code'] = 'delete_ok';
		return $this->result;
	}
}
?>
