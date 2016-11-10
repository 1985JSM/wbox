<?
if(!defined('_INPLUS_')) { exit; } 

Class Stats extends StdController
{	
	/* init */
	public function init() {
	
		/**
		* code array
		*/

		// user_std_arr
		$this->set('user_std_arr', array(
			'area'		=> '지역별',
			'year'		=> '연도별',
			'month'		=> '월별',
			'day'		=> '일별',
			'age'		=> '연령별',
			'gender'	=> '성별'
		));

		// shop_std
		$this->set('shop_std_arr', array(
			'sido'		=> '시/도별',
			'sigungu'	=> '시/구/군별',
			'year'		=> '연도별',
			'month'		=> '월별',
			'day'		=> '일별'
		));

		// reserve_std
		$this->set('reserve_std_arr', array(
			'sido'		=> '시/도별',
			'sigungu'	=> '시/구/군별',
			'year'		=> '연도별',
			'month'		=> '월별',
			'day'		=> '일별',
			'age'		=> '연령별',
			'gender'	=> '성별'
		));


		parent::init();
	}	

	/* select sigungu */
	public function selectShopSigungu($sh_sido) {
		$list = selectSigungu($sh_sido);
		$content = '<option value="">시/군/구</option>';
		foreach($list as $sigungu_name) {
			$content .= '<option value="'.$sigungu_name.'">'.$sigungu_name.'</option>';
		}
		$this->result['content'] = $content;
		
		return $this->result;
	}

	/* 회원 가입 통계 */
	public function selectUserJoinStats($std_type) {

		global $sch_area, $sch_s_date, $sch_e_date;

		$select_table = "tbl_user a ";
		$select_field = "count(a.mb_id) as cnt";

		$db_where = "where 1 = 1 ";

		// 지역
		if($sch_area) {
			$db_where .= " and a.mb_area = '$sch_area' ";
		}

		// 시작일
		if($sch_s_date) {
			$db_where .= " and a.reg_time >= '$sch_s_date 00:00:00' ";
		}

		// 종료일
		if($sch_e_date) {
			$db_where .= " and a.reg_time <= '$sch_e_date 23:59:59' ";
		}

		// 집계기준별 조회
		if($std_type == 'area') {
			$select_field .= ", a.mb_area ";
			$group_field = "a.mb_area";
			$order_field = "a.mb_area asc";
		}
		else if($std_type == 'year') {
			$select_field .= ", left(a.reg_time, 4) as year";
			$group_field = "left(a.reg_time, 4)";
			$order_field = "left(a.reg_time, 4) asc";
		}
		else if($std_type == 'month') {
			$select_field .= ", left(a.reg_time, 7) as month";
			$group_field = "left(a.reg_time, 7)";
			$order_field = "left(a.reg_time, 7) asc";
		}
		else if($std_type == 'day') {
			$select_field .= ", left(a.reg_time, 10) as day";
			$group_field = "left(a.reg_time, 10)";
			$order_field = "left(a.reg_time, 10) asc";
		}
		else if($std_type == 'age') {
			$select_field .= ", (left(a.reg_time, 4) - left(a.mb_birth, 4) + 1)  as age";
			$group_field = "(left(a.reg_time, 4) - left(a.mb_birth, 4) + 1)";
			$order_field = "(left(a.reg_time, 4) - left(a.mb_birth, 4) + 1)";
		}
		else if($std_type == 'gender') {
			$select_field .= ", a.mb_gender";
			$group_field = "a.mb_gender";
			$order_field = "a.mb_gender asc";
		}

		$list = dbSelect($select_table, $select_field, $db_where, "group by $group_field order by $order_field", "", 0);

		// 합계 구하기
		$total = 0;
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$total += $list[$i]['cnt'];
		}
		$this->set('total', $total);

		
		// 집계기준별 통계 자료 정리
		unset($stats);
		if($std_type == 'area') {

			// 초기화
			global $area_arr;
			foreach($area_arr as $key => $val) {
				if($sch_area && $key != $sch_area) {
					continue;
				}
				$stats[$key] = array(
					'name'	=> $val,
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['mb_area'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'year') {

			// 초기화
			$min_year = $list[0]['year'];
			$list_size = sizeof($list);
			$max_year = $list[$list_size-1]['year'];

			$year = $min_year;
			while($year <= $max_year) {
				$key = $year;
				$stats[$key] = array(
					'name'	=> $year.'년',
					'cnt'	=> 0,
					'per'	=> 0
				);

				$year++;
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['year'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'month') {

			// 초기화
			$min_month = strtotime($list[0]['month'].'-01');
			$list_size = sizeof($list);
			$max_month = strtotime($list[$list_size-1]['month'].'-01');

			$month = $min_month;
			while($month <= $max_month) {
				$key = date('Y-m', $month);
				$stats[$key] = array(
					'name'	=> date('Y년 m월', $month),
					'cnt'	=> 0,
					'per'	=> 0
				);

				$month = strtotime('+1 month', $month);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['month'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'day') {

			// 초기화
			$min_day = strtotime($list[0]['day']);
			$list_size = sizeof($list);
			$max_day = strtotime($list[$list_size-1]['day']);

			$day = $min_day;
			while($day <= $max_day) {
				$key = date('Y-m-d', $day);
				$stats[$key] = array(
					'name'	=> date('Y년 m월 d일', $day),
					'cnt'	=> 0,
					'per'	=> 0
				);

				$day = strtotime('+1 day', $day);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['day'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'age') {

			// 초기화
			$stats['10'] = array(
				'name'	=> '10대 이하',
				'cnt'	=> 0,
				'per'	=> 0
			);

			for($i = 2 ; $i < 6 ; $i++) {
				$key = $i * 10;
				$stats[$key] = array(
					'name'	=> $key.'대',
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			$stats['60'] = array(
				'name'	=> '60대 이상',
				'cnt'	=> 0,
				'per'	=> 0
			);

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = floor($list[$i]['age'] / 10) * 10;

				if($key < 20) { $key = '10'; }
				else if($key > 50) { $key = '60'; }

				$cnt = $list[$i]['cnt'];

				$stats[$key]['cnt'] += $cnt;
			}

			// 퍼센트
			foreach($stats as $key => $arr) {
				$stats[$key]['per'] = round($arr['cnt'] / $total * 100);
			}

			//print_r($stats);
		}
		else if($std_type == 'gender') {

			// 초기화
			global $gender_arr;
			foreach($gender_arr as $key => $val) {
				$stats[$key] = array(
					'name'	=> $val,
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['mb_gender'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}



		return $stats;

	}

	/* 가맹점 가입 통계 */
	public function selectShopJoinStats($std_type) {

		global $sch_sido, $sch_sigungu, $sch_s_date, $sch_e_date;

		$select_table = "tbl_shop a ";
		$select_field = "count(a.sh_code) as cnt";

		$db_where = "where 1 = 1 ";

		// 시/도
		if($sch_sido) {
			$db_where .= " and a.sh_sido = '$sch_sido' ";
		}

		// 시/구/군
		if($sch_sigungu) {
			$db_where .= " and a.sh_sigungu = '$sch_sigungu' ";
		}

		// 시작일
		if($sch_s_date) {
			$db_where .= " and a.reg_time >= '$sch_s_date 00:00:00' ";
		}

		// 종료일
		if($sch_e_date) {
			$db_where .= " and a.reg_time <= '$sch_e_date 23:59:59' ";
		}

		// 집계기준별 조회
		if($std_type == 'sido') {
			$select_field .= ", a.sh_sido ";
			$group_field = "a.sh_sido";
			$order_field = "a.sh_sido asc";
		}
		else if($std_type == 'sigungu') {
			$select_field .= ", concat(a.sh_sido, ' ', a.sh_sigungu) as sh_sigungu";
			$group_field = "concat(a.sh_sido, ' ', a.sh_sigungu)";
			$order_field = "concat(a.sh_sido, ' ', a.sh_sigungu) asc";
		}
		else if($std_type == 'year') {
			$select_field .= ", left(a.reg_time, 4) as year";
			$group_field = "left(a.reg_time, 4)";
			$order_field = "left(a.reg_time, 4) asc";
		}
		else if($std_type == 'month') {
			$select_field .= ", left(a.reg_time, 7) as month";
			$group_field = "left(a.reg_time, 7)";
			$order_field = "left(a.reg_time, 7) asc";
		}
		else if($std_type == 'day') {
			$select_field .= ", left(a.reg_time, 10) as day";
			$group_field = "left(a.reg_time, 10)";
			$order_field = "left(a.reg_time, 10) asc";
		}	

		$list = dbSelect($select_table, $select_field, $db_where, "group by $group_field order by $order_field", "", 0);

		// 합계 구하기
		$total = 0;
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$total += $list[$i]['cnt'];
		}
		$this->set('total', $total);

		
		// 집계기준별 통계 자료 정리
		unset($stats);
		if($std_type == 'sido') {

			// 초기화
			$sido_arr = selectSido();
			foreach($sido_arr as $sido) {
				if($sch_sido && $sido != $sch_sido) {
					continue;
				}
				$stats[$sido] = array(
					'name'	=> $sido,
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['sh_sido'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'sigungu') {

			// 초기화
			$sido_arr = selectSido();
			foreach($sido_arr as $sido) {
				if($sch_sido && $sido != $sch_sido) {
					continue;
				}
				$sigungu_arr = $sigungu_arr = selectSigungu($sido);
				foreach($sigungu_arr as $sigungu) {
					if($sch_sigungu && $sigungu != $sch_sigungu) {
						continue;
					}

					$key = $sido.' '.$sigungu;

					$stats[$key] = array(
						'name'	=> $key,
						'cnt'	=> 0,
						'per'	=> 0
					);
				}
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['sh_sigungu'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'year') {

			// 초기화
			$min_year = $list[0]['year'];
			$list_size = sizeof($list);
			$max_year = $list[$list_size-1]['year'];

			$year = $min_year;
			while($year <= $max_year) {
				$key = $year;
				$stats[$key] = array(
					'name'	=> $year.'년',
					'cnt'	=> 0,
					'per'	=> 0
				);

				$year++;
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['year'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'month') {

			// 초기화
			$min_month = strtotime($list[0]['month'].'-01');
			$list_size = sizeof($list);
			$max_month = strtotime($list[$list_size-1]['month'].'-01');

			$month = $min_month;
			while($month <= $max_month) {
				$key = date('Y-m', $month);
				$stats[$key] = array(
					'name'	=> date('Y년 m월', $month),
					'cnt'	=> 0,
					'per'	=> 0
				);

				$month = strtotime('+1 month', $month);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['month'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'day') {

			// 초기화
			$min_day = strtotime($list[0]['day']);
			$list_size = sizeof($list);
			$max_day = strtotime($list[$list_size-1]['day']);

			$day = $min_day;
			while($day <= $max_day) {
				$key = date('Y-m-d', $day);
				$stats[$key] = array(
					'name'	=> date('Y년 m월 d일', $day),
					'cnt'	=> 0,
					'per'	=> 0
				);

				$day = strtotime('+1 day', $day);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['day'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'age') {

			// 초기화
			$stats['10'] = array(
				'name'	=> '10대 이하',
				'cnt'	=> 0,
				'per'	=> 0
			);

			for($i = 2 ; $i < 6 ; $i++) {
				$key = $i * 10;
				$stats[$key] = array(
					'name'	=> $key.'대',
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			$stats['60'] = array(
				'name'	=> '60대 이상',
				'cnt'	=> 0,
				'per'	=> 0
			);

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = floor($list[$i]['age'] / 10) * 10;

				if($key < 20) { $key = '10'; }
				else if($key > 50) { $key = '60'; }

				$cnt = $list[$i]['cnt'];

				$stats[$key]['cnt'] += $cnt;
			}

			// 퍼센트
			foreach($stats as $key => $arr) {
				$stats[$key]['per'] = round($arr['cnt'] / $total * 100);
			}

			//print_r($stats);
		}
		else if($std_type == 'gender') {

			// 초기화
			global $gender_arr;
			foreach($gender_arr as $key => $val) {
				$stats[$key] = array(
					'name'	=> $val,
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['mb_gender'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}



		return $stats;

	}

	/* 사용자 예약 통계 */
	protected function makeDbWhere() {

		$db_where = "where 1 = 1 and a.rs_type = 'U' and a.rs_state = 'E' ";

		$this->set('db_where', $db_where);

		return $db_where;
	}

	public function selectUserReserveStats($std_type) {

		global $sch_sido, $sch_sigungu, $sch_s_date, $sch_e_date;

		$select_table = "tbl_reserve a ";
		$select_table.= "left outer join tbl_shop b on a.sh_code = b.sh_code ";
		$select_table.= "left outer join tbl_user c on a.reg_id = c.mb_id ";

		$select_field = "count(a.rs_id) as cnt";

		$db_where = $this->makeDbWhere();

		// 시/도
		if($sch_sido) {
			$db_where .= " and b.sh_sido = '$sch_sido' ";
		}

		// 시/구/군
		if($sch_sigungu) {
			$db_where .= " and b.sh_sigungu = '$sch_sigungu' ";
		}

		// 시작일
		if($sch_s_date) {
			$db_where .= " and a.rs_date >= '$sch_s_date' ";
		}

		// 종료일
		if($sch_e_date) {
			$db_where .= " and a.rs_date <= '$sch_e_date' ";
		}

		// 집계기준별 조회
		if($std_type == 'sido') {
			$select_field .= ", b.sh_sido ";
			$group_field = "b.sh_sido";
			$order_field = "b.sh_sido asc";
		}
		else if($std_type == 'sigungu') {
			$select_field .= ", concat(b.sh_sido, ' ', b.sh_sigungu) as sh_sigungu";
			$group_field = "concat(b.sh_sido, ' ', b.sh_sigungu)";
			$order_field = "concat(b.sh_sido, ' ', b.sh_sigungu) asc";
		}
		else if($std_type == 'year') {
			$select_field .= ", left(a.rs_date, 4) as year";
			$group_field = "left(a.rs_date, 4)";
			$order_field = "left(a.rs_date, 4) asc";
		}
		else if($std_type == 'month') {
			$select_field .= ", left(a.rs_date, 7) as month";
			$group_field = "left(a.rs_date, 7)";
			$order_field = "left(a.rs_date, 7) asc";
		}
		else if($std_type == 'day') {
			$select_field .= ", left(a.rs_date, 10) as day";
			$group_field = "left(a.rs_date, 10)";
			$order_field = "left(a.rs_date, 10) asc";
		}	
		else if($std_type == 'age') {
			$select_field .= ", (left(a.reg_time, 4) - left(c.mb_birth, 4) + 1)  as age";
			$group_field = "(left(a.reg_time, 4) - left(c.mb_birth, 4) + 1)";
			$order_field = "(left(a.reg_time, 4) - left(c.mb_birth, 4) + 1)";
		}
		else if($std_type == 'gender') {
			$select_field .= ", c.mb_gender";
			$group_field = "c.mb_gender";
			$order_field = "c.mb_gender asc";
		}

		$list = dbSelect($select_table, $select_field, $db_where, "group by $group_field order by $order_field", "", 0);


		// 합계 구하기
		$total = 0;
		for($i = 0 ; $i < sizeof($list) ; $i++) {
			$total += $list[$i]['cnt'];
		}
		$this->set('total', $total);

		
		// 집계기준별 통계 자료 정리
		unset($stats);
		if($std_type == 'sido') {

			// 초기화
			$sido_arr = selectSido();
			foreach($sido_arr as $sido) {
				if($sch_sido && $sido != $sch_sido) {
					continue;
				}
				$stats[$sido] = array(
					'name'	=> $sido,
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['sh_sido'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'sigungu') {

			// 초기화
			$sido_arr = selectSido();
			foreach($sido_arr as $sido) {
				if($sch_sido && $sido != $sch_sido) {
					continue;
				}
				$sigungu_arr = $sigungu_arr = selectSigungu($sido);
				foreach($sigungu_arr as $sigungu) {
					if($sch_sigungu && $sigungu != $sch_sigungu) {
						continue;
					}

					$key = $sido.' '.$sigungu;

					$stats[$key] = array(
						'name'	=> $key,
						'cnt'	=> 0,
						'per'	=> 0
					);
				}
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['sh_sigungu'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'year') {

			// 초기화
			$min_year = $list[0]['year'];
			$list_size = sizeof($list);
			$max_year = $list[$list_size-1]['year'];

			$year = $min_year;
			while($year <= $max_year) {
				$key = $year;
				$stats[$key] = array(
					'name'	=> $year.'년',
					'cnt'	=> 0,
					'per'	=> 0
				);

				$year++;
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['year'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'month') {

			// 초기화
			$min_month = strtotime($list[0]['month'].'-01');
			$list_size = sizeof($list);
			$max_month = strtotime($list[$list_size-1]['month'].'-01');

			$month = $min_month;
			while($month <= $max_month) {
				$key = date('Y-m', $month);
				$stats[$key] = array(
					'name'	=> date('Y년 m월', $month),
					'cnt'	=> 0,
					'per'	=> 0
				);

				$month = strtotime('+1 month', $month);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['month'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'day') {

			// 초기화
			$min_day = strtotime($list[0]['day']);
			$list_size = sizeof($list);
			$max_day = strtotime($list[$list_size-1]['day']);

			$day = $min_day;
			while($day <= $max_day) {
				$key = date('Y-m-d', $day);
				$stats[$key] = array(
					'name'	=> date('Y년 m월 d일', $day),
					'cnt'	=> 0,
					'per'	=> 0
				);

				$day = strtotime('+1 day', $day);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['day'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'age') {

			// 초기화
			$stats['10'] = array(
				'name'	=> '10대 이하',
				'cnt'	=> 0,
				'per'	=> 0
			);

			for($i = 2 ; $i < 6 ; $i++) {
				$key = $i * 10;
				$stats[$key] = array(
					'name'	=> $key.'대',
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			$stats['60'] = array(
				'name'	=> '60대 이상',
				'cnt'	=> 0,
				'per'	=> 0
			);

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = floor($list[$i]['age'] / 10) * 10;

				if($key < 20) { $key = '10'; }
				else if($key > 50) { $key = '60'; }

				$cnt = $list[$i]['cnt'];

				$stats[$key]['cnt'] += $cnt;
			}

			// 퍼센트
			foreach($stats as $key => $arr) {
				$stats[$key]['per'] = round($arr['cnt'] / $total * 100);
			}

			//print_r($stats);
		}
		else if($std_type == 'gender') {

			// 초기화
			global $gender_arr;
			foreach($gender_arr as $key => $val) {
				$stats[$key] = array(
					'name'	=> $val,
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['mb_gender'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}
		else if($std_type == 'age') {

			// 초기화
			$stats['10'] = array(
				'name'	=> '10대 이하',
				'cnt'	=> 0,
				'per'	=> 0
			);

			for($i = 2 ; $i < 6 ; $i++) {
				$key = $i * 10;
				$stats[$key] = array(
					'name'	=> $key.'대',
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			$stats['60'] = array(
				'name'	=> '60대 이상',
				'cnt'	=> 0,
				'per'	=> 0
			);

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = floor($list[$i]['age'] / 10) * 10;

				if($key < 20) { $key = '10'; }
				else if($key > 50) { $key = '60'; }

				$cnt = $list[$i]['cnt'];

				$stats[$key]['cnt'] += $cnt;
			}

			// 퍼센트
			foreach($stats as $key => $arr) {
				$stats[$key]['per'] = round($arr['cnt'] / $total * 100);
			}

			//print_r($stats);
		}
		else if($std_type == 'gender') {

			// 초기화
			global $gender_arr;
			foreach($gender_arr as $key => $val) {
				$stats[$key] = array(
					'name'	=> $val,
					'cnt'	=> 0,
					'per'	=> 0
				);
			}

			// 수치 입력
			for($i = 0 ; $i < sizeof($list) ; $i++) {
				$key = $list[$i]['mb_gender'];
				$cnt = $list[$i]['cnt'];
				$per = round($cnt / $total * 100);

				$stats[$key]['cnt'] = $cnt;
				$stats[$key]['per'] = $per;
			}
		}



		return $stats;

	}


}
?>
