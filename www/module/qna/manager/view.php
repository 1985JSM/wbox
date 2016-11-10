<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/qna/list.html';

/* init Class */
$oQna = new QnaManager();
$oQna->init();
$module_name = $oQna->get('module_name');	// 모듈명

/* search condition */
$query_string = $oQna->get('query_string');
$page = $oQna->get('page');

/* insert or update */
$pk = $oQna->get('pk');
$uid = $oQna->get('uid');
$data = $oQna->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.');
}

$file_list = $data['file_list'];
$max_file = $oQna->get('max_file');

$sr_list = $oQna->selectSurroundList($uid);
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

	<div class="board_view">
		<dl>
		<dt><?=$data['bo_subject']?></dt>
		<dd>
			<span><em>작성자</em><?=$data['bo_name']?></span>
			<span><em>작성일시</em><?=$data['reg_time']?></span>
			<span><em>답변여부</em><?=$data['txt_bo_state']?></span>
		</dd>							
		<dd class="cont">
			<div>
				<!-- 게시판 내용 -->
				<p><?=nl2br($data['bo_content'])?></p>
				<!-- //게시판 내용 -->
			</div>
		</dd>				
		</dl>

		<? if($data['bo_state'] == 'Y') { ?>
		<dl class="comment">
		<dt><span class="success">[답변]</span> 답변입니다.</dt>
		<dd>
			<span><em>작성자</em><?=$data['ans_name']?></span>
			<span><em>작성일시</em><?=$data['ans_time']?></span>
		</dd>
		<dd class="cont">
			<div>
				<p><?=nl2br($data['bo_answer'])?></p>
			</div>
		</dd>		
		</dl>
		<? } ?>

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
				<? if($data['bo_state'] == 'Y') { ?>
				<button type="button" onclick="alert('답변이 작성된 글은 수정할 수 없습니다.')" class="sButton" title="수정">수정</button>
				<? } else { ?>
				<a href="./write.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton" title="수정">수정</a>
				<? } ?>
				<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton warning" title="삭제">삭제</a>									
			</div>
			<div class="right">
				<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			</div>
		</div>
		<!-- //button -->

	</div>
	<!-- //board_view -->

</div>
