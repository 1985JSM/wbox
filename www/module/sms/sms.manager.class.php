<?php
if(!defined('_INPLUS_')) { exit; }

include_once(_MODULE_PATH_.'/sms/sms.class.php');

class SmsManager extends Sms
{
	public function joinToSmscore()
	{
		global $member;

		// smscore를 불러옵니다
		include_once $_SERVER['DOCUMENT_ROOT'] . '/plugin/Smscore/Smscore.php';
		$smscore = new Smscore();
		
		// 샵 정보를 불러옵니다.
		include_once(_MODULE_PATH_.'/shop/shop.class.php');
		$oShop = new Shop();
		$oShop->init();
		$sh_data = $oShop->selectDetail($member['sh_code']);

		$data['mb_partner'] = 'wbox';
		$data['mb_pt_id'] = $member['mb_id'];
		$data['mb_ci'] = $_POST['ct_ci'];
		$data['mb_di'] = $_POST['ct_di'];
		$data['mb_name'] = $_POST['ct_name'];
		$data['mb_birthday'] = substr($_POST['ct_birthday'], 0, 4) . '-' . substr($_POST['ct_birthday'], 4, 2) . '-' . substr($_POST['ct_birthday'], 6, 2);
		$data['mb_gender'] = $_POST['ct_gender'];
		$data['mb_email'] = $member['mb_email'];
		$data['mb_hp'] = $_POST['ct_phone'];
		$data['ct_nation'] = $_POST['ct_nation'];
		$data['mb_biz_name'] = $sh_data['sh_name'];
		$data['mb_biz_ceo'] = $member['mb_name'];
		$data['mb_biz_addr'] = $sh_data['sh_sido'] . ' ' . $sh_data['sh_sigungu'] . ' ' . $sh_data['sh_dong'] . $sh_data['sh_addr2'];
		$data['mb_biz_tel'] = $sh_data['sh_tel'];
		$data['mb_biz_email'] = $member['mb_email'];

		$result = $smscore->join($data);

		if ($result['code'] == 'success') {
			// 성공은 했지만 API_KEY를 받아오지 못했다면
			if ($result['mb_api_key'] == '') {
				$result['code'] = 'failed';
				$result['msg'] = '문제가 발생하였습니다. 문의게시판에 문의 바랍니다.';
			} // 키를 정상적으로 받아왔다면 정상처리
			else {
				print_r($this->updateKeyToAccount($result['mb_api_key'], $data['mb_partner'].'::'.$data['mb_pt_id'], $member['sh_code']));
			}
		} else if ($result['code'] == 'failure') {
			$result['msg'] = '문제가 발생하였습니다. 문의게시판에 문의 바랍니다.<br /> 문제 정보 : ' . $result['msg'];
		}
		return $result;
	}

	/*
	 * 성공했을 때 멤버에 api키를 업데이트합니다
	 */
	public function updateKeyToAccount($api_key, $mb_id, $sh_code)
	{
		if(!isset($oShop)) {
			include_once(_MODULE_PATH_.'/shop/shop.class.php');
			$oShop = new Shop();
			$oShop->init();
		}
		dbUpdate($oShop->get(data_table), "smscore_api_key='{$api_key}', smscore_mb_id='{$mb_id}'", "WHERE sh_code='{$sh_code}'");
	}

	/*
	 * (외부모듈에서) 필요한 정보들을 가져옵니다
	 */
	public function getArrOfInformation($what_you_want)
	{
		global $member;
		switch ($what_you_want) {
			case 'cs_level_arr':
				// 고객 등급을 구해오기 위함
				if(!isset($oCustomer)) {
					include_once(_MODULE_PATH_ . '/customer/customer.manager.class.php');
					$oCustomer = new CustomerManager();
					$oCustomer->init();
				}
				return $oCustomer->get('cs_level_arr');
				break;
			case 'st_id_arr':
				// 담당자 목록을 구해오기 위함
				if(!isset($oStaff)) {
					include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
					$oStaff = new StaffManager();
					$oStaff->init();
				}
				return $oStaff->selectStaffByShopCode($member['sh_code']);
				break;
			case 'sch_type_arr':
				if(!isset($oCustomer)) {
					include_once(_MODULE_PATH_ . '/customer/customer.manager.class.php');
					$oCustomer = new CustomerManager();
					$oCustomer->init();
				}
				return $oCustomer->get('sch_type_arr');
			default:
				return false;
		}
	}

	/*
	 * {method}에 따른 고객정보를 가져옵니다.
	 */
	public function getCustomerBy($method, $method_data = 0)
	{
		include_once(_MODULE_PATH_ . '/customer/customer.manager.class.php');
		$oCustomer = new CustomerManager();
		$oCustomer->init();
		$oCustomer->makeDBWhere();
		$make_where = $oCustomer->get('db_where');

		switch ($method) {
			case 'all':

				break;
			case 'direct':
				$make_where .= ' AND (cs_id=\'csid\'';
				foreach ($method_data as $key => $value) {
					$make_where .= " OR {$oCustomer->get('pk')}='{$value['cs_id']}'";
				}
				$make_where .= ')';

				$oCustomer->set('db_where', $make_where);
				return dbSelect($oCustomer->get('data_table'), '*', $make_where, "", "");
				break;
			case 'level':
				// sch_cs_level
				foreach ($method_data as $key => $value) {
					//$make_where .= " AND {$key}='{$value}'";
					$oCustomer->set($key, $value);
				}
				break;
			case 'staff':
				// sch_st_id
				foreach ($method_data as $key => $value) {
					$oCustomer->set($key, $value);
				}
				break;
			case 'reservation':
				return $oCustomer->getCustomersByCntReservations($method_data);
				break;
			default:
				return false;
		}

		return $oCustomer->selectList();
	}

	/*
	 * 유형에 따른 고객의 수를 구합니다
	 */
	public function getCustomerCnt($method, $method_data = 0)
	{
		$result = array(
			'total' => 0,
			'vetoer'=> 0
		);
		$data = $this->getCustomerBy($method, $method_data);

		if (count($data) > 0) {
			foreach ($data as $key => $value) {
				$result['total'] += 1;
				if ($value['flag_receive_sms'] == 'N') {
					$result['vetoer'] += 1;
				}
			}
		}
		

		return $result;
	}

	/*
	 * 수신 거부자를 걸러줍니다.
	 * user의 'flag_receive_sms'필드의 값을 통하여 구분합니다
	 */
	public function filterVetoer($data)
	{
		$result = array();
		if (count($data) > 0) {
			foreach ($data as $key => $value) {
				if ($value['flag_receive_sms'] == 'Y') {
					$result[$key] = $value;
				} else {
					continue;
				}
			}
		} else {
			return array(
				'code'	=> 'failed',
				'msg'   => '내용이 없습니다.'
			);
		}

		return $result;
	}

	/*
	 * 전송내역을 받아옵니다.
	 */
	public function getSendList()
	{
		global $member;

		// 메시지유형
		$this->set('sch_ms_type', array(
			'S'		=> 'SMS',
			'L'		=> 'LMS',
			'M'		=> 'MMS'
		));

		// 전송유형
		$this->set('sch_ms_rs_type', array(
			'D'		=> '즉시발송',
			'R'		=> '예약발송'
		));

		// 검색어
		$this->set('sch_like', array(
			'ms_sender_no'	    	=> '발신번호',
			'ms_receiver_no'		=> '수신번호',
			'ms_receiver_name'		=> '수신자명',
			'ms_content'		    => '내용'
		));

		// 기간유형
		$this->set('sch_date', array(
			'reg_time'		=> '요청일시',
			'ms_sd_time'	=> '결제일시'
		));

		// 상태
		$this->set('sch_ms_state', array(
			'W'		=> '대기중',
			'S'		=> '전송성공',
			'F'		=> '전송실패'
		));

		$auth_info = $this->getAuthInfoByShCode($member['sh_code']);

		include_once $_SERVER['DOCUMENT_ROOT'] . '/plugin/Smscore/Smscore.php';
		$smscore = new Smscore($auth_info['smscore_api_key'], $auth_info['smscore_mb_id']);
		$data = array(
			'page' => $this->get('page'),
			'sch_cnt_rows' => $this->get('sch_cnt_rows'),
			'sch_ms_type' => $_GET['sch_ms_type'],
			'sch_ms_rs_type' => $_GET['sch_ms_rs_type'],
			'sch_ms_state' => $_GET['sch_ms_state'],
			'sch_like'  => $_GET['sch_like'],
			'sch_text' => $_GET['sch_text'],
			'sch_date' => $_GET['sch_date'],
			'sch_s_date' => $_GET['sch_s_date'],
			'sch_e_date' => $_GET['sch_e_date']
		);
		$result = $smscore->getSendList($data);

		if ($result['cnt_current'] > 0) {
			foreach ($result['list'] as $key => $value) {
				// 결제 상태에 대한
				switch ($value['ms_state']) {
					case 'S':
						$result['list'][$key]['txt_ms_state_class'] = 'success';
						break;
					case 'W':
						$result['list'][$key]['txt_ms_state_class'] = 'info';
						break;
					case 'F':
						$result['list'][$key]['txt_ms_state_class'] = 'failed';
						break;
				}

				$result['list'][$key]['ms_sd_time'] = str_replace(' ', '<br />', $value['ms_sd_time']);
			}
		}
		return $result;
	}

	/**
	 * 결제 내역을 받아옵니다.
	 */
	public function getPayList()
	{
		global $member;

		// 결제수단
		$this->set('pa_method', array(
			'C'		=> '신용카드',
			'V'		=> '계좌이체',
			'B'		=> '무통장입금'
		));

		// 결제상태
		$this->set('pa_state', array(
			'W'		=> '결제대기',
			'P'		=> '결제완료',
			'C'		=> '취소요청',
			'R'		=> '환불완료'
		));

		// 기간유형
		$this->set('sch_date', array(
			'reg_time'		=> '요청일시',
			'pa_pay_time'	=> '결제일시'
		));

		$auth_info = $this->getAuthInfoByShCode($member['sh_code']);

		include_once $_SERVER['DOCUMENT_ROOT'] . '/plugin/Smscore/Smscore.php';
		$smscore = new Smscore($auth_info['smscore_api_key'], $auth_info['smscore_mb_id']);

		$data = array(
			'page' => $this->get('page'),
			'sch_cnt_rows' => $this->get('cnt_rows'),
			'sch_pa_method' => $_GET['sch_pa_method'],
			'sch_pa_state' => $_GET['sch_pa_state'],
			'sch_date' => $_GET['sch_date'],
			'sch_s_date' => $_GET['sch_s_date'],
			'sch_e_date' => $_GET['sch_e_date']
		);

		$result = $smscore->getPayList($data);

		if ($result['cnt_current'] > 0) {
			foreach ($result['list'] as $key => $value) {
				// 결제 상태에 대한
				switch ($value['pa_state']) {
					case 'P':
						$result['list'][$key]['txt_pa_state'] = 'success';
						break;
					case 'W':
						break;
				}

				// 결제 성공이면 그에 따른 영수증 출력
				if ($value['pa_state'] == 'P') {
					switch ($value['pa_method']) {
						case 'C': // 신용카드
							$result['list'][$key]['print_receipt'] = '<a href="javascript:showReceiptByTID(\'LGD_MID\', \'LGD_TID\', \'' . $value['pa_bill_no'] . '\')" class="sButton tiny">전표</a>';
							break;
						case 'V': // 계좌이체
							$result['list'][$key]['print_receipt'] = '<a href="javascript:showCashReceipts(\'LGD_MID\',\'LGD_OID\',\'' . $value['pa_bill_no'] . '\',\'BANK\',\'test\')" class="sButton tiny">현금영수증</a>'; // 서비스는 service 테스트는 test
							break;
					}
				}

				$result['list'][$key]['pa_pay_datetime'] = str_replace(' ', '<br />', $value['pa_pay_datetime']);
			}
		}
		return $result;
	}

	/**
	 * MMS 이미지 등록시
	 */
    public function insertMmsImage($pr_uid)
    {
        $this->set('module','sms');
        $this->set('max_file',3);
        parent::uploadFiles($pr_uid);
        $ord_field = 'reg_time';
        $db_where = " where pr_uid = '$pr_uid' and pr_module = 'sms' ";


        $data = dbOnce($this->get('file_table'), "file_id", $db_where, "order by $ord_field desc");
        if($data){
            $result['code'] = 'success';
            $result['url'] = './ajax.mms_list.html';
        }

        return $result;
    }
}