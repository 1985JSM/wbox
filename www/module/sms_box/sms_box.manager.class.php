<?
if(!defined('_INPLUS_')) { exit; }

include_once(_MODULE_PATH_.'/sms_box/sms_box.class.php');

class SmsBoxManager extends SmsBox
{
	function __construct($sh_code)
	{
		parent::__construct($sh_code);
		$this->set('cnt_rows', 11);
	}

	protected function initInsert()
	{
		$this->set('insert_field', 'sh_code');
		$this->set('required_field', 'sh_code');
		$this->set('return_url', './list.html');
	}

	protected function postInsert($arr)
	{
		$arr = parent::postInsert($arr);
		$pk = $this->get('pk');
		$this->result[$pk] = $arr[$pk];
		return $arr;
	}

	protected function initUpdate()	{
		$pk = $this->get('pk');
		$this->set('update_field', $pk.',sms_box_contents');
		$this->set('required_field', $pk.',sms_box_contents');
		$this->set('return_url', './list.html');
	}
	function initSelect()
	{
		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', '*');
	}

	function makeDbWhere()
	{
		$result = parent::makeDbWhere();
		$result .= " AND sh_code='{$this->get('sh_code')}'";
		$this->set('db_where', $result);
		return $result;
	}

	function checkDeleteAuth($uid)
	{
		global $is_admin, $member;
		$pk = $this->get('pk');
		// 관리자인지
		if($is_admin) {
			return true;
		}

		// sh_code가 같은지 확인
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk='$uid'", "");
		if($member['sh_code'] == $data['sh_code']) {
			return true;
		}

		return false;
	}
}
?>