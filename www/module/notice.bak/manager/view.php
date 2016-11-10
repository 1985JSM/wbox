<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/notice/list.html';

/* init Class */
$oNotice = new NoticeManager();
$oNotice->init();
$module_name = $oNotice->get('module_name');	// 모듈명

/* search condition */
$query_string = $oNotice->get('query_string');
$page = $oNotice->get('page');

/* insert or update */
$pk = $oNotice->get('pk');
$uid = $oNotice->get('uid');
$data = $oNotice->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.');
}

$file_list = $data['file_list'];
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">

		<h4>상세보기</h4>
		
		<table class="view_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>제목</th>
			<td colspan="3"><?=$data['nt_subject']?></td>
		</tr>		
		<tr>
			<th>작성자</th>
			<td><?=$data['nt_name']?></td>
			<th>작성일시</th>
			<td><?=$data['reg_time']?></td>
		</tr>
		<tr>
			<th>내용</th>
			<td colspan="3"><?=nl2br($data['nt_content'])?></td>
		</tr>
		<? for($i = 0 ; $i < sizeof($file_list) ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>첨부파일 #<?=$i+1?></th>
			<td colspan="3">	
				<?=$file_list[$i]['file_name']?>
				(<?=$file_list[$i]['size']?>, <?=$file_list[$i]['down']?>회)
				<?=$file_list[$i]['btn_download']?>
			</td>
		</tr>
		<? } ?>				
		</tbody>
		</table>

		<p class="button">
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
		</p>

	</div>
</div>
