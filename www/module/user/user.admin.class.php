<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/user/user.class.php');

Class UserAdmin extends User
{	
	/* init */
	public function init() {

		// search
		$this->set('sch_type_arr', array(
			'a.mb_name'		=> '이름',
			'a.mb_email'	=> '이메일',
			'a.mb_hp'		=> '휴대폰'
		));

		$this->set('sch_date_type_arr', array(
			'a.reg_time'		=> '가입일'
		));

		$this->set('order_field_arr', array(
			'a.reg_time'			=> '가입일',
			'cnt_reserve'			=> '예약건수',
			'last_reserve_date'		=> '예약건수',
			'last_favorite_time'	=> '최근즐겨찾기',			
			'a.mb_name'				=> '이름',
			'a.mb_email'			=> '이메일'
		));

		parent::init();

		// reserve
		include_once(_MODULE_PATH_.'/reserve/reserve.class.php');
		$oReserve = new Reserve();
		$oReserve->init();
		$this->set('reserve_table',	$oReserve->get('data_table'));
		$this->set('rs_pk',	$oReserve->get('pk'));

		// favorite
		include_once(_MODULE_PATH_.'/favorite/favorite.class.php');
		$oFavorite = new Favorite();
		$oFavorite->init();
		$this->set('favorite_table',	$oFavorite->get('data_table'));
		$this->set('fv_pk',	$oFavorite->get('pk'));

		/*
		// shop
		include_once(_MODULE_PATH_.'/shop/shop.class.php');
		$oShop = new Shop();
		$oShop->init();
		$this->set('shop_table',	$oShop->get('data_table'));
		$this->set('sh_pk',	$oShop->get('pk'));
		*/
	}

	/* detail */
	protected function convertDetail($data) {

		$data = parent::convertDetail($data);

		return $data;
	}
	
	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();

		// reserve
		$reserve_table = $this->get('reserve_table');
		$rs_pk = $this->get('rs_pk');

		// favorite
		$favorite_table = $this->get('favorite_table');
		$fv_pk = $this->get('fv_pk');

		// list_mode
		$list_mode = $this->get('list_mode');
		if($list_mode == 'reserve') {
			$db_where .= " and (select count($rs_pk) from $reserve_table where reg_id = a.mb_id and rs_type = 'U') > '0' ";
		}
		else if($list_mode == 'favorite') {
			$db_where .= " and (select count($fv_pk) from $favorite_table where reg_id = a.mb_id) > '0' ";
		}
		else if($list_mode == 'leave') {
			$db_where .= " and a.mb_level = '1' ";

		}
		


		/*

		global $member;
		$sh_code = $member['sh_code'];
		$list_mode = $this->get('list_mode');
		if($list_mode == 'reserve') {
			$reserve_table = $this->get('reserve_table');
			$in_list = dbSelect($reserve_table, "distinct(reg_id)","where rs_type = 'U'", "", "");
		}
		else if($list_mode == 'favorite') {	
			$favorite_table = $this->get('favorite_table');
			$in_list = dbSelect($favorite_table, "distinct(reg_id)","", "", "");
		}

		unset($in_arr);
		for($i = 0 ; $i < sizeof($in_list) ; $i++) {
			$in_arr[$i] = $in_list[$i]['reg_id'];
		}

		if(sizeof($in_arr) > 0) {
			$db_in = implode("','", $in_arr);
		}
		else {
			$db_in = 'none';
		}
		$db_where.= " and mb_id in ('$db_in') ";

		
		*/
		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */	
	protected function initSelect() {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		// reserve
		$reserve_table = $this->get('reserve_table');
		$rs_pk = $this->get('rs_pk');

		// favorite
		$favorite_table = $this->get('favorite_table');
		$fv_pk = $this->get('fv_pk');

		/*
		// shop
		$shop_table = $this->get('shop_table');
		$sh_pk = $this->get('sh_pk');
		*/

		$select_table = "$data_table a ";

		$select_field = "a.*";
		$select_field.= ", (select count($rs_pk) from $reserve_table where reg_id = a.mb_id and rs_type = 'U') as cnt_total_reserve ";
		$select_field.= ", (select count($rs_pk) from $reserve_table where reg_id = a.mb_id and rs_type = 'U' and rs_state = 'E') as cnt_finish_reserve ";
		$select_field.= ", (select count($fv_pk) from $favorite_table where reg_id = a.mb_id) as cnt_favorite ";


		/*
		global $member;
		$sh_code = $member['sh_code'];

		$list_mode = $this->get('list_mode');

		$select_table = "$data_table a ";

		if($list_mode == 'reserve') {
			$select_table .= " left outer join $reserve_table f on f.reg_id = a.$pk ";
			$select_table .= " left outer join $shop_table e on e.sh_code = f.sh_code ";
		}
		else if($list_mode == 'favorite') {	
			$select_table .= " left outer join $favorite_table f on f.reg_id = a.$pk ";
			$select_table .= " left outer join $shop_table e on e.sh_code = f.sh_code ";
		}

		
		$select_field = "a.*, e.sh_name";
		$select_field.= ", (select count(b.$rs_pk) from $reserve_table b where b.sh_code = '$sh_code' and b.reg_id = a.mb_id) as cnt_reserve ";
		$select_field.= ", (select c.rs_date from $reserve_table c where c.sh_code = '$sh_code' and c.reg_id = a.mb_id order by c.rs_date desc limit 1) as last_reserve_date ";
		$select_field.= ", (select d.reg_time from $favorite_table d where d.sh_code = '$sh_code' and d.reg_id = a.mb_id order by d.reg_time desc limit 1) as last_favorite_time";
		*/

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}

	/* cancel leave member */
	public function cancelLeaveMember() {

		$del_uid = $_POST['del_uid'];
		if(sizeof($del_uid) > 0) {
			$db_in = implode("','", $del_uid);

			$data_table = $this->get('data_table');
			$pk = $this->get('pk');

			dbUpdate($data_table, "mb_level = '3', lv_time = ''", "where $pk in ('$db_in')");
		}

		if(sizeof($del_uid) > 0) {
			$this->result['code'] = 'update_ok';
			$this->postDelete();			
		}
		
		return $this->result;
	}
	
	
}
?>
