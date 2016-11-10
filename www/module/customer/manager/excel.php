<?
if(!defined('_INPLUS_')) { exit; }
$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

/* init Class */
$oCustomer = new CustomerManager();
$oCustomer->init();
$module_name = $oCustomer->get('module_name');	// 모듈명

/* list */
$oCustomer->set('cnt_rows', 9999);
$list = $oCustomer->selectList();
$total_cnt = $oCustomer->get('total_cnt');
$cnt_page = $oCustomer->get('cnt_page');

/* search condition */
$sch_type_arr = $oCustomer->get('sch_type_arr');
$query_string = $oCustomer->get('query_string');

/* pagination */
$page = $oCustomer->get('page');
$page_arr = $oCustomer->getPageArray();
$pk = $oCustomer->get('pk');

/* code */
$cs_level_arr = $oCustomer->get('cs_level_arr');

/* staff */
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$st_id_arr = $oStaff->selectStaffByShopCode($member['sh_code']);

/* 최근 기간 */
$sch_date_arr = $oCustomer->get('sch_date_arr');
unset($sch_date_class);
for($i = 0 ; $i < sizeof($sch_date_arr) ; $i++) {
	if($sch_s_date == $sch_date_arr[$i] && $sch_e_date == $sch_date_arr[0]) {
		$sch_date_class[$i] = 'active';
	}
}
if(!$sch_s_date && !$sch_e_date) { $sch_date_class[$i] = 'active'; }


$title = date("Ymd").'회원정보';
$title = iconv('utf-8', 'euc-kr', $title);
header( "Content-type: application/vnd.ms-excel" );
header( "Content-charset: euc-kr" );
header( "Content-Disposition: attachment; filename=".$title.".xls");
header( "Content-Description: PHP4 Generated Data" );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="ko" />
<title>판매현황</title>
<style type="text/css">
<!--
.style1 {
	color: #FF3300;
	font-weight: bold;
}
-->
</style>
</head>
<body>

<!-- list_table -->
<table border="1">
<colgroup>
<col width="50" />
<col width="120" />
<col width="50" />
<col width="*" />
<col width="120" />
<col width="140" />
<col width="80" />
<col width="80" />
<col width="80" />
<col width="140" />
<col width="50" />
<col width="*" />
</colgroup>
<thead>
<tr>
    <th rowspan="2" align="center" bgcolor="#92cddc">No</th>
    <th rowspan="2" bgcolor="#92cddc">이름</th>
    <th rowspan="2" bgcolor="#92cddc">성별</th>
    <th rowspan="2" bgcolor="#92cddc">이메일</th>
    <th rowspan="2" bgcolor="#92cddc">휴대폰</th>
    <th rowspan="2" align="center" bgcolor="#92cddc">닉네임</th>
    <th rowspan="2" align="center" bgcolor="#92cddc">가입일</th>
    <th colspan="2" align="center" bgcolor="#c3d69b">이용내역(건)</th>
    <th colspan="3" align="center" bgcolor="#c3d69b">고객관리정보</th>
    </tr>
<tr>
    <th align="center" bgcolor="#c3d69b">완료예약</th>
    <th bgcolor="#c3d69b">종료예약</th>
    <th align="center" bgcolor="#c3d69b">담당자</th>
    <th align="center" bgcolor="#c3d69b">등급</th>
    <th align="center" bgcolor="#c3d69b">메모</th>
</tr>
</thead>
<tbody>

<?
if (sizeof($list) == 0) {
	?>
	<tr>
		<td colspan="12" align="center" class="nodata">데이터가 없습니다.</td>
	</tr>
<?
} else {
	// 휴대폰 번호에 숫자를 넣으면 맨 앞의 0이 짤리는 문제로
	// td에 style=mso-number-format:'\@'를 삽입하여 해결가능
	for ($i = 0; $i < sizeof($list); $i++) { ?>
		<tr>
			<td align="center" bgcolor="#dbeef3"><?= $list[$i]['no'] ?></td>
			<td align="center"><?= $list[$i]['cs_name'] ?></td>
			<td align="center"><?= $list[$i]['txt_cs_gender'] ?></td>
			<td align="left"><?= $list[$i]['cs_email'] ?></td>
			<td style="mso-number-format:'\@'" align="center"><?= $list[$i]['cs_hp'] ?></td>
			<td align="center"><?= $list[$i]['cs_nick'] ?></td>
			<td align="center"><?= $list[$i]['reg_date'] ?></td>
			<td align="center" bgcolor="#f2f2f2"><span class="style1"><?= number_format($list[$i]['cnt_finish_reserve']) ?></span></td>
			<td align="center" bgcolor="#f2f2f2"><?= number_format($list[$i]['cnt_total_reserve']) ?></td>
			<td align="center" bgcolor="#f2f2f2"><?= $st_id_arr[$list[$i]['st_id']] ?></td>
			<td align="center" bgcolor="#f2f2f2"><?= $list[$i]['txt_cs_level'] ?></td>
			<td align="center" bgcolor="#f2f2f2"><p><?= $list[$i]['cs_memo'] ?></p></td>
		</tr>
	<?
	}
}
?>

</tbody>
</table>

</body>
</html>