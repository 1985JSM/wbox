<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/alliance/list.html';

/* init Class */
$oAlliance = new AllianceAdmin();
$oAlliance->init();
$module_name = $oAlliance->get('module_name');	// 모듈명

/* search condition */
$query_string = $oAlliance->get('query_string');
$page = $oAlliance->get('page');

/* insert or update */
$pk = $oAlliance->get('pk');
$uid = $oAlliance->get('uid');
$data = $oAlliance->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.');
}

$file_list = $data['file_list'];
$max_file = $oAlliance->get('max_file');

$sr_list = $oAlliance->selectSurroundList($uid);
$prev = $sr_list['prev'];
$next = $sr_list['next'];
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>	
		<tr>
			<th class="required">이름</th>
			<td colspan="3"><?=$data['bo_name']?></td>
		</tr>
		<tr>
			<th class="required">연락처</th>
			<td><?=$data['bo_tel']?> (SMS <?=$data['txt_flag_sms']?>)</td>
			<th class="required">통화가능시간</th>
			<td><?=$data['bo_etc1']?> ~ <?=$data['bo_etc2']?></td>
		</tr>
		<tr>
			<th class="required">이메일</th>
			<td colspan="3"><?=$data['bo_email']?> (이메일 <?=$data['txt_flag_sms']?>)</td>
		</tr>
		<tr>
			
		</tr>
		<tr>
			<th>업체명</th>
			<td><?=getWithoutNull($data['bo_etc3'])?></td>
			<th>대표자</th>
			<td><?=getWithoutNull($data['bo_etc4'])?></td>
		</tr>
		<tr>
			<th>사업자등록번호</th>
			<td><?=getWithoutNull($data['bo_etc5'])?></td>
			<th>업체연락처</th>
			<td><?=getWithoutNull($data['bo_etc6'])?></td>
		</tr>
		<tr class="addr">
			<th>주소</th>
			<td colspan="3"><?=getWithoutNull($data['bo_etc7'])?></td>
		</tr>
		<tr>
		
		<tr>
			<th>문의내용</th>
			<td colspan="3">
				<p><?=nl2br($data['bo_content'])?></p>
			</td>
		</tr>			
				
		<tr>
			<th>작성일시</th>
			<td colspan="3"><?=$data['reg_time']?></td>	
		</tr>
		</tbody>
		</table>
		</fieldset>

		<!-- view_paging -->
		<div class="view_paging">
			<dl class="prev">
			<dt>이전글</dt>
			<dd>
				<? if($prev[$pk]) { ?>
				<a href="./view.html?<?=$pk?>=<?=$prev[$pk]?>&page=<?=$page?><?=$query_string?>"><?=$prev['bo_subject']?></a>
				<? } else { ?>이전글이 없습니다.<? } ?>
			</dd>
			</dl>
			<dl class="next">
			<dt>다음글</dt>
			<dd>
				<? if($next[$pk]) { ?>
				<a href="./view.html?<?=$pk?>=<?=$next[$pk]?>&page=<?=$page?><?=$query_string?>"><?=$next['bo_subject']?></a>
				<? } else { ?>다음글이 없습니다.<? } ?>
			</dd>
			</dl>
		</div>
		<!-- //view_paging -->

		<!-- button -->
		<div class="button">
			<div class="left">		
				<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton warning" title="삭제">삭제</a>					
			</div>
			<div class="right">
				<a href="./list.html?" class="sButton active" title="목록">목록</a>
			</div>
		</div>
		<!-- //button -->

	</div>
	<!-- //board_view -->

</div>
