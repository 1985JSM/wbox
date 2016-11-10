<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/coupon/coupon.class.php');

Class CouponAdmin extends Coupon
{	
	/* init */
	public function init() {

		parent::init();
	}

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		$arr['cp_publish'] = 'A';

		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		$arr['cp_publish'] = 'A';

		return $arr;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();

		$db_where.= " and cp_publish = 'A' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}
}
?>
