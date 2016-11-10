<?
if(!defined('_INPLUS_')) { exit; } 

$layout_size = 'tiny';

/* set URI */
$this_uri = '/webadmin/recommend/list.html';

/* init Class */
$oRecommend = new RecommendAdmin();
$oRecommend->init();
$module_name = $oRecommend->get('module_name');	// 모듈명

/* search condition */
$query_string = $oRecommend->get('query_string');
$page = $oRecommend->get('page');

/* insert or update */
$pk = $oRecommend->get('pk');
$uid = $oRecommend->get('uid');
$data = $oRecommend->selectDetail($uid);

$rc_display_arr = $oRecommend->get('rc_display_arr');

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert';	

	$data = array(
		'rc_display'	=> 'Y'
	);
}

$max_file = $oRecommend->get('max_file');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">
		
		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
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
		<tbody id="write_tbody" class="rc_type_<?=$data['rc_type']?>">
		<tr>
			<th class="required">제목</td>
			<td>
				<input type="text" name="rc_subject" class="text required" value="<?=$data['rc_subject']?>" size="20" maxlength="10" title="제목" />
				<br />
				<span class="comment">추천 샵의 제목입니다. <strong class="info">최대 10자</strong>까지 입력 가능합니다.
			</td>
		</tr>
		<tr>
			<th class="required">부제</td>
			<td>
				<input type="text" name="rc_subject2" class="text required" value="<?=$data['rc_subject2']?>" size="50" maxlength="25" title="부제" />
				<br />
				<span class="comment">추천 샵의 부제입니다. <strong class="info">최대 25자</strong>까지 입력 가능합니다.
			</td>
		</tr>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th class="required">이미지</th>
			<td>	
				<input type="hidden" name="file_type[]" value="default" />
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="첨부파일" />
				<? if($file_list[$i]['file_id']) { ?>
				<br />
				<input type="checkbox" name="del_file[]" id="del_file_<?=$i?>" value="<?=$file_list[$i]['file_id']?>" title="파일삭제" />
				<label for="del_file_<?=$i?>">기존파일삭제</label>
				<span>|</span>				
				<?=$file_list[$i]['file_name']?>
				(<?=$file_list[$i]['size']?>)
				<?=$file_list[$i]['btn_download']?>
				<? } ?>
				<br />
				<span class="comment">추천 테마의 대표 이미지로 들어갑니다.</span>
			</td>
		</tr>
		<? } ?>
		<tr>
			<th class="required">노출여부</th>
			<td>
				<? printRadio('rc_display', $rc_display_arr, $data['rc_display'], 1); ?>
			</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<? if($mode == 'update') { ?>
		<fieldset class="etc">

		<!-- list_top -->
		<div class="list_top">
			<div class="left">
				<strong>추천 가맹점</strong>
				
			</div>
			<div class="right">
				<a href="../shop/ajax.list.html?<?=$pk?>=<?=$uid?>" class="btn_ajax size_800x700 sButton tiny info" target="#layer_popup" title="가맹점추가">가맹점추가</a>
				
			</div>
		</div>
		<!-- //list_top -->

		<p class="comment info">가맹점 정보 삭제시, 출력되고 있는 추천 가맹점 목록에서 삭제해주세요.</p>

		<table class="list_table border" border="1">
		<caption>추천가맹점</caption>
		<colgroup>
		<col width="50" />
		<col width="*" />			
		<col width="100" />
		</colgroup>
		<thead>
		<tr>
			<th>No</th>
			<th>가맹점명</th>
			<th>제거</th>
		</tr>
		</thead>
		<tbody id="shop_tbody">
		<? include_once(_MODULE_PATH_.'/shop/admin/ajax.recommend_list.php'); ?>
		</tbody>
		</table>
		</fieldset>
		<? } ?>

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
