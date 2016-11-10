<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/board/board.class.php');

Class Alliance extends Board
{
	/* init */
	public function init() {

		// info
		$this->set('module',		'alliance');
		$this->set('module_name',	'제휴문의');

		// db
		$this->set('bo_table',	'alliance');

		parent::init();

		// search
		$this->set('sch_type_arr', array(			
			'bo_name'	=> '작성자',
			'bo_etc3'	=> '업체명',
			'bo_etc7'	=> '주소',
			'bo_email'	=> '이메일',
			'bo_tel'	=> '연락처'			
		));

		$this->set('sch_date_type_arr', array(			
			'reg_time'	=> '작성일'			
		));

	}	

	/* insert */
	protected function convertInsert($arr) {

		$arr = parent::convertInsert($arr);

		$arr['bo_table'] = $this->get('bo_table');
		$arr['bo_state'] = 'N';

		$arr['bo_subject'] = $arr['bo_name'].'님의 제휴문의입니다.';

		$arr['bo_etc1'] = $_POST['bo_etc1'];
		$arr['bo_etc2'] = $_POST['bo_etc2'];
		$arr['bo_etc3'] = $_POST['bo_etc3'];
		$arr['bo_etc4'] = $_POST['bo_etc4'];
		$arr['bo_etc5'] = $_POST['bo_etc5'];
		$arr['bo_etc6'] = $_POST['bo_etc6'];
		$arr['bo_etc7'] = $_POST['bo_etc7'];
		$arr['bo_etc8'] = $_POST['bo_etc8'];
		$arr['bo_etc9'] = $_POST['bo_etc9'];
		$arr['bo_etc10'] = $_POST['bo_etc10'];
	
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {

		$arr = parent::convertUpdate($arr);

		$arr['bo_table'] = $this->get('bo_table');

		$arr['bo_subject'] = $arr['bo_name'].'님의 제휴문의입니다.';

		$arr['bo_etc1'] = $_POST['bo_etc1'];
		$arr['bo_etc2'] = $_POST['bo_etc2'];
		$arr['bo_etc3'] = $_POST['bo_etc3'];
		$arr['bo_etc4'] = $_POST['bo_etc4'];
		$arr['bo_etc5'] = $_POST['bo_etc5'];
		$arr['bo_etc6'] = $_POST['bo_etc6'];
		$arr['bo_etc7'] = $_POST['bo_etc7'];
		$arr['bo_etc8'] = $_POST['bo_etc8'];
		$arr['bo_etc9'] = $_POST['bo_etc9'];
		$arr['bo_etc10'] = $_POST['bo_etc10'];
	
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