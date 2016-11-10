<?
if(!defined('_INPLUS_')) { exit; }

$oSms = new SmsManager();
$sh_data = $oSms->getShopInfo($member['sh_code']);
putLog($sms_send_text);
// SMS -> SMS전송에서 테스트 전송
if ($mode == 'test_sending') {
	$data = array(
		'smscore_api_key' => $sh_data['smscore_api_key'],
		'smscore_mb_id' => $sh_data['smscore_mb_id'],
		'sms_sd_no' => $sms_sd_no,
		'sms_rc_no' => $tester_hp,
		'sms_rc_name' => $tester_name,
		'sms_contents' => $send_text,
		'sms_kind'	=> 'direct_test'
	);

	echo json_encode($oSms->sendSms($data));
}

// SMS -> SMS전송에서 전송하기
else if ($mode == 'typeRecipient') {
	$result = array();

	$i = 0;
	$sms_hp_sent_arr = array();
	$result = array();
	if ($sms_rs_hour == "") {
		$sms_rs_hour = 0;
	}
	if ($sms_rs_minutes == "") {
		$sms_rs_minutes = 0;
	}

	// 성공 실패항목 카운트
	$result_tmp = array(
		'success'   => 0,
		'failed'    => 0
	);

	while (1) {
		if (!empty(${'recipient_'.$i.'_name'})) {
			// 보낼 데이터값들 정리
			$data = array();
			$data['smscore_api_key'] = $sh_data['smscore_api_key'];
			$data['smscore_mb_id'] = $sh_data['smscore_mb_id'];
			$data['sms_type'] = 'S';
			$data['sms_sd_no'] = $sms_sd_no;
			$data['sms_rc_no'] = ${'recipient_'.$i.'_hp'};
			$data['sms_rc_name'] = ${'recipient_'.$i.'_name'};
			$data['sms_kind'] = 'direct';
			$data['sms_contents'] = $sms_send_text;
			if ($sms_rs == 'R') {
				$data['sms_rs_type'] = $sms_rs_type;
				$data['sms_rs_time'] = $sms_rs_date . ' ' . $sms_rs_hour . ':' . $sms_rs_minutes;
			} else {
				$data['sms_rs_type'] = 0;
			}
			// 중복검사 체크 옵션
			if ($sms_remove_repeated == 'Y') {
				if ((count($sms_hp_sent_arr) > 0) && in_array($data['sms_rc_no'], $sms_hp_sent_arr)) {
					$result[$i] = array('code'=>'failed', 'msg'=>'중복된 번호입니다.');
					$i++;
					continue;
				}
				$sms_hp_sent_arr[$i] = $data['rc_no'];
			}

			// SMS전송과 결과값 저장
			$result = $oSms->sendSms($data);
			if ($result['cnt_success'] > 0) {
				$result_tmp['success']++;
			} else {
				$result_tmp['failed']++;
				$result_tmp['log'][] = $result['msg'];
			}
		} else {
			break;
		}
		$i++;
	}
	$result_tmp['code'] = 'success';
	echo json_encode($result_tmp);
}

// 고객 선택 전송
else if ($mode == 'memberSelect') {
	$customer_list = array();
	$sms_hp_sent_arr = array();
	switch ($mode_memberSelect) {
		case 'chk_sort_direct':
			$cs_id_data = array();
			$i = 0;
			while (1) {
				if (!empty(${'recipient_'.$i.'_csid'})) {
					// 보낼 데이터값들 정리
					$cs_id_data[$i]['cs_id'] = ${'recipient_'.$i.'_csid'};

				} else {
					break;
				}
				$i++;
			}

			$customer_list = $oSms->getCustomerBy('direct', $cs_id_data);
			break;
		case 'chk_sort_level':
			$customer_list = $oSms->getCustomerBy('level', array(
				'sch_cs_level' => $sch_cs_level
			));
			break;
		case 'chk_sort_all':
			$customer_list = $oSms->getCustomerBy('all');
			break;
		case 'chk_sort_staff':
			$customer_list = $oSms->getCustomerBy('staff', array(
				'sch_st_id' => $sch_st_id
			));
			break;
		default:
			return false;
	}

	if (count($customer_list) < 1 ) {
		echo json_encode(array(
			"result"=>"failed",
			"msg"	=>"선택된 고객이 없습니다."
			));
		return false;
	}

	
	if ($filter_vetoer) {
		$customer_list = $oSms->filterVetoer($customer_list);
	}
	
	foreach ($customer_list as $key => $value) {
		$result[$key] = $value['sh_code'];
	}
	$sh_data = $oSms->getShopInfo($member['sh_code']);

	// 전송
	foreach ($customer_list as $key => $value) {
		// 보낼 데이터값들 정리
		$data = array();
		$data['smscore_api_key'] = $sh_data['smscore_api_key'];
		$data['smscore_mb_id'] = $sh_data['smscore_mb_id'];
		$data['sms_sd_no'] = $sms_sd_no;
		$data['sms_rc_no'] = $value['cs_hp'];
		$data['sms_rc_name'] = $value['cs_name'];
		$data['sms_kind'] = 'direct';
		$data['sms_contents'] = $sms_send_text;
		if ($sms_rs_type == 'R') {
			$data['sms_rs_type'] = $sms_rs_type;
			$data['sms_rs_time'] = $sms_rs_date . ' ' . $sms_rs_hour . ':' . $sms_rs_minutes;
		} else {
			$data['sms_rs_type'] = 0;
		}

		// 중복검사 체크 옵션
		if ($sms_remove_repeated == 'Y') {
			if ((count($sms_hp_sent_arr) > 0) && in_array($data['sms_rc_no'], $sms_hp_sent_arr)) {
				$result[$key] = array('code'=>'failure', 'msg'=>'중복된 번호입니다.');
				continue;
			}
			$sms_hp_sent_arr[$i] = $data['rc_no'];
		}
		// SMS전송과 결과값 저장
		$result[$key] = $oSms->sendSms($data);

	}

	// 성공 실패항목 카운트
	$result_tmp = array(
		'success'   => 0,
		'failed'    => 0
	);
	foreach ($result as $value) {
		if ($value['cnt_success'] > 0) {
			$result_tmp['success']++;
		} else {
			$result_tmp['failed']++;
		}
		$result_tmp['log'][] = $value['msg'];
	}
	$result_tmp['code'] = 'success';

	echo json_encode($result_tmp);
	//print_r($result);
}else if ($mode == 'mms_image_insert') {
    $uid = $_POST['uid'];
    $result = $oSms->insertMmsImage($uid);
}