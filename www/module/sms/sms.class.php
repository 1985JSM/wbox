<?
if(!defined('_INPLUS_')) { exit; }
include_once $_SERVER['DOCUMENT_ROOT'] . '/plugin/Smscore/Smscore.php';
Class Sms extends StdController
{
	/* context */
	/*
	 */
	public function __construct($option = 0)
	{
		parent::__construct();
		$this->set('cnt_rows', 10);
		$this->set('search_field', 'pa_type,pa_state,pa_method,date,sch_like,sch_text,s_date,e_date');
		$this->init();
		$this->set('pk', 'sms_id');
		$this->set('data_table', 'tbl_sms');

	}

	/**
	 * 가입여부를 확인합니다.
	 * alert_option이 true이면 오류 메시지를 alert창으로 띄웁니다.
	 */
	public function checkJoined($alert_option = false)
	{
		global $member;
		$api_key = $this->getAPIKeyByShCode($member['sh_code']);

		// key가 존재하는데 가입페이지에 접속할 시
		if (($this->get('is_join_page')) && ($api_key != '')) {
			$result = array(
				'msg' => '이미 가입되어있습니다.',
				'url' => '/webmanager/sms/sms_send.html'
			);
		} 
		// API키가 없을 때 가입이 필요한 경우
		else if ((!($this->get('is_join_page')) && $api_key == '')) {
			$result = array(
				'msg' => '가입이 필요합니다.',
				'url' => '/webmanager/sms/sms_join.html'
			);
		}
		if ($alert_option && ($result['msg'] != '')) {
			alert($result['msg'], $result['url']);
			exit;
		} else {
			return $result;
		}
	}

	/**
	 * SMS를 전송합니다
	 * $data에 필요한 값들
	 * 
	 *
	 */
	public function sendSms($data)
	{
		if (($data['smscore_api_key'] == '') || ($data['smscore_mb_id']=='')) {
			if ($data['sh_code'] == '') {
				return array(
					'code' => 'failure',
					'msg' => '인증 정보가 없습니다.'
				);
			}
			$auth_info = $this->getAuthInfoByShCode($data['sh_code']);
			$data['smscore_api_key'] = $auth_info['smscore_api_key'];
			$data['smscore_mb_id'] = $auth_info['smscore_mb_id'];
		}

		$smscore = new Smscore($data['smscore_api_key'], $data['smscore_mb_id']);

		$sms = array();

		if ($data['sms_type'] == 'M') {
			$sms['ms_type'] = $data['sms_type'];
		} else {
			$sms_length = $this->getSmsLength($data['sms_contents']);
			$sms['ms_type'] = $sms_length['type'];
			$data['sms_type'] = $sms_length['type'];
		}
		if ($data['sms_rs_type'] == '') {
			$data['sms_rs_type'] = 'D';
		}
		
		// new line converter
		$data['sms_contents'] = str_replace("\n", '&#10;', $data['sms_contents']);

		$sms['ms_sender_no'] = $data['sms_sd_no'];
		$sms['ms_receiver_name[]'] = $data['sms_rc_name'];
		$sms['ms_receiver_no[]'] = $data['sms_rc_no'];
		$sms['ms_content'] = str_replace('{이름}', $data['sms_rc_name'], $data['sms_contents']);
		$sms['ms_rs_type'] = $data['sms_rs_type'];
		$sms['ms_rs_time'] = $data['sms_rs_time'];
		
		$result = $smscore->send($sms);

		// 직접 전송일 때 디비 작업
		//if ($data['sms_id'] == '' && ($data['sms_kind'] == 'direct' || $data['sms_kind'] == 'direct_test')) {
		$data['sms_result'] = $result['code'];
		$data['sms_result_msg'] = $result['msg'];
		putLog($data);
		$this->set('enroll_sms', $data);
		$this->insertData();
		//}

		return $result;
	}

	/**
	 * 메시지 자동발송을 통해 보내질 메시지 가공 후 저장하는 함수
	 *
	 * DB에 데이터 저장 실패시 data/error_log/sms_auto에 로그 저장
	 */
	public function enrollSms($method, $data)
	{
		global $member;
		if (($_SERVER['REMOTE_ADDR'] == '58.149.89.146') || ($member['mb_id'] == 'mongdol')) {
		} else {
			return false;
		}
		// 테스트
		if ($method == 'test') {

		}
		// 직접 전송
		else if ($method == 'direct') {

		}
		// 자동 전송
		// sh_code는 필수
		// customer_id 혹은 user_id 중 하나 필수
		else if ($method != '') {
			include_once(_MODULE_PATH_.'/sms_auto/sms_auto.class.php');

			$oSmsAuto = new SmsAuto($data['sh_code']);
			$sms = array();//sms보낼 정보를 저장합니다

			$config_data = $oSmsAuto->get('config_data');
			
			if ($config_data['data'][$method]['use'] != 'Y') {
				return false;
			}

			$auto_data = $oSmsAuto->convertSms($method, $data);
			$auth_info = $this->getAuthInfoByShCode($data['sh_code']);
			$sms['smscore_api_key'] = $auth_info['smscore_api_key'];
			$sms['smscore_mb_id'] = $auth_info['smscore_mb_id'];
			$sms_length = $this->getSmsLength($auto_data['data']['sms_contents']);
			$sms['sms_type'] = $sms_length['type'];
			$sms['sms_sd_no'] = $auto_data['data']['sms_sd_no'];
			$sms['sms_rc_no'] = $auto_data['data']['sms_rc_no'];
			$sms['sms_rc_name'] = $auto_data['data']['sms_rc_name'];
			$sms['sms_contents'] = $auto_data['data']['sms_contents'];
			$sms['sms_kind'] = $method;
			$sms['sms_status'] = $auto_data['data']['sms_status'];
			if ($auto_data['data']['sms_send_time'] > 1000000) {
				$sms['sms_send_time'] = date("Y-m-d H:i", $auto_data['data']['sms_send_time']);
			}

			$this->set('enroll_sms', $sms);
			
		} else {
			return array(
				'code'  => 'failed',
				'msg'   => 'method가 입력되지 않았습니다.'
			);
		}
		ob_start();
		print_r($sms);
		$result = $this->insertData();

		$log_data = ob_get_contents();
		ob_end_clean();

		if ($result['code'] == 'insert_ok') {
			return $result;
		}
		// 성공하지 않았다면 기록 남긴 후 false
		else {
			$log_path = $_SERVER['DOCUMENT_ROOT'].'/data/error_log/sms_auto';
			if(!is_dir($log_path)) {
				@mkdir($log_path, 0707);
				@chmod($log_path, 0707);
			}
			$log_file = $log_path.'/'.date('Y.m.d').'.txt';

			global $member;
			$mb_id = $member['mb_id'];
			if(!$mb_id) { $mb_id = 'guest'; }
			$time = date('Y-m-d H:i:s');
			$ip = $_SERVER['REMOTE_ADDR'];

			$content = '';
			if(file_exists($log_file)) {
				$content .= file_get_contents($log_file);
			}
			$content.= '['.$time.']['.$ip.']['.$mb_id.']	'.$log_data."\n";

			file_put_contents($log_file, $content);

			return false;
		}

	}

	public function enrollReportSms($method, $data)
	{
		global $member;
		if (($_SERVER['REMOTE_ADDR'] == '58.149.89.146') || ($member['mb_id'] == 'mongdol')) {
		} else {
			return false;
		}

		if (!isset($oPush)) {
			include_once(_MODULE_PATH_.'/push/push.class.php');
			$oPush = new Push();
			$oPush->init();
		}

		include_once(_MODULE_PATH_.'/sms_auto/sms_auto.class.php');
		$oSmsAuto = new SmsAuto($data['sh_code']);
		$report_data = $oSmsAuto->get('report_data');

		if (($report_data['use'] != 'Y') || ($report_data['data'][$method]['use'] != 'Y')) {
			return false;
		}

/*
		// 푸시 수신자 정보 세팅
		if(strpos($method, 'to_user') > -1) {
			include_once(_MODULE_PATH_.'/customer/customer.class.php');
			$oCustomer = new Customer();
			$oCustomer->init();
			$data = $oCustomer->selectDetail($data['cs_id']);
			$sms['sms_rc_name'] = $data['cs_name'];
		}
		else if(strpos($method, 'to_staff') > -1) {
			$sms['sms_rc_name'] = $data['mb_name'];

		}
		else {
			return false;
		}*/


		$arr = $oPush->getPushConfig($method, $data);
		$sms['sms_contents'] = $arr['content'];
		$auth_info = $this->getShopInfo($data['sh_code']);
		$user_info = $this->getUserInfo($data['sh_code']);
		$sms['smscore_api_key'] = $auth_info['smscore_api_key'];
		$sms['smscore_mb_id'] = $auth_info['smscore_mb_id'];
		$sms['sms_sd_no'] = $user_info['data']['sd_tel_no_arr'][0];
		$sms['sms_rc_name'] = '자동알림';
		// 문자 타입을 구합니다 90바이트 아래면 Sms 위면 Lms
		$sms_length = $this->getSmsLength($sms['sms_contents']);
		$sms['sms_type'] = $sms_length['type'];
		$sms['sms_status'] = 'W';
		$sms['sms_kind'] = $method;

		if (count($report_data['rc_no']) > 0) {
			foreach ($report_data['rc_no'] as $rc_no) {
				$sms['sms_rc_no'] = $rc_no;
				$this->set('enroll_sms', $sms);
				$this->insertData();
			}
		}
	}

	/*
	 * 자동 문자중에서 특정 이벤트가 아닌
	 * 특정 날짜를 찾아서 등록하는 함수입니다
	 *
	 */
	public function auto()
	{
		$time = time();

		$time = strtotime('2016-11-10 10:12:09');

		include_once(_MODULE_PATH_.'/sms_auto/sms_auto.class.php');

		// 자동 문자가 설정된 가맹점 리스트를 구한 후 각 항목에 대한 처리
		$auto_list = dbSelect('tbl_sms_auto', 'sh_code', "WHERE sh_code <> '' AND sa_config_data <> ''", '', '');
		foreach ($auto_list as $arr) {
			foreach ($arr as $sh_code) {
				$sh_data = $this->getShopInfo($sh_code);
				$user_info = $this->getUserInfo($sh_code);

				// 각 가맹점의 설정에 따라 처리합니다
				$oSmsAuto = new SmsAuto($sh_code);
				$config_data = $oSmsAuto->get('config_data');

				// config_data값이 없으면 넘어감
				if ((count($config_data['data']) < 1)) {
					continue;
				}

				foreach ($config_data['data'] as $method => $value_arr) {
					// 해당기능을 사용하지 않으면 넘어감
				
					if ($value_arr['use'] != 'Y') {
						continue;
					}

					$sms_tmp = array();

					switch ($method) {
						case 'noReservationLongTime':
							$current_method_list = dbSelect("(SELECT * FROM tbl_reserve WHERE sh_code='{$sh_code}' AND rs_state='E' ORDER BY rs_id desc) AS myView", '*', '', '', 'GROUP BY myView.cs_id');
							for ($i = 1; $i < 4; $i++) { // $i < 4
								if ($value_arr['option' . $i . '_use'] == 'Y') {
									$find_date = date("Y-m-d H:i", strtotime("-" . $value_arr['option' . $i . '_value'] . " days", $time));
									if (count($current_method_list) > 0) {
										foreach ($current_method_list as $cml_key => $cml_data) {
											if ($find_date == ($cml_data['rs_date'] . ' ' . $cml_data['rs_time'])) {
												$sms_tmp[] = $oSmsAuto->convertSms($method, $cml_data);
											}
										}
									}
								}
							}
							break;
						case 'birthday':
							// 설정한 시간과 일치한지 확인
							if (!(($value_arr['option2_value'] == date('H', $time)) && ($value_arr['option3_value']) == date('i', $time))) {
								continue;
							}

							// 찾을 날짜를 구합니다
							$find_date = '-';
							if ($value_arr['option1_value'] == '당일') {
								$find_date .= date("m", $time) . '-' . date("d", $time);
							} else if ($value_arr['option1_value'] == '전날') {
								$find_date .= date("m", strtotime("-1 days")) . '-' . date("d", strtotime("-1 days"));
							}

							$birthday_list = dbSelect('tbl_customer', '*', "WHERE sh_code='{$sh_code}' AND cs_birth LIKE '%{$find_date}'", '', '');
							if (count($birthday_list) > 0) {
								foreach ($birthday_list as $cs_key => $cs_data) {
									$sms_tmp[$cs_key] = $oSmsAuto->convertSms($method, $cs_data);
									// 제한시간 상관없이 무조건 보낸다고함
									$sms_tmp[$cs_key]['data']['sms_status'] = 'W';
								}
							}
							break;
						case 'celebrateOneAnniversary':
							if ($value_arr['option1_use'] == 'Y') {
								$find_date = date("Y-m-d", strtotime("-" . $value_arr['option1_value'] . " days", $time));
								$find_time = date("H:i", strtotime("-" . $value_arr['option1_value'] . " days", $time));

								$current_method_list = dbSelect('tbl_reserve', '*', "WHERE sh_code='{$sh_code}' AND rs_date='{$find_date}' AND rs_time='{$find_time}' AND rs_state='E'", '', '');
								if (count($current_method_list) > 0) {
									foreach ($current_method_list as $cml_key => $cml_data) {
										$sms_tmp[] = $oSmsAuto->convertSms($method, $cml_data);
									}	
								}
								
							}
							break;
						case 'beforeReservation':
							if ($value_arr['option1_use'] == 'Y') {
								$find_date = date("Y-m-d H:i", strtotime("+1 minutes", $time));
								$current_method_list = dbSelect('tbl_reserve', '*', "WHERE sh_code='{$sh_code}' AND ac_time LIKE '%{$find_date}%' AND rs_state='A'", '', '');
								if (count($current_method_list) > 0) {
									foreach ($current_method_list as $cml_key => $cml_data) {
										$sms_tmp[] = $oSmsAuto->convertSms($method, $cml_data);
									}
								}
							}
							if ($value_arr['option2_use'] == 'Y') {
								$find_unix = strtotime("-1 days", $time);
								$find_date1 = date("Y-m-d", $find_unix);
								$find_date2 = date("H:i", $find_unix);
								$current_method_list = dbSelect('tbl_reserve', '*', "WHERE sh_code='{$sh_code}' AND rs_date='{$find_date1}' AND rs_time='{$find_date2}' AND rs_state='A'", '', '');
								if (count($current_method_list) > 0) {
									foreach ($current_method_list as $cml_key => $cml_data) {
										$sms_tmp[] = $oSmsAuto->convertSms($method, $cml_data);
									}
								}
							}
							if ($value_arr['option3_use'] == 'Y') {
								$find_unix = strtotime("-1 hours", $time);
								$find_date1 = date("Y-m-d", $find_unix);
								$find_date2 = date("H:i", $find_unix);
								$current_method_list = dbSelect('tbl_reserve', '*', "WHERE sh_code='{$sh_code}' AND rs_date='{$find_date1}' AND rs_date='{$find_date2}' AND rs_state='A'", '', '');
								if (count($current_method_list) > 0) {
									foreach ($current_method_list as $cml_key => $cml_data) {
										$sms_tmp[] = $oSmsAuto->convertSms($method, $cml_data);
									}
								}
							}
							break;
					}

					if (count($sms_tmp) > 0) {
						foreach ($sms_tmp as $sms_key => $sms_data) {
							$sms['smscore_api_key'] = $sh_data['smscore_api_key'];
							$sms['smscore_mb_id'] = $sh_data['smscore_mb_id'];
							$sms['sms_type'] = $sms_data['data']['sms_type'];
							$sms['sms_sd_no'] = $config_data['sd_no'];
							$sms['sms_rc_no'] = $sms_data['data']['sms_rc_no'];
							$sms['sms_rc_name'] = $sms_data['data']['sms_rc_name'];
							$sms['sms_contents'] = $sms_data['data']['sms_contents'];
							$sms['sms_kind'] = $method;
							$sms['sms_status'] = $sms_data['data']['sms_status'];
							$this->set('enroll_sms', $sms);
							$result = $this->insertData();
						}
					}

				}
				$report_data = $oSmsAuto->get('report_data');
				// config_data값이 없으면 넘어감
				if ((count($report_data['data']) < 1)) {
					continue;
				}
				foreach ($report_data['data'] as $method => $value_arr) {
					$data_arr = array();
					switch ($method) {
						case 'report_amount':
							if ($value_arr['use'] == 'Y') {
								// 옵션에 대한 처리
								if ($value_arr['option2'] == date('H:i', $time)) {
									if ($user_info['data']['mb_cnt_sms'] < $value_arr['option1']) {
										$data_arr['sms_contents'] = $sh_data['sh_name'] . '의 메시지 충전 건수가 "' . number_format($user_info['data']['mb_cnt_sms']) . '"건 남았습니다.';
										$data_arr['smscore_api_key'] = $sh_data['smscore_api_key'];
										$data_arr['smscore_mb_id'] = $sh_data['smscore_mb_id'];
										$data_arr['sms_sd_no'] = $user_info['data']['sd_tel_no_arr'][0];
										$sms_length = $this->getSmsLength($data_arr['sms_contents']);
										$data_arr['sms_type'] = $sms_length['type'];
										$data_arr['sms_status'] = 'W';
										$data_arr['sms_kind'] = $method;
										$data_arr['sms_rc_name'] = $sh_data['sh_name'];

										if (count($report_data['rc_no']) > 0) {
											foreach ($report_data['rc_no'] as $rc_no) {
												$data_arr['sms_rc_no'] = $rc_no;
												$this->set('enroll_sms', $data_arr);
												$this->insertData();
											}
										}
									}
								}
							}
							break;
						case 'remain_to_user':
							if ($value_arr['use'] != 'Y') {
								break;
							}
							$list = dbSelect('tbl_reserve', "*", "where rs_state in ('A', 'P')", "", "");
							for($i = 0 ; $i < sizeof($list) ; $i++) {
								// 예약시간과의 현재시간의 차이
								$rs_time = strtotime($list[$i]['rs_date'] . ' ' . $list[$i]['rs_time'] . ':00');

								$s_gap_time = $rs_time - $time;
								/**
								 * 1. 예약시간알림
								 */
								if (($s_gap_time == 60 * 60)) {
									if (!isset($oPush)) {
										include_once(_MODULE_PATH_.'/push/push.class.php');
										$oPush = new Push();
										$oPush->init();
									}
									$arr = $oPush->getPushConfig($method, $list[$i]);
									$data_arr['sms_contents'] = $arr['content'];
									$data_arr['smscore_api_key'] = $sh_data['smscore_api_key'];
									$data_arr['smscore_mb_id'] = $sh_data['smscore_mb_id'];
									$data_arr['sms_sd_no'] = $user_info['data']['sd_tel_no_arr'][0];
									$data_arr['sms_rc_name'] = '자동알림';
									// 문자 타입을 구합니다 90바이트 아래면 Sms 위면 Lms
									$sms_length = $this->getSmsLength($data_arr['sms_contents']);
									$data_arr['sms_type'] = $sms_length['type'];
									$data_arr['sms_status'] = 'W';
									$data_arr['sms_kind'] = $method;
									if (count($report_data['rc_no']) > 0) {
										foreach ($report_data['rc_no'] as $rc_no) {
											$data_arr['sms_rc_no'] = $rc_no;
											$this->set('enroll_sms', $data_arr);
											$this->insertData();
										}
									}
								}
							}
							break;
					}
				}
				unset($oSmsAuto);
			}
		}
	}

	public function getSmsLength($contents)
	{
		$result['length'] = strlen(iconv('utf-8', 'euc-kr', $contents));

		if ($result['length'] < 91) {
			$result['type'] = 'S';
		} else {
			$result['type'] = 'L';
		}

		return $result;
	}

	// 등록된 SMS들을 처리합니다
	// W와 A를 찾는다
	// W는 처리하고
	// 상태를 구해와서 지금이 W이면 A도 처리한다 sms_send_time이 지나있으면 역시 보낸다
	public function processingEnrolled()
	{
		$this->set('data_table', 'tbl_sms');
		$this->set('select_table', 'tbl_sms');
		$this->set('select_field', '*');

		$sms_list = dbSelect($this->get('data_table'), $this->get('select_field'), "WHERE sms_status='W' AND (sms_send_time IS NULL OR sms_Send_time < now())", '', '');
		$this->processingEnrolledSend($sms_list);

		$oSmsAuto = new SmsAuto('');
		$sms_status = $oSmsAuto->getSmsStatus();

		if ($sms_status == 'W') {
			$sms_list = dbSelect($this->get('data_table'), $this->get('select_field'), "WHERE sms_status='A' AND (sms_send_time IS NULL OR sms_Send_time < now())", '', '');
			$this->processingEnrolledSend($sms_list);
		}
	}

	/**
	 * processingEnrolled에서 리스트를 구하면 그 리스트를 토대로 전송하고 업데이트 까지 한다
	 */
	private function processingEnrolledSend($sms_list)
	{
		if (count($sms_list) < 1) {
			return false;
		}
		foreach ($sms_list as $data) {
			$result = $this->sendSms($data);

			global $member;
			$upt_time = date('Y-m-d H:i:s');
			if ($result['code'] == 'success') {
				$sms_status = 'E';
			} else {
				$sms_status = 'C';
			}
			$upt_str = "sms_status='{$sms_status}',
						sms_result='{$result['code']}',
						sms_result_msg='{$result['msg']}',
						upt_id='{$member['mb_id']}',
						upt_time='{$upt_time}'";
			dbUpdate($this->get('data_table'), $upt_str, "WHERE sms_id='{$data['sms_id']}'", 1);
		}
	}



	/*
	 * sh_code를 이용하여 API키를 구해옵니다
	 */
	public function getAPIKeyByShCode($sh_code)
	{
		include_once(_MODULE_PATH_.'/shop/shop.class.php');
		$oShop = new Shop();
		$oShop->init();
		$result = $oShop->selectDetail($sh_code);

		return $result['smscore_api_key'];
	}

	/*
	 * sh_code를 이용하여 API키를 구해옵니다
	 */
	public function getAuthInfoByShCode($sh_code)
	{
		include_once(_MODULE_PATH_.'/shop/shop.class.php');
		$oShop = new Shop();
		$oShop->init();
		$result = $oShop->selectDetail($sh_code);

		return $result;
	}

	/*
	 * Shop의 정보를 구해옵니다.
	 * 샵에 API관련 값이 모두 있기때문에 그냥 샵을 부르는 것으로
	 */
	public function getShopInfo($sh_code)
	{
		include_once(_MODULE_PATH_.'/shop/shop.class.php');
		$oShop = new Shop();
		$oShop->init();
		$result = $oShop->selectDetail($sh_code);

		return $result;
	}

	/*
	 * 유저정보를 구해옵니다.
	 */
	public function getUserInfo($sh_code)
	{
		$sh_data = $this->getShopInfo($sh_code);
		$tmp['smscore_api_key'] = $sh_data['smscore_api_key'];
		$tmp['smscore_mb_id'] = $sh_data['smscore_mb_id'];

		$smscore = new Smscore($tmp['smscore_api_key'], $tmp['smscore_mb_id']);
		return $smscore->getUserInfo();
	}

	/*
	 * SQL작업 설정
	 */
	protected function initInsert()
	{
		$this->set('insert_field', 'sms_id,smscore_api_key,sms_type,sms_sd_no,sms_rc_no,sms_contents,sms_kind,sms_status');
		$this->set('required_field', 'smscore_api_key,sms_type,sms_sd_no,sms_rc_no,sms_contents,sms_kind');
		//$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr)
	{
		$arr = parent::convertInsert($arr);

		// $this->enrollSms가 먼저 실행되어져야함
		foreach ($this->get('enroll_sms') as $key => $value) {
			$arr[$key] = $value;
		}
		return $arr;
	}

	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);
	}

	// 튕기는 문제 방지
	protected function validateValues($arr) {
		$chk_key_arr = explode(',', $this->get('required_field'));

		for($i = 0 ; $i < sizeof($chk_key_arr) ; $i++) {
			$key = $chk_key_arr[$i];
			if(!$key) { continue; }
			if(!$arr[$key]) {
				if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
					$content = array(
						'type' => 'Validate error',
						'msg' => 'column : '.$key
					);
					//print_r($content);
				}
				return false;
			}
		}
		return true;
	}
}
?>