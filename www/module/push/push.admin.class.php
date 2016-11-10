<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/push/push.class.php');

Class PushAdmin extends Push
{	
	/* init */
	public function init() {

		// 권한검사
		if(!checkAdminAuth('admin')) {
			alert('권한이 없습니다.', '/admin');
			exit;
		}

		parent::init();
	}

	/* 환경 설정 저장 */
	public function updateConfig() {

		$config_table = $this->get('config_table');
		$ps_cf_pk = $this->get('ps_cf_pk');

		$ps_cf_code_arr = $_POST['ps_cf_code'];
		$ps_cf_content_arr = $_POST['ps_cf_content'];

		for($i = 0 ; $i < sizeof($ps_cf_code_arr) ; $i++) {
			$arr = array(
				'ps_cf_content'	=> $ps_cf_content_arr[$i],
				'upt_id'		=> $member['mb_id'],
				'upt_time'		=> date('Y-m-d H:i:s')
			);
			dbUpdateByArray($config_table, $arr, "where $ps_cf_pk = '".$ps_cf_code_arr[$i]."'");
		}

		$this->result['url'] = './config.html';
		$this->result['code'] = 'update_ok';

		return $this->result;
	}

}
?>
