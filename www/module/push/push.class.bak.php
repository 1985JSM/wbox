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
		$this->set('ps_cf_pk', 'ps_cf_id');

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

		parent::init();
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

	/* send push */
	public function sendPush($push_type, $data) {

		if($push_type == 'write_reserve') {
			// 예약 접수
			$arr = $this->convertWriteReserve($data);
		}
		else if($push_type == 'modify_reserve') {
			// 예약 변경
			$arr = $this->convertModifyReserve($data);
		}
		else if($push_type == 'confirm_progress') {
			// 예약 재확인
			$arr = $this->convertConfirmProgress($data);
		}
		else if($push_type == 'abnormal_cancel') {
			// 사용자 비정상취소
			$arr = $this->convertAbnormalCancel($data);
		}
		else if($push_type == 'abnormal_cancel2') {
			// 담당자 비정상취소
			$arr = $this->convertAbnormalCancel2($data);
		}
		else if($push_type == 'confirm_finish') {
			// 매장 방문
			$arr = $this->convertConfirmFinish($data);
		}
		else if($push_type == 'write_review') {
			// 리뷰 작성
			$arr = $this->convertWriteReview($data);
		}
		else if($push_type == 'reply_review') {
			// 리뷰 답변
			$arr = $this->convertReplyReview($data);
		}

		if($arr['push_os'] == 'android') {
			$result = $this->sendToAndroid($arr);
		}

		if($result) {
			$arr['push_state'] = 'Y';
		}
		else {
			$arr['push_state'] = 'N';
		}

		unset($arr['push_key']);
		$arr['push_type'] = $push_type;
		$arr = $this->convertInsert($arr);
		dbInsertByArray($this->get('data_table'), $arr);
	}

	/* convert write reserve */	
	protected function convertWriteReserve($data) {

		// 사용자가 작성한 예약이 아닐 경우
		if($data['rs_type'] != 'U') {
			return null;			
		}		

		// 담당자가 수신을 원치 않을 경우
		include_once(_MODULE_PATH_.'/staff/staff.class.php');
		$oStaff = new Staff();
		$oStaff->init();
		$receiver = $oStaff->selectDetail($data['st_id']);
		if($receiver['flag_use_push'] == 'N') {
			return null;
		}

		// 정보 가공
		$sh_code = $data['sh_code'];
		$push_key = $this->get('android_staff_key');
		$push_os = $receiver['mb_push_os'];
		$push_id = $receiver['mb_push_id'];

		$push_title = '예약이 접수되었습니다.';

		$week_arr = $this->get('week_arr');
		$rs_time = strtotime($data['rs_date'].' '.$data['rs_time']);
		$rs_week = date('w', $rs_time);
		$txt_rs_datetime = date('Y년 m월 d일', $rs_time).' ('.$week_arr[$rs_week].') '.$data['rs_time'];

		$push_content = $data['us_name'].'님이 '.$txt_rs_datetime.' 예약하였습니다.';

		$pk = $data['pk'];
		//$push_url = '/webstaff/reserve/view.html?'.$pk.'='.$data[$pk];
		$push_url = '/webstaff/page/main.html';

		// return		
		$arr = array(
			'sh_code'		=> $sh_code,
			'push_key'		=> $push_key,
			'push_os'		=> $push_os,
			'push_id'		=> $push_id,
			'push_title'	=> $push_title,
			'push_content'	=> $push_content,
			'push_url'		=> $push_url
		);

		return $arr;
	}

	/* convert modify reserve */	
	protected function convertModifyReserve($data) {

		global $layout, $mode;

		// 사용자가 작성한 예약이 아닐 경우
		if($data['rs_type'] != 'U') {
			return null;			
		}		

		$week_arr = $this->get('week_arr');
		$rs_time = strtotime($data['rs_date'].' '.$data['rs_time']);
		$rs_week = date('w', $rs_time);
		$txt_rs_datetime = date('Y년 m월 d일', $rs_time).' ('.$week_arr[$rs_week].') '.$data['rs_time'];

		$rs_state = $data['rs_state'];
		if($mode == 'update_state') {
			if($rs_state == 'W') {
				$txt_mode = '신청 접수';
			}
			if($rs_state == 'A') {
				$txt_mode = '승인';
			}
			else if($rs_state == 'P') {
				$txt_mode = '확정';
			}
			else if($rs_state == 'E') {
				$txt_mode = '완료 처리';
			}
			else if($rs_state == 'B') {
				$txt_mode = '취소';
			}
			else if($rs_state == 'C') {
				$txt_mode = '취소';
			}
		}
		else {
			$txt_mode = '변경';
		}

		$push_title = '예약이 '.$txt_mode.'되었습니다.';	
						
		if($layout == 'user') {
			// 사용자가 변경하는 경우

			// 담당자가 수신을 원치 않을 경우
			include_once(_MODULE_PATH_.'/staff/staff.class.php');
			$oStaff = new Staff();
			$oStaff->init();
			$receiver = $oStaff->selectDetail($data['st_id']);
			if($receiver['flag_use_push'] == 'N') {
				return null;
			}		

			$push_key = $this->get('android_staff_key');
			$push_content = $data['us_name'].'님이 '.$txt_rs_datetime.' 예약을 '.$txt_mode.'하였습니다.';

			$pk = $data['pk'];		
			//$push_url = '/webstaff/reserve/view.html?'.$pk.'='.$data[$pk];
			$push_url = '/webstaff/page/main.html';
		}
		else {
			// 담당자가 변경하는 경우

			// 사용자가 수신을 원치 않을 경우
			include_once(_MODULE_PATH_.'/user/user.class.php');
			$oUser = new User();
			$oUser->init();
			$receiver = $oUser->selectDetail($data['reg_id']);
			if($receiver['flag_use_push'] == 'N') {
				return null;
			}

			$push_key = $this->get('android_user_key');
			$push_content = $data['sh_name'].' 담당자가 예약을 '.$txt_mode.'하였습니다.';
			//$push_url = '/webuser/reserve/list.html';
			$push_url = '/webuser/page/main.html';

			if($rs_state == 'E') {
				$push_title = '만족하셨나요?';
				$push_content = '이용하신 매장 리뷰 작성 시, 포인트가 추가 적립됩니다.';
				//$push_url = '/webuser/shop/view.html?sh_code='.$data['sh_code'];
				$push_url = '/webuser/page/main.html';
			}
		}		

		// 정보 가공
		$sh_code = $data['sh_code'];		
		$push_os = $receiver['mb_push_os'];
		$push_id = $receiver['mb_push_id'];

			

		// return		
		$arr = array(
			'sh_code'		=> $sh_code,
			'push_key'		=> $push_key,
			'push_os'		=> $push_os,
			'push_id'		=> $push_id,
			'push_title'	=> $push_title,
			'push_content'	=> $push_content,
			'push_url'		=> $push_url
		);

		return $arr;
	}

	/* convert confirm progress */
	protected function convertConfirmProgress($data) {

		// 사용자가 작성한 예약이 아닐 경우
		if($data['rs_type'] != 'U') {
			return null;			
		}		

		// 사용자가 수신을 원치 않을 경우
		include_once(_MODULE_PATH_.'/user/user.class.php');
		$oUser = new User();
		$oUser->init();
		$receiver = $oUser->selectDetail($data['reg_id']);
		if($receiver['flag_use_push'] == 'N') {
			return null;
		}

		// 정보 가공
		$sh_code = $data['sh_code'];
		$push_key = $this->get('android_user_key');
		$push_os = $receiver['mb_push_os'];
		$push_id = $receiver['mb_push_id'];

		$rs_time = strtotime($data['rs_date'].' '.$data['rs_time']);
		$rs_arr = getRemainTime($rs_time);
		if($rs_arr['h'] > 0 && $rs_arr['h'] < 10) {
			$rs_arr['h'] = '0'.$rs_arr['h'];
		}

		if($rs_arr['m'] > 0 && $rs_arr['m'] < 10) {
			$rs_arr['m'] = '0'.$rs_arr['m'];
		}

		if($rs_arr['h'] > 0 && $rs_arr['m'] > 0 ) { $txt_rs_time = $rs_arr['h'].'시간 '.$rs_arr['m'].'분'; }
		else if($rs_arr['h'] > 0 ) { $txt_rs_time = $rs_arr['h'].'시간'; }
		else if($rs_arr['m'] > 0 ) { $txt_rs_time = $rs_arr['m'].'분'; }

		$push_title = '예약 '.$txt_rs_time.' 전 입니다.';
		$push_content = $data['us_name'].'님, 예약을 재확인 해주시면 포인트가 추가 적립됩니다.';

		$pk = $data['pk'];
		//$push_url = '/webuser/reserve/list.html';
		$push_url = '/webuser/page/main.html';

		// return		
		$arr = array(
			'sh_code'		=> $sh_code,
			'push_key'		=> $push_key,
			'push_os'		=> $push_os,
			'push_id'		=> $push_id,
			'push_title'	=> $push_title,
			'push_content'	=> $push_content,
			'push_url'		=> $push_url
		);

		return $arr;
	}

	/* convert abnormal cancel */
	protected function convertAbnormalCancel($data) {

		// 사용자가 작성한 예약이 아닐 경우
		if($data['rs_type'] != 'U') {
			return null;			
		}		

		// 사용자가 수신을 원치 않을 경우
		include_once(_MODULE_PATH_.'/user/user.class.php');
		$oUser = new User();
		$oUser->init();
		$receiver = $oUser->selectDetail($data['reg_id']);
		if($receiver['flag_use_push'] == 'N') {
			return null;
		}

		// 정보 가공
		$sh_code = $data['sh_code'];
		$push_key = $this->get('android_user_key');
		$push_os = $receiver['mb_push_os'];
		$push_id = $receiver['mb_push_id'];

		$push_title = '예약이 취소되었습니다.';
		$push_content = $data['us_name'].'님, 예약시간까지 매장에 방문하지 않아 예약이 취소되었습니다.';

		$pk = $data['pk'];
		//$push_url = '/webuser/reserve/list.html';
		$push_url = '/webuser/page/main.html';

		// return		
		$arr = array(
			'sh_code'		=> $sh_code,
			'push_key'		=> $push_key,
			'push_os'		=> $push_os,
			'push_id'		=> $push_id,
			'push_title'	=> $push_title,
			'push_content'	=> $push_content,
			'push_url'		=> $push_url
		);

		return $arr;
	}

	/* convert abnormal cancel2 */
	protected function convertAbnormalCancel2($data) {

		/*
		// 사용자가 작성한 예약이 아닐 경우
		if($data['rs_type'] != 'U') {
			return null;			
		}
		*/

		// 담당자가 수신을 원치 않을 경우
		include_once(_MODULE_PATH_.'/staff/staff.class.php');
		$oStaff = new Staff();
		$oStaff->init();
		$receiver = $oStaff->selectDetail($data['st_id']);
		if($receiver['flag_use_push'] == 'N') {
			return null;
		}		

		// 정보 가공
		$sh_code = $data['sh_code'];
		$push_key = $this->get('android_staff_key');
		$push_os = $receiver['mb_push_os'];
		$push_id = $receiver['mb_push_id'];

		$push_title = '예약이 취소되었습니다.';

		$week_arr = $this->get('week_arr');
		$rs_time = strtotime($data['rs_date'].' '.$data['rs_time']);
		$rs_week = date('w', $rs_time);
		$txt_rs_datetime = date('Y년 m월 d일', $rs_time).' ('.$week_arr[$rs_week].') '.$data['rs_time'];

		$push_content = $data['us_name'].'님의 '.$txt_rs_datetime.' 예약이 비정상 취소되었습니다.';

		$pk = $data['pk'];
		//$push_url = '/webstaff/reserve/view.html?'.$pk.'='.$data[$pk];
		$push_url = '/webstaff/page/main.html';

		// return		
		$arr = array(
			'sh_code'		=> $sh_code,
			'push_key'		=> $push_key,
			'push_os'		=> $push_os,
			'push_id'		=> $push_id,
			'push_title'	=> $push_title,
			'push_content'	=> $push_content,
			'push_url'		=> $push_url
		);

		return $arr;
	}

	/* convert confirm finish */	
	protected function convertConfirmFinish($data) {

		/*
		// 사용자가 작성한 예약이 아닐 경우
		if($data['rs_type'] != 'U') {
			return null;			
		}
		*/

		// 담당자가 수신을 원치 않을 경우
		include_once(_MODULE_PATH_.'/staff/staff.class.php');
		$oStaff = new Staff();
		$oStaff->init();
		$receiver = $oStaff->selectDetail($data['st_id']);
		if($receiver['flag_use_push'] == 'N') {
			return null;
		}

		// 정보 가공
		$sh_code = $data['sh_code'];
		$push_key = $this->get('android_staff_key');
		$push_os = $receiver['mb_push_os'];
		$push_id = $receiver['mb_push_id'];

		
		$rs_time = strtotime($data['rs_date'].' '.$data['rs_time']);
		$rs_arr = getRemainTime($rs_time);
		if($rs_arr['h'] > 0 && $rs_arr['h'] < 10) {
			$rs_arr['h'] = '0'.$rs_arr['h'];
		}

		if($rs_arr['m'] > 0 && $rs_arr['m'] < 10) {
			$rs_arr['m'] = '0'.$rs_arr['m'];
		}

		if($rs_arr['h'] > 0 && $rs_arr['m'] > 0 ) { $txt_rs_time = $rs_arr['h'].'시간 '.$rs_arr['m'].'분'; }
		else if($rs_arr['h'] > 0 ) { $txt_rs_time = $rs_arr['h'].'시간'; }
		else if($rs_arr['m'] > 0 ) { $txt_rs_time = $rs_arr['m'].'분'; }
		
		//$push_title = '완료하셨나요?';
		$push_title = '예약이 '.$txt_rs_time.' 경과하였습니다.';

		$week_arr = $this->get('week_arr');
		$rs_time = strtotime($data['rs_date'].' '.$data['rs_time']);
		$rs_week = date('w', $rs_time);
		$txt_rs_datetime = date('Y년 m월 d일', $rs_time).' ('.$week_arr[$rs_week].') '.$data['rs_time'];

		$push_content = $data['us_name'].'님에게 서비스가 정상 제공 되었다면 예약을 완료 처리 해주세요.';

		$pk = $data['pk'];
		//$push_url = '/webstaff/reserve/view.html?'.$pk.'='.$data[$pk];
		$push_url = '/webstaff/page/main.html';

		// return		
		$arr = array(
			'sh_code'		=> $sh_code,
			'push_key'		=> $push_key,
			'push_os'		=> $push_os,
			'push_id'		=> $push_id,
			'push_title'	=> $push_title,
			'push_content'	=> $push_content,
			'push_url'		=> $push_url
		);

		return $arr;
	}

	/* convert write review */
	protected function convertWriteReview($data) {

		// 사용자가 작성한 리뷰가 아닐 경우
		if($data['rv_type'] != 'U') {
			return null;			
		}		

		// 담당자가 없을 경우
		if(!$data['mb_id']) {
			return null;
		}

		// 담당자가 수신을 원치 않을 경우
		include_once(_MODULE_PATH_.'/staff/staff.class.php');
		$oStaff = new Staff();
		$oStaff->init();
		$receiver = $oStaff->selectDetail($data['mb_id']);
		if($receiver['flag_use_push'] == 'N') {
			return null;
		}

		// 정보 가공
		$sh_code = $data['sh_code'];
		$push_key = $this->get('android_staff_key');
		$push_os = $receiver['mb_push_os'];
		$push_id = $receiver['mb_push_id'];

		$push_title = '리뷰를 확인해주세요.';
		$push_content = $data['rv_name'].'님이 리뷰를 작성하였습니다.';		

		$pk = $data['pk'];
		//$push_url = '/webstaff/review/list.html';
		$push_url = '/webstaff/page/main.html';

		// return		
		$arr = array(
			'sh_code'		=> $sh_code,
			'push_key'		=> $push_key,
			'push_os'		=> $push_os,
			'push_id'		=> $push_id,
			'push_title'	=> $push_title,
			'push_content'	=> $push_content,
			'push_url'		=> $push_url
		);

		return $arr;
	}

	/* convert reply review */
	protected function convertReplyReview($data) {

		// 사용자가 작성한 리뷰가 아닐 경우
		if($data['rv_type'] != 'U') {
			return null;			
		}		

		// 사용자가 수신을 원치 않을 경우
		include_once(_MODULE_PATH_.'/user/user.class.php');
		$oUser = new User();
		$oUser->init();
		$receiver = $oUser->selectDetail($data['reg_id']);
		if($receiver['flag_use_push'] == 'N') {
			return null;
		}

		// 정보 가공
		$sh_code = $data['sh_code'];
		$push_key = $this->get('android_user_key');
		$push_os = $receiver['mb_push_os'];
		$push_id = $receiver['mb_push_id'];

		$push_title = '답변을 확인해주세요.';
		$push_content = '작성하신 리뷰에 답변이 작성되었습니다.';		

		$pk = $data['pk'];
		//$push_url = '/webuser/shop/view.html?'.$pk.'='.$data[$pk];
		$push_url = '/webuser/page/main.html';

		// return		
		$arr = array(
			'sh_code'		=> $sh_code,
			'push_key'		=> $push_key,
			'push_os'		=> $push_os,
			'push_id'		=> $push_id,
			'push_title'	=> $push_title,
			'push_content'	=> $push_content,
			'push_url'		=> $push_url
		);

		return $arr;
	}

	/**
	* 단체 발송
	*/
	public function sendWaitList() {

		$reserve_table = $this->get('reserve_table');
		$reserve_pk = $this->get('reserve_pk');		
		$list = dbSelect($reserve_table, "*", "where rs_state = 'W'", "", "");

		$now_time = time();
		$process_hour = $this->get('process_hour');

		unset($cf_list);
		unset($cc_list);
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$rs_time = strtotime($list[$i]['rs_date'].' '.$list[$i]['rs_time']);
			$gap_time = $rs_time - $now_time;			
			if($gap_time >= 0 && $gap_time <= $process_hour * 3600) {
				$cf_list[] = $list[$i];
			}
			else if($gap_time < 0) {
				$cc_list[] = $list[$i];
			}
		}

		$chk_minute = date('i', $now_time);
		if($chk_minute % 5 == 0 || $_SERVER['REMOTE_ADDR'] == '211.35.19.138') {
			// 재확인
			for($i = 0 ; $i < sizeof($cf_list) ; $i++) {
				$this->sendPush('confirm_progress', $cf_list[$i]);
			}
		}

		// 비정상취소
		unset($cc_arr);
		for($i = 0 ; $i < sizeof($cc_list) ; $i++) {
			$cc_arr[$i] = $cc_list[$i][$reserve_pk];
			$cc_list[$i]['pk'] = $reserve_pk;
			$this->sendPush('abnormal_cancel', $cc_list[$i]);
			$this->sendPush('abnormal_cancel2', $cc_list[$i]);
		}

		if(sizeof($cc_arr) > 0) {
			$db_in = implode("','", $cc_arr);
			dbUpdate($reserve_table, "rs_state = 'B'", "where rs_state = 'W' and $reserve_pk in ('$db_in')");
		}
	}

	public function sendProgressList() {

		$reserve_table = $this->get('reserve_table');
		$reserve_pk = $this->get('reserve_pk');		
		$list = dbSelect($reserve_table, "*", "where rs_state = 'P' ", "", "");

		$now_time = time();

		unset($cf_list);
		for($i = 0 ; $i < sizeof($list) ; $i++) {

			$rs_time = strtotime($list[$i]['rs_date'].' '.$list[$i]['rs_time']);
			$gap_time = $rs_time - $now_time;			
			if($gap_time < 0) {
				$cf_list[] = $list[$i];
			}
		}

		$chk_minute = date('i', $now_time);
		if($chk_minute % 5 == 0) {
			// 재확인
			for($i = 0 ; $i < sizeof($cf_list) ; $i++) {
				$cf_list[$i]['pk'] = $reserve_pk;
				$this->sendPush('confirm_finish', $cf_list[$i]);
			}
		}
	}

}
?>