<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '메시지 충전내역';

$oSms = new SmsManager();
$oSms->checkJoined(true);
$payment_list = $oSms->getPayList();

$oSms->set('total_cnt', $payment_list['cnt_total']);
$page = $oSms->get('page');
$page_arr = $oSms->getPageArray();
$query_string = $oSms->get('query_string');
$sch_date_arr = $oSms->get('sch_date_arr');
?>
<script language="JavaScript" src="http://pgweb.uplus.co.kr:7085/WEB_SERVER/js/receipt_link.js"></script>
<!--script language="JavaScript" src="http://pgweb.uplus.co.kr/WEB_SERVER/js/receipt_link.js"></script-->
<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function() {
		/* 출력옵션 */
		$("select.order_select").on("change", function() {

			var f = document.search_form;
			var name = $(this).attr("name");
			var value = $(this).val();

			$("input[name='" + name + "']", f).attr("value", value).val(value);
			if(f.onsubmit()) {
				f.submit();
			}
		});
	});
	/* 검색폼 유효성 검사 */
	function submitSearchForm(f) {

		if(!validateForm(f)) {
			return false;
		}

		return true;
	}
	//]]>

</script>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_payment">
		<!-- search -->
		<div class="search">
			<form name="search_form" method="get" onsubmit="return submitSearchForm()">
				<input type="hidden" name="sch_cnt_rows" value="<?=$sch_cnt_rows?>" />

			<fieldset>
			<legend>검색조건</legend>
			<table class="search_table" border="1">
			<caption>검색조건</caption>
			<colgroup>
			<col width="90" />
			<col width="*" />
			</colgroup>
			<tbody>
			<tr>
				<th>유형</th>
				<td colspan="3">								

					<select name="sch_pa_method" class="select" title="결제수단">
						<option value="">결제수단</option>
						<? printSelectOption($oSms->get('pa_method'), $sch_pa_method, 1); ?>
					</select>

					<select name="sch_pa_state" class="select" title="결제상태">
						<option value="">결제상태</option>
						<? printSelectOption($oSms->get('pa_state'), $sch_pa_state, 1); ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>기간</th>
				<td>								
					<select name="sch_date" class="select" title="기간유형">
						<option value="">기간유형</option>
						<? printSelectOption($oSms->get('sch_date'), $sch_date, 1); ?>
					</select>

					<input type="text" name="sch_s_date" id="sch_s_date" value="<?=$sch_s_date?>" class="text date" size="12" maxlength="10" title="검색 시작일" />
					~
					<input type="text" name="sch_e_date" id="sch_e_date" value="<?=$sch_e_date?>" class="text date" size="12" maxlength="10" title="검색 종료일" />	
					
					<a href="./list.html?sch_s_date=<?=$sch_date_arr[0]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny btn_quick_date">1일</a>
					<a href="./list.html?sch_s_date=<?=$sch_date_arr[1]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny btn_quick_date">7일</a>
					<a href="./list.html?sch_s_date=<?=$sch_date_arr[2]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny btn_quick_date">30일</a>
					<a href="./list.html?sch_s_date=<?=$sch_date_arr[3]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny btn_quick_date">6개월</a>
				</td>
			</tr>
			<tr>
				<th>결제번호</th>
				<td>					
					<input type="text" name="" value="" class="text" size="50" maxlength="50" title="검색어" /> (현재 사용안함)
				</td>
			</tr>
			</tbody>
			</table>
			</fieldset>

			<p class="button">		
				<button type="submit" class="sButton info" title="검색">검 색</button>
				<a href="?page=1" class="sButton" title="초기화">초기화</a>
			</p>
			</form>
		</div>
		<!-- //search -->				

		<!-- list_top -->
		<div class="list_top">
			<div class="left">
				Total : <strong><?=$payment_list['cnt_total']?></strong> 건, 현재 : <strong><?=$oSms->get('page')?></strong> 페이지
			</div>
			<div class="right">
				<strong>*출력옵션 : </strong>
				<select name="sch_cnt_rows" class="select order_select" title="출력개수">
				<? printSelectOption($oSms->get('cnt_rows_arr'), $oSms->get('cnt_rows'), 1); ?>
				</select>
			</div>
		</div>
		<!-- //list_top -->

		<!-- list -->
		<table class="list_table border" summary="결제내역에 관련된 표로써 결제일시, 결제번호, 충전건수, 결제수단, 결제상태, 결제금액, 영수증 등 순으로 출력됩니다.">
		<caption>결제내역</caption>
		<colgroup>
		<col width="120" />
		<col width="*" />
		<col width="80" />
		<col width="80" />
		<col width="80" />
		<col width="100" />
		<col width="60" />
		</colgroup>
		<thead>
		<tr>
			<th>결제일시</th>
			<th>결제번호</th>
			<th>충전건수</th>
			<th>결제수단</th>
			<th>결제상태</th>
			<th>결제금액</th>
			<th>영수증</th>
		</tr>	
		</thead>
		<tbody>
		<?
		if ($payment_list['cnt_current'] > 0) {
			foreach ($payment_list['list'] as $key => $value) { ?>
			<tr>
				<td><?=$value['pa_pay_datetime']?></td>
				<td><?=$value['pa_pg_tid']?></td>
				<td><?=$value['pa_subject']?></td>
				<td><?=$value['txt_pa_method']?></td>
				<td><span class="<?=$value['txt_pa_state_class']?>"><?=$value['txt_pa_state']?></span></td>
				<td><strong><?=number_format($value['pa_price'])?></strong></td>
				<td><?=$value['print_receipt']?></td>
			</tr>
			<?
			}
		} else {
			printNoData(7);
		}
		?>
		</tbody>
		</table>
		<!-- //list -->

		<!-- pagination -->
		<div class="pagination">
			<ul>
				<? printPagination($page_arr, $query_string); ?>
			</ul>
		</div>
		<!-- //pagination -->
	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->