<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/portfolio/portfolio.class.php');

Class PortfolioManager extends Portfolio
{	
	/* init */
	public function init() {

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 100);
		$this->set('thumb_height', 100);

		parent::init();
	}

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		// staff
		global $oStaff;
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$st_data = $oStaff->selectDetail($arr['st_id']);
		//$arr['pf_name'] = $st_data['txt_staff'];
		$arr['pf_name'] = $st_data['mb_nick'];

		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		// staff
		global $oStaff;
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$st_data = $oStaff->selectDetail($arr['st_id']);
		//$arr['pf_name'] = $st_data['txt_staff'];
		$arr['pf_name'] = $st_data['mb_nick'];

		return $arr;
	}	

	/* auth */
	protected function checkReadAuth($uid) {

		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");		
		if($member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");		
		if($member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();

		global $member;
		$sh_code = $member['sh_code'];
		$db_where.= " and a.sh_code = '$sh_code' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* comment */
	protected function getInsertCommentArray() {

		$arr = parent::getInsertCommentArray();

		global $member;

		$arr['cm_type'] = 'M';
		$arr['cm_name'] = $_POST['cm_name'];

		return $arr;
	}

	protected function getReplyCommentArray() {

		$arr = parent::getReplyCommentArray();

		/* staff */
		global $member;
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
			$oStaff = new StaffManager();
			$oStaff->init();
		}
		$st_id_arr = $oStaff->selectStaffByShopCode($member['sh_code']);

		$st_id = $arr['re_id'];
		$arr['re_name'] = $st_id_arr[$st_id];

		return $arr;
	}

	protected function convertComment($data) {

		$data = parent::convertComment($data);

		$data['flag_reply'] = true;
		$data['flag_delete'] = true;

		return $data;
	}

	protected function checkAuthComment($cm_id) {

		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');

		global $member;

		$data = dbOnce($comment_table, "*", "where $comment_pk = '$cm_id'", "");
		if($data['sh_code'] == $member['sh_code']) {
			return true;
		}

		return false;
	}
}
?>
