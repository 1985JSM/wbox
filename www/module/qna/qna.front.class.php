<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/qna/qna.class.php');

Class QnaFront extends Qna
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

		$arr['bo_publish'] = 'B';
		$arr['bo_display'] = 'A';
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		$arr['bo_publish'] = 'B';
		$arr['bo_display'] = 'A';
	
		return $arr;
	}

	/* auth */
	protected function checkReadAuth($uid) {

		return false;
	}

	protected function checkDeleteAuth($uid) {	

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		global $member;
		$mb_id = $member['mb_id'];
		$db_where.= " and bo_publish = 'B' and reg_id = '$mb_id' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	
	
	
}
?>
