<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/portfolio/portfolio.class.php');

Class PortfolioStaff extends Portfolio
{	
	/* init */
	public function init() {

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 320);
		$this->set('thumb_height', 190);
		$this->set('file_table', 'tbl_file');

		parent::init();
	}	

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);
		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];
		$arr['st_id'] = $member['mb_id'];
		//$arr['pf_name'] = $member['txt_staff'];
		$arr['pf_name'] = $member['mb_nick'];

		return $arr;
	}

	protected function postInsert($arr) {


		$arr = parent::postInsert($arr);

		$pk = $this->get('pk');
		$uid = $arr[$pk];
		$this->result[$pk] = $uid;

		$this->uploadPhoto($uid);
		
		return $arr;
	}

	/* update */
	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];
		$arr['st_id'] = $member['mb_id'];
		//$arr['pf_name'] = $member['txt_staff'];
		$arr['pf_name'] = $member['mb_nick'];

		return $arr;
	}	

	protected function postUpdate($arr) {

		$arr = parent::postUpdate($arr);

		$pk = $this->get('pk');
		$uid = $arr[$pk];
		$this->result[$pk] = $uid;

		$this->uploadPhoto($uid);

		return $arr;
	}

	/* auth */
	protected function checkReadAuth($uid) {

		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "st_id", "where $pk = '$uid'", "");		
		if($member['mb_id'] == $data['st_id']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "st_id", "where $pk = '$uid'", "");		
		if($member['mb_id'] == $data['st_id']) { return true; }

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();

		global $member;
		$st_id = $member['mb_id'];
		$db_where.= " and st_id = '$st_id' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/* upload from app */
	public function uploadPhoto($uid) {

		global $member;

		$pk = $this->get('pk');

		// DB 정보 세팅
		$file_table = $this->get('file_table');
		$module = 'portfolio';

		// 저장 경로
		$dir_path = $this->getUploadDirectory($module, $uid);
		if($_POST['file_id']){
			$file_id = $_POST['file_id'];

			if(sizeof($file_id)>0){
				$file_num = implode($file_id,"','");
				$del_file_list = dbSelect("tbl_file","file_id","where file_id not in ('$file_num') and pr_uid = '$uid' and pr_module = '$module' ","","");
				for($i = 0 ; $i < count($del_file_list) ; $i++) {
					$this->deleteFile($del_file_list[$i]['file_id']);
				}	
			}		
		}

		/*
		if ($_SERVER['REMOTE_ADDR'] == '58.149.89.146') {
			print_r($_FILES);
			$dir_path = $this->getUploadDirectory($module, $uid);

			//$target_dir = "uploads/";
			echo '<br /> dir_path : ' . $dir_path . '<br />';
			$target_file = basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($dir_path . $target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $target)) {
			    	echo '<br />success<br />';
			    }
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
		} else {
		// 파일 정보 세팅
		$file_type_arr = $_POST['file_type'];
		$file_name_arr = $_POST['file_name'];
		$file_content_arr = $_POST['file_content'];

		

		for($i = 0; $i < sizeof($file_name_arr) ; $i++) {
			$file_type = $file_type_arr[$i];
			$file_name = $file_name_arr[$i];
			$file_content = $file_content_arr[$i];
			$content = $file_content;
			$file_content = base64_decode($file_content);

			if($file_name && $file_content) {

				// 파일 저장
				
				$file_path = $dir_path.'/'.$file_name;
				file_put_contents($file_path, $file_content);
				$file_size = filesize($file_path);

				// 파일 정보 DB 등록
				$file_arr = array(
					'pr_module'	=> $module,
					'pr_uid'	=> $uid,
					'file_type'	=> $file_type,
					'file_path'	=> $file_path,
					'file_name'	=> $file_name,
					'file_size'	=> $file_size,
					'file_hit'	=> 0,
					'reg_id'	=> $member['mb_id'],
					'reg_time'	=> date('Y-m-d H:i:s')
				);
				dbInsertByArray($this->get('file_table'), $file_arr);

				
				dbInsertByArray("tbl_test", array(
					'content'	=> $content,
					'time'	=> date('Y-m-d H:i:s')
				));
				
			}

		}
		*/
		
		//}
		
	}

	/* comment */
	protected function getInsertCommentArray() {

		$arr = parent::getInsertCommentArray();

		global $member;

		$arr['cm_type'] = 'S';
		$arr['cm_name'] = $_POST['cm_name'];

		return $arr;
	}

	protected function convertComment($data) {

		$data = parent::convertComment($data);

		// 사용자 권한
		global $member;
		if($member['sh_code'] == $data['sh_code']) {
			$data['flag_delete'] = true;
			$data['flag_reply'] = true;
			$data['flag_delete_reply'] = true;
		}

		return $data;
	}

	protected function checkAuthComment($cm_id) {

		$comment_table = $this->get('comment_table');
		$comment_pk = $this->get('comment_pk');

		global $member;

		$data = dbOnce($comment_table, "*", "where $comment_pk = '$cm_id'", "");
		if($data['sh_code'] == $member['sh_code']) {
			return true;
		}

		return false;
	}

	protected function getReplyCommentArray() {

		global $member;

		$arr = array(
			're_id'			=> $member['mb_id'],
			//'re_name'		=> $member['txt_staff'],
			're_name'		=> $member['mb_nick'],
			're_content'	=> $_POST['re_content'],
			're_time'		=> date('Y-m-d H:i:s')
		);

		return $arr;
	}

	public function uploadFileFromApp() {
		global $oUser;

		if(!isset($oUser)) {
			include_once(_MODULE_PATH_.'/user/user.class.php');
			$oUser = new User();
			$oUser->init();
		}

		$uid = $_POST['uid'];
		$result = $this->uploadFiles($uid);

		return $result;
	}

	protected function uploadFiles($pr_uid) {
		parent::uploadFiles($pr_uid);
		$file_pk = $this->get('file_pk');
		$module = $this->get('module');
		$ord_field = 'reg_time';
		if($module){
			$db_where = " where pr_uid = '$pr_uid' and pr_module = '$module' ";
		}

		$data = dbOnce($this->get('file_table'), "file_id", $db_where, "order by $ord_field desc");		
		if($data){
			$result['code'] = 'success';
			$result['uid'] = $data[$file_pk];	
		}
		
		return $result;		
	}
}
?>
