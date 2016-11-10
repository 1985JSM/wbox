<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/advance/list.html';

/* init Class */
$oAdvance = new AdvanceManager();
$oAdvance->init();
$module_name = $oAdvance->get('module_name');	// 모듈명

/* search condition */
$query_string = $oAdvance->get('query_string');
$page = $oAdvance->get('page');

/* insert or update */
$pk = $oAdvance->get('pk');
$uid = $oAdvance->get('uid');
$data = $oAdvance->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
}
else {
	$mode = 'insert';	

	$data = array(
		'ad_type'	=> 'M'
	);
}

/* code */
$ad_type_arr = $oAdvance->get('ad_type_arr');
$ad_month_arr = $oAdvance->get('ad_month_arr');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$("#ad_type").on("change", function() {
		var ad_type = $(this).val();
		$("#write_tbody").attr("class", "ad_type_" + ad_type);		
	});

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">
		
		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
				
		<table class="write_table" id="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody id="write_tbody" class="ad_type_<?=$data['ad_type']?>">		
		<?
		printWriteInput('선불제명', 'ad_name', $data['ad_name'], 'required', 40, 20); 
		?>
		<tr>
			<th class="required">판매금액</th>
			<td>
				<input type="text" name="ad_price" class="text money required" value="<?=number_format($data['ad_price'])?>" size="15" maxlength="10" title="선불제가격" />원
			</td>
		</tr>
		<tr>
			<th class="required">선불제유형</th>
			<td>
				<select name="ad_type" id="ad_type" class="select required" title="선불제유형">
				<? printSelectOption($ad_type_arr, $data['ad_type'], 1); ?>
				</select>
			</td>
		</tr>
		<tr class="tr_ad_options ad_type_M">
			<th>정액요금</th>
			<td>
				<input type="text" name="ad_money" class="text money" value="<?=number_format($data['ad_money'])?>" size="15" maxlength="10" title="정액요금" />원
			</td>
		</tr>
		<tr class="tr_ad_options ad_type_Q">
			<th>이용횟수</th>
			<td>
				<input type="text" name="ad_quantity" class="text number" value="<?=number_format($data['ad_quantity'])?>" size="15" maxlength="5" title="이용횟수" />회
			</td>
		</tr>
		<tr class="tr_ad_options ad_type_P">
			<th>이용기간</th>
			<td>
				<select name="ad_month" class="select" title="이용기간">
				<? printSelectOption($ad_month_arr, $data['ad_month'], 1); ?>
				</select>
				<br />
				<span class="comment">
					- 선불제 상품의 실제 이용기간(시작일~만료일)은 <strong class="primary">고객관리</strong> 메뉴에서 고객에게 선불제 상품을 등록(연결)할 때 설정할 수 있습니다.
				</span>
			</td>
		</tr>
		<?
		printWriteTextarea('내용', 'ad_content', $data['ad_content'], '', '5', '80');
		?>					
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			<? if($mode == 'update') { ?>
			<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton" title="삭제">삭제</a>
			<? } ?>
		</p>

		</form>
	</div>
</div>
