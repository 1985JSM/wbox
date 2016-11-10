<?
if(!defined('_INPLUS_')) { exit; }

Class SmsBox extends StdController
{
	function __construct($sh_code)
	{
		parent::__construct();
		$this->set('sh_code', $sh_code);

		$this->set('module', 'sms_box');
		$this->set('module_name', '메시지 보관함');
		$this->set('pk', 'sms_box_id');

		// db
		$this->set('bo_table',	'sms_box');
		$this->set('data_table', 'tbl_sms_box');

		$this->init();
		include_once(_MODULE_PATH_.'/sms/sms.class.php');
		$oSms = new Sms();
		$oSms->checkJoined(true);
	}

}
?>