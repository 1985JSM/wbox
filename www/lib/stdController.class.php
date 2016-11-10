<?
if(!defined('_INPLUS_')) { exit; } 

Class StdController extends Object
{
	protected $result = array();

	/* construct */
	public function __construct() {
		// context
		$this->result['code'] = 'error';
		$this->set('data_table', '');
		$this->set('search_field', '');

		$this->set('pk', 'uid');
		//$this->set('order_field', $this->get('pk'));
		$this->set('order_direct', 'desc');
		$this->set('group_field', '');

		// file
		$this->set('file_table', 'tbl_file');
		$this->set('file_pk', 'file_id');
		$this->set('max_file', 0);

		// thumbnail
		$this->set('flag_use_thumb', false);
		$this->set('thumb_width', 0);
		$this->set('thumb_height', 0);
		$this->set('no_image', '');
		$this->set('is_crop', true);

		// pagination		
		$this->set('cnt_rows', 10);
		$this->set('cnt_page', 5);		

		// 정렬순서
		$this->set('order_direct_arr', array(
			'asc'	=> '오름차순',
			'desc'	=> '내림차순'
		));

		// 1페이지당 출력개수
		$this->set('cnt_rows_arr', array(
			'1'		=> '1개씩',
			'10'	=> '10개씩',
			'20'	=> '20개씩',
			'30'	=> '30개씩',
			'50'	=> '50개씩',
			'100'	=> '100개씩'
		));

		// 검색어 반영
		$this->set('keyword_element', '');
		$this->set('keyword_class', '');

		// 최근 기간
		$this->set('sch_date_arr', array(
			'0'	=> getPrevDate(0),
			'1'	=> getPrevDate(2),
			'2'	=> getPrevDate(6),
			'3'	=> getPrevDate(29)
		));

		$page = ($_GET['page']) ? $_GET['page'] : $_POST['page'];
		if(!$page) { $page = 1; }
		$this->set('page', $page);

		// no upload file
		$this->set('no_upload_file', 'php,asp,jsp,html,html,js,css');
	}

	/* init */
	public function init() {
		// uid
		$pk = $this->get('pk');
		$uid = $_POST[$pk] ? $_POST[$pk] : $_GET[$pk];
		$this->set('uid', $uid);

		// file_uid
		$file_pk = $this->get('file_pk');
		$file_uid = $_POST[$file_pk] ? $_POST[$file_pk] : $_GET[$file_pk];
		$this->set('file_uid', $file_uid);

		// order_field
		$sch_order_field = $_POST['sch_order_field'] ? $_POST['sch_order_field'] : $_GET['sch_order_field'];
		if($sch_order_field) { $this->set('order_field', $sch_order_field); }

		// order_direct
		$sch_order_direct = $_POST['sch_order_direct'] ? $_POST['sch_order_direct'] : $_GET['sch_order_direct'];
		if($sch_order_direct) { $this->set('order_direct', $sch_order_direct); }

		// cnt_rows
		$sch_cnt_rows = $_POST['sch_cnt_rows'] ? $_POST['sch_cnt_rows'] : $_GET['sch_cnt_rows'];
		if($sch_cnt_rows) { $this->set('cnt_rows', $sch_cnt_rows); }

		// query string
		$this->makeQueryString();		
	}

	/* query string */
	protected function makeQueryString() {
		$query_string = $_POST['query_string'] ? $_POST['query_string'] : $_GET['query_string'];
		if(!$query_string) {
			$arr = explode(',', $this->get('search_field').',type,keyword,date_type,s_date,e_date,order_field,order_direct,cnt_rows,sum_type,s_sum,e_sum');

			for($i = 0 ; $i < sizeof($arr) ; $i++) {
				$key = 'sch_'.$arr[$i];
				if(strpos($arr[$i], '.') > -1) { $key = str_replace('.', '_', $key); }

				$val = $this->get($key);
				if(!$val) {
					$val = ($_POST[$key]) ? $_POST[$key] : $_GET[$key];
				}
				if($val) {
					if(is_array($val)) {
						if(sizeof($val) == 1 && $val[0] == '') {
							unset($_GET[$key]);
							unset($_POST[$key]);
						}
						else {
							for($j = 0 ; $j < sizeof($val) ; $j++) {
								$query_string .= '&'.$key.'[]='.urlencode($val[$j]);
							}
						}
					}
					else {
						$query_string .= '&'.$key.'='.urlencode($val);
					}
				}
			}
		}

		$this->set('query_string', $query_string);		
	}

	/* order field */
	protected function getOrderField() {	

		$order_field = $this->get('order_field');
		if(!$order_field) { $order_field = 'reg_time'; }

		if($this->get('select_table') != $this->get('data_table') && strpos($this->get('select_table'), 'join') > -1 && strpos($order_field, 'a.') < 0) { $order_field = 'a.'.$order_field; }

		return $order_field;
	}

	/* init having */
	protected function initDbHaving() {

		$sch_having_field = $this->get('sch_having_field');
		if(!$sch_having_field && $_POST['sch_having_field']) { $sch_having_field = $_POST['sch_having_field']; }
		if(!$sch_having_field && $_GET['sch_having_field']) { $sch_having_field = $_GET['sch_having_field']; }
		if(!$sch_having_field && $query_arr['sch_having_field']) { $sch_having_field = $query_arr['sch_having_field']; }
		$this->set('sch_having_field', $sch_having_field);

		$sch_s_having = $this->get('sch_s_having');
		if(!$sch_s_having && $_POST['sch_s_having'])		{ $sch_s_having = $_POST['sch_s_having']; }
		if(!$sch_s_having && $_GET['sch_s_having'])		{ $sch_s_having = $_GET['sch_s_having']; }
		if(!$sch_s_having && $query_arr['sch_s_having'])	{ $sch_s_having = $query_arr['sch_s_having']; }
		$this->set('sch_s_having', $sch_s_having);

		$sch_e_having = $this->get('sch_e_having');
		if(!$sch_e_having && $_POST['sch_e_having'])		{ $sch_e_having = $_POST['sch_e_having']; }
		if(!$sch_e_having && $_GET['sch_e_having'])		{ $sch_e_having = $_GET['sch_e_having']; }
		if(!$sch_e_having && $query_arr['sch_e_having'])	{ $sch_e_having = $query_arr['sch_e_having']; }
		$this->set('sch_e_having', $sch_e_having);
	}

	/* get having */
	protected function getDbHaving() {

		$sch_having_field	= $this->get('sch_having_field');
		$sch_s_having		= $this->get('sch_s_having');
		$sch_e_having		= $this->get('sch_e_having');

		if($sch_having_field) {
			$db_having = ' having 1 = 1 ';
			if($sch_s_having && $sch_s_having > 0) {
				$db_having .= "and $sch_having_field >= '$sch_s_having' ";
			}

			if($sch_e_having && $sch_e_having > 0) {
				$db_having .= "and $sch_having_field <= '$sch_e_having' ";
			}
		}
		else {
			$db_having = '';
		}

		$this->set('db_having', $db_having);

		return $db_having;
	}

	/* auth */
	protected function checkReadAuth($uid) {
		
		global $is_admin, $member;
		$pk = $this->get('pk');

		// 관리자인지
		if($is_admin) { return true; }

		// 비밀글인지		
		$data = dbOnce($this->get('data_table'), "reg_id", "where $pk = '$uid'", "");		
		if($data['flag_secret'] != 'Y') { return true; }

		// 본인 글인지		
		if($member['mb_id'] == $data['reg_id']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		global $is_admin, $member;
		$pk = $this->get('pk');
		// 관리자인지
		if($is_admin) { return true; }

		// 본인 글인지		
		$data = dbOnce($this->get('data_table'), "reg_id", "where $pk = '$uid'", "");
		if($member['mb_id'] == $data['reg_id']) { return true; }

		return false;
	}

	/* validate */
	protected function validateValues($arr) {		
		$chk_key_arr = explode(',', $this->get('required_field'));

		for($i = 0 ; $i < sizeof($chk_key_arr) ; $i++) {
			$key = $chk_key_arr[$i];
			if(!$key) { continue; }
			if(!$arr[$key]) { 
				if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
					$content = '<strong>Validate error</strong>';
					$content.= '<br />';
					$content.= 'column : '.$key;
					printError($content);				
				}		
				return false; 
			}
		}
		return true;
	}

	/* insert */
	protected function initInsert() {
		
	}

	public function insertData() {
		$this->initInsert();

		$arr = $this->getParameters($this->get('insert_field'), 'post');
		$arr = $this->convertInsert($arr);

		if($this->validateValues($arr)) {				
			dbInsertByArray($this->get('data_table'), $arr);
			$this->result['code'] = 'insert_ok';
			$arr = $this->postInsert($arr);
		}

		return $this->result;
	}

	protected function convertInsert($arr) {
		global $member;
		$arr['reg_id'] = $member['mb_id'];
		$arr['reg_time'] = date('Y-m-d H:i:s');
		return $arr;
	}

	protected function postInsert($arr) {

		$pk = $this->get('pk');
		$reg_id = $arr['reg_id'];
		//$ord_field = $this->getOrderField();
		$ord_field = 'reg_time';

		// uid 구하기
		$db_where = "where reg_id = '$reg_id'";
		if($arr['reg_time']) {
			$db_where .= " and reg_time = '".$arr['reg_time']."'";
		}
		$data = dbOnce($this->get('data_table'), $pk, $db_where, "order by $ord_field desc");		
		$uid = $data[$pk];
		$arr[$pk] = $uid;

		if($uid) {
			$this->result['url'] = $this->get('return_url').'?'.$pk.'='.$uid;	
		}

		// 첨부파일
		if($this->get('max_file')) {
			$this->uploadFiles($uid);
		}

		return $arr;
	}

	/* update */
	protected function initUpdate() {

	}

	public function updateData() {

		// 권한 체크
		$pk = $this->get('pk');
		$uid = $this->get('uid');
		if(!$this->checkDeleteAuth($uid)) { alert('권한이 없습니다.'); }

		$this->initUpdate();

		$arr = $this->getParameters($this->get('update_field'), 'post');		
		$arr = $this->convertUpdate($arr);

		if($this->validateValues($arr)) {	
			$p_arr = $arr;
			unset($arr[$pk]);			

			dbUpdateByArray($this->get('data_table'), $arr, "where $pk = '".$uid."'");

			$this->result['code'] = 'update_ok';
			$this->postUpdate($p_arr);			
		}

		return $this->result;
	}

	protected function convertUpdate($arr) {
		global $member;
		$arr['upt_id'] = $member['mb_id'];		
		$arr['upt_time'] = date('Y-m-d H:i:s');

		return $arr;
	}

	protected function postUpdate($p_arr) {
		$pk = $this->get('pk');
		$uid = $this->get('uid');
		$page = $this->get('page');
		$query_string = $this->get('query_string');
		if($query_string) { $query_string = '&'.$query_string; }
		
		$this->result['url'] = $this->get('return_url').'?'.$pk.'='.$uid.'&page='.$page.$query_string;	

		// 기존파일 삭제
		$del_file = $_POST['del_file'];
		for($i = 0 ; $i < sizeof($del_file); $i++) {
			$this->deleteFile($del_file[$i]);
		}

		// 첨부파일
		if($this->get('max_file')) {
			$this->uploadFiles($uid);
		}

		return $p_arr;
	}

	/* detail */
	protected function initSelect() {

	}

	public function selectDetail($uid) {

		// 권한 체크
		$pk = $this->get('pk');
		if($uid && !$this->checkReadAuth($uid)) { alert('권한이 없습니다.'); }

		$this->initSelect();

		$db_where = "where $pk = '$uid'";
		if($this->get('select_table') != $this->get('data_table') && strpos($this->get('select_table'), 'join') > -1) { $db_where = "where a.$pk = '$uid'"; }

		$data = dbOnce($this->get('select_table'), $this->get('select_field'), $db_where, "");
		return $this->convertDetail($data);
	}

	protected function convertDetail($data) {

		$module = $this->get('module');		
		$pk = $this->get('pk');
		$uid = $data[$pk];

		// 등록일시
		$data['reg_date'] = str_replace('-', '.', substr($data['reg_time'], 0, 10));
		$data['upt_date'] = str_replace('-', '.', substr($data['upt_time'], 0, 10));

		if($data['reg_date'] == '0000.00.00') { $data['reg_date'] = '-'; }
		if($data['upt_date'] == '0000.00.00') { $data['upt_date'] = '-'; }

		// 첨부파일
		if($this->get('max_file')) {
			$data['file_list'] = $this->getFileList($uid, $module);			
		}

		// 썸네일
		$flag_use_thumb = $this->get('flag_use_thumb');
		if($flag_use_thumb) {
			$thumb_width = $this->get('thumb_width');
			$thumb_height = $this->get('thumb_height');
			$data['thumb'] = $this->getThumbnail($data, $thumb_width, $thumb_height);
		}

		return $data;
	}

	/* search */
	protected function getDefaultWhere() {
		$db_where = "where 1 = 1 ";
		$query_string = $this->get('query_string');
		$query_string = str_replace('?', '&', $query_string);
		$q_arr = explode('&', $query_string);

		// =(일치) 검색
		unset($query_arr);
		for($i = 0 ; $i < sizeof($q_arr) ; $i++) {
			if(!$q_arr[$i]) { continue; }

			$tmp = explode('=', $q_arr[$i]);
			if($tmp[1]) { $query_arr[$tmp[0]] = $tmp[1]; }
		}

		$arr = explode(',', $this->get('search_field'));
		for($i = 0 ; $i < sizeof($arr) ; $i++) {
			$key1 = $arr[$i];
			$key2 = 'sch_'.$key1;
			if(strpos($key1, '.') > -1) { $key2 = str_replace('.', '_', $key2); }
		
			$val = $this->get($key2);
			if(!$val && $_POST[$key2]) { $val = $_POST[$key2]; }
			if(!$val && $_GET[$key2]) { $val = $_GET[$key2]; }
			if(!$val && $query_arr[$key2]) { $val = $query_arr[$key2]; }

			if($val) { 
				if(is_array($val)) {
					if(sizeof($val) == 1 && $val[0] == '') {
						unset($_GET[$key2]);
						unset($_POST[$key2]);
					}
					else {
						$db_where .= " and (";
						for($j = 0 ; $j < sizeof($val) ; $j++) {
							if($j > 0) { $db_where .= " or "; }
							$db_where .= " $key1 = '".$val[$j]."' ";
						}
						$db_where .= ")";
					}
				}
				else {
					$db_where .= "and $key1 = '$val' "; 
				}
			}
		}

		// 키워드 검색
		$sch_type = $this->get('sch_type');
		if(!$sch_type && $_POST['sch_type']) { $sch_type = $_POST['sch_type']; }
		if(!$sch_type && $_GET['sch_type']) { $sch_type = $_GET['sch_type']; }		
		if(!$sch_type && $query_arr['sch_type']) { $sch_type = $query_arr['sch_type']; }
		$this->set('sch_type', $sch_type);

		$sch_keyword = $this->get('sch_keyword');
		if(!$sch_keyword && $_POST['sch_keyword']) { $sch_keyword = $_POST['sch_keyword']; }
		if(!$sch_keyword && $_GET['sch_keyword']) { $sch_keyword = $_GET['sch_keyword']; }
		if(!$sch_keyword && $query_arr['sch_keyword']) { $sch_keyword = $query_arr['sch_keyword']; }		
		$this->set('sch_keyword', $sch_keyword);

		if($sch_type && $sch_keyword) {
			$sch_type_arr = $this->get('sch_type_arr');
			if($sch_type == 'all') {				
				unset($like_arr);
				foreach($sch_type_arr as $key => $val) {
					$like_arr[] =" $key like '%$sch_keyword%' ";
				}
				$db_where .= " and ( ".implode('or', $like_arr)." ) ";
			} else if(strpos($sch_type, ',') > -1) {
				$sch_column_arr = explode(',', $sch_type);
				unset($like_arr);
				foreach($sch_column_arr as $key) {

					if(in_array($key, $sch_type_arr)) {
						$like_arr[] =" $key like '%$sch_keyword%' ";
					}
				}

				if(count($like_arr) > 0) {
					$db_where .= " and ( ".implode('or', $like_arr)." ) ";
				}
			}			
			else {
				// in_array에서 고객관리 -> 고객목록에서 검색이 되지 않는 문제로 키를 검색하는 것으로 변경
				if(array_key_exists($sch_type, $sch_type_arr)) {

					$db_where .= "and $sch_type like '%$sch_keyword%' ";
				}
			}
		}

		// 기간 검색
		$sch_date_type = $this->get('sch_date_type');		
		if(!$sch_date_type && $_POST['sch_date_type']) { $sch_date_type = $_POST['sch_date_type']; }
		if(!$sch_date_type && $_GET['sch_date_type']) { $sch_date_type = $_GET['sch_date_type']; }		
		if(!$sch_date_type && $query_arr['sch_date_type']) { $sch_date_type = $query_arr['sch_date_type']; }
		$this->set('sch_date_type', $sch_date_type);

		$sch_s_date = $this->get('sch_s_date');
		if(!$sch_s_date && $_POST['sch_s_date']) { $sch_s_date = $_POST['sch_s_date']; }
		if(!$sch_s_date && $_GET['sch_s_date']) { $sch_s_date = $_GET['sch_s_date']; }
		if(!$sch_s_date && $query_arr['sch_s_date']) { $sch_s_date = $query_arr['sch_s_date']; }
		$this->set('sch_s_date', $sch_s_date);

		$sch_e_date = $this->get('sch_e_date');
		if(!$sch_e_date && $_POST['sch_e_date']) { $sch_e_date = $_POST['sch_e_date']; }
		if(!$sch_e_date && $_GET['sch_e_date']) { $sch_e_date = $_GET['sch_e_date']; }
		if(!$sch_e_date && $query_arr['sch_e_date']) { $sch_e_date = $query_arr['sch_e_date']; }
		$this->set('sch_e_date', $sch_e_date);
		
		if($sch_date_type) {
			if($sch_s_date && $sch_s_date != '0000-00-00') {
				$db_where .= "and $sch_date_type >= '$sch_s_date 00:00:00' ";
			}

			if($sch_e_date && $sch_e_date != '0000-00-00') {
				$db_where .= "and $sch_date_type <= '$sch_e_date 23:59:59' ";
			}
		}		

		return $db_where;
	}

	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();		
		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* list */	
	protected function countTotal() {

		$select_table = $this->get('select_table');
		$select_field = $this->get('select_field');
		$db_where = $this->get('db_where');
		$group_field = $this->get('group_field');
		$db_having = $this->get('db_having');

		$total_cnt = dbCount($select_table, $db_where, $group_field, $db_having);

		return $total_cnt;
	}

	public function selectList() {
		$this->initSelect();

		$select_table = $this->get('select_table');
		$select_field = $this->get('select_field');

		$db_where = $this->makeDbWhere();
		$group_field = $this->get('group_field');

		// having
		$this->initDbHaving();
		$db_having = $this->getDbHaving();

		$total_cnt = $this->countTotal();				
		$this->set('total_cnt', $total_cnt);
			
		$limit = "limit ";
		$limit.= ($this->get('page') - 1) * $this->get('cnt_rows');
		$limit.= ", ".$this->get('cnt_rows');

		$ord_field = $this->getOrderField();
		$ord_direct = $this->get('order_direct');

		$db_order = "order by $ord_field $ord_direct";
		if($group_field) { $db_order = " group by $group_field $db_having ".$db_order; }

		$flag_log = false;

		$list = dbSelect($select_table, $select_field, $db_where, $db_order, $limit, $flag_log);
		return $this->convertList($list);
	}	

	protected function convertList($list) {

		// 검색결과 반영
		$keyword_class = $this->get('keyword_class');
		$keyword_element = $this->get('keyword_element');
		if(!$keyword_element) { $keyword_element = 'strong'; }
				
		$sch_type = $this->get('sch_type');
		$sch_keyword = $this->get('sch_keyword');
		if($sch_type && $sch_keyword) {
			unset($sch_key_arr);
			if($sch_type == 'all') {
				$sch_type_arr = $this->get('sch_type_arr');
				foreach($sch_type_arr as $key => $val) {
					$sch_key_arr[] = $key;
				}
			}			
			else if(strpos($sch_type, ',') > -1) {
				$sch_type_arr = explode(',', $sch_type);
				foreach($sch_type_arr as $key) {
					$sch_key_arr[] = $key;
				}
			}
			else {
				$sch_key_arr[] = $sch_type;
			}
		}

		for($i = 0 ; $i < sizeof($list) ; $i++) {
			// 기본 변환
			$list[$i] = $this->convertDetail($list[$i]);

			// 번호
			$list[$i]['no'] = number_format($this->get('total_cnt') - ($this->get('page') - 1) * $this->get('cnt_rows') - $i);
			$list[$i]['odd'] = $i % 2;

			// 검색결과			
			if($sch_type && $sch_keyword) {

				for($j = 0 ; $j < sizeof($sch_key_arr) ; $j++) {
					$sch_key = $sch_key_arr[$j];

					$new_str = '<'.$keyword_element;
					if($keyword_class) { $new_str .= ' class="'.$keyword_class.'"';	}
					$new_str .= '>'.$sch_keyword.'</'.$keyword_element.'>';
					$list[$i]['kwd_'.$sch_key] = str_replace($sch_keyword, $new_str, $list[$i][$sch_key]);

				}
			}			
		}

		return $list;
	}

	/* pagination */
	public function getPageArray() {
		$cnt_total = $this->get('total_cnt');
		$cnt_rows = $this->get('cnt_rows');
		$cnt_page = $this->get('cnt_page');
		$page = $this->get('page');

		$total_page = ceil($cnt_total / $cnt_rows);
		$total_group = ceil($total_page / $cnt_page);
		$now_group = ceil($page / $cnt_page);

		// 처음&이전
		if($now_group > 1) {
			$page_arr[] = array(					
				'page'	=> 1,
				'title'	=> '처음',
				'class'	=> 'arrow begin'
			);

			$page_arr[] = array(					
				'page'	=> ($now_group - 2) * $cnt_page + 1,
				'title'	=> '이전',
				'class'	=> 'arrow prev'
			);
		}

		// 반복
		$tmp_page = ($now_group - 1) * $cnt_page;
		for($i = 0 ; $i < $cnt_page ; $i++) {
			$tmp_page++;
			if($tmp_page > $total_page) { break; }

			$page_arr[] = array(
				'page'	=> $tmp_page,
				'title'	=> number_format($tmp_page),
				'class'	=> ($tmp_page == $page) ? 'on' : ''
			);
		}
		
		// 다음&끝
		if($now_group < $total_group) {
			$page_arr[] = array(
				'page'	=> $now_group * $cnt_page + 1,
				'title' => '다음',
				'class'	=> 'arrow next',
			);

			$page_arr[] = array(
				'page'	=> $total_page,
				'title'	=> '끝',
				'class'	=> 'arrow end'
			);
		}
	
		return $page_arr;
	}

	/* delete */
	protected function initDelete() {

	}

	public function deleteData() {

		$module = $this->get('module');
		$uid = $this->get('uid');

		$this->initDelete();
		$del_uid = $_POST['del_uid'];
		if($uid) { $del_uid[] = $uid; }

		for($i = 0 ; $i < sizeof($del_uid) ; $i++) {
			$uid = $del_uid[$i];
		
			// 권한 체크
			if(!$this->checkDeleteAuth($uid)) { alert('권한이 없습니다.'); }

			$this->dbDelete($uid);

			// 첨부파일 삭제
			if($this->get('max_file')) {
				dbDelete($this->get('file_table'), "where pr_module = '$module' and pr_uid = '$uid'");
				deleteAll(_UPLOAD_PATH_.'/'.$module.'/'.substr($uid, 0, 1).'/'.$uid);
			}
		}

		if(sizeof($del_uid) > 0) {
			$this->result['code'] = 'delete_ok';
			$this->postDelete();			
		}
		
		return $this->result;
	}	

	protected function dbDelete($uid) {
		$pk = $this->get('pk');
		dbDelete($this->get('data_table'), "where $pk = '$uid'");
	}

	protected function postDelete() {		
		$this->initSelect();
		$page = $this->get('page');
		$query_string = $this->get('query_string');
		if($query_string) { $query_string = '&'.$query_string; }

		$db_where = $this->makeDbWhere();

		$limit = "limit ";
		$limit.= ($page - 1) * $this->get('cnt_rows');
		$limit.= ", ".$this->get('cnt_rows');

		$ord_field = $this->getOrderField();		
		$list = dbSelect($this->get('select_table'), $this->get('select_field'), $db_where, "order by $ord_field desc", $limit);
	
		if(sizeof($list) == 0 && $page > 1) { $page--; }

		$this->result['url'] = './list.html?page='.$page.$query_string;
	}

	/* get file list */
	public function getFileList($uid, $module = '') {		
		if(!$module) { $module = $this->get('module'); }

		$file_pk = $this->get('file_pk');
		$list = dbSelect($this->get('file_table'), "*", "where pr_module = '$module' and pr_uid = '$uid'", "order by $file_pk asc", "");
		$unit_arr = explode(',', ',K,M,G,T,P');

		for($i = 0 ; $i < sizeof($list) ; $i++) {
			// file size
			$size = $list[$i]['file_size'];
			$seq = 0;
			while($size >= 1024) {
				if($seq > sizeof($unit_arr)) { break; }
				$size = round($size * 10 / 1024) / 10;
				$seq++;
			}
			$list[$i]['size'] = $size.$unit_arr[$seq].'B';

			// 다운로드수
			$list[$i]['down'] = number_format($list[$i]['file_download']);

			// 다운로드 링크
			$list[$i]['btn_download'] = '<a href="./download.html?file_id='.$list[$i]['file_id'].'" class="sButton tiny" target="_blank" title="다운로드">다운로드</a>';
		}

		return $list;
	}

	/* upload */
	protected function getUploadDirectory($module, $pr_uid) {
		$dir_path = _UPLOAD_PATH_.'/'.$module.'/'.substr($pr_uid, 0, 1).'/'.$pr_uid;
		makeDirectory($dir_path);

		return $dir_path;
	}

	protected function getSaveName() {
		$save_name = dbPassword(time().substr(microtime(), 2, 6));

		return $save_name;
	}

	protected function uploadFiles($pr_uid) {
		global $member;	
		$module = $this->get('module');

		//$wr_id = getSessionValue('ss_mb_id');
		$reg_id = $member['mb_id'];
		$reg_time = date("Y-m-d H:i:s");

		// 디렉토리		
		$dir_path = $this->getUploadDirectory($module, $pr_uid);		
		
		$up_files = $_FILES['wr_file'];
		$file_type = $_POST['file_type'];

		$max_file = $this->get('max_file');

		for($i = 0 ; $i < $max_file ; $i++) {
			if(!$up_files['tmp_name'][$i]) { continue; }
			unset($up_file);
			$up_file['tmp_name'] = $up_files['tmp_name'][$i];
			$up_file['name'] = $up_files['name'][$i];
			$up_file['type'] = $up_files['type'][$i];			
			$up_file['size'] = $up_files['size'][$i];
			$up_file['error'] = $up_files['error'][$i];

			$save_name = $this->getSaveName();
			$save_file = $this->uploadFile($up_file, $dir_path, $save_name);
			if($save_file) {
				$file_path = $save_file['file_path'];
				$file_name = $up_file['name'];

				$file_arr = array(
					'pr_module'	=> $module,
					'pr_uid'	=> $pr_uid,
					'file_type'	=> $file_type[$i],
					'file_path'	=> $file_path,
					'file_name'	=> $file_name,
					'file_size'	=> $up_file['size'],
					'file_hit'	=> 0,
					'reg_id'	=> $reg_id,
					'reg_time'	=> $reg_time
				);

				dbInsertByArray($this->get('file_table'), $file_arr);
			}
		}
	}

	protected function uploadFile($up_file, $dir_path, $save_name = '', $flag_rewrite = false) {
		if(is_uploaded_file($up_file['tmp_name'])) {
			$file_ext = strtolower(substr(strrchr($up_file['name'], '.'), 1));
			if(strpos($this->get('no_upload_file'), $file_ext) > -1) { return false; }
			makeDirectory($dir_path);

			if(!$save_name) { $save_name = substr($up_file['name'], 0, strrpos($up_file['name'], '.')); }

			$file_name = $save_name.'.'.$file_ext;
			$file_path = $dir_path.'/'.$file_name;

			if(!$flag_rewrite) {
				$seq = 1;
				while(true) {				
					if(file_exists($file_path)) {
						$file_name = $save_name.'_'.$seq.'.'.$file_ext;
						$file_path = $dir_path.'/'.$file_name;
						$seq++;
					}
					else { break; }
				}
			}

			move_uploaded_file($up_file['tmp_name'], $file_path);
			chmod($file_path, 0707);

			$save_file = array(
				'file_path'	=> $file_path,
				'file_name'	=> $file_name
			);

			return $save_file;
		}
		return true;
	}

	/* copy */
	public function copyFile($uid, $pr_uid, $pr_module = '') {
		global $member;

		$data = dbOnce($this->get('file_table'), "*", "where uid = '$uid'", "");
		$file_path = $data['file_path'];

		if(file_exists($file_path)) {
			if(!$pr_module) { $pr_module = $data['pr_module']; }

			$dir_path = _UPLOAD_PATH_.'/'.$pr_module.'/'.$pr_uid;
			makeDirectory($dir_path);
			
			$file_ext = strtolower(substr(strrchr($file_path, '.'), 1));
			$save_name = dbPassword(time().substr(microtime(), 2, 6));
			$new_path = $dir_path.'/'.$save_name.'.'.$file_ext;

			@copy($file_path, $new_path);
			@chmod($new_path, 0707);

			$arr = array(
				'pr_module'	=> $pr_module,
				'pr_uid'	=> $pr_uid,
				'file_path'	=> $new_path,
				'file_name'	=> $data['file_name'],
				'file_size'	=> $data['file_size'],
				'reg_id'		=> $member['mb_id'],
				'reg_time'	=> date('Y-m-d H:i:s')
			);

			dbInsertByArray($this->get('file_table'), $arr);
		}

		return $new_path;
	}

	/* make thumbnail */
	protected function getThumbnail($data, $thumb_width, $thumb_height) {

		$is_crop = $this->get('is_crop');

		$file_list = $data['file_list'];		
		for($i = 0 ; $i < sizeof($file_list) ; $i++) {
			// 파일 존재 & 확장자 검사
			$source_file = $file_list[$i]['file_path'];
			$file_ext = strtolower(substr(strrchr($file_list[$i]['file_name'], '.'), 1));
			if(file_exists($source_file) && strpos('jpg,jpeg,gif,png', $file_ext) > -1) {

				// 썸네일 경로
				$slush_idx = strrpos($source_file, '/');
				$point_idx = strrpos($source_file, '.');
				$source_name = trim(substr($source_file, $slush_idx + 1, $point_idx - $slush_idx - 1));
				$point_ext = trim(substr($source_file, $point_idx, strlen($source_file) - $point_idx));
				$thumb_path = str_replace($source_name.$point_ext, $source_name.'_thumb_'.$thumb_width.'x'.$thumb_height.$point_ext, $source_file);

				// 썸네일 존재 검사
				if(!file_exists($thumb_path)) {
					$thumb_name = makeThumbnail($source_file, $thumb_path, $thumb_width, $thumb_height, 1, $is_crop);	
				}

				$thumb = str_replace(_UPLOAD_PATH_, _UPLOAD_URI_, $thumb_path);	
				break;
			}
		}

		// 썸네일이 없을 경우 원본
		if(!$thumb) {
			for($i = 0 ; $i < sizeof($file_list) ; $i++) {
				$source_file = $file_list[$i]['file_path'];
				$file_ext = strtolower(substr(strrchr($file_list[$i]['file_name'], '.'), 1));
				if(file_exists($source_file) && strpos('jpg,jpeg,gif,png', $file_ext) > -1) {
					$thumb = str_replace(_UPLOAD_PATH_, _UPLOAD_URI_, $file_list[$i]['file_path']);
					break;
				}
			}
		}

		// 원본도 없을 경우 노이미지
		if(!$thumb) {
			$no_image = $this->get('no_image');
			if($no_image) {
				$thumb = $no_image;
			}
		}

		return $thumb;
	}

	protected function getThumbnailFromFile($f_data) {

		$thumb_width = $this->get('thumb_width');
		$thumb_height = $this->get('thumb_height');
	
		// 파일 존재 & 확장자 검사
		$source_file = $f_data['file_path'];
		$file_ext = strtolower(substr(strrchr($f_data['file_name'], '.'), 1));
		if(file_exists($source_file) && strpos('jpg,jpeg,gif,png', $file_ext) > -1) {

			// 썸네일 경로
			$slush_idx = strrpos($source_file, '/');
			$point_idx = strrpos($source_file, '.');
			$source_name = trim(substr($source_file, $slush_idx + 1, $point_idx - $slush_idx - 1));
			$point_ext = trim(substr($source_file, $point_idx, strlen($source_file) - $point_idx));
			$thumb_path = str_replace($source_name.$point_ext, $source_name.'_thumb_'.$thumb_width.'x'.$thumb_height.$point_ext, $source_file);

			// 썸네일 존재 검사
			if(!file_exists($thumb_path)) {
				$thumb_name = makeThumbnail($source_file, $thumb_path, $thumb_width, $thumb_height, 1, 1);	
			}

			$thumb = str_replace(_UPLOAD_PATH_, _UPLOAD_URI_, $thumb_path);	
			// 썸네일이 없을 경우 원본
			if(!$thumb) {
				$thumb = str_replace(_UPLOAD_PATH_, _UPLOAD_URI_, $f_data['file_path']);
			}
		}

		// 원본도 없을 경우 노이미지
		if(!$thumb) {
			$no_image = $this->get('no_image');
			if($no_image) {
				$thumb = $no_image;
			}
		}

		return $thumb;
	}

	/* delete file */
	protected function deleteFile($file_uid) {
		$file_pk = $this->get('file_pk');

		// 원본파일 삭제
		$data = dbOnce($this->get('file_table'), "file_path", "where $file_pk = '$file_uid'", "");
		$file_path = $data['file_path'];
		@unlink($file_path);

		// 썸네일 삭제		
		$slush_idx = strrpos($file_path, '/');
		$point_idx = strrpos($file_path, '.');
		$source_name = trim(substr($file_path, $slush_idx + 1, $point_idx - $slush_idx - 1));
		$point_ext = trim(substr($file_path, $point_idx, strlen($source_file) - $point_idx));

		$thumb_list = glob(trim(substr($file_path, 0, $point_idx)).'_thumb_*');
		if(is_array($thumb_list)) {
			foreach($thumb_list as $thumb_path) {
				unlink($thumb_path);
			}
		}

		dbDelete($this->get('file_table'), "where $file_pk = '$file_uid'");
	}

	/* download file */
	public function downloadFile($file_uid) {
		$file_pk = $this->get('file_pk');

		// 다운로드 수 증가
		dbUpdate($this->get('file_table'), "file_download = file_download + 1", "where $file_pk = '$file_uid'");

		// file info
		$data = dbOnce($this->get('file_table'), "file_path, file_name, file_size", "where $file_pk = '$file_uid'", "");

		$file_path = $data['file_path'];
		$file_name = urlencode($data['file_name']);

		if(!is_file($file_path) || !file_exists($file_path)) {
			printError('파일이 존재하지 않습니다.');
			exit;
		}

		// download
		if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
			header("content-type: doesn/matter");
			header("content-length: ".filesize("$file_path"));
			header("content-disposition: attachment; filename=\"$file_name\"");
			header("content-transfer-encoding: binary");
		} 
		else {
			header("content-type: file/unknown");
			header("content-length: ".filesize("$file_path"));
			header("content-disposition: attachment; filename=\"$file_name\"");
			header("content-description: php generated data");
		}
		header("pragma: no-cache");
		header("expires: 0");
		flush();

		$fp = fopen($file_path, 'rb');

		$download_rate = 10;

		while(!feof($fp)) {
			print fread($fp, round($download_rate * 1024));
			flush();
			usleep(1000);
		}

		fclose ($fp);
		flush();
	}
}
?>