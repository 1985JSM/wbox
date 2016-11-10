<?
if(!defined('_INPLUS_')) { exit; }
include_once(_MODULE_PATH_.'/customer/customer.class.php');

Class CustomerManager extends Customer
{	
	/* init */
	public function init() {	

		parent::init();
	}

	/* insert */
	protected function convertInsert($arr) {
		$arr = parent::convertInsert($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		return $arr;
	}

	/* insert */
	public function insertDataFromReserve($data) {

		global $member;
		
		$sh_code = $member['sh_code'];
		$us_name = $data['us_name'];
		$us_hp = $data['us_hp'];	
		$us_hp = str_replace('-', '', $us_hp);
		$us_hp = str_replace('.', '', $us_hp);
		$us_hp = str_replace(' ', '', $us_hp);

		if(!$us_name || !$us_hp) {
			return null;
		}
		
		$data_table = $this->get('data_table');
		$pk = $this->get('pk');
		$cs_id = $data['cs_id'];
		if($cs_id) {
			$cs_data = dbOnce($data_table, "*", "where $pk = '$cs_id'", "");
			if(!$cs_data['mb_id']) {
				$arr = array(
					'cs_name'	=> $us_name,
					'cs_hp'		=> $us_hp
				);
				dbUpdateByArray($data_table, $arr, "where $pk = '$cs_id'");
			}
		}
		else {
			$data = dbOnce($data_table, "cs_id", "where sh_code = '$sh_code' and cs_name = '$us_name' and cs_hp = '$us_hp'", "order by cs_id desc");
			$cs_id = $data['cs_id'];
			
			if(!$cs_id) {
				// 회원정보
				$arr = array(
					'sh_code'	=> $sh_code,
					'st_id'		=> $data['st_id'],
					'cs_level'	=> '3',
					'cs_name'	=> $us_name,
					'cs_hp'		=> $us_hp
				);

				$arr = parent::convertInsert($arr);
				
				dbInsertByArray($this->get('data_table'), $arr);

				$data = dbOnce($data_table, "cs_id", "where sh_code = '$sh_code' and cs_name = '$us_name' and cs_hp = '$us_hp'", "order by cs_id desc");
				$cs_id = $data['cs_id'];
			}		
		}

		return $cs_id;
	}

	/* update */
	protected function convertUpdate($arr) {
		$arr = parent::convertUpdate($arr);

		// sh_code
		global $member;
		$arr['sh_code'] = $member['sh_code'];

		return $arr;
	}	

	/* auth */
	protected function checkReadAuth($uid) {

		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");
		if(!$data['sh_code'] || $member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	protected function checkDeleteAuth($uid) {
		
		// 본인이 관리하는 가맹점인지		
		global $member;
		$pk = $this->get('pk');		
		$data = dbOnce($this->get('data_table'), "sh_code", "where $pk = '$uid'", "");		
		if(!$data['sh_code'] || $member['sh_code'] == $data['sh_code']) { return true; }

		return false;
	}

	/* search */
	protected function makeDbWhere() {
		$db_where = $this->getDefaultWhere();
		
		global $member;
		$sh_code = $member['sh_code'];
		$db_where.= " and sh_code = '$sh_code' ";

		$this->set('db_where', $db_where);

		return $db_where;		
	}

	/**
	 * 예약횟수로 고객정보를 불러오는 함수
	 * @param int $num 검색하려는 횟수
	 */
	public function getCustomersByCntReservations($num) {
		$customer_list = $this->selectList();

		if (empty($oReserve)) {
			include_once(_MODULE_PATH_.'/reserve/reserve.manager.class.php');
			$oReserve = new ReserveManager();
			$oReserve->init();
		}

		$result = array();
		foreach ($customer_list as $key => $value) {
			$tmp = $oReserve->countByCustomerId($value['cs_id'], 'E');

			$value['cnt_reserve'] = $tmp;
			if ($tmp == $num) {
				$result[] = $value;
			}
			// 검색조건이 10회 이상이므로 10 이상인 것을 검색
			else if (($num > 10) && ($tmp > 10)) {
				$result[] = $value;
			}
		}
		return $result;
	}

	/*
	 * 일괄 등록시 첨부한 파일을 가공하는 부분
	 */
	public function processPluralCustomerData($files) {
		global $member;

		//CSV mimetype이 저장된 배열
		$csv_mimetypes = array(
			'text/csv',
			'text/plain',
			'application/csv',
			'text/comma-separated-values',
			'application/excel',
			'application/vnd.ms-excel',
			'application/vnd.msexcel',
			'text/anytext',
			'application/octet-stream',
			'application/txt',
		);

		//CSV파일인지 점검합니다
		if (in_array($files['csvfile']['type'], $csv_mimetypes)) {

			//저장할 디렉토리
			$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/data/upload/customer/';

			//저장할 파일명
			$uploadFile = $uploadDir . date('Y-m-d') . $member['sh_code'] . '.csv';

			//파일 이동
			if (move_uploaded_file($files['csvfile']['tmp_name'], $uploadFile)) {
			} else echo "업로드에 실패하셨습니다.";

			//fgetcsv시에 한글이 깨지는 현상을 대비하는 명령어
			setlocale(LC_CTYPE, "ko_KR.eucKR"); // 조건 확인


			$uploadHandle = fopen($uploadFile, "r");

			// 담당자 목록을 불러옵니다.
			/*
			if (!isset($oStaff)) {
				include_once(_MODULE_PATH_ . '/staff/staff.manager.class.php');
				$oStaff = new StaffManager();
				$oStaff->init();
			}
			$get_staff_list = $oStaff->selectStaffByShopCode($member['sh_code']);
			*/

			// 고객 목록을 불러옵니다.
			unset($get_customer_name_list);
			unset($get_customer_tel_list);
			foreach ($this->selectList() as $key => $value) {
				$get_customer_name_list[] = $value['cs_name'];
				$get_customer_tel_list[] = $value['cs_hp'];
			}

			// 파일 내에서의 중복체크를 하기 위한 함수
			unset($file_name_list);
			unset($file_tel_list);

			unset($fread);
			while ($fread_b = fgetcsv($uploadHandle)) {
				foreach ($fread_b as $key => $value) {
					$value = iconv('euc-kr', 'utf-8', $value);

					$fread_b[$key] = $value;
				}
				// 전화번호 하이픈 제거
				$fread_b[4] = str_replace('-', '', $fread_b[4]);
				$fread_b[4] = str_replace('.', '', $fread_b[4]);
				$fread_b[4] = str_replace(' ', '', $fread_b[4]);

				// 이름과 휴대폰 번호를 확인 후 중복된 것 있으면 제거
				if ((in_array($fread_b[0], $get_customer_name_list)) && (in_array($fread_b[4], $get_customer_tel_list))) {
					continue;
				} else if (empty($fread_b[0]) || empty($fread_b[4])) {
					// 값이 비어있으면 통과
					continue;
				} else if (count($file_name_list) > 0) {
					if ($file_tel_list[array_search($fread_b[0], $file_name_list)] == $fread_b[4]) {
						// 파일 내에서 중복 통과
						continue;
					}
				}

				$file_name_list[] = $fread_b[0];
				$file_tel_list[] = $fread_b[4];
				$fread[] = $fread_b;
			}

			fclose($uploadHandle);
			if (count($fread) < 2) {
				return array(
					'code'  => 'error'
				);
			}
			return $fread;
		} else {
			echo '파일은 CSV형식만 업로드 가능합니다.';
			return false;
		}
	}

	/*
     * 고객 일괄등록
     */
	public function insertPluralCustomerData($data) {
		global $gender_arr;
		global $birth_type_arr;
		global $member;

		if(!isset($oStaff)) {
			include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
			$oStaff = new StaffManager();
			$oStaff->init();
		}
		$st_id_arr = $oStaff->selectStaffByShopCode($member['sh_code']);

		foreach ($data['data'] as $key => $value) {
			// 성별 변환
			$value[1] = array_search($value[1], $gender_arr);

			// 역법 변환 (값이 잘못 되었을 때는 기본으로 '양력'이 들어감)
			$value[6] = array_search($value[6], $birth_type_arr);
			if ($value[6] == "") {
				$value[6] = array_shift(array_slice($birth_type_arr, 0, 1));
				$value[6] = array_search($value[6], $birth_type_arr);
			}

			// 등급 변환 (값이 잘못 되었을 때는 기본으로 '일반'이 들어감)
			$value[7] = array_search($value[7], $this->get('cs_level_arr'));
			if ($value[7] == "") {
				$value[7] = array_shift(array_slice($this->get('cs_level_arr'), 0, 1));
				$value[7] = array_search($value[7], $this->get('cs_level_arr'));
			}

			// 담당자 변환
			$value[8] = array_search($value[8], $st_id_arr);
			$arr = array(
				'sh_code'	    => $member['sh_code'],
				'cs_name'	    => $value[0],
				'cs_gender'	    => $value[1],
				'cs_nick'	    => $value[2],
				'cs_email'  	=> $value[3],
				'cs_hp'         => $value[4],
				'cs_birth'      => $value[5],
				'cs_birth_type' => $value[6],
				'cs_level'      => $value[7],
				'st_id'         => $value[8],
				'cs_memo'       => $value[9]
			);

			$arr = parent::convertInsert($arr);
			if ($this->validateValues($arr)) {
				dbInsertByArray($this->get('data_table'), $arr);
			}
		}
		return array(
			'code'      => 'ok',
			'message'   => '업로드가 성공적으로 처리되었습니다.',
			'return_url'=> './list.html'
		);
	}
}
?>
