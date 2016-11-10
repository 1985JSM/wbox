<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/qna/list.html';

/* init Class */
$oQna = new QnaAdmin();
$oQna->init();
$module_name = $oQna->get('module_name');	// 모듈명

/* search condition */
$query_string = $oQna->get('query_string');
$page = $oQna->get('page');

/* insert or update */
$pk = $oQna->get('pk');
$uid = $oQna->get('uid');
$data = $oQna->selectDetail($uid);

// file
$file_list = $data['file_list'];
$max_file = $oQna->get('max_file');
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
		<dt><?=$data['bo_subject']?></dt>
		<dd>
			<span><em>작성자</em><?=$data['bo_name']?></span>
			<span><em>작성일시</em><?=$data['reg_time']?></span>
			<span><em>작성유형</em><?=$data['txt_bo_publish']?></span>
			<span><em>답변여부</em><?=$data['txt_bo_state']?></span>
		</dd>							
		<dd>
			<span><em>연락처</em><?=getWithoutNull($data['bo_tel'])?></span>
			<span><em>이메일</em><?=getWithoutNull($data['bo_email'])?></span>			
		</dd>	
		<dd class="cont">
			<div>
				<!-- 게시판 내용 -->
				<p><?=nl2br($data['bo_content'])?></p>
				<!-- //게시판 내용 -->
			</div>
		</dd>				
		</dl>
	</div>

	<div class="write">

		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="update_answer" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

		<h4>답변작성</h4>		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>		
		<th class="required">답변내용</th>
			<td>
				<textarea name="bo_answer" class="textarea required" rows="20" cols="120" title="답변내용"><?=$data['bo_answer']?></textarea>	
			</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./view.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton active" title="취소">취소</a>
		</p>

		</form>
	</div>
</div>
