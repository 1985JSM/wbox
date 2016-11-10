<?
if(!defined('_INPLUS_')) { exit; } 

/* customer */
if(!isset($oCustomer)) {
	include_once(_MODULE_PATH_.'/customer/customer.staff.class.php');
	$oCustomer = new CustomerStaff();
	$oCustomer->init();
}

/* list */
$list = $oCustomer->selectList();
$total_cnt = $oCustomer->get('total_cnt');
$this_cnt = sizeof($list);
$pk = $oCustomer->get('pk');

if($this_cnt == 0) {
	$next_page = 0;
}
else {
	$next_page = $page + 1;
}

$json_etc = array(
	'total_cnt'	=> $total_cnt,
	'this_cnt'	=> $this_cnt,
	'next_page'	=> $next_page
);

for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
<li>
	<span><?=$list[$i]['cs_name']?></span>
	<em><?=$list[$i]['cs_hp']?></em>
	<span><button type="button" onclick="chooseCustomer('<?=$list[$i][$pk]?>', '<?=$list[$i]['mb_id']?>', '<?=$list[$i]['cs_name']?>', '<?=$list[$i]['cs_hp']?>')" class="btn_gray_s">선택</button></span>
</li>
<? } if($page < 2 && sizeof($list) == 0) { ?>
<li class="no_date">
	<p>
		검색결과가 없습니다.
		<? /*<br />	
		해당 정보로 예약을 원하시는 경우 <br />
		아래 예약하기 버튼을 클릭하여 예약을 해주세요.</p>
		<a href="" class="btn_orange">비회원 예약하기
		*/ ?>
	</a>
</li>
<? } ?>