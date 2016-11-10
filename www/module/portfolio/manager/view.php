<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/portfolio/list.html';

/* init Class */
$oPortfolio = new PortfolioManager();
$oPortfolio->init();
$module_name = $oPortfolio->get('module_name');	// 모듈명

$oPortfolio->set('thumb_width', '640');
$oPortfolio->set('thumb_height', '380');

/* search condition */
$query_string = $oPortfolio->get('query_string');
$page = $oPortfolio->get('page');

/* insert or update */
$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');
$data = $oPortfolio->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.');
}

/* file */
$max_file = $oShop->get('max_file');
$main_img = $data['main_img'];
$sub_img = $data['sub_img'];

/* comment */
//$oPortfolio->set('thumb_width', '120');
//$oPortfolio->set('thumb_height', '120');
$cmt_list = $oPortfolio->selectCommentList($uid, 1, 9999);
$cnt_comment = $oPortfolio->selectCountComment($uid);
$cmt_pk = $oPortfolio->get('comment_pk');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<!-- view -->

	<div class="board_view">
		<dl>
		<dt><?=$data['pf_subject']?></dt>
		<dd>
			<span><em>담당자</em><?=$data['pf_name']?></span>
			<span><em>작성일시</em><?=str_replace('-', '.', substr($data['reg_time'], 0, 16))?></span>
			<span><em>좋아요</em><?=number_format($data['cnt_like'])?></span>
		</dd>							
		<dd class="cont">
			<div>
				<!-- 게시판 내용 -->
				<p><img src="<?=$main_img['thumb']?>" alt="대표이미지" /></p>
				<? for($i = 0 ; $i < sizeof($sub_img) ; $i++) { ?>
				<p><img src="<?=$sub_img[$i]['thumb']?>" alt="서브이미지<?=$i+1?>" /></p>
				<? } ?>
				<p><?=nl2br($data['pf_content'])?></p>
				<!-- //게시판 내용 -->
			</div>
		</dd>		
		<dd>
			<em>태그</em>
			<span class="tag">
				<? for($i = 0 ; $i < sizeof($data['pf_tag_arr']) ; $i++) { 
					if($i > 0) { echo ','; }
					?>#<?=$data['pf_tag_arr'][$i]?><? } ?>
			</span>
		</dd>
		
		</dl>
		
		<!-- button -->
		<div class="button">
			<div class="left">		
				<a href="./write.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton" title="수정">수정</a>        
				<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton" title="삭제">삭제</a>	
			</div>
			<div class="right">
				<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			</div>
		</div>
		<!-- //button -->

		<div class="reply">
			<div class="reply_top">
				<div class="left">총 <?=number_format($cnt_comment)?>개의 댓글이 있습니다.</div>
				<div class="right"><a href="./ajax.write_comment.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="btn_ajax size_500x400 sButton primary tiny" target="#layer_popup" title="댓글쓰기">댓글쓰기</a></div>
			</div>
			<div class="reply_list">
				<ul>
				<? for($i = 0 ; $i < sizeof($cmt_list) ; $i++) { ?>
				<li>
					
					<em><?=$cmt_list[$i]['cm_name']?> (<?=$cmt_list[$i]['reg_date']?>)</em>
					<span class="txt"><?=nl2br($cmt_list[$i]['cm_content'])?></span>

					<? if($cmt_list[$i]['flag_reply']) { ?><a href="./ajax.reply_comment.html?<?=$pk?>=<?=$uid?>&<?=$cmt_pk?>=<?=$cmt_list[$i][$cmt_pk]?>&page=<?=$page?><?=$query_string?>" class="btn_ajax size_500x400 sButton tiny" target="#layer_popup" title="답변쓰기">답변</a><? } ?>
					<? if($cmt_list[$i]['flag_delete']) { ?><a href="./process.html?mode=delete_comment&<?=$pk?>=<?=$uid?>&<?=$cmt_pk?>=<?=$cmt_list[$i][$cmt_pk]?>&page=<?=$page?><?=$query_string?>" class="btn_delete sButton tiny">삭제</a><? } ?>

					<? if($cmt_list[$i]['re_id'] && $cmt_list[$i]['re_content']) { ?>
					<div class="rep_area">
						<strong><?=$cmt_list[$i]['re_name']?> (<?=$cmt_list[$i]['re_date']?>)</strong>
						<span class="rep_txt"><?=$cmt_list[$i]['re_content']?></span>
						<? if($cmt_list[$i]['flag_reply']) { ?><a href="./process.html?mode=delete_reply&<?=$pk?>=<?=$uid?>&<?=$cmt_pk?>=<?=$cmt_list[$i][$cmt_pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny">삭제</a><? } ?>
					</div>
					<? } ?>

				</li>
				<? } if(sizeof($cmt_list) == 0) { ?><li class="no_data">작성된 댓글이 없습니다.</li><? } ?>
				</ul>

			</div>
		</div>

	</div>
	<!-- //board_view -->
		

</div>
