<?

function makeTimecode2($data) {

	$now = $data;

		// 연
		$tmp = substr($now, 0, 2) * 1 + 65;
		$code = chr($tmp);

		// 월
		$tmp = substr($now, 2, 2) * 1 + 65;
		$code.= chr($tmp);

		// 일
		$code.= substr($now, 4, 2);

		// 시
		$tmp = substr($now, 6, 2) * 1 + 65;
		$code.= chr($tmp);

		// 분
		$code.= substr($now, 8, 1);

		$tmp = substr($now, 9, 1) * 1 + 65;
		$code.= chr($tmp);

		// 초
		$tmp = substr($now, 10, 1) * 1 + 65;
		$code.= chr($tmp);

		$code.= substr($now, 11, 1);

		// 마이크로초
		$tmp = substr($now, 12, 1) * 1 + 65;
		$code.= chr($tmp);

		$code.= substr($now, 13, 2);

	return $code;
}

$list = dbSelect("tbl_portfolio2","pf_id, concat(date_format(reg_time,'%y%m%d%H%I%S'),lpad(pf_id,3,'0')) as new_pf_id","order by reg_time asc","","");
for($i=0;$i<sizeof($list);$i++){
	$pf_id = $list[$i]['pf_id'];
	$new_pf_id = makeTimecode2($list[$i]['new_pf_id']);
	
	//dbUpdate("tbl_portfolio2","pf_id ='".$new_pf_id."'","where pf_id = '".$pf_id."'");
	//dbUpdate("tbl_file2","pr_uid ='".$new_pf_id."'","where pr_uid = '".$pf_id."' and pr_module = 'portfolio'");
	//dbUpdate("tbl_portfolio_comment2","pf_id ='".$new_pf_id."'","where pf_id = '".$pf_id."'");
	//dbUpdate("tbl_portfolio_like2","pf_id ='".$new_pf_id."'","where pf_id = '".$pf_id."'");
	echo $pf_id." : ".$new_pf_id.'<br />';
}

?>