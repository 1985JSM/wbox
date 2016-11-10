<?
if(!defined('_INPLUS_')) { exit; } 

Class Blog extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'blog');
		$this->set('module_name',	'블로그포스팅');		

		// context
		$this->set('data_table', 'tbl_blog');
		$this->set('pk', 'bl_id');

		$this->set('max_file', 1);

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('no_image', '/img/mobile/common/s_logo2.png');
		$this->set('thumb_width', 180);
		$this->set('thumb_height', 180);

		$this->set('search_field', 'sh_code,bl_type,bl_display');
		$this->set('sch_type_arr', array(
			'bl_subject'	=> '블로그포스팅명'
		));
	
		/**
		* code array
		*/
		$this->set('bl_type_arr', array(
			'A'	=> '최고관리자',
			'M'	=> '가맹점관리자'
		));

		$this->set('bl_display_arr', array(
			'Y'	=> '노출',
			'N'	=> '미노출'
		));

		parent::init();
	}	

	/* validate */
	protected function validateValues($arr)	{
		
		// 기본 유효성 검사
		$result = parent::validateValues($arr);
		
		return $result;
	}

	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'bl_subject,bl_url,bl_content,bl_display');
		$this->set('required_field', 'bl_type,bl_subject,bl_url');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',bl_subject,bl_url,bl_content,bl_display');
		$this->set('required_field', $pk.',bl_type,bl_subject,bl_url');		
		$this->set('return_url', './write.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		return $arr;
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$blog_use_table = $this->get('blog_use_table');
		$bl_us_pk = $this->get('bl_us_pk');

		$select_table = "$data_table a";
		$select_field = "a.*";
		//$select_field.= ", (select count(".$bl_us_pk.") from $blog_use_table where a.$pk = $pk) as cnt_use ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// bl_type
		$bl_type_arr = $this->get('bl_type_arr');
		$data['txt_bl_type'] = $bl_type_arr[$data['bl_type']];

		// bl_display
		$bl_display_arr = $this->get('bl_display_arr');
		$data['txt_bl_display'] = $bl_display_arr[$data['bl_display']];
		
		return $data;
	}
}
?>