<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/user/user.class.php');

Class UserManager extends User
{	
	/* init */
	public function init() {

		$this->set('sch_type_arr', array(
			'a.mb_name'	=> '이름',
			'a.mb_email'	=> '이메일',
			'a.mb_hp'	=> '휴대폰'
		));

		$this->set('sch_date_type_arr', array(
			'a.reg_time'		=> '가입일',
			'last_reserve_date'	=> '최근예약일'
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

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 100);
		$this->set('thumb_height', 100);

		// reserve
		include_once(_MODULE_PATH_.'/reserve/reserve.class.php');
		$oReserve = new Reserve();
		$oReserve->init();
		$this->set('reserve_table',	$oReserve->get('data_table'));
		$this->set('reserve_pk',	$oReserve->get('pk'));

		// favorite
		include_once(_MODULE_PATH_.'/favorite/favorite.class.php');
		$oFavorite = new Favorite();
		$oFavorite->init();
		$this->set('favorite_table',	$oFavorite->get('data_table'));
		$this->set('favorite_pk',	$oFavorite->get('pk'));
	}

	/* detail */
	protected function convertDetail($data) {

		$data = parent::convertDetail($data);

		// 즐겨찾기
		$data['last_favorite_date'] = str_replace('-', '.', substr($data['last_favorite_time'], 0, 10));

		return $data;
	}
	
	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();

		global $member;
		$sh_code = $member['sh_code'];
		$list_mode = $this->get('list_mode');
		if($list_mode == 'reserve') {
			$reserve_table = $this->get('reserve_table');
			$in_list = dbSelect($reserve_table, "distinct(reg_id)","where sh_code = '$sh_code' and rs_type = 'U'", "", "");
		}
		else if($list_mode == 'favorite') {	
			$favorite_table = $this->get('favorite_table');
			$in_list = dbSelect($favorite_table, "distinct(reg_id)","where sh_code = '$sh_code'", "", "");
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

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */	
	protected function initSelect() {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		// reserve
		$reserve_table = $this->get('reserve_table');
		$reserve_pk = $this->get('reserve_pk');

		// favorite
		$favorite_table = $this->get('favorite_table');
		$favorite_pk = $this->get('favorite_pk');

		global $member;
		$sh_code = $member['sh_code'];

		$select_table = "$data_table a ";
		$select_field = "*";
		$select_field.= ", (select count(b.$reserve_pk) from $reserve_table b where b.sh_code = '$sh_code' and b.reg_id = a.mb_id) as cnt_reserve ";
		$select_field.= ", (select c.rs_date from $reserve_table c where c.sh_code = '$sh_code' and c.reg_id = a.mb_id order by c.rs_date desc limit 1) as last_reserve_date ";
		$select_field.= ", (select d.reg_time from $favorite_table d where d.sh_code = '$sh_code' and d.reg_id = a.mb_id order by d.reg_time desc limit 1) as last_favorite_time ";


		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}
	
	
}
?>
