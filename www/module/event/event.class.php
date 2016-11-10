<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/board/board.class.php');

Class Event extends Board
{
	/* init */
	public function init() {

		// info
		$this->set('module',		'event');
		$this->set('module_name',	'이벤트');

		// db
		$this->set('bo_table',	'event');

		$this->set('max_file', 2);
		$this->set('flag_use_thumb', true);

		parent::init();

		// bo_display
		$this->set('bo_display_arr', array(
			'U'	=> '사용자앱'
		));

		// bo_state
		$this->set('bo_state_arr', array(
			'Y'	=> '진행중 이벤트',
			'N'	=> '종료된 이벤트'
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

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);	
		
		// 이미지
		unset($main_img);
		unset($sub_img);
		$file_list = $data['file_list'];

		$sub_seq = 0;
		for($i = 0 ; $i < sizeof($file_list) ; $i++) {
			if($file_list[$i]['file_type'] == 'main') {
				$main_img = $file_list[$i];
				$main_img['thumb'] = $this->getThumbnailFromFile($main_img);
			}
			else if($file_list[$i]['file_type'] == 'sub') {
				$sub_img = $file_list[$i];
				$sub_img['thumb'] = $this->getThumbnailFromFile($sub_img);

				$sub_seq += 1;
			}
		}
		$data['main_img'] = $main_img;
		$data['sub_img'] = $sub_img;

		return $data;
	}	
}
?>