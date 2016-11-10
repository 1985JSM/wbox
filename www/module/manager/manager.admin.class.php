<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/manager/manager.class.php');

Class ManagerAdmin extends Manager
{	
	/* init */
	public function init() {

		// 권한검사
		if(!checkAdminAuth('admin')) {
			alert('권한이 없습니다.', '/admin');
			exit;
		}

		parent::init();

		// shop
		include_once(_MODULE_PATH_.'/shop/shop.class.php');
		$oShop = new Shop();
		$oShop->init();
		$this->set('shop_table',	$oShop->get('data_table'));
		$this->set('shop_pk',		$oShop->get('pk'));

		// search
		$this->set('sch_type_arr', array(
			'a.mb_id'	=> '아이디',
			'a.mb_name'	=> '담당자명',
			'b.sh_name'	=> '가맹점명'
		));
	}

	/* list */
	protected function initSelect()	{

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		// shop
		$shop_table = $this->get('shop_table');
		$shop_pk = $this->get('shop_pk');

		$select_table = "$data_table a ";
		$select_table.= "left outer join $shop_table b on a.$shop_pk = b.$shop_pk ";

		$select_field = "a.* ";
		$select_field.= ", b.sh_name ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* update password */
	public function updatePassword() {
		$pk = $this->get('pk');
		$uid = $this->get('uid');

		$mb_pass = $_POST['mb_pass'];
		$mb_pass2 = $_POST['mb_pass2'];
		if(!$uid || !$mb_pass || $mb_pass != $mb_pass2) {
			$this->result['msg'] = '비정상적인 접근입니다.';
			return $this->result;
		}

		$data_table = $this->get('data_table');
		$mb_pass = dbPassword($mb_pass);
		dbUpdate($data_table, "mb_pass = '$mb_pass'", "where $pk = '$uid'");

		$this->result['code'] = 'update_ok';

		$query_string = $this->get('query_string');
		$page = $this->get('page');

		$this->result['url'] = './write.html?'.$pk.'='.$uid.'&page='.$page.$query_string;

		return $this->result;
	}
	
}
?>
