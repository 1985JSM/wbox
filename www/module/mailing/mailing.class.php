<?
if(!defined('_INPLUS_')) { exit; } 

Class Mailing extends StdController
{	
	/* init */
	public function init() {	
		// moduel info
		$this->set('module',		'mailing');
		$this->set('module_name',	'메일링');

		// contenxt
		$this->set('data_table', 'tbl_mailing');
		$this->set('pk', 'ma_id');

		// default
		$this->set('from_mail', _HOMEPAGE_EMAIL_);
		$this->set('from_name', _HOMEPAGE_TITLE_);
	}	

	/* insert mail */
	protected function insertMail() {

		$arr = array(
			'from_name'	=> $this->get('from_name'),
			'from_mail'	=> $this->get('from_mail'),
			'to_name'	=> $this->get('to_name'),
			'to_mail'	=> $this->get('to_mail'),
			'ma_subject'	=> $this->get('subject'),
			'ma_content'	=> $this->get('content'),
			'ma_state'	=> 'W'
		);

		$arr = parent::convertInsert($arr);
		dbInsertByArray($this->get('data_table'), $arr);

		return true;
	}

	/* send mail */
	public function sendMail($mode, $arr) {
		$file_path = _MODULE_PATH_.'/mailing/mail_form/'.$mode.'.inc.php';
		if(!file_exists($file_path)) { return $this->result; }
	
		ob_start();
		include_once($file_path);
		$content = ob_get_contents();
		ob_end_clean();

		$this->set('to_mail', $to_mail);
		$this->set('to_name', $to_name);
		$this->set('subject', $subject);
		$this->set('content', $content);	

		return $this->insertMail();		
	}

	/* send custom */
	public function sendCustom($subject, $content, $to_mail) {

		$file_path = _MODULE_PATH_.'/mailing/mail_form/custom.inc.php';
		if(!file_exists($file_path)) { return $this->result; }

		ob_start();
		include_once($file_path);
		$content = ob_get_contents();
		ob_end_clean();

		$to_mail_arr = explode(',', $to_mail);

		$arr = array(
			'from_name'		=> $this->get('from_name'),
			'from_mail'		=> $this->get('from_mail'),
			'to_name'		=> '고객님',			
			'ma_subject'	=> $subject,
			'ma_content'	=> $content,
			'ma_state'	=> 'W'
		);
		$arr = parent::convertInsert($arr);

		for($i = 0 ; $i < sizeof($to_mail_arr) ; $i++) {
			$arr['to_mail'] = $to_mail_arr[$i];			
			dbInsertByArray($this->get('data_table'), $arr);
		}

		$tot_cnt = sizeof($to_mail_arr);

		return $tot_cnt;
	}

	/* send */
	protected function send($arr) {
		// context
		$from_mail = $arr['from_mail'];
		$from_name = $arr['from_name'];
		$to_mail = $arr['to_mail'];
		$to_name = $arr['to_name'];
		$subject = $arr['ma_subject'];
		$content = $arr['ma_content'];

		// 인코딩
		$from_name   = "=?UTF-8?B?" . base64_encode($from_name) . "?=";
		$subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";

		$header  = "Return-Path: <$from_mail>\n";
		$header .= "From: $from_name <$from_mail>\n";
		$header .= "Reply-To: <$from_mail>\n";
		$header .= "MIME-Version: 1.0\n";
		$header .= "X-Mailer: SIR Mailer 0.92 (sir.co.kr) : $_SERVER[SERVER_ADDR] : $_SERVER[REMOTE_ADDR] : http://wbox.inplus21.com : $_SERVER[PHP_SELF] : $_SERVER[HTTP_REFERER] \n";

		$header .= "Content-Type: TEXT/HTML; charset=UTF-8\n";		
		$header .= "Content-Transfer-Encoding: BASE64\n\n";
		$header .= chunk_split(base64_encode($content)) . "\n";		

		$result = @mail($to_mail, $subject, "", $header, "-f ".$from_mail);
		return $result;
	}	

	/* wait list */
	public function sendWaitList() {

		$pk = $this->get('pk');
		$list = dbSelect($this->get('data_table'), "*", "where ma_state = 'W'", "order by $pk asc", "limit 30");

		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$result = $this->send($list[$i]);
			if($result) {
				$uid = $list[$i][$pk];
				dbUpdate($this->get('data_table'), "ma_state = 'S'", "where $pk = '$uid'");
			}
		}
	}
}
?>
