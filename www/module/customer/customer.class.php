<?
if(!defined('_INPLUS_')) { exit; } 

Class Customer extends StdController
{	
	/* init */
	public function init() {

		// module info
		$this->set('module',		'customer');
		$this->set('module_name',	'고객');		

		// context
		$this->set('data_table',	'tbl_customer');
		$this->set('pk', 'cs_id');

		$this->set('reserve_table', 'tbl_reserve');
		$this->set('rs_pk', 'rs_id');

		// search
		$this->set('search_field', 'sh_code,cs_level,st_id,flag_receive_sms');
		$this->set('sch_type_arr', array(
			'cs_name'	=> '이름',
			'cs_email'	=> '이메일',
			'cs_hp'		=> '휴대폰'
		));

		$this->set('sch_date_type_arr', array(
			'reg_time'	=> '가입일'
		));
		
		// level
		$this->set('cs_level_arr', array(
			'3'		=> '일반',
			'5'		=> '브론즈',
			'6'		=> '실버',
			'7'		=> '골드',
			'9'		=> 'VIP'
		));

		// shop
		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
		}
		$this->set('staff_table', $oStaff->get('data_table'));
		$this->set('staff_pk', $oStaff->get('pk'));		
		$this->set('st_id_arr', $oStaff->selectStaffCodeTotal());

		parent::init();
	}
	
	/* insert */
	protected function initInsert()	{
		$this->set('insert_field', 'cs_name,cs_email,cs_hp,flag_receive_sms,cs_nick,cs_area,cs_birth,cs_birth_type,cs_gender,st_id,cs_level,cs_memo');
		$this->set('required_field', 'sh_code,cs_name');		
		$this->set('return_url', './list.html');
	}

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		$arr['cs_hp'] = str_replace('-', '', $arr['cs_hp']);
		$arr['cs_hp'] = str_replace('.', '', $arr['cs_hp']);
		$arr['cs_hp'] = str_replace(' ', '', $arr['cs_hp']);

		return $arr;
	}

	/* update */
	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',cs_name,cs_email,cs_hp,flag_receive_sms,cs_nick,cs_area,cs_birth,cs_birth_type,cs_gender,st_id,cs_level,cs_memo');
		$this->set('required_field', $pk.',sh_code,cs_name');		
		$this->set('return_url', './view.html');
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		$arr['cs_hp'] = str_replace('-', '', $arr['cs_hp']);
		$arr['cs_hp'] = str_replace('.', '', $arr['cs_hp']);
		$arr['cs_hp'] = str_replace(' ', '', $arr['cs_hp']);

		return $arr;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = parent::makeDbWhere();

		return $db_where;		
	}

	/* list */
	protected function initSelect()	{

		$data_table = $this->get('data_table');
		$pk = $this->get('pk');

		$reserve_table = $this->get('reserve_table');
		$rs_pk = $this->get('rs_pk');
		
		$select_table = "$data_table a";
		$select_field = "*";


		$select_field.= ", (select count($rs_pk) from $reserve_table where cs_id = a.cs_id) as cnt_total_reserve ";
		$select_field.= ", (select count($rs_pk) from $reserve_table where cs_id = a.cs_id and rs_state = 'E') as cnt_finish_reserve ";

		$this->set('select_table', $select_table);
		$this->set('select_field', $select_field);
	}	

	/* detail */
	protected function convertDetail($data)	{		
		$data = parent::convertDetail($data);

		// 권한등급
		$arr = $this->get('cs_level_arr');
		$data['txt_cs_level'] = $arr[$data['cs_level']];

		// 지역
		global $area_arr;
		$data['txt_cs_area'] = $area_arr[$data['cs_area']];

		// 생일
		$arr = explode('-', $data['cs_birth']);
		$data['txt_cs_birth'] = $arr[0].'년 '.$arr[1].'월 '.$arr[2].'일';

		global $birth_type_arr;
		$data['txt_cs_birth_type'] = $birth_type_arr[$data['cs_birth_type']];
		$data['txt_cs_birth_type2'] = cutString($data['txt_cs_birth_type'], 1, '');

		// 성별
		global $gender_arr;
		$data['txt_cs_gender'] = $gender_arr[$data['cs_gender']];
		$data['txt_cs_gender2'] = cutString($data['txt_cs_gender'], 1, '');

		// 담당자
		$st_id_arr = $this->get('st_id_arr');
		$data['txt_st_id'] = $st_id_arr[$data['st_id']];

		return $data;
	}		
}
?>
