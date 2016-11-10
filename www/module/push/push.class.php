<?
if(!defined('_INPLUS_')) { exit; } 

Class Push extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'push');
		$this->set('module_name',	'푸시');		

		$this->set('push_mode',	'service');
		$this->set('android_user_key',	'AIzaSyA40InqQIQnBnwed6ojTQUwcTJUzNc8x7Y');
		$this->set('android_staff_key',	'AIzaSyAThpOxZk7_Tri12LrJp6Dxy1tq80VV2YM');

		// context
		$this->set('data_table', 'tbl_push');
		$this->set('pk', 'push_id');

		$this->set('config_table', 'tbl_push_config');
		$this->set('ps_cf_pk', 'ps_cf_code');

		$this->set('search_field', 'sh_code');
		$this->set('sch_type_arr', array(
			'push_title'	=> '제목',
			'push_content'	=> '내용'
		));
	
		/**
		* code array
		*/
		$this->set('push_type_arr', array(
			'reply_review'	=> '리뷰 답변',
			'CP'	=> '예약 재확인'
		));

		$this->set('week_arr', array(
			'0'	=> '일',
			'1'	=> '월',
			'2'	=> '화',
			'3'	=> '수',
			'4'	=> '목',
			'5'	=> '금',
			'6'	=> '토'
		));

		// push_config	
		$cf_list = dbSelect($this->get('config_table'), "*", "", "", "");
		unset($push_config);
		for($i = 0 ; $i < sizeof($cf_list); $i++) {
			$code = $cf_list[$i]['ps_cf_code'];

			if(strpos($code, 'to_user') > -1) {
				$receiver = '사용자';
			}
			else if(strpos($code, 'to_staff') > -1) {
				$receiver = '담당자';
			}

			$push_config[$code] = array(
				'title'		=> $cf_list[$i]['ps_cf_title'],
				'content'	=> $cf_list[$i]['ps_cf_content'],
				'url'		=> $cf_list[$i]['ps_cf_url'],
				'memo'		=> $cf_list[$i]['ps_cf_memo'],
				'receiver'	=> $receiver
			);
		}
		$this->set('push_config', $push_config);

		parent::init();
	}	

	/* get receiver by user id */
	protected function getReceiverByUserId($mb_id) {

		include_once(_MODULE_PATH_.'/user/user.class.php');
		$oUser = new User();
		$oUser->init();
		$data = $oUser->selectDetail($mb_id);

		// 사용자가 푸시 수신을 원치 않을 경우
		if($data['flag_use_push'] == 'N') {
			return null;
		}

		$receiver = array(
			'push_os'	=> $data['mb_push_os'],
			'push_id'	=> $data['mb_push_id']
		);

		return $receiver;
	}

	/* get receiver by staff id */
	protected function getReceiverByStaffId($mb_id) {

		include_once(_MODULE_PATH_.'/staff/staff.class.php');
		$oStaff = new Staff();
		$oStaff->init();
		$data = $oStaff->selectDetail($mb_id);

		// 담당자가 푸시 수신을 원치 않을 경우
		if($data['flag_use_push'] == 'N') {
			return null;
		}

		$receiver = array(
			'push_os'	=> $data['mb_push_os'],
			'push_id'	=> $data['mb_push_id']
		);

		return $receiver;
	}

	public function getPushConfig($ps_cf_code, $data) {

		$push_config = $this->get('push_config');
		$arr = $push_config[$ps_cf_code];

		$rs_time = strtotime($data['rs_date'].' '.$data['rs_time'].':00');
		$txt_rs_datetime = beautifyDateTime($rs_time, true);		

		$rs_arr = getRemainTime($rs_time);
		if($rs_arr['h'] > 0 && $rs_arr['m'] > 0 ) { $txt_remain_time = $rs_arr['h'].'시간 '.$rs_arr['m'].'분'; }
		else if($rs_arr['h'] > 0 ) { $txt_remain_time = $rs_arr['h'].'시간'; }
		else if($rs_arr['m'] > 0 ) { $txt_remain_time = $rs_arr['m'].'분'; }

		$content = $arr['content'];
		$content = str_replace('{매장명}',		$data['sh_name'], $content);
		$content = str_replace('{예약자명}',	$data['us_name'], $content);
		$content = str_replace('{예약일시}',	$txt_rs_datetime, $content);
		$content = str_replace('{남은시간}',	$txt_remain_time, $content);

		$content = str_replace('{작성자명}',	$data['bo_name'], $content);

		$arr['content'] = $content;

		return $arr;
	}

	/* convert push msg */
	protected function makePushInfo($ps_cf_code, $data) {

		unset($arr);

		// 푸시 수신자 정보 세팅
		if(strpos($ps_cf_code, 'to_user') > -1) {
			$receiver = $this->getReceiverByUserId($data['us_id']);
			$push_key = $this->get('android_user_key');
		}
		else if(strpos($ps_cf_code, 'to_staff') > -1) {
			$receiver = $this->getReceiverByStaffId($data['st_id']);
			$push_key = $this->get('android_staff_key');
		}
		else {
			return null;
		}

		// 푸시를 수신받을 수 있는 정보가 없을 경우
		if(!$receiver['push_os']) {
			return null;
		}

		// 푸시 내용 설정
		$push_config = $this->getPushConfig($ps_cf_code, $data);

		// 발송을 위한 최종 데이터 설정
		$arr = array(
			'ps_cf_code'	=> $ps_cf_code,
			'sh_code'		=> $data['sh_code'],
			'push_key'		=> $push_key,
			'push_os'		=> $receiver['push_os'],
			'push_id'		=> $receiver['push_id'],
			'push_title'	=> $push_config['title'],
			'push_content'	=> $push_config['content'],
			'push_url'		=> $push_config['url']
		);

		return $arr;
	}

	/* send push */
	public function sendPush($ps_cf_code, $data) {

		$arr = $this->makePushInfo($ps_cf_code, $data);
		if(!$arr['push_os']) {
			return false;
		}

		// 안드로이드 푸시 발송
		if($arr['push_os'] == 'android') {
			$result = $this->sendToAndroid($arr);
		} else if ($arr['push_os'] == 'I') {
			$arr['push_key'] = $arr['push_id'];
			$result = $this->sendToIos($arr);
		}

		if($result) {
			$arr['push_state'] = 'Y';
		}
		else {
			$arr['push_state'] = 'N';
		}

		$arr = $this->convertInsert($arr);
		dbInsertByArray($this->get('data_table'), $arr);
	}

	/* send push list */
	public function sendPushList() {

		$now_time = strtotime(date('Y-m-d H:i:00'));

		# 0. 예약건 조회
		$reserve_table = $this->get('reserve_table');
		$reserve_pk = $this->get('reserve_pk');		
		$list = dbSelect($reserve_table, "*", "where rs_state in ('W', 'A', 'P')", "", "");
		for($i = 0 ; $i < sizeof($list) ; $i++) {

			// 예약시간과의 현재시간의 차이
			$rs_time = strtotime($list[$i]['rs_date'].' '.$list[$i]['rs_time'].':00');
			$s_gap_time = $rs_time - $now_time;
			$e_gap_time = ($rs_time + $list[$i]['sv_time'] * 60) - $now_time;

			/**
			* 1. 예약시간알림
			* 기존 상태 : A, P
			* 수신자 : user
			* 예약일시와 10, 20, 30, 40, 50, 60분 차이가 생길 경우
			*/
			if(($list[$i]['rs_state'] == 'A' || $list[$i]['rs_state'] == 'P') &&
				($s_gap_time == 10 * 60 || $s_gap_time == 20 * 60 || $s_gap_time == 30 * 60 || $s_gap_time == 40 * 60 || $s_gap_time == 50 * 60 || $s_gap_time == 60 * 60)) {
				$this->sendPush('remain_to_user', $list[$i]);
			}

			/**
			* 2. 예약경과
			* 기존 상태 : P
			* 수신자 : staff
			* 서비스 종료시점(예약일시 + 서비스시간) + 1시간 후
			*/
			if($list[$i]['rs_state'] == 'P' && $e_gap_time == 60 * 60 * (-1)) {
				$this->sendPush('pass_to_staff', $list[$i]);
			}

			/**
			* 3. 비정상취소
			* 기존 상태 : W
			* 예약일시가 1분이라도 지났을 경우
			*/
			if(($list[$i]['rs_state'] == 'W' || $list[$i]['rs_state'] == 'A') && $s_gap_time < 60 * (-1)) {
				$this->sendPush('auto_to_user', $list[$i]);
				$this->sendPush('auto_to_staff', $list[$i]);

				dbUpdate($reserve_table, "rs_state = 'B'", "where rs_state in ('W', 'A') and $reserve_pk = '".$list[$i][$reserve_pk]."'");
			}
		}
	}

	/* send to android */
	protected function sendToAndroid($arr) {

		// 헤더 부분
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.$arr['push_key']
		);

		// 푸시 내용
		$arr = array(
			'data'	=> array(
				'pushType'		=> $this->get('push_mode'),
				'pushTitle'		=> $arr['push_title'],
				'pushContent'	=> $arr['push_content'],
				'pushUrl'		=> $arr['push_url']
			),
			'registration_ids'	=> array(
				'0'	=> $arr['push_id']
			)
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
		$response = curl_exec($ch);
		curl_close($ch);

		// 푸시 전송 결과 반환.
		$result = json_decode($response, 1);

		return $result['success'];
	}

	protected function sendToIos($arr) {
		$path = $_SERVER['DOCUMENT_ROOT'].'/plugin/ApnsPHP';
		// Adjust to your timezone
		//date_default_timezone_set('Asia/Seoul');
		// Report all PHP errors
		//error_reporting(-1);
		// Using Autoload all classes are loaded on-demand
		require_once $path.'/Autoload.php';
		// Instantiate a new ApnsPHP_Push object

		if (strpos($arr['ps_cf_code'], 'user') !== false) {
			$push = new ApnsPHP_Push(
				ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
				$path.'/wbox_apns_user.pem'
			);
		} else if (strpos($arr['ps_cf_code'], 'staff') !== false) {
			$push = new ApnsPHP_Push(
				ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
				$path.'/wbox_apns_staff.pem'
			);
		}

		// Connect to the Apple Push Notification Service
		$push->connect();

		// Instantiate a new Message with a single recipient
		$message = new ApnsPHP_Message($arr['push_key']);
		// Set a custom identifier. To get back this identifier use the getCustomIdentifier() method
		// over a ApnsPHP_Message object retrieved with the getErrors() message.
		$message->setCustomIdentifier($arr['push_title']);
		// Set badge icon to "3"
		$message->setBadge(1);
		// Set a simple welcome text
		$message->setText($arr['push_content']);
		// Play the default sound
		$message->setSound();
		// Set a custom property
		$message->setCustomProperty('ps_title', $arr['push_title']);
		$message->setCustomProperty('url', str_replace($_SERVER['SCRIPT_URL'], "", $_SERVER['SCRIPT_URI']) . $arr['push_url']);
		// Set the expiry value to 30 seconds
		$message->setExpiry(30);

		// Add the message to the message queue
		$push->add($message);

		// Send all messages in the message queue
		$push->send();

		// Disconnect from the Apple Push Notification Service
		$push->disconnect();

		// Examine the error message container
		$aErrorQueue = $push->getErrors();
		if (!empty($aErrorQueue)) {
			$time = date('Y-m-d H:i:s');
			$ip = $_SERVER['REMOTE_ADDR'];

			$log_file = $_SERVER['DOCUMENT_ROOT'].'/data/log/' . date('Y.m.d') . '.txt';
			$content = '['.$time.']['.$ip.']	';
			ob_start();
			print_r($aErrorQueue);
			$content .= ob_get_contents();
			ob_end_clean();

			file_put_contents($log_file, $content, FILE_APPEND);
			@chmod($log_file, 0707);
			return null;
		} else {
			return 'Y';
		}


	}
}
?>