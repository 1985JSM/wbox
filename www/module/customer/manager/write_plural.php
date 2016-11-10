<?
if(!defined('_INPLUS_')) { exit; }

/* set URI */
$this_uri = '/webmanager/customer/list.html';
$layout_size = 'small';
if ($_GET['mode'] == 'upload_list') {
	$layout_size = 'large';
}
$doc_title = '고객 엑셀 업로드';

/* init Class */
$oCustomer = new CustomerManager();
$oCustomer->init();
$module_name = $oCustomer->get('module_name');	// 모듈명

/* search condition */
$query_string = $oCustomer->get('query_string');
$page = $oCustomer->get('page');

/* insert or update */
$pk = $oCustomer->get('pk');
$uid = $oCustomer->get('uid');
$data = $oCustomer->selectDetail($uid);

if ($_GET['mode'] == 'upload_list') {
	if(empty($_FILES['csvfile'])) {
		echo '파일을 첨부하셔야합니다.';
	} else {
		$fread = $oCustomer->processPluralCustomerData($_FILES);
		?>
		<style>
			div.information {margin-bottom:40px; padding:15px 30px 20px 30px; border:1px solid #dadada; font-size:11px; background:#f5f5f5;}
			div.information strong {font-weight:bold;}
			div.information p {padding:5px 0 20px 0;}
		</style>
		<!-- <?=$module?> -->
		<div id="<?=$module?>">

			<div class="information">
				<h4><span class="icon tip_info"></span> 도움말</h4>
				아래 고객 목록은 등록될 고객 목록을 미리 보여줍니다.<br />
				아래 고객 목록 확인 후 등록을 원하시는 경우, 아래의 <strong class="info">[등록하기]</strong> 버튼을 클릭해주세요.
			</div>


			<!-- list -->
			<div class="list">
				<h4>등록할 고객 목록</h4>
				<form name="upload_form" method="post" action="?<?= $pk ?>=<?= $uid ?>&page=<?= $page ?><?= $query_string ?>&mode=upload">
					<?
					for ($i = 1; $i < sizeof($fread); $i++) {
						?>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][0] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][1] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][2] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][3] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][4] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][5] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][6] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][7] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][8] ?>"/>
						<input type="hidden" name="data[<?= ($i - 1) ?>][]" value="<?= $fread[$i][9] ?>"/>
						<?
					}
					?>
				<!-- list_table -->
				<table class="list_table border odd" border="1">
					<colgroup>
						<col width="120" />
						<col width="50" />
						<col width="130" />
						<col width="230" />
						<col width="100" />
						<col width="100" />
						<col width="70" />
						<col width="100" />
						<col width="150" />
						<col width="*" />
					</colgroup>
					<thead>
					<tr>
						<th>이름</th>
						<th>성별</th>
						<th>닉네임</th>
						<th>이메일</th>
						<th>휴대폰</th>
						<th>생년월일</th>
						<th>양력/음력</th>
						<th>가맹점등급</th>
						<th>담당자</th>
						<th>메모</th>
					</tr>
					</thead>
					<tbody>
					<?
					if (count($fread) > 1) {
						for ($i = 1; $i < sizeof($fread); $i++) {
							echo '<tr class="list_tr_' . ($i - 1) . '">';
							foreach ($fread[$i] as $key => $value) {
								if ($key == 9 && $value = "") {
									$value = "-";
								}
								echo '<td>' . $value . '</td>';
							}
							echo '</tr>';
						}
					} else {
						echo '<td colspan="10" class="no_data">업로드할 수 있는 정보가 없습니다.</td>';//검색 결과가 없습니다.
					}
					?>
					</tbody>
				</table>
				<!-- //list_table -->

				<p class="button">
					<button type="submit" class="sButton primary">등록하기</button>
					<a href="?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
				</p>
				</form>
			</div>
			<!-- //list -->
		</div>
		<!-- //<?=$module?> -->
		<?
	}
} else if ($_GET['mode'] == 'upload') {
	$upload_result = $oCustomer->insertPluralCustomerData($_POST);

	if ($upload_result['code'] == 'ok') {
		alert($upload_result['message'], $upload_result['return_url']);
	} else {
		alert('업로드가 실패하였습니다. 다시 시도해주십시오.', './list.html');
	}
} else {
?>
<style>
	div.information {margin-bottom:40px; padding:15px 30px 20px 30px; border:1px solid #dadada; font-size:11px; background:#f5f5f5;}
	div.information strong {font-weight:bold;}
	div.information p {padding:5px 0 20px 0;}
</style>
<!-- <?=$module?> -->
<div id="<?=$module?>">

	<div class="information">
		<h4><span class="icon tip_info"></span> 도움말</h4>

		엑셀파일을 이용하여 회원을 한번에 여러 명 등록 할 수 있습니다.<br />
		반드시 아래의 샘플파일을 다운로드 받아서 작성합니다. 파일은 <strong>CSV형식</strong>만 업로드 가능합니다.<br />
		<p><a href="/share/sample.csv" class="sButton tiny">고객 엑셀 샘플 다운로드</a> </p>

		1. <strong>샘플파일의 항목명은 절대 수정하지 않은 상태</strong>로, 정보가 없는 항목은 비워두시기 바랍니다.<br />
		2. 작성이 완료된 파일을 아래에 첨부하고, <strong class="info">[등록하기]</strong> 버튼을 클릭하시면 등록 전 등록내용을 미리 확인하실 수 있습니다.

	</div>


	<div class="write">

		<form name="upload_form" method="post" action="?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>&mode=upload_list" enctype="multipart/form-data" autocomplete="off">
			<fieldset>
				<legend>검색관련</legend>
				<input type="hidden" name="mode" value="<?=$mode?>" />
				<input type="hidden" name="page" value="<?=$page?>" />
				<input type="hidden" name="query_string" value="<?=$query_string?>" />
			</fieldset>

			<!-- 예약박스를 통해 가입한 고객 -->
			<fieldset>
				<legend>등록/수정</legend>
				<h4>회원 엑셀 업로드</h4>

				<table class="write_table" border="1">
					<caption>등록/수정</caption>
					<colgroup>
						<col width="140" />
						<col width="*" />
					</colgroup>
					<tbody>
					<tr>
						<th>엑셀파일 업로드</th>
						<td>
							<input type="file" name="csvfile" class="file" size="80" title="파일">
						</td>
					</tr>
					</tbody>
				</table>
			</fieldset>

			<p class="button">
				<button type="submit" class="sButton primary">등록하기</button>
				<a href="list.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			</p>
			<!-- //고객등록을 통해 가입한 고객 -->

		</form>
	</div>
</div>
<!-- //<?=$module?> -->
<? } ?>