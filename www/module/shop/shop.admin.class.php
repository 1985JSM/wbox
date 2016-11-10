<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/shop/shop.class.php');

Class ShopAdmin extends Shop
{	
	/* init */
	public function init() {		

		parent::init();
	}

	/* update */
	protected function initUpdate()	{
		parent::initUpdate();
		$update_field = $this->get('update_field');
		$update_field = str_replace(',sh_state', '', $update_field);
		$this->set('update_field', $update_field);

		$required_field = $this->get('required_field');
		$required_field = str_replace(',sh_state', ',open_time,close_time,sh_holiday', $required_field);
		$this->set('required_field', $required_field);
	}
	
	/* delete */
	protected function dbDelete($uid) {

		// 예약삭제
		dbDelete("tbl_reserve", "where sh_code = '$uid'");

		// 리뷰 삭제
		$list = dbSelect("tbl_review", "rv_id", "where sh_code = '$uid'", "", "");
		$module = 'review';
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$pr_uid = $list[$i]['rv_id'];
			dbDelete("tbl_file", "where pr_module = '$module' and pr_uid = '$pr_uid'");
			deleteAll(_UPLOAD_PATH_.'/'.$module.'/'.substr($pr_uid, 0, 1).'/'.$pr_uid);
		}
		dbDelete("tbl_review", "where sh_code = '$uid'");

		// 갤러리 삭제
		$list = dbSelect("tbl_gallery", "gl_id", "where sh_code = '$uid'", "", "");
		$module = 'gallery';
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$pr_uid = $list[$i]['gl_id'];
			dbDelete("tbl_file", "where pr_module = '$module' and pr_uid = '$pr_uid'");
			deleteAll(_UPLOAD_PATH_.'/'.$module.'/'.substr($pr_uid, 0, 1).'/'.$pr_uid);
		}
		dbDelete("tbl_gallery", "where sh_code = '$uid'");

		// 서비스 삭제
		$list = dbSelect("tbl_service", "sv_id", "where sh_code = '$uid'", "", "");
		$module = 'service';
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$pr_uid = $list[$i]['sv_id'];
			dbDelete("tbl_file", "where pr_module = '$module' and pr_uid = '$pr_uid'");
			deleteAll(_UPLOAD_PATH_.'/'.$module.'/'.substr($pr_uid, 0, 1).'/'.$pr_uid);
		}
		dbDelete("tbl_service", "where sh_code = '$uid'");

		// 담당자 삭제
		$list = dbSelect("tbl_staff", "mb_id", "where sh_code = '$uid'", "", "");
		$module = 'staff';
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$pr_uid = $list[$i]['mb_id'];
			dbDelete("tbl_file", "where pr_module = '$module' and pr_uid = '$pr_uid'");
			deleteAll(_UPLOAD_PATH_.'/'.$module.'/'.substr($pr_uid, 0, 1).'/'.$pr_uid);
		}
		dbDelete("tbl_staff", "where sh_code = '$uid'");

		// 관리자 삭제
		$list = dbSelect("tbl_manager", "mb_id", "where sh_code = '$uid'", "", "");
		$module = 'manager';
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$pr_uid = $list[$i]['mb_id'];
			dbDelete("tbl_file", "where pr_module = '$module' and pr_uid = '$pr_uid'");
			deleteAll(_UPLOAD_PATH_.'/'.$module.'/'.substr($pr_uid, 0, 1).'/'.$pr_uid);
		}
		dbDelete("tbl_manager", "where sh_code = '$uid'");

		// 즐겨찾기 삭제
		dbDelete("tbl_favorite", "where sh_code = '$uid'");

		// 방문로그 삭제
		dbDelete("tbl_shop_visit", "where sh_code = '$uid'");

		parent::dbDelete($uid);
	}
}
?>
