<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'small';
$doc_title = '고객 엑셀 업로드';
?>
<style>
div.information {margin-bottom:40px; padding:15px 30px 20px 30px; border:1px solid #dadada; font-size:11px; background:#f5f5f5;}
div.information strong {font-weight:bold;}
div.information p {padding:5px 0 20px 0;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<div class="information">
		<h4><span class="icon tip_info"></span> 도움말</h4>
		
		엑셀파일을 이용하여 회원을 한번에 여러 명 등록 할 수 있습니다.<br />
		반드시 아래의 샘플파일을 다운로드 받아서 작성합니다. 파일은 <strong>CSV형식</strong>만 업로드 가능합니다.<br />
		<p><a href="#" class="sButton tiny">고객 엑셀 샘플 다운로드</a> </p>
		
		1. <strong>샘플파일의 항목명은 절대 수정하지 않은 상태</strong>로, 정보가 없는 항목은 비워두시기 바랍니다.<br />
		2. 작성이 완료된 파일을 아래에 첨부하고, <strong class="info">[등록하기]</strong> 버튼을 클릭하시면 등록 전 등록내용을 미리 확인하실 수 있습니다.
		
	</div>


	<div class="write">

		<form name="" method="" action="" onsubmit="" enctype="" autocomplete="">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>

		<!-- 예약박스를 통해 가입한 고객 -->
		<fieldset>
		<legend>등록/수정</legend>	
		<h4>회원 엑셀 업로드</h4>	
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>엑셀파일 업로드</th>
			<td>	
				<input type="hidden" name="file_type[]" value="sub">
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="서브이미지4">
				<br>
				<input type="checkbox" name="del_file[]" id="del_file_3" value="473" title="파일삭제">
				<label for="del_file_3">기존파일삭제</label>
				<span>|</span>				
				3.JPG (176.8KB)
				<a href="./download.html?file_id=473" class="sButton tiny" target="_blank" title="다운로드">다운로드</a>
			</td>
		</tr>	
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">등록하기</button>
			<a href="#" class="sButton active" title="목록">목록</a>
		</p>
		<!-- //고객등록을 통해 가입한 고객 -->

		</form>
	</div>
</div>
<!-- //<?=$module?> -->