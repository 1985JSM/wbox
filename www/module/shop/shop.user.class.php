<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/shop/shop.class.php');

Class ShopUser extends Shop
{	
	/* init */
	public function init() {	

		// listing
		$this->set('cnt_rows', 10);
		
		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 640);
		$this->set('thumb_height', 380);
		$this->set('no_image', '/img/mobile/common/no_image_box.png');

		//sh_state_arr

		parent::init();
	}

	/* get having */
	protected function getDbHaving() {

		$db_having = parent::getDbHaving();
		if(!$db_having) {
			$db_having = ' having 1 = 1 ';
		}

		// 서비스/담당자가 각 1개 이상
		$service_pk = $this->get('service_pk');
		$staff_pk = $this->get('staff_pk');
		$this->set('sch_having_field', '');
		$db_having .= " and cnt_staff * cnt_service > '0' ";

		// 거리
		$flag_use_distance = $this->get('flag_use_distance');
		$sch_distance = $this->get('sch_distance');
		if($flag_use_distance && $sch_distance) {
			$lat = getCookieValue('ck_lat');
			$lng = getCookieValue('ck_lng');

			$db_having .= " and distance <= '$sch_distance' ";
		}
		$this->set('db_having', $db_having);

		return $db_having;
	}

	/* detal */
	protected function convertDetail($data) {

		$data = parent::convertDetail($data);

		if($data['distance'] > 1000) {
			$data['txt_distance'] = number_format($data['distance'] / 1000, 1).'km';
		}
		else if($data['distance'] > 0) {
			$data['txt_distance'] = round($data['distance'], 1).'m';
		}

		return $data;
	}

	/* search */
	protected function makeDbWhere() {

		/*
		$db_where = $this->getDefaultWhere();
		$db_where.= " and a.sh_state = 'Y' and a.open_time != '' and a.close_time != '' and a.sh_holiday != '' ";

		$list_mode = $this->get('list_mode');		
		if($list_mode == 'favorite') {
			global $member;
			$mb_id = $member['mb_id'];
			$pk = $this->get('pk');
			
			$favorite_table = $this->get('favorite_table');
			$list = dbSelect($favorite_table, "distinct($pk) as $pk", "where reg_id = '$mb_id'", "", "");
			unset($arr);
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$arr[] = $list[$i][$pk];
			}

			if(sizeof($arr) > 0) {
				$db_in = implode("','", $arr);
			}
			else {
				$db_in = 'none';
			}
			$db_where .= " and a.$pk in ('$db_in') ";
		}
		else if($list_mode == 'reserve') {
			global $member;
			$mb_id = $member['mb_id'];
			$pk = $this->get('pk');

			$reserve_table = $this->get('reserve_table');
			$list = dbSelect($reserve_table, "distinct($pk) as $pk", "where rs_type = 'U' and reg_id = '$mb_id'", "", "");
			unset($arr);
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$arr[] = $list[$i][$pk];
			}

			if(sizeof($arr) > 0) {
				$db_in = implode("','", $arr);
			}
			else {
				$db_in = 'none';
			}
			$db_where .= " and a.$pk in ('$db_in') ";			
		}
		else if($list_mode == 'visit') {
			$pk = $this->get('pk');

			$ck_visit_shop = getCookieValue('ck_visit_shop');
			if($ck_visit_shop) {
				$ck_visit_shop = json_decode($ck_visit_shop, 1);
			}

			unset($arr);
			for($i = 0 ; $i < sizeof($ck_visit_shop) ; $i++) {
				if($ck_visit_shop[$i]) {
					$arr[] = $ck_visit_shop[$i];
				}
			}

			if(sizeof($arr) > 0) {
				$db_in = implode("','", $arr);				
			}
			else {
				$db_in = 'none';
			}

			$db_where .= " and a.$pk in ('$db_in') ";
		}
		*/
		$db_where = parent::makeDbWhere();

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */	
	protected function initSelect() {

		parent::initSelect();

		$select_table = $this->get('select_table');
		$select_field = $this->get('select_field');

		// 거리
		$lat = getCookieValue('ck_lat');
		$lng = getCookieValue('ck_lng');
		if($lat && $lng) {
			$this->set('flag_use_distance', 1);
			$select_field .= ", (6371 * acos(cos(radians('$lat')) * cos(radians(a.sh_lat)) * cos(radians(a.sh_lng) - radians('$lng')) + sin(radians('$lat')) * sin(radians(a.sh_lat)))) * 1000 as distance ";

			$this->set('order_field', 'distance');
			$this->set('order_direct', 'asc');
		}

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}

	protected function countTotal() {

		$select_table = $this->get('select_table');
		$select_field = $this->get('select_field');
		$db_where = $this->get('db_where');
		$group_field = $this->get('group_field');
		$db_having = $this->get('db_having');

		$tmp_list = dbSelect($select_table, $select_field, $db_where, "group by $group_field ".$db_having, '');
		$total_cnt = sizeof($tmp_list);

		return $total_cnt;
	}

	/* count by sigungu */
	public function countBySingungu($sh_sido) {

		// 전체보기
		$arr = array(
			'전체보기'	=> 0
		);

		// 시군구 배열
		$sigungu_arr = selectSigungu($sh_sido);
		foreach($sigungu_arr as $key) {
			$arr[$key] = 0;
		}

		// 시군구별 카운트
		$select_table = "(select a.sh_sigungu, ";
		$select_table.= "(select count(b.sh_code) from tbl_service b where a.sh_code = b.sh_code) as cnt_service, ";
		$select_table.= "(select count(c.sh_code) from tbl_staff c where a.sh_code = c.sh_code) as cnt_staff ";
		$select_table.= "from tbl_shop a ";
		$select_table.= "where a.sh_sido = '$sh_sido' ";
		$select_table.= "and a.sh_state = 'Y' ";
		$select_table.= "and a.open_time != '' ";
		$select_table.= "and a.close_time != '' ";
		$select_table.= "and a.sh_holiday != '' ";
		$select_table.= "group by a.sh_code ";
		$select_table.= "having cnt_staff * cnt_service > '0' ) t";
		$select_field = "t.sh_sigungu, count(t.sh_sigungu) as cnt";

		$list = dbSelect($select_table, $select_field, "", "group by t.sh_sigungu", "");

		$cnt_total = 0;
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$key = $list[$i]['sh_sigungu'];
			$arr[$key] = $list[$i]['cnt'];
			$cnt_total += $list[$i]['cnt'];
		}

		$arr['전체보기'] = $cnt_total;

		return $arr;
	}

	/* set visit cookie */
	public function setVisitCookie($sh_code) {

		$flag_new = false;

		$ck_visit_shop = getCookieValue('ck_visit_shop');				
		if($ck_visit_shop) {
			$ck_visit_shop = json_decode($ck_visit_shop, 1); 
		}

		if(is_array($ck_visit_shop) && sizeof($ck_visit_shop) > 0) {
			$chk = in_array($sh_code, $ck_visit_shop);
			if(!$chk) {
				$flag_new = true;
			}
		}
		else {
			$flag_new = true;
		}

		if($flag_new) {
			$ck_visit_shop[] = $sh_code;

			include_once(_MODULE_PATH_.'/shop_visit/shop_visit.class.php');
			$oShopVisit = new ShopVisit();
			$oShopVisit->init();
			$visit_table = $oShopVisit->get('data_table');
						
			global $member;
			$arr = array(
				'sh_code'	=> $sh_code,
				'reg_id'	=> $member['mb_id'],
				'reg_time'	=> date('Y-m-d H:i:s')
			);

			dbInsertByArray($visit_table, $arr);

		}

		//$ck_visit_shop[] = $sh_code;
		$ck_visit_shop = json_encode($ck_visit_shop);		

		setCookieValue('ck_visit_shop', $ck_visit_shop, 3600 * 2);
		//deleteCookieValue('ck_visit_shop');
	}

	/* like */
	public function checkFlagLike($uid, $like_type, $mb_id) {

		$like_table = $this->get('like_table');

		$cnt = dbCount($like_table, "where sh_code = '$uid' and like_type = '$like_type' and reg_id = '$mb_id'");
		
		return $cnt;
	}

	public function likeShop($uid, $like_type, $mb_id) {

		$like_table = $this->get('like_table');

		dbDelete($like_table, "where sh_code = '$uid' and reg_id = '$mb_id'");

		$arr = array(
			'sh_code'	=> $uid,
			'like_type'	=> $like_type,
			'reg_id'	=> $mb_id,
			'reg_time'	=> date('Y-m-d H:i:s')
		);

		dbInsertByArray($like_table, $arr);

		$cnt_like = dbCount($like_table, "where sh_code = '$uid' and like_type = '$like_type'");

		$this->result['code'] = 'insert_ok';
		$this->result['cnt_like'] = $cnt_like;

		return $this->result;
	}

	public function dislikeShop($uid, $like_type, $mb_id) {

		$like_table = $this->get('like_table');

		dbDelete($like_table, "where sh_code = '$uid' and reg_id = '$mb_id'");

		$cnt_like = dbCount($like_table, "where sh_code = '$uid' and like_type = '$like_type'");

		$this->result['code'] = 'delete_ok';
		$this->result['cnt_like'] = $cnt_like;

		return $this->result;
	}
}
?>
