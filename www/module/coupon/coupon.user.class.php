<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/coupon/coupon.class.php');

Class CouponUser extends Coupon
{	
	/* init */
	public function init() {

		parent::init();
	}	

	/* detail */
	protected function convertDetail($data) {

		$data = parent::convertDetail($data);

		// 사용불가 여부 확인하기
		global $member;
		$data['flag_use'] = $this->checkFlagUse($data, $member['mb_id']);			

		return $data;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$db_where.= " and cp_display = 'Y' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* 관리자가 발행한 쿠폰 내역 조회 
	public function selectAdminCouponList() {

		global $member;
		$mb_id = $member['mb_id'];
		$mb_level = $member['mb_level'];

		$this->initSelect();

		$select_table = $this->get('select_table');
		$select_field = $this->get('select_field');

		$pk =$this->get('pk');

		$list = dbSelect($select_table, $select_field, "where cp_display = 'Y' and cp_publish = 'A' and cp_levels like '%".$mb_level."%'", "order by a.$pk desc", "");

		$list = $this->convertList($list);

		// 사용불가 여부 확인하기
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$list[$i]['flag_use'] = $this->checkFlagUse($list[$i], $mb_id);			
		}

		return $list;

	}
	*/

}
?>
