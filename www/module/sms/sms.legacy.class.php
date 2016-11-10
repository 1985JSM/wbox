<?
if(!defined('_INPLUS_')) { exit; }

Class SmsLegacy extends Object
{
	/* context */
	public function __construct() {
		$this->set('url', 'http://sms.direct.co.kr/link/send.php');
		$this->set('sms_id', '042362');
		$this->set('sms_key', '22dcbceac4c29803efd1718ecff161b8');
		$this->set('referer', 'wbox.inplus21.com');

		$this->set('from_name', _HOMEPAGE_TITLE_);
		$this->set('from_no', '01077283681');
		$this->set('to_no', '');
		$this->set('msg', '');
	}

	/* send
	protected function send() {

		$url = $this->get('url');
		$biz_id = $this->get('biz_id');
		$smskey = $this->get('smskey');
		$referer = $this->get('referer');

		$from_no = $this->get('from_no');
		$from_no = str_replace('-', '', $from_no);
		$from_no = str_replace('.', '', $from_no);
		$from_no = str_replace(' ', '', $from_no);

		$to_no = $this->get('to_no');
		$to_no = str_replace('-', '', $to_no);
		$to_no = str_replace('.', '', $to_no);
		$to_no = str_replace(' ', '', $to_no);

		$msg = $this->get('msg');
		$msg = iconv('UTF-8', 'EUC-KR', $msg);

		$data = 'stran_phone='.$to_no.'&stran_callback='.$from_no.'&guest_no='.$this->get('sms_id').'&guest_key='.$this->get('sms_key').'&stran_msg='.$msg;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec ($ch);
		curl_close ($ch);

		return $result;
	}
	*/

	protected function send() {
		include_once(_GABIA_SMS_PATH_.'/api.class.php');

		$from_no = $this->get('from_no');
		$from_no = str_replace('-', '', $from_no);
		$from_no = str_replace('.', '', $from_no);
		$from_no = str_replace(' ', '', $from_no);

		$to_no = $this->get('to_no');
		$to_no = str_replace('-', '', $to_no);
		$to_no = str_replace('.', '', $to_no);
		$to_no = str_replace(' ', '', $to_no);

		$msg = $this->get('msg');

		$api = new gabiaSmsApi('mela8909','9df130d6dd3a3db020b011b94038c224');
		$ref_key = 'key_'.time();

		$chk = $api->sms_send($to_no, $from_no, $msg, $reg_key, '');
		if($chk == gabiaSmsApi::$RESULT_OK) {
			$result = true;
		}

		return true;
	}

	/* send sms */
	public function sendSms($mode, $arr) {

		if($mode == 'auth_no') {
			$this->set('to_no', $arr['mb_hp']);
			$msg = '['.$this->get('from_name').']인증번호:'.$arr['auth_no'];
			$this->set('msg', $msg);
		}
		/*
		else if($mode == 'new_pass')
		{
			$this->set('to_no', $arr['mb_hp']);

			$msg = '[디콩] 임시비밀번호 : '.$arr['new_pass'];
			$this->set('msg', $msg);
		}
		*/

		return $this->send();
	}
}
?>
