<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/manager/list.html';

/* init Class */
$oManager = new ManagerAdmin();
$oManager->init();
$module_name = $oManager->get('module_name');	// 모듈명

/* search condition */
$query_string = $oManager->get('query_string');
$page = $oManager->get('page');

/* insert or update */
$pk = $oManager->get('pk');
$uid = $oManager->get('uid');
$data = $oManager->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.', './list.html');
}

$max_file = $oManager->get('max_file');
$file_list =$data['file_list'];
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">

		<h4>기본사항</h4>
				
		<table class="view_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>아이디</th>
			<td><?=$data['mb_id']?></td>		
		</tr>
		<tr>
			<th>가맹점</th>
			<td><?=$data['sh_name']?></td>
		</tr>
		<tr>
			<th>담당자명</th>
			<td><?=$data['mb_id']?></td>
		</tr>
		<tr>
			<th>이메일</th>
			<td><?=$data['mb_id']?></td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td><?=$data['mb_hp']?></td>
		</tr>
		<tr>
			<th>최근접속</th>
			<td><?=getWithoutNull($data['mb_login_time'])?></td>
		</tr>		
		<? for($i = 0 ; $i < sizeof($file_list) ; $i++) { ?>
		<tr>
			<th>첨부파일 #<?=$i+1?></th>
			<td>					
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
