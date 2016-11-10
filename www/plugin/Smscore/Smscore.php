<?php
class Smscore
{
	// URL입니다
	protected $host = 'http://smscore.co.kr';

	/**
	 * 클래스 호출 시 api key와 주소를 정의합니다.
	 *
	 */
	function __construct($api_key = '', $mb_id = '')
	{
		if ($api_key == '') {
			$this->no_key = true;
		}
		$this->mb_api_key = $api_key;
		$this->mb_id = $mb_id;
		$this->default_param = "mb_id={$mb_id}&mb_api_key={$api_key}&";
	}

	/**
	 * SMS코어에 가입합니다.
	 * 배열을 인자로 받습니다.
	 * 회원가입에 필요한 파라미터와 그 값들을 배열에 같은 형태로 적습니다 (???)
	 */
	public function join($data)
	{
		$post = '';
		$available_key = array(
							"mb_partner",
							"mb_pt_id",
							"mb_di",
							"mb_ci",
							"mb_name",
							"mb_gender",
							"mb_birthday",
							"mb_email",
							"mb_hp",
							"mb_biz_name",
							"mb_biz_ceo",
							"mb_biz_addr",
							"mb_biz_email",
							"mb_biz_tel",
							"mb_biz_no",
							"mb_biz_type",
							"mb_biz_item"
						);

		foreach ($data as $key => $value) {
			// 필요한 데이터만 뽑아냅니다
			if (in_array($key, $available_key)) {
				if ($post != '') {
					$post .= '&';
				}
				$post .= "{$key}={$value}";
			}
		}

		return $this->curlRequest('/webapi/member/join.html', 'post', $post);
	}

	/*
	 * SMS를 전송합니다
	 * ms_type : 메시지 유형 (S:SMS, L:LMS, M:MMS)
	 * ms_content : 메시지 내용
	 * rc_no : 수신번호
	 * sd_no : 발신번호
	 * rs_type : 전송 유형
	 * rs_time : (전송 유형이 1인 예약 전송일 때) 전송 예약 일시
	 */
	public function send($data)
	{
		
		$available_key = array(
							"ms_type",
							"ms_sender_no",
							"ms_receiver_name[]",
							"ms_receiver_no[]",
							"ms_content",
							"ms_rs_type",
							"ms_rs_time",
							"ms_file1",
							"ms_file2",
							"ms_file3"
						);
		$post = $this->convertParamToStr($data, $available_key);

		// API요청과 결과 값 파싱
		// 결과값은 오브젝트가 됩니다
		return $this->curlRequest('/webapi/message/send.html', 'post', $post);
	}

	/*
	 * 발신번호를 구해옵니다
	 */
	public function getSenderNum()
	{
		$result[] = '01011112222';
		$result[] = '01033334444';
		return $result;
	}

	// 발송내역을 받아옵니다
	public function getSendList($data)
	{
		$available_key = array(
			"sch_ms_type",
			"sch_ms_rs_type",
			"sch_ms_state",
			"sch_like",
			"sch_text",
			"sch_date",
			"sch_s_date",
			"sch_e_date",
			"sch_cnt_rows",
			"page"
		);
		$post = $this->convertParamToStr($data, $available_key);
		return $this->curlRequest('/webapi/message/list.html', 'post', $post);
	}

	// 결제내역을 받아옵니다
	public function getPayList($data)
	{
		$available_key = array(
			"sch_pa_type",
			"sch_pa_method",
			"sch_pa_state",
			"sch_like",
			"sch_date",
			"sch_s_date",
			"sch_e_date",
			"sch_text",
			"sch_cnt_rows",
			"page"
		);
		$post = $this->convertParamToStr($data, $available_key);
		return $this->curlRequest('/webapi/payment/list.html', 'post', $post);
	}

	/*
	 * getSenderNum을 통하여서 해당하는 번호가 유효한지 확인
	 */
	public function checkValidSdno($hp_num)
	{
		return in_array($hp_num, $this->getSenderNum());
	}

	/**
	 * 사용자 정보를 구해옵니다.
	 */
	public function getUserInfo($option = 'all')
	{
		$data = 'mb_id=' . $this->mb_id . '&mb_api_key=' . $this->mb_api_key;
		$result = $this->curlRequest('/webapi/member/info.html', 'post', $data);
		
		if ($option == 'sd_no') {
			return $result['sd_tel_no_arr'];
		}

		return $result;
	}

	private function convertParamToStr($data_arr, $available_key_arr)
	{
		$post = $this->default_param;
		if (count($data_arr) < 1) {
			return $post;
		}
		foreach ($data_arr as $key => $value) {
			// 필요한 데이터만 뽑아냅니다
			if (in_array($key, $available_key_arr)) {
				if ($post != '') {
					$post .= '&';
				}
				$post .= "{$key}={$value}";
			}
		}
		return $post;
	}

	/* 
	 * CURL요청을 보냅니다 
	 */
	private function curlRequest($path, $method='', $data='')
	{
		$url = $this->host . $path;

		$handle = curl_init();
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		if ($method == 'post') {
			curl_setopt($handle, CURLOPT_POST, true);
			curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
		}
		
		$result = json_decode(curl_exec($handle), true);
		curl_close($handle);

		return $result;
	}

}