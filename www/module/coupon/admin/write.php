<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/coupon/list.html';

/* init Class */
$oCoupon = new CouponAdmin();
$oCoupon->init();
$module_name = $oCoupon->get('module_name');	// 모듈명

/* search condition */
$query_string = $oCoupon->get('query_string');
$page = $oCoupon->get('page');

/* insert or update */
$pk = $oCoupon->get('pk');
$uid = $oCoupon->get('uid');
$data = $oCoupon->selectDetail($uid);

/* code */
$cp_publish_arr = $oCoupon->get('cp_publish_arr');
$cp_type_arr = $oCoupon->get('cp_type_arr');
$cp_sale_type_arr = $oCoupon->get('cp_sale_type_arr');
$cp_level_arr = $oCoupon->get('mb_level_arr');
unset($cp_level_arr[1]);
unset($cp_level_arr[2]);

$cp_limit_arr = $oCoupon->get('cp_limit_arr');
$cp_publish_arr = $oCoupon->get('cp_publish_arr');
$cp_display_arr = $oCoupon->get('cp_display_arr');

if($data[$pk]) {
	$mode = 'update';
}
else {
	$mode = 'insert';	

	$data = array(
		'cp_type'		=> 'C',
		'cp_limit'		=> 'Y',
		'cp_display'	=> 'Y'
	);
}
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$("input.cp_type").on("click", function(e) {
		var cp_type = $(this).val();
		$("#write_tbody").attr("class", "cp_type_" + cp_type);
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
				
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody id="write_tbody" class="cp_type_<?=$data['cp_type']?>">
		<?
		printWriteInput('쿠폰명', 'cp_name', $data['cp_name'], 'required', 40, 20); 
		?>
		<tr>
			<th class="required">쿠폰유형</th>
			<td>
				<? printRadio('cp_type', $cp_type_arr, $data['cp_type'], 1); ?>				
			</td>
		</tr>
		<tr class="cp_sale_price">
			<th class="required">할인금액(율)</th>
			<td>
				<input type="text" name="cp_sale_price" class="text number" value="<?=$data['cp_sale_price']?>" size="10" maxlength="10" title="할인금액" /> 

				<select name="cp_sale_type" class="select" title="할인방식">
				<? printSelectOption($cp_sale_type_arr, $data['cp_sale_type'], 1); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th class="required">사용등급</th>
			<td>
				<? printCheckBox('cp_levels', $cp_level_arr, $data['cp_levels'], 1); ?>
			</td>
		</tr>
		<tr>
			<th>제공수량</th>
			<td>
				<input type="text" name="cp_quantity" class="text number" value="<?=$data['cp_quantity']?>" size="10" maxlength="10" title="제공수량" /> 개 까지 사용가능
				<br />
				<span class="comment">- 0개 또는 비워놓는 경우 <strong class="info">무제한 제공</strong>됩니다.</span>				
			</td>
		</tr>
		<tr>
			<th class="required">사용제한</th>
			<td>
				<? printRadio('cp_limit', $cp_limit_arr, $data['cp_limit'], 1); ?>
			</td>
		</tr>
		<tr>
			<th class="required">노출여부</th>
			<td>
				<? printRadio('cp_display', $cp_display_arr, $data['cp_display'], 1); ?>
			</td>
		</tr>
		<?
		printWriteInput('이용안내1', 'cp_guide1', $data['cp_guide1'], '', 80, 50);
		printWriteInput('이용안내2', 'cp_guide2', $data['cp_guide2'], '', 80, 50);
		printWriteInput('이용안내3', 'cp_guide3', $data['cp_guide3'], '', 80, 50);
		?>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			<? if($mode == 'update') { ?>
			<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$poage?><?=$query_string?>" id="btn_delete" class="sButton" title="삭제">삭제</a>
			<? } ?>
		</p>

		</form>
	</div>
</div>
