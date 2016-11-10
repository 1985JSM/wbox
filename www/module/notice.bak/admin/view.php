<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/notice/list.html';

/* init Class */
$oNotice = new NoticeAdmin();
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

	<div class="board_view">
		<dl>
		<dt><?=$data['nt_subject']?></dt>
		<dd>
			<span><em>작성자</em><?=$data['nt_name']?></span>
			<span><em>작성일시</em><?=$data['reg_time']?></span>
			<span><em>출력구분</em>가맹점</span>
		</dd>							
		<dd class="cont">
			<div>
				<!-- 게시판 내용 -->
				<p><?=nl2br($data['nt_content'])?></p>
				<!-- //게시판 내용 -->
			</div>
		</dd>				
		</dl>

		<div class="view_paging">
			<dl class="prev">
				<dt>이전글</dt>
				<dd>
				<a href="#">공지사항 테스트입니다. 공지사항 테스트입니다.</a>
				</dd>
			</dl>
			<dl class="next">
				<dt>다음글</dt>
				<dd>다음글이 없습니다.</dd>
			</dl>
		</div>

		<!-- button -->
		<div class="button">
			<div class="left">		
				<a href="#" class="sButton" title="수정">수정</a>
				<a href="#" class="sButton" title="삭제">삭제</a>

			</div>
			<div class="right">
				<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			</div>
		</div>
		<!-- //button -->


	</div>
	<!-- //board_view -->

	<!--div class="write">

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
			<th>출력구분</th>
			<td colspan="3">가맹점, 담당자, 사용자, 홈페이지</td>
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
			<a href="./write.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton primary" title="수정">수정</a>
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton warning" title="삭제">삭제</a>
		</p>

	</div-->
</div>
