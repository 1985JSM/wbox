<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/board/board.class.php');

Class Qna extends Board
{
	/* init */
	public function init() {

		// info
		$this->set('module',		'qna');
		$this->set('module_name',	'1:1문의');

		// db
		$this->set('bo_table',	'qna');

		parent::init();

		// bo_publish
		$this->set('bo_publish_arr', array(
			'M'	=> '가맹점관리자',
			'U'	=> '사용자앱',
			'B'	=> '브랜드사이트'
		));

		// bo_state
		$this->set('bo_state_arr', array(
			'Y'	=> '답변완료',
			'N'	=> '답변대기'
		));
	}	

	/* insert */
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		$arr['bo_table'] = $this->get('bo_table');
		$arr['bo_state'] = 'N';
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		$arr['bo_table'] = $this->get('bo_table');
	
		return $arr;
	}

	/* detail */
	protected function convertDetail($data) {

		$data = parent::convertDetail($data);

		// bo_state
		if($data['bo_state'] == 'Y') {
			$data['class_bo_state'] = 'success';
		}
		else {
			$data['class_bo_state'] = 'failed';
		}

		return $data;
	}
}
?>