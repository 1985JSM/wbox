<?
if(!defined('_INPLUS_')) { exit; }
/*
 * sh_code를 기본으로 적어야합니다.
 *
 */
class SmsAuto extends StdController
{
	function __construct($sh_code)
	{
		$this->init();
		$this->set('sh_code', $sh_code);
		$this->set('module', 'sms_auto');
		$this->set('module_name', 'SMS자동 전송');

		$this->set('data_table', 'tbl_sms_auto');

		$this->set('select_table', $this->get('data_table'));
		$this->set('select_field', '*');

		$this->set('page', 1);
		$this->set('cnt_rows', 1);

		$this->set('pk', 'sa_id');

		$this->set('substitution_code', array(
			'default' => array(
				'us_name'       => '{사용자이름}',
				'sh_name'       => '{가맹점명}'
			),
			'reservation' => array(
				'sv_name'       => '{예약:서비스명}',
				'rs_date'       => '{예약:예약일시}',
				'st_name'       => '{예약:담당자명}',
				'sv_time'       => '{예약:소요시간}',
				'sv_price'      => '{예약:시술금액}',
				'pm_sale_price' => '{예약:일반할인금액}',
				'total_price'   => '{예약:실제결제금액}'
			),
			'advance' => array(

			)
		));

		// 설정 값을 불러옵니다.
		$data = $this->selectList();
		if ($data != '') {
			$this->set('is_set', true);
		}
		$config_data = json_decode($data[0]['sa_config_data'], true);
		
		$this->set('config_data', $config_data);
		$this->set('sd_no', $config_data['sd_no']);
		$this->set('report_data', json_decode($data[0]['sa_report_data'], true));

		$this->set('uid', $data[0]['sa_id']);

		include_once(_MODULE_PATH_.'/sms/sms.class.php');
		$this->oSms = new Sms();
	}

	/**
	 * 자동 문자를 설정하는 값입니다
	 * 이 곳에서 추가 삭제 수정을 하시면 됩니다
	 *
	 * 구조
	 * title
	 * description
	 * hint
	 * use
	 * option_text
	 * contents
	 *
	 * Type 설정 방법
	 * {method}_{time}
	 * method : 1. afterTheEvent  - {time} 후에 실행한다.
	 *          2. beforeTheEvent - {time} 전에 실행한다.
	 *          3. atTheEvent     - {time} 때 실행한다. (unixtime만 사용 권함)
	 * time : 1. seconds  - 초
	 *        2. minutes  - 분
	 *        3. hours    - 시
	 *        4. days     - 날
	 *        5. unixtime - (atTheEvent에서만 사용 권함) 특정 날짜
	 *        6. birthday - 생일에서만 사용하는 특별한 경우
	 *
	 * code_type -> substitution_code 참조합니다
	 */
	public function defineNotificationList($method = 'all')
	{
		// 변경 가능한 문자 목록
		$result['var'] = array(
			'firstCompleteReservation'      => array(
				'title'             => '신규고객 방문 안내',
				'description'       => '신규(최초) 방문(예약) 고객이 시술 완료 후<br />설정된 시간에 자동 메시지가 전송됩니다.<br />(※단, 예약 상태가 "완료"로 변경된 경우 입니다.)',
				'hint'              => '시술 이용과 별개의 안내메시가 있는 경우 이용합니다.',
				'option1_input_type'=> 'text',
				'option1_type'      => 'afterTheEvent_hours',
				'option1_printed'   => '시술완료 {{input}} 시간 후 자동전송',
				'option_text'       => '※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 상태변경 즉시 전송',
				'code_type'         => 'reservation'
			),
			'completeReservation'           => array(
				'title'             => '기존고객 방문 안내',
				'description'       => '2회 이상 방문(예약) 고객이 시술 완료 후<br />설정된 시간에 자동 메시지가 전송됩니다.<br />(※단, 예약 상태가 "완료"로 변경된 경우 입니다.)',
				'hint'              => '시술 이용과 별개의 안내메시가 있는 경우 이용합니다.',
				'option1_input_type'=> 'text',
				'option1_type'      => 'afterTheEvent_hours',
				'option1_printed'   => '시술완료 {{input}} 시간 후 자동전송',
				'option_text'       => '※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 상태변경 즉시 전송',
				'code_type'         => 'reservation'
			),
			'noReservationLongTime'         => array(
				'title'             => '미방문(예약) 안내',
				'description'       => '최종 시술완료 후 장/단시간 방문(예약)이 없을 경우<br />설정된 시간에 자동 메시지가 전송됩니다.<br />(※단, 최종 시술이 "완료"된 상태 기준입니다.)',
				'hint'              => '',
				'option1_input_type'=> 'text',
				'option1_type'      => 'afterTheEvent_day',
				'option1_printed'   => '{{input}} 일 동안 미방문 자동전송 ',
				'option1_check_use' => true,
				'option2_input_type'=> 'text',
				'option2_type'      => 'afterTheEvent_day',
				'option2_printed'   => '{{input}} 일 동안 미방문 자동전송 ',
				'option2_check_use' => true,
				'option3_input_type'=> 'text',
				'option3_type'      => 'afterTheEvent_day',
				'option3_printed'   => '{{input}} 일 동안 미방문 자동전송 ',
				'option3_check_use' => true,
				'option_text'       => '※ 1일 단위로 숫자만 입력'
			),
			'birthday'                      => array(
				'title'             => '생일 안내',
				'description'       => '가맹점 관리고객 생일자에게 설정된 시간에<br />자동 메시지가 전송됩니다.<br />(※단, 생일 정보가 있는 고객의 경우 입니다.)',
				'hint'              => '',
				'option1_input_type'=> 'select',
				'option1_type'      => 'atTheEvent_birthday',
				'option1_printed'   => '생일 {{input}} 자동전송<br />',
				'option2_input_type'=> 'select',
				'option2_type'      => 'atTheEvent_hours',
				'option2_printed'   => '전송 예약시간 {{input}} 시 ',
				'option3_input_type'=> 'select',
				'option3_type'      => 'atTheEvent_minutes',
				'option3_printed'   => '{{input}}분',
				'option_text'       => '※ 발송 제한 시간 설정이 적용안됨'
			),

			'celebrateOneAnniversary'       => array(
				'title'             => '이벤트 안내',
				'description'       => '신규(최초) 방문(예약) 후 1년 감사/이벤트 메시지가<br />설정된 시간에 자동 전송됩니다.<br />(※단, 첫 예약 상태가 "완료"일로부터 1년째 되는날의 기준입니다.)',
				'hint'              => '',
				'option1_input_type'=> 'text',
				'option1_type'      => 'afterTheEvent_days',
				'option1_printed'   => '첫 방문 후 {{input}} 일째',
				'option_text'       => '※ 1일 단위로 숫자만 입력'),
			'beforeReservation'              => array(
				'title'             => '예약 시술 전 예약 안내',
				'description'       => '노쇼 방지를 위해 예약완료 고객에게 설정된 시간에<br />자동 메시지가 전송됩니다.<br />(※단, 담당자가 예약승인을 완료한 <br />고객의 경우 입니다.)',
				'hint'              => '',
				//'option1_input_type'=> 'text',
				'option1_type'      => 'afterTheEvent_day',
				'option1_printed'   => '담당자 예약 승인 즉시 전송',
				'option1_check_use' => true,
				//'option2_input_type'=> 'text',
				'option2_type'      => 'afterTheEvent_day',
				'option2_printed'   => '예약일 하루전 예약시간 전송',
				'option2_check_use' => true,
				//'option3_input_type'=> 'text',
				'option3_type'      => 'afterTheEvent_day',
				'option3_printed'   => '예약 1시간전 전송',
				'option3_check_use' => true
			)
		);

		// 변경 불가능한 문자 목록
		$result['let'] = array(
			'purchaseAdvanceDefault'        => array(
				'title'             => '선불제 구매 안내',
				'description'       => '선불제를 구입한 경우 구매 상세내역을<br />자동으로 설정된 시간에 메시지가 전송됩니다.<br />(※단, 선불제 신규등록 고객의 경우 입니다.) ',
				'hint'              => '고객의 선불제 사용 유형에 따라 메시지가 전송됩니다.',
				'contents'          => '사랑합니다. {사용자이름}님! {가맹점명}입니다. &#10;&#10;{가맹점명} 선불제 구입에 감사드리며, 상세 구입내역을 알려드립니다. &#10;&#10;- 선불제유형: {선불제:유형}&#10;- 전체: { 총 사용유형}&#10;- 사용: {사용한 사용유형}&#10;- 잔여: {선불제:잔여}&#10;- 사용기간: {선불제:사용기간}&#10;&#10;감사합니다. ^^',
				'option1_input_type'=> 'text',
				'option1_type'      => 'afterTheEvent_hours',
				'option1_printed'   => '등록 후 {{input}} 시간 후 자동전송',
				'option_text'       => '※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 등록 후 즉시 전송',
				'readonly'          => true),
			'useAdvanceDefault'             => array(
				'title'             => '선불제 사용 안내',
				'description'       => '선불제를 구입한 고객이 사용할때 마다 잔여량을<br />자동으로 설정된 시간에 자동 메시지가 전송됩니다.<br />(※단, 선불제 구입 및 결제정보 입력의 경우 입니다.) ',
				'hint'              => '고객의 선불제 사용 유형에 따라 메시지가 전송됩니다.',
				'contents'          => '사랑합니다. {사용자이름}님! {가맹점명}입니다. &#10;&#10;{가맹점명} 선불제 이용내역을 알려드립니다.&#10;- {선불제:유형}:{사용유형}을 이용하셨습니다.&#10;&#10;사용후 남은 선불제 내역입니다. - 전체: {선불제:전체} &#10;- 사용: {선불제:사용} &#10;- 잔여: {선불제:잔여} &#10;- 사용기간: {선불제:사용기간} &#10;&#10;감사합니다. ^^',
				'option_text'       => '※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 상태변경 즉시 전송',
				'option1_input_type'=> 'text',
				'option1_type'      => 'afterTheEvent_hours',
				'option1_printed'   => '선불제 사용 {{input}} 시간 후 자동전송',
				'readonly'          => true),
			'completeReservationDefault'    => array(
				'title'             => '시술 이용 완료 안내',
				'description'       => ' 시술완료 후 고객에게 시술내역 메시지가<br />설정된 시간에 자동 전송됩니다.<br />(※단, 예약 상태가 "완료"로 변경된 경우 입니다.) ',
				'hint'              => '고객 이용내역에 따라 메시지가 전송됩니다.',
				'contents'          => '사랑합니다. {사용자이름}님! {가맹점명}입니다. &#10;&#10;{가맹점명} 시술 이용내역을 알려드립니다. &#10;- 예약일자: {예약일시}&#10;- 서비스명: {서비스명}&#10;- 담당자: {담당자명} &#10;- 소요시간: {소요시간}분&#10;- 금액: {시술금액} &#10;- 할인: {일반할인}원 &#10;- 쿠폰: {쿠폰명}/{쿠폰할인금액}원 &#10;- 실제 결제금액: {실제결제금액} &#10;&#10;감사합니다. ^^',
				'option_text'       => '※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 상태변경 즉시 전송',
				'option1_input_type'=> 'text',
				'option1_type'      => 'afterTheEvent_hours',
				'option1_printed'   => '시술완료 {{input}} 시간 후 자동전송',
				'code_type'         => 'reservation',
				'readonly'          => true)
		);

		if ($method != 'all') {
			foreach ($result as $type => $data_arr) {
				foreach ($data_arr as $key => $value) {
					if ($key == $method) {
						$result = $data_arr[$key];
						break;
					}
				}
			}
		}
		return $result;
	}

	public function defineReportList($method = 'all')
	{
		$result = array(
			'report_amount'     => array(
				'condition_description' => '충전건수가 설정된 값 이하가 될 때 알림 시간에 알림',
				'contents'  => '메시지 충전 건수',
				'option'    => array(
					'option1',
					'option2'
				),
				'use'       => 'N'
			),
			'reserve_to_staff'      => array(
				'condition_description' => '예약이 접수된 경우 담당자에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.',
				'contents' => '푸시 메시지와 동일',
				'use'   => 'N'
			),
			'accept_to_user'        => array(
				'condition_description' => '담당자 예약 승인한 경우 고객에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.',
				'contents' => '푸시 메시지와 동일',
				'use'   => 'N'
			),
			'remain_to_user'        => array(
				'condition_description' => '예약시간이 도래할 경우 고객에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.',
				'contents' => '푸시 메시지와 동일',
				'use'   => 'N'
			)
		);

		return $result;
	}

public function test1($data)
{
	global $member;
	$log_file = $_SERVER['DOCUMENT_ROOT'].'/data/log/smstest.txt';
	$mb_id = $member['mb_id'];
	if(!$mb_id) { $mb_id = 'guest'; }
	$time = date('Y-m-d H:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];

	$content = '['.$time.']['.$ip.']['.$mb_id.']	';
	ob_start();
	print_R($data);
	$content .= ob_get_contents();
	ob_end_clean();

	file_put_contents($log_file, $content, FILE_APPEND);
	@chmod($log_file, 0707);
}
	/**
	 * 자동알림 설정을 추가하기 위한 함수입니다.
	 * 해당 가맹점의 데이터가 없으면 추가합니다.
	 *
	 * 프로세스가 변경버튼을 누르면 업데이트밖에 하지않는데,
	 * 업데이트 할 row가 없으면 안되므로
	 */
	public function initSetup()
	{
		if (($this->get('is_set') == false) && ($this->get('sh_code') != '')) {
			$this->insertData();
		}
	}

	/*
	 * 리스트에서 사용할 데이터를 불러옵니다
	 */
	public function getListData()
	{
		$list = $this->defineNotificationList();
		$config_data = $this->get('config_data');
		$config_data = $config_data['data'];
		$result = $list;

		foreach ($list as $sort => $data_arr) {
			if (count($config_data) > 0) {
				foreach ($config_data as $method => $value_arr) {
					foreach ($value_arr as $key => $value) {
						if (is_array($list[$sort][$method])) {
							$result[$sort][$method][$key] = $value;
						}
					}
				}
			}
			
		}

		return $result;
	}

	/**
	 * 발신제한시간을 구합니다
	 */
	public function getRestrictTime()
	{
		$get_time = $this->get('config_data');
		$get_time = $get_time['restrict_time'];

		$result['time1_start'] = explode(':', $get_time['time1_start']);
		$result['time1_end'] = explode(':', $get_time['time1_end']);
		$result['time2_start'] = explode(':', $get_time['time2_start']);
		$result['time2_end'] = explode(':', $get_time['time2_end']);

		return $result;
	}

	/**
	 * sms에 등록할 수 있도록 데이터들을 가공합니다
	 *
	 * 하는 일
	 * 메시지 내용 생성
	 * 발신제한시간 연동
	 * 수신번호 설정
	 */
	public function convertSms($method, $sms_data)
	{
		$result['data'] = $sms_data;
		$config_data = $this->get('config_data');
		//print_r($config_data);
		$current_time['hours'] = date('h');
		$current_time['minutes'] = date('m');
		if ($this->get('is_set') == false) {
			return array(
				'code'  => 'failed',
				'msg'   => '자동 문자전송이 등록되지 않았습니다.'
			);
		}

		// 치환할 문자 설정
		// 코드와 값은 배열의 키 값을 사용합니다
		$code_arr_origin = $this->get('substitution_code');
		$code_arr = $code_arr_origin['default'];
		$original_config_data = $this->defineNotificationList($method);
		if ($original_config_data['code_type'] != '') {
			foreach ($code_arr_origin[$original_config_data['code_type']] as $key => $value) {
				$code_arr[$key] = $value;
			}
		}

		// 샵 이름을 가지고 오기 위함
		include_once(_MODULE_PATH_.'/shop/shop.class.php');
		$oShop = new Shop();
		$oShop->init();
		$sh_data = $oShop->selectDetail($this->get('sh_code'));
		$sms_data['sh_name'] = $sh_data['sh_name'];
		// api key 저장
		$result['data']['smscore_api_key'] = $sms_data['smscore_api_key'];
		$result['data']['smscore_mb_id'] = $sms_data['smscore_mb_id'];

		// 콘텐츠 내용 입력
		$text = $config_data['data'][$method]['contents'];
		switch ($method) {
			case 'firstCompleteReservation':
				$result['data']['sms_rc_no'] = $sms_data['us_hp'];
				$result['data']['sms_rc_name'] = $sms_data['us_name'];
				break;
			case 'completeReservation':
				$result['data']['sms_rc_no'] = $sms_data['us_hp'];
				$result['data']['sms_rc_name'] = $sms_data['us_name'];
				break;
			case 'noReservationLongTime':
				include_once(_MODULE_PATH_.'/customer/customer.class.php');
				$oCustomer = new Customer();
				$oCustomer->init();
				$cs_data = $oCustomer->selectDetail($sms_data['cs_id']);

				$sms_data['us_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_no'] = $cs_data['cs_hp'];
				break;
			case 'birthday':
				$sms_data['us_name'] = $sms_data['cs_name'];
				$result['data']['sms_rc_name'] = $sms_data['cs_name'];
				$result['data']['sms_rc_no'] = $sms_data['cs_hp'];

				break;
			case 'celebrateOneAnniversary':
				include_once(_MODULE_PATH_.'/customer/customer.class.php');
				$oCustomer = new Customer();
				$oCustomer->init();
				$cs_data = $oCustomer->selectDetail($sms_data['cs_id']);

				$sms_data['us_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_no'] = $cs_data['cs_hp'];
				break;
			case 'beforeReservation':
				include_once(_MODULE_PATH_.'/customer/customer.class.php');
				$oCustomer = new Customer();
				$oCustomer->init();
				$cs_data = $oCustomer->selectDetail($sms_data['cs_id']);

				$sms_data['us_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_no'] = $cs_data['cs_hp'];
				break;
			case 'purchaseAdvanceDefault':
				$text = '사랑합니다. {사용자이름}님! {가맹점명}입니다. &#10;&#10;{가맹점명} 선불제 구입에 감사드리며, 상세 구입내역을 알려드립니다. &#10;&#10;- 선불제유형: {선불제:유형}&#10;';
				include_once(_MODULE_PATH_.'/advance_purchase/advance_purchase.class.php');
				$oAdvancePurchase = new AdvancePurchase();
				$oAdvancePurchase->init();
				$ap_data = $oAdvancePurchase->selectDetail($sms_data['ad_pc_id']);

				// 선불제, 이용권
				if ($ap_data['ad_pc_type'] == 'M' || $ap_data['ad_pc_type'] == 'Q') {
					if ($ap_data['ad_pc_type'] == 'M') {
						$sms_data['txt_ad_pc_type'] = '정액권';
					} else {
						$sms_data['txt_ad_pc_type'] = '이용권';
					}

					$sms_data['ad_pc_quantity'] = $ap_data['ad_pc_quantity'];
					$sms_data['remain_quantity'] = $ap_data['remain_quantity'];
					$code_arr['ad_pc_quantity'] = '{선불제:전체}';
					$code_arr['remain_quantity'] = '{선불제:잔여}';
					$code_arr['cnt_charge'] = '{선불제:충전횟수}';
					$text .= '&#10;- 전체: {선불제:전체}&#10;- 충전횟수: {선불제:충전횟수}&#10;- 잔여: {선불제:잔여}';
				}
				// 정기권
				else if ($ap_data['ad_pc_type'] == 'P') {
					$sms_data['txt_ad_pc_type'] = '정기권';
				}

				$code_arr['txt_ad_pc_type'] = '{선불제:유형}';

				include_once(_MODULE_PATH_.'/customer/customer.class.php');
				$oCustomer = new Customer();
				$oCustomer->init();
				$cs_data = $oCustomer->selectDetail($sms_data['cs_id']);
				$sms_data['us_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_no'] = $cs_data['cs_hp'];

				$code_arr['ad_pc_expire'] = '{선불제:사용기간}';
				$text .= '&#10;- 사용기간: {선불제:사용기간}까지&#10;&#10;감사합니다. ^^';
				break;
			case 'useAdvanceDefault':
				$text = '사랑합니다. {사용자이름}님! {가맹점명}입니다. &#10;&#10;{가맹점명} 선불제 이용내역을 알려드립니다.&#10;- {선불제:유형}을 이용하셨습니다.&#10;&#10;사용후 남은 선불제 내역입니다.';

				include_once(_MODULE_PATH_.'/advance_purchase/advance_purchase.class.php');
				$oAdvancePurchase = new AdvancePurchase();
				$oAdvancePurchase->init();
				$ap_data = $oAdvancePurchase->selectDetail($sms_data['ad_pc_id']);

				// 선불제 구매와 같지만 텍스트만 다름
				// 선불제, 이용권
				if ($ap_data['ad_pc_type'] == 'M' || $ap_data['ad_pc_type'] == 'Q') {
					if ($ap_data['ad_pc_type'] == 'M') {
						$sms_data['txt_ad_pc_type'] = '정액권';
					} else {
						$sms_data['txt_ad_pc_type'] = '이용권';
					}

					$sms_data['ad_pc_quantity'] = $ap_data['ad_pc_quantity'];
					$sms_data['remain_quantity'] = $ap_data['remain_quantity'];
					$code_arr['ad_pc_quantity'] = '{선불제:전체}';
					$code_arr['remain_quantity'] = '{선불제:잔여}';
					$text .= '&#10;- 전체: {선불제:전체}&#10;- 잔여: {선불제:잔여}';
				}
				// 정기권
				else if ($ap_data['ad_pc_type'] == 'P') {
					$sms_data['txt_ad_pc_type'] = '정기권';
				}

				$code_arr['txt_ad_pc_type'] = '{선불제:유형}';

				include_once(_MODULE_PATH_.'/customer/customer.class.php');
				$oCustomer = new Customer();
				$oCustomer->init();
				$cs_data = $oCustomer->selectDetail($sms_data['cs_id']);
				$sms_data['us_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_name'] = $cs_data['cs_name'];
				$result['data']['sms_rc_no'] = $cs_data['cs_hp'];

				$code_arr['ad_pc_expire'] = '{선불제:사용기간}';

				$text .= '&#10;- 사용기간: {선불제:사용기간} &#10;&#10;감사합니다. ^^';

				break;
			case 'completeReservationDefault':
				$text = '사랑합니다. {사용자이름}님! {가맹점명}입니다. &#10;&#10;{가맹점명} 시술 이용내역을 알려드립니다. &#10;- 예약일자: {예약:예약일시}&#10;- 서비스명: {예약:서비스명}&#10;- 담당자: {예약:담당자명} &#10;- 소요시간: {예약:소요시간}분&#10;- 금액: {예약:시술금액} &#10;- 할인: {예약:일반할인금액}원';

				// 쿠폰 아이디가 존재하면 쿠폰 데이터 추가
				if ($sms_data['cp_id'] > 0) {
					include_once(_MODULE_PATH_.'/coupon/coupon.class.php');
					$oCoupon = new Coupon();
					$oCoupon->init();
					$text .= '&#10;- 쿠폰: {예약:쿠폰명}/{예약:쿠폰할인금액}원 ';
					$cp_data = $oCoupon->selectDetail($sms_data['cp_id']);

					$code_arr['cp_name'] = '{예약:쿠폰명}';
					$code_arr['cp_sale_price'] = '{예약:쿠폰할인금액}';
					$sms_data['cp_name'] = $cp_data['cp_name'];
					$sms_data['cp_sale_price'] = $cp_data['cp_sale_price'];

				}

				$text .= '&#10;- 실제 결제금액: {예약:실제결제금액} &#10;&#10;감사합니다. ^^';

				$result['data']['sms_rc_no'] = $sms_data['us_hp'];
				$result['data']['sms_rc_name'] = $sms_data['us_name'];
				break;
			default:
				break;
		}


		// sms 내용 코드치환 후 저장
		foreach ($code_arr as $key => $value) {
			$text = str_replace($value, $sms_data[$key], $text);
		}
		$result['data']['sms_contents'] = $text;

		// 문자 타입을 구합니다 90바이트 아래면 Sms 위면 Lms
		if (mb_strlen($text, 'cp949') < 91) {
			$result['data']['sms_type'] = 'S';
		} else {
			$result['data']['sms_type'] = 'L';
		}

		// 특정 시간이 지난 후에 보내는 옵션일 때 보내는 시간 구하기
		// 옵션이 지금은 최고가 3개지만 그냥 루프 4번돌게 만듬
		for ($i = 1; $i < 5; $i ++) {
			// config_data의 옵션값이 사용중인지 확인한 후 오리지날 데이터의 타입을 확인합니다
			if ($config_data['data'][$method]['option' . $i . '_use'] == 'Y') {
				$type_tmp = explode('_', $original_config_data['option' . $i . '_type']);
				if ($type_tmp[0] == 'afterTheEvent') {
					if ($config_data['data'][$method]['option' . $i . '_value'] == 0) {
						continue;
					}

					switch ($type_tmp[1]) {
						case 'seconds':
							break;
						case 'minutes':
							$result['data']['sms_send_time'] = mktime(date("H"), (date("i") + $config_data['data'][$method]['option' . $i . '_value']), 0, date("n"), date("j"), date("Y"));
							break;
						case 'hours':
							$result['data']['sms_send_time'] = mktime((date("H") + $config_data['data'][$method]['option' . $i . '_value']), date("i"), 0, date("n"), date("j"), date("Y"));
							break;
						case 'days':
							$result['data']['sms_send_time'] = mktime(date("H"), date("i"), 0, (date("n") + $config_data['data'][$method]['option' . $i . '_value']), date("j"), date("Y"));
							break;
						default:
							break;
					}
				}
			} else {
				continue;
			}
		}


		// 발신제한 시간을 계산하여 상태를 정의합니다
		if ($method == 'birthday') {
			$result['data']['sms_status'] = 'E';
		} else {
			$result['data']['sms_status'] = $this->getSmsStatus();
		}

		$result['data']['sms_sd_no'] = $config_data['sd_no'];

		$result['code'] = 'success';

		return $result;
	}

	/*
	 * 발신이 가능한지 구합니다.
	 */
	public function getSmsStatus()
	{
		$status_arr = array(
			'W'	=> '등록됨', // 전송되길 대기중
			'A'	=> '연기', // 제한시간 등으로 인해서
			'E'	=> '완료',
			'C'	=> '정상취소',
			'B' => '비정상' // 아무런 처리가 되지 않음
		);

		$status = 'B';
		$restrict_time = $this->getRestrictTime();

		$current_time = date('H') . date('i');

		$time1['start'] = sprintf('%02d',$restrict_time['time1_start'][0]) . sprintf('%02d',$restrict_time['time1_start'][1]);
		$time1['end'] = sprintf('%02d',$restrict_time['time1_end'][0]) . sprintf('%02d',$restrict_time['time1_end'][1]);
		$time2['start'] = sprintf('%02d',$restrict_time['time2_start'][0]) . sprintf('%02d',$restrict_time['time2_start'][1]);
		$time2['end'] = sprintf('%02d',$restrict_time['time2_end'][0]) . sprintf('%02d',$restrict_time['time2_end'][1]);

		// 현재시간이 제한시간 범위에 있을 때만 A로 변환
		if (($time1['start'] <= $current_time) && ($time1['end'] >= $current_time)) {

			$status = 'A';
		}
		else if (($time2['start'] <= $current_time) && ($time2['end'] >= $current_time)) {
			$status = 'A';
		} else {
			$status = 'W';
		}
		return $status;
	}

	/**
	 * list페이지에서 변경을 누를 시 전송되는 데이터들을 알맞게 변환해준다.
	 */
	public function getPostData()
	{
		$result = array();
		//$notification_list = $this->defineNotificationList();
		foreach ($this->defineNotificationList() as $method => $real_arr) {
			foreach ($real_arr as $key => $value) {
				// 내용
				if ($value['readonly']) {
					$result[$key]['contents'] = $value['contents'];
				} else {
					$result[$key]['contents'] = $_POST[$key . '_text'];
				}


				// 각 옵션의 밸류 값
				// 옵션을 사용할 것인지 여부를 사용하는 경우
				for ($i=1; $i<5; $i++) {
					// 옵션 값과 종류를 삽입합니다
					if (!empty($value['option' . $i . '_printed'])) {
						if ($_POST[$key . '_option' . $i . '_value'] == "") {
							$result[$key]['option' . $i . '_value'] = 0;
						} else {
							$result[$key]['option' . $i . '_value'] = $_POST[$key . '_option' . $i . '_value'];
						}
						$result[$key]['option' . $i . '_type'] = $value['option' . $i . '_type'];
					} else {
						continue;
					}

					// 옵션을 사용할 것인지 여부
					// option_check_use가 true면 해당하는 체크박스의 값을 따르고
					// 아니면 무조건 사용
					if ($value['option' . $i . '_check_use'] == true) {
						if ($_POST[$key . '_option' . $i . '_use'] == 'Y') {
							$result[$key]['option' . $i . '_use'] = 'Y';
						} else {
							$result[$key]['option' . $i . '_use'] = 'N';
						}
					} else {
						$result[$key]['option' . $i . '_use'] = 'Y';
					}
				}

				// 사용할 것인지 체크
				if ($_POST[$key . '_use'] == 'Y') {
					$result[$key]['use'] = 'Y';
				} else {
					$result[$key]['use'] = 'N';
				}
			}
		}
		return $result;
	}

	public function getTimeOption($method, $current_value)
	{
		$arr = array();
		switch ($method) {
			case 'seconds':
				break;
			case 'minutes':
				for ($i=0; $i<60; $i+=5) {
					$arr[$i] = $i;
				}
				break;
			case 'hours':
				for ($i=0; $i<24; $i++) {
					$arr[$i] = $i;
				}
				break;
		}
		ob_start();
		printSelectOption($arr, $current_value);
		$result = ob_get_contents();
		ob_end_clean();

		return $result;
	}

	//
	//
	// 아래부터는 sql 관련 셋팅
	//
	//

	protected function initInsert()
	{
		$this->set('insert_field', 'sa_id,sh_code,sa_config_data');
		$this->set('required_field', 'sh_code,sa_config_data');
		$this->set('return_url', './list.html');
	}

	protected function convertInsert($arr)
	{
		$arr = parent::convertInsert($arr);
		$arr['sh_code'] = $this->get('sh_code');
		$arr['sa_config_data'] = json_encode($this->getPostData());
		return $arr;
	}

	/*
	 * 자신의 sh_code(가맹점)의 정보를 불러옵니다.
	 */
	protected function makeDbWhere()
	{
		$db_where = parent::makeDbWhere();
		$db_where .= " AND sh_code='{$this->get('sh_code')}'";
		$this->set('db_where', $db_where);
		return $db_where;
	}



	protected function initUpdate()	{
		if ($_POST['mode'] == 'modify_auto') {
			$this->set('update_field', 'sa_config_data');
			$this->set('required_field', 'sa_config_data');
			$this->set('return_url', './list.html');
		}
		else if ($_POST['mode'] == 'modify_report') {
			$this->set('update_field', 'sa_report_data');
			$this->set('required_field', 'sa_report_data');
			$this->set('return_url', './report_list.html');
		}
	}

	public function updateData()
	{
		$this->initUpdate();

		$arr = $this->getParameters($this->get('update_field'), 'post');
		$arr = $this->convertUpdate($arr);

		if($this->validateValues($arr)) {
			$p_arr = $arr;

			dbUpdateByArray($this->get('data_table'), $arr, "where sh_code = '" .$this->get('sh_code'). "'");

			$this->result['code'] = 'update_ok';
			$this->postUpdate($p_arr);
		}

		return $this->result;
	}

	protected function convertUpdate($arr)
	{
		global $member;
		$arr = parent::convertUpdate($arr);

		if ($_POST['mode'] == 'modify_auto') {

			$data_tmp = array();
			$user_info = $this->oSms->getUserInfo($member['sh_code']);
			if (in_array($_POST['sms_sd_no'], $user_info['data']['sd_tel_no_arr'])) {
				$data_tmp['sd_no'] = $_POST['sms_sd_no'];
			}
			else {
				alert('올바르지 않은 발신번호입니다.');
			}

			// 발신 제한시간을 구합니다
			// end타임이 더 크면 0으로 만들어줍니다
			if ($_POST['restrict_time1_start_hours'] <= $_POST['restrict_time1_end_hours']) {
				if (($_POST['restrict_time1_start_hours'] == $_POST['restrict_time1_end_hours']) && ($_POST['restrict_time1_start_minutes'] > $_POST['restrict_time1_end_minutes'])) {
					$restrict_time1_start = $_POST['restrict_time1_start_hours'] . ':0';
					$restrict_time1_end = $_POST['restrict_time1_end_hours'] . ':0';
				} else {
					$restrict_time1_start = $_POST['restrict_time1_start_hours'] . ':' . $_POST['restrict_time1_start_minutes'];
					$restrict_time1_end = $_POST['restrict_time1_end_hours'] . ':' . $_POST['restrict_time1_end_minutes'];
				}
			} else {
				$restrict_time1_start = '0:0';
				$restrict_time1_end = '0:0';
			}

			if ($_POST['restrict_time2_start_hours'] <= $_POST['restrict_time2_end_hours']) {
				if (($_POST['restrict_time2_start_hours'] == $_POST['restrict_time2_end_hours']) && ($_POST['restrict_time2_start_minutes'] > $_POST['restrict_time2_end_minutes'])) {
					$restrict_time2_start = $_POST['restrict_time2_start_hours'] . ':0';
					$restrict_time2_end = $_POST['restrict_time2_end_hours'] . ':0';
				} else {
					$restrict_time2_start = $_POST['restrict_time2_start_hours'] . ':' . $_POST['restrict_time2_start_minutes'];
					$restrict_time2_end = $_POST['restrict_time2_end_hours'] . ':' . $_POST['restrict_time2_end_minutes'];
				}
			} else {
				$restrict_time2_start = '0:0';
				$restrict_time2_end = '0:0';
			}
			$data_tmp['restrict_time']['time1_start'] = $restrict_time1_start;
			$data_tmp['restrict_time']['time1_end'] = $restrict_time1_end;
			$data_tmp['restrict_time']['time2_start'] = $restrict_time2_start;
			$data_tmp['restrict_time']['time2_end'] = $restrict_time2_end;

			$data_tmp['data'] = $this->getPostData();

			$arr['sa_config_data'] = array_to_json($data_tmp);
		}
		else if ($_POST['mode'] == 'modify_report') {
			$data = array();

			// 수신번호 입력
			if (is_numeric($_POST['sa_report_rc_no1'])) {
				$data['rc_no'][] = $_POST['sa_report_rc_no1'];
			}
			if (is_numeric($_POST['sa_report_rc_no2'])) {
				$data['rc_no'][] = $_POST['sa_report_rc_no2'];
			}
			if (is_numeric($_POST['sa_report_rc_no3'])) {
				$data['rc_no'][] = $_POST['sa_report_rc_no3'];
			}

			// 사용 여부 체크
			$data['use'] = $_POST['sa_report_use'];


			//각 옵션 별로 사용 여부 저장
			foreach ($this->defineReportList() as $key => $value) {
				if ($_POST['use_' . $key] == 'on') {
					$data['data'][$key]['use'] = 'Y';
				}
				if (is_array($value['option'])) {
					foreach ($value['option'] as $option_key => $option_value) {
						$data['data'][$key][$option_value] = $_POST[$key . '_' . $option_value];
					}
				}
			}

			$data_tmp = array_to_json($data);

			$arr['sa_report_data'] = $data_tmp;
		}
		return $arr;
	}
}
?>