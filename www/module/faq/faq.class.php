<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/board/board.class.php');

Class Faq extends Board
{
	/* init */
	public function init() {

		// info
		$this->set('module',		'faq');
		$this->set('module_name',	'FAQ');

		// db
		$this->set('bo_table',	'faq');

		parent::init();

		// bo_display
		$this->set('bo_display_arr', array(
			'M'	=> '가맹점홈페이지',
			'U'	=> '사용자앱',
			'B'	=> '브랜드사이트'
		));
	}	

	/* insert */
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		$arr['bo_table'] = $this->get('bo_table');
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		$arr['bo_table'] = $this->get('bo_table');
	
		return $arr;
	}
}
?>