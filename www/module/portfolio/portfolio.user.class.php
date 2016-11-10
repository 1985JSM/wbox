<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/portfolio/portfolio.class.php');

Class PortfolioUser extends Portfolio
{	
	/* init */
	public function init() {

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 320);
		$this->set('thumb_height', 190);

		parent::init();
	}	

	/* like */
	public function checkFlagLike($uid, $mb_id) {

		$like_table = $this->get('like_table');

		$cnt = dbCount($like_table, "where pf_id = '$uid' and reg_id = '$mb_id'");
		
		return $cnt;
	}

	public function likePortfolio($uid, $mb_id) {

		$like_table = $this->get('like_table');

		$arr = array(
			'pf_id'		=> $uid,
			'reg_id'	=> $mb_id,
			'reg_time'	=> date('Y-m-d H:i:s')
		);

		dbInsertByArray($like_table, $arr);

		$cnt_like = dbCount($like_table, "where pf_id = '$uid'");

		$this->result['code'] = 'insert_ok';
		$this->result['cnt_like'] = $cnt_like;

		return $this->result;
	}

	public function dislikePortfolio($uid, $mb_id) {

		$like_table = $this->get('like_table');

		dbDelete($like_table, "where pf_id = '$uid' and reg_id = '$mb_id'");

		$cnt_like = dbCount($like_table, "where pf_id = '$uid'");

		$this->result['code'] = 'delete_ok';
		$this->result['cnt_like'] = $cnt_like;

		return $this->result;
	}

	/* comment */
	protected function getInsertCommentArray() {

		$arr = parent::getInsertCommentArray();

		global $member;

		$arr['cm_type'] = 'U';
		$arr['cm_name'] = $member['mb_nick'];

		return $arr;
	}

	protected function convertComment($data) {

		$data = parent::convertComment($data);

		// 사용자 권한
		global $member;
		if($member['mb_id'] == $data['reg_id'] && $data['cm_type'] == 'U') {
			$data['flag_delete'] = true;
		}

		return $data;
	}

	protected function checkAuthComment($cm_id) {

		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');

		global $member;

		$data = dbOnce($comment_table, "*", "where $comment_pk = '$cm_id'", "");
		if($data['cm_type'] == 'U' && $data['reg_id'] == $member['mb_id']) {
			return true;
		}

		return false;
	}
}
?>
