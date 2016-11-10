<?
if(!defined('_INPLUS_')) { exit; } 

Class SmsConfig extends StdController
{	
	/* init */
	public function init() {
		// module info
		$this->set('module',		'sms_config');
		$this->set('module_name',	'SMS 환경설정');

		// contenxt
		$this->set('data_table', 'tbl_sms_config');
		$this->set('search_field', 'op_type');
		$this->set('sch_type_arr', array(
			'op_subject'	=> '옵션제목'
		));

		// code array
		$this->set('cf_msg_arr', array(
			'1'		=> '휴대폰인증',	
		));
		
		parent::init();		
	}	

	/* list */
	protected function initSelect()	{
		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', '*');
	}
}
?>
