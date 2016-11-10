<?
if(!defined('_INPLUS_')) { exit; } 

Class Notice extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'notice');
		$this->set('module_name',	'공지사항');		

		// context
		$this->set('data_table', 'tbl_notice');
		$this->set('pk', 'nt_id');

		$this->set('search_field', 'sh_code');
		$this->set('sch_type_arr', array(
			'nt_subject'	=> '제목',
			'nt_content'	=> '내용'
		));
		$this->set('max_file', 1);

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 600);
	
		/**
		* code array
		*/
		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'nt_subject,nt_content,nt_name');
		$this->set('required_field', 'nt_subject,nt_content,nt_name');		
		$this->set('return_url', './view.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		global $member;
		$arr['nt_name'] = $member['mb_name'];

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',nt_subject,nt_content,nt_name');
		$this->set('required_field', $pk.',nt_subject,nt_content,nt_name');		
		$this->set('return_url', './view.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		global $member;
		$arr['nt_name'] = $member['mb_name'];

		return $arr;
	}

	/* list */
	protected function initSelect()	{
		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', "*");
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);
		
		return $data;
	}	
}
?>