<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/qna/qna.class.php');

Class QnaUser extends Qna
{	
	/* init */
	public function init() {

		parent::init();

		// bo_state
		$this->set('bo_state_arr', array(
			'Y'	=> '답변',
			'N'	=> '대기'
		));

		$this->set('cnt_rows', 5);
	}

	/* insert */
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		global $member;
		$arr['bo_name'] = $member['mb_name'];
		$arr['bo_email'] = $member['mb_email'];
		$arr['bo_tel'] = $member['mb_hp'];

		$arr['bo_publish'] = 'U';
		$arr['bo_display'] = 'A';
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		global $member;
		$arr['bo_name'] = $member['mb_name'];
		$arr['bo_email'] = $member['mb_email'];
		$arr['bo_tel'] = $member['mb_hp'];

		$arr['bo_publish'] = 'U';
		$arr['bo_display'] = 'A';
	
		return $arr;
	}

	/* auth */
	protected function checkReadAuth($uid) {

		global $member;

		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "bo_publish, reg_id", "where $pk = '$uid'", "");		
		if($data['bo_publish'] == 'U' && $member['mb_id'] == $data['reg_id']) { 
			return true; 
		}

		return true;
	}

	protected function checkDeleteAuth($uid) {	

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		global $member;
		$mb_id = $member['mb_id'];
		$db_where.= " and bo_publish = 'U' and reg_id = '$mb_id' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	
	
	
}
?>
