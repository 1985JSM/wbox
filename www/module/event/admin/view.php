<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/event/list.html';

/* init Class */
$oEvent = new EventAdmin();
$oEvent->init();
$module_name = $oEvent->get('module_name');	// 모듈명

/* search condition */
$query_string = $oEvent->get('query_string');
$page = $oEvent->get('page');

$oEvent->set('thumb_width', 600);
$oEvent->set('thumb_height', 0);

/* insert or update */
$pk = $oEvent->get('pk');
$uid = $oEvent->get('uid');
$data = $oEvent->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.');
}

// file
$file_list = $data['file_list'];
$max_file = $oEvent->get('max_file');
$main_img = $data['main_img'];
$sub_img = $data['sub_img'];

$sr_list = $oEvent->selectSurroundList($uid);
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
		<dt>[<?=$data['txt_bo_state']?>] <?=$data['bo_subject']?></dt>
		<dd>
			<span><em>작성자</em><?=$data['bo_name']?></span>
			<span><em>작성일시</em><?=$data['reg_time']?></span>
			<span><em>이벤트기간</em><?=$data['bo_s_date']?> ~ <?=$data['bo_e_date']?></span>
		</dd>							
		<dd class="cont">
			<div>
				<!-- 게시판 내용 -->
				<p>
					<? if($main_img) { ?><img src="<?=$main_img['thumb']?>" alt="main image" /><br /><? } ?>
					<? if($sub_img) { ?><img src="<?=$sub_img['thumb']?>" alt="sub image" /><br /><? } ?>
					<?=nl2br($data['bo_content'])?>
				</p>
				<!-- //게시판 내용 -->
			</div>
		</dd>				
		</dl>

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
				<a href="./write.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton" title="수정">수정</a>            
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
