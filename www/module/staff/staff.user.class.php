<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/staff/staff.class.php');

Class StaffUser extends Staff
{	
	/* init */
	public function init() {

		parent::init();

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 305);
		$this->set('thumb_height', 200);
	}

	/* get having */
	protected function getDbHaving() {

		$db_having = parent::getDbHaving();
		if(!$db_having) {
			$db_having = ' having 1 = 1 ';
		}

		// 서비스/담당자가 각 1개 이상
		$service_pk = $this->get('service_pk');
		$this->set('sch_having_field', '');
		$db_having .= " and cnt_service >= '0' ";

		$this->set('db_having', $db_having);

		return $db_having;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();		
		$db_where.= " and b.sh_state = 'Y' and b.open_time != '' and b.close_time != '' and b.sh_holiday != '' ";
		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */
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

	/* like */
	public function checkFlagLike($uid, $mb_id) {

		$like_table = $this->get('like_table');

		$cnt = dbCount($like_table, "where st_id = '$uid' and reg_id = '$mb_id'");
		
		return $cnt;
	}

	public function likeStaff($uid, $mb_id) {

		$like_table = $this->get('like_table');

		$arr = array(
			'st_id'		=> $uid,
			'reg_id'	=> $mb_id,
			'reg_time'	=> date('Y-m-d H:i:s')
		);

		dbInsertByArray($like_table, $arr);

		$cnt_like = dbCount($like_table, "where st_id = '$uid'");

		$this->result['code'] = 'insert_ok';
		$this->result['cnt_like'] = $cnt_like;

		return $this->result;
	}

	public function dislikeStaff($uid, $mb_id) {

		$like_table = $this->get('like_table');

		dbDelete($like_table, "where st_id = '$uid' and reg_id = '$mb_id'");

		$cnt_like = dbCount($like_table, "where st_id = '$uid'");

		$this->result['code'] = 'delete_ok';
		$this->result['cnt_like'] = $cnt_like;

		return $this->result;
	}
}
?>
