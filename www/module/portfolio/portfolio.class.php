<?
if(!defined('_INPLUS_')) { exit; } 

Class Portfolio extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'portfolio');
		$this->set('module_name',	'포트폴리오');		

		// context
		$this->set('data_table', 'tbl_portfolio');
		$this->set('pk', 'pf_id');

		$this->set('like_table', 'tbl_portfolio_like');
		$this->set('like_pk', 'pf_lk_id');

		$this->set('comment_table', 'tbl_portfolio_comment');
		$this->set('comment_pk',	'cm_id');


		$this->set('search_field', 'a.sh_code,a.st_id');
		$this->set('sch_type_arr', array(
			'b.sh_sido'		=> '지역',
			'a.pf_name'		=> '담당자',
			'a.pf_subject'	=> '제목',
			'a.pf_tags'		=> '태그'
		));

		// order_field_arr
		$this->set('order_field_arr', array(
			'a.pf_id'		=> '최신순',
			'cnt_like'		=> '좋아요순',
			'cnt_comment'	=> '댓글순'
		));

		$this->set('max_file', 5);
		//$this->set('cnt_rows', 5);

		// shop
		include_once(_MODULE_PATH_.'/shop/shop.class.php');
		$oShop = new Shop();
		$oShop->init();		
		$this->set('shop_table', $oShop->get('data_table'));
		$this->set('sh_pk', $oShop->get('pk'));
	
		/**
		* code array
		*/
		$this->set('cm_type_arr', array(
			'U'	=> '사용자',
			'S'	=> '담당자',
			'M'	=> '관리자'
		));


		parent::init();
	}	

	/* insert */
	protected function initInsert()	{
		$pk = $this->get('pk');
		$this->set('insert_field', $pk.',sh_code,st_id,pf_subject,pf_content,pf_name,pf_tags');
		$this->set('required_field', $pk.',sh_code,st_id,pf_subject,pf_content,pf_name');		
		$this->set('return_url', './list.html');
	}
	
	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',sh_code,st_id,pf_subject,pf_content,pf_name,pf_tags');
		$this->set('required_field', $pk.',sh_code,st_id,pf_subject,pf_content,pf_name');		
		$this->set('return_url', './write.html');
	}

	/* search */
	protected function makeDbWhere() {

		$db_where = parent::makeDbWhere();		

		$sch_type = ($_POST['sch_type']) ? $_POST['sch_type'] : $_GET['sch_type'];
		$sch_keyword = ($_POST['sch_keyword']) ? $_POST['sch_keyword'] : $_GET['sch_keyword'];
		if($sch_type == 'b.sh_sido') {
			$db_where .= " or b.sh_sigungu like '%".$sch_keyword."%' or b.sh_dong like '%".$sch_keyword."%' ";
		}

		$this->set('db_where', $db_where);

		return $db_where;		

	}

	/* list */
	/*
	protected function getOrderField() {	

		$order_field = "cnt_like desc, cnt_comment desc, a.reg_time";

		return $order_field;
	}
	*/

	protected function initSelect()	{

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$shop_table = $this->get('shop_table');
		$sh_pk = $this->get('sh_pk');

		$like_table = $this->get('like_table');
		$like_pk = $this->get('like_pk');

		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');

		$select_table = "$data_table a ";
		$select_table.= "left outer join $shop_table b on a.$sh_pk = b.$sh_pk ";
		
		$select_field = "a.*";
		$select_field.= ", b.sh_name ";
		$select_field.= ", (select count($like_pk) from $like_table where a.$pk = $pk) as cnt_like ";
		$select_field.= ", (select count($comment_pk) from $comment_table where a.$pk = $pk) as cnt_comment ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);	

		// 태그
		$pf_tag_arr = explode(',', $data['pf_tags']);
		for($i = 0 ; $i < sizeof($pf_tag_arr) ; $i++) {
			$pf_tag_arr[$i] = trim($pf_tag_arr[$i]);
		}
		$data['pf_tag_arr'] = $pf_tag_arr;
		$data['pf_main_tag'] = $pf_tag_arr[0];
		
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
				$sub_img[$sub_seq] = $file_list[$i];
				$sub_img[$sub_seq]['thumb'] = $this->getThumbnailFromFile($sub_img[$sub_seq]);

				$sub_seq += 1;
			}
		}
		$data['main_img'] = $main_img;
		$data['sub_img'] = $sub_img;

		return $data;
	}	

	/* delete */
	protected function dbDelete($uid) {

		$pk = $this->get('pk');
		$comment_table = $this->get('comment_table');

		dbDelete($comment_table, "where $pk = '$uid'");

		parent::dbDelete($uid);
	}

	/* comment */
	public function insertComment() {

		$uid = $this->get('uid');

		$comment_table = $this->get('comment_table');

		$arr = $this->getInsertCommentArray();

		dbInsertByArray($comment_table, $arr);

		$this->result['code'] = 'ok';
		$this->result['cnt_comment'] = $this->selectCountComment($uid);

		return $this->result;
	}

	protected function getInsertCommentArray() {

		$pk = $this->get('pk');
		$uid = $this->get('uid');

		$arr = array(
			'sh_code'		=> $_POST['sh_code'],
			$pk				=> $uid,
			'cm_content'	=> $_POST['cm_content'],
		);

		$arr = parent::convertInsert($arr);

		return $arr;
	}

	public function replyComment() {

		$pk = $this->get('pk');
		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');

		$cm_id = ($_POST[$comment_pk]) ? $_POST[$comment_pk] : $_GET[$comment_pk];
		if($this->checkAuthComment($cm_id)) {

			$arr = $this->getReplyCommentArray();			
			dbUpdateByArray($comment_table, $arr, "where $comment_pk = '$cm_id'");
		}

		$this->result['code'] = 'ok';
		$this->result['cnt_comment'] = $this->selectCountComment($uid);

		return $this->result;
	}	

	protected function getReplyCommentArray() {

		$arr = array(
			're_id'			=> $_POST['re_id'],
			're_name'		=> $_POST['re_name'],
			're_content'	=> $_POST['re_content'],
			're_time'		=> date('Y-m-d H:i:s')
		);

		return $arr;
	}

	public function selectCommentList($uid, $page, $cnt_rows = 10) {

		$pk = $this->get('pk');
		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');

		$db_limit = "limit ";
		$db_limit.= ($page - 1) * 10;
		$db_limit.= ", ".$cnt_rows;

		$list = dbSelect($comment_table, "*", "where $pk = '$uid'", "order by $comment_pk desc", $db_limit, 0);

		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$list[$i] = $this->convertComment($list[$i]);			
		}

		return $list;
	}

	public function selectCommentDetail($cm_id) {

		$pk = $this->get('pk');
		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');

		$data = dbOnce($comment_table, "*", "where $comment_pk = '$cm_id'", "");
		$data = $this->convertComment($data);

		return $data;
	}

	protected function convertComment($data) {

		// 등록일시
		$data['reg_date'] = str_replace('-', '.', substr($data['reg_time'], 0, 10));
		$data['upt_date'] = str_replace('-', '.', substr($data['upt_time'], 0, 10));
		$data['re_date'] = str_replace('-', '.', substr($data['re_time'], 0, 10));

		if($data['reg_date'] == '0000.00.00') { $data['reg_date'] = '-'; }
		if($data['upt_date'] == '0000.00.00') { $data['upt_date'] = '-'; }
		if($data['re_date'] == '0000.00.00') { $data['re_date'] = '-'; }

		// 사용자 프로필 사진
		if($data['cm_type'] == 'U') {
			$profile_img = dbOnce("tbl_file", "*", "where pr_module = 'user' and pr_uid = '".$data['reg_id']."'", "order by file_id desc");
			$profile_img['thumb'] = $this->getThumbnailFromFile($profile_img);
		}	

		if(!$profile_img['thumb']) {
			$profile_img['thumb'] = '/img/mobile/common/s_logo2.png';
		}
		$data['profile_img'] = $profile_img;

		return $data;
	}

	public function selectCountComment($uid) {
		$pk = $this->get('pk');
		$comment_table = $this->get('comment_table');

		$cnt = dbCount($comment_table, "where $pk = '$uid'");

		return $cnt;
	}

	public function deleteComment() {		

		$pk = $this->get('pk');
		$uid = $this->get('uid');

		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');
		$cm_id = ($_POST[$comment_pk]) ? $_POST[$comment_pk] : $_GET[$comment_pk];

		if($this->checkAuthComment($cm_id)) {
			dbDelete($comment_table, "where $comment_pk = '$cm_id'");
		}

		$this->result['code'] = 'ok';
		$this->result['cnt_comment'] = $this->selectCountComment($uid);

		return $this->result;
	}

	public function deleteReply() {		

		$pk = $this->get('pk');
		$uid = $this->get('uid');

		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');
		$cm_id = ($_POST[$comment_pk]) ? $_POST[$comment_pk] : $_GET[$comment_pk];

		if($this->checkAuthComment($cm_id)) {
			$arr = array(
				're_id'			=> '',				
				're_name'		=> '',
				're_content'	=> '',
				're_time'		=> ''

			);
			dbUpdateByArray($comment_table, $arr, "where $comment_pk = '$cm_id'");
		}

		$this->result['code'] = 'ok';
		$this->result['cnt_comment'] = $this->selectCountComment($uid);

		return $this->result;
	}

}
?>