<?
if(!defined('_INPLUS_')) { exit; } 

Class Board extends StdController
{	
	/* init */
	public function init() {

		// db
		$this->set('data_table',	'tbl_board');
		$this->set('pk',			'bo_id');

		// search
		$this->set('search_field', 'bo_table,bo_state,bo_category,bo_s_date,bo_e_date,bo_publish,bo_display,sh_code');
		$this->set('sch_type_arr', array(			
			'bo_subject'	=> '제목',
			'bo_content'	=> '내용',
			'bo_name'		=> '작성자',
		));

		// new_days
		$this->set('new_days', 1);

		// bo_publish
		$this->set('bo_publish_arr', array(
			'A'	=> '최고관리자',
			'M'	=> '가맹점관리자',
			'S'	=> '담당자앱',
			'U'	=> '사용자앱',
			'B'	=> '브랜드사이트'
		));

		// bo_display
		$this->set('bo_display_arr', array(
			'M'	=> '가맹점홈페이지',
			'S'	=> '담당자앱',
			'U'	=> '사용자앱',
			'B'	=> '브랜드사이트'
		));

		// flag_email
		$this->set('flag_email_arr', array(
			'Y'	=> '수신',
			'N'	=> '미수신'
		));

		// flag_sms
		$this->set('flag_sms_arr', array(
			'Y'	=> '수신',
			'N'	=> '미수신'
		));
	
		/**
		* code array
		*/
		parent::init();
	}	

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		$bo_table = $this->get('bo_table');
		$db_where.= " and bo_table = '$bo_table' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}	
	
	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'bo_table,bo_subject,bo_content,bo_name,bo_email,bo_tel,flag_email,flag_sms,bo_category,bo_state,bo_s_date,bo_e_date,bo_display');
		$this->set('required_field', 'bo_table,bo_subject,bo_content,bo_name');		
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// 아이피
		$arr['bo_ip'] = $_SERVER['REMOTE_ADDR'];	

		// 조회수
		$arr['bo_hit'] = 0;
		
		return $arr;
	}

	protected function postInsert($arr) {

		$arr = parent::postInsert($arr);

		// 에디터
		$this->moveEditorImage($arr);

		return $arr;
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',bo_table,bo_subject,bo_content,bo_name,bo_email,bo_tel,flag_email,flag_sms,bo_category,bo_state,bo_s_date,bo_e_date,bo_display');
		$this->set('required_field', $pk.',bo_table,bo_subject,bo_content,bo_name');		
		$this->set('return_url', './view.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// 아이피
		$arr['bo_ip'] = $_SERVER['REMOTE_ADDR'];		

		return $arr;
	}	

	protected function postUpdate($arr) {

		$arr = parent::postUpdate($arr);

		// 에디터
		$this->moveEditorImage($arr);

		return $arr;
	}

	/* answer */
	protected function convertAnswer($arr) {

		return $arr;
	}

	public function updateAnswer() {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$uid = $this->get('uid');
		$bo_answer = $_POST['bo_answer'];
		
		global $member;
		$now_time = date('Y-m-d H:i:s');
		$arr = array(
			'bo_answer'	=> $bo_answer,
			'bo_state'	=> 'Y',
			'ans_id'	=> $member['mb_id'],
			'ans_time'	=> $now_time
		);

		$arr = $this->convertAnswer($arr);

		dbUpdateByArray($data_table, $arr, "where $pk = '$uid'");
		
		$query_string = $this->get('query_string');
		if($query_string) { $query_string = '&'.$query_string; }		
		$this->result['url'] = './view.html?'.$pk.'='.$uid.'&page='.$page.$query_string;	
		$this->result['code'] = 'update_ok';

		return $this->result;
	}

	public function deleteAnswer() {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$uid = $this->get('uid');

		global $member;
		$now_time = date('Y-m-d H:i:s');
		$arr = array(
			'bo_answer'	=> '',
			'bo_state'	=> 'N',
			'ans_id'	=> '',
			'ans_name'	=> '',
			'ans_time'	=> ''
		);

		dbUpdateByArray($data_table, $arr, "where $pk = '$uid'");
		
		$query_string = $this->get('query_string');
		if($query_string) { $query_string = '&'.$query_string; }		
		$this->result['url'] = './view.html?'.$pk.'='.$uid.'&page='.$page.$query_string;	
		$this->result['code'] = 'update_ok';

		return $this->result;
	}

	/* list */
	protected function initSelect()	{
		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', '*');
	}	

	protected function convertList($list) {
		$list = parent::convertList($list);

		return $list;
	}

	public function selectLatest($cnt_rows) {

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$bo_table = $this->get('bo_table');

		if(!$cnt_rows) {
			$cnt_rows = 3;
		}

		$db_where = $this->makeDbWhere();

		$list = dbSelect($data_table, "*", $db_where, "order by $pk desc", "limit $cnt_rows", 0);
		$list = $this->convertList($list);

		return $list;
	}

	/* detail */
	protected function convertDetail($data) {
		$data = parent::convertDetail($data);

		// 조회수 증가
		$pk = $this->get('pk');
		$bo_table = $data['bo_table'];
		$bo_id = $data[$pk];

		$flag_hit = getCookieValue('ck_'.$bo_table.'_'.$bo_id);
		if(!$flag_hit) {
			$data_table = $this->get('data_table');
			dbUpdate($data_table, "bo_hit = bo_hit + 1", "where bo_table = '$bo_table' and bo_id = '$bo_id'");
			setCookieValue('ck_'.$bo_table.'_'.$bo_id, true);

			$data['bo_hit'] += 1;
		}		

		// 새글 여부
		$new_days = $this->get('new_days');
		$reg_time = strtotime($data['reg_time']);
		$now_time = time();
		if($reg_time + $new_days * 24 * 3600 > $now_time) {
			$data['flag_new'] = true;
		}

		// 첨부파일 여부
		$data['cnt_file'] = sizeof($data['file_list']);
		if($data['cnt_file'] > 0) {
			$data['flag_file'] = true;			
		}

		// 작성유형
		$bo_publish_arr = $this->get('bo_publish_arr');
		$data['txt_bo_publish'] = $bo_publish_arr[$data['bo_publish']];

		// 출력유형
		$bo_display_arr = $this->get('bo_display_arr');
		$data['txt_bo_display'] = $bo_display_arr[$data['bo_display']];

		// 카테고리
		$bo_category_arr = $this->get('bo_category_arr');
		$data['txt_bo_category'] = $bo_category_arr[$data['bo_category']];

		// 상태
		$bo_state_arr = $this->get('bo_state_arr');
		$data['txt_bo_state'] = $bo_state_arr[$data['bo_state']];

		// 이메일 수신여부
		$flag_email_arr = $this->get('flag_email_arr');
		$data['txt_flag_email'] = $flag_email_arr[$data['flag_email']];

		// SMS 수신여부
		$flag_sms_arr = $this->get('flag_sms_arr');
		$data['txt_flag_sms'] = $flag_sms_arr[$data['flag_sms']];
		
		return $data;
	}

	/* move editor image */
	protected function moveEditorImage($arr) {

		$pk = $this->get('pk');
		$uid = $arr[$pk];
		$module = $this->get('module');

		$bo_content = $arr['bo_content'];
		$pattern = "/<img[^>]*src=\\\\[\'\"]?([^>\'\"]+[^>\'\"]+)\\\\[\'\"]?[^>]*>/";
		preg_match_all($pattern, $bo_content, $matchs);

		if(sizeof($matchs[1]) > 0) {			
			for($i = 0 ; $i < sizeof($matchs[1]) ; $i++) {
				$img_arr = parse_url($matchs[1][$i]);
				$tmp_src = $img_arr['path'];	

				if(strpos($tmp_src, 'data/upload') > -1) {

				} 
				else {
					$img_name = basename($tmp_src);
					$tmp_path = _EDITOR_PATH_.'/'.$tmp_src;

					// 디렉토리		
					$dir_path = $this->getUploadDirectory($module, $uid);
					$new_path = $dir_path.'/'.$img_name;
					$new_src = str_replace(_UPLOAD_PATH_, _UPLOAD_URI_, $new_path);

					@copy($tmp_path, $new_path);
					@unlink($tmp_path);

					$bo_content = str_replace($tmp_src, $new_src, $bo_content);
				}
			}

			// update
			dbUpdate($this->get('data_table'), "bo_content = '$bo_content'", "where $pk = '$uid'");
		}
	}	

	/* get surround list */
	public function selectSurroundList($uid) {

		$this->initSelect();

		$select_table = $this->get('select_table');
		$select_field = $this->get('select_field');
		
		$db_where = $this->makeDbWhere();

		$pk = $this->get('pk');

		//echo "db_where : $db_where ";

		$prev = dbOnce($select_table, $select_field, $db_where." and $pk < '$uid'", "order by $pk desc", 0);
		if($prev[$pk]) {
			$prev = $this->convertDetail($prev);
		}

		$next = dbOnce($select_table, $select_field, $db_where." and $pk > '$uid'", "order by $pk asc");
		if($next[$pk]) {
			$next = $this->convertDetail($next);
		}

		$result = array(
			'prev'	=> $prev,
			'next'	=> $next
		);

		return $result;

	}
}
?>
