<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'tiny';
$doc_title = '메인비주얼 관리';
?>


<!-- <?=$module?> -->
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
		<h4>기본정보</h4>		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th class="required">제목</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="80" title="제목" />
			</td>
		</tr>	
		<tr class="file">			
			<th class="required">메인이미지<br />(640 * 400)</th>
			<td class="file">	
				<input type="file" name="" value="" class="file" size="80" title="첨부파일" />
				<br />
				<a href="" target="_blank"><img src="/img/mobile/main/img_main.jpg" width="100" height="63" alt="thumbnail" /></a>
				<span>|</span>
				<input type="checkbox" name="" value="" title="파일삭제" />
				<label>기존파일삭제</label>
				Test.png (150.5KB, 0회)
				<a href="" class="sButton tiny" target="_blank" title="다운로드">다운로드</a>						
			</td>
		</tr>
		<tr>
			<th class="required">상태</th>
			<td>
				<input type="radio" name="" value=""/> <label>사용</label>
				<input type="radio" name="" value=""/> <label>미사용</label>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>


		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="/webadmin/page/mainshop_list.html" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="즉시탈퇴처리">삭제</a>
		</p>

		</form>
	</div>
</div>
<!-- //<?=$module?> -->
