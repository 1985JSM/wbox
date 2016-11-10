<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'tiny';
$doc_title = '이벤트';
?>


<!-- <?=$module?> -->
<div id="<?=$module?>">

	<div class="write">

		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />
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
		<tr>
			<th class="required">이벤트시작일</th>
			<td>
				<input type="text" name="" value="" class="text date required" size="20" maxlength="10" title="이벤트시작일" />
			</td>
		</tr>
		<tr>
			<th class="required">이벤트종료일</th>
			<td>
				<input type="text" name="" value="" class="text date required" size="20" maxlength="10" title="이벤트종료일" />
			</td>
		</tr>
		
		<tr>
			<th class="required">상태</th>
			<td>
				<input type="radio" name="" value=""/> <label>진행</label>
				<input type="radio" name="" value=""/> <label>종료</label>
			</td>
		</tr>
		<tr>
			<th>이용안내1</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="80" title="제목" />
				<br />
				<span class="comment">이벤트 상세페이지 하단에 출력됩니다. <strong class="info">최대 5개까지</strong> 입력가능합니다.</span>
			</td>
		</tr>
		<tr>
			<th>이용안내2</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="80" title="제목" />
			</td>
		</tr>
		<tr>
			<th>이용안내3</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="80" title="제목" />
			</td>
		</tr>
		<tr>
			<th>이용안내4</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="80" title="제목" />
			</td>
		</tr>
		<tr>
			<th>이용안내5</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="80" title="제목" />
			</td>
		</tr>
		<tr class="file">			
			<th class="required">배너이미지<br />(600 * 160)</th>
			<td class="file">	
				<input type="file" name="" value="" class="file" size="80" title="첨부파일" />
				<br />
				<a href="" target="_blank"><img src="/img/mobile/main/img_main.jpg" width="100" height="27" alt="thumbnail" /></a>
				<span>|</span>
				<input type="checkbox" name="" value="" title="파일삭제" />
				<label>기존파일삭제</label>
				Test.png (150.5KB, 0회)
				<a href="" class="sButton tiny" target="_blank" title="다운로드">다운로드</a>						
			</td>
		</tr>
		<tr class="file">			
			<th class="required">상세이미지1<br />(가로 640)</th>
			<td class="file">	
				<input type="file" name="" value="" class="file" size="80" title="첨부파일" />
				<br />
				<a href="" target="_blank"><img src="/img/mobile/main/img_main.jpg" width="100" height="100" alt="thumbnail" /></a>
				<span>|</span>
				<input type="checkbox" name="" value="" title="파일삭제" />
				<label>기존파일삭제</label>
				Test.png (150.5KB, 0회)
				<a href="" class="sButton tiny" target="_blank" title="다운로드">다운로드</a>						
			</td>
		</tr>
		<tr class="file">			
			<th>상세이미지2<br />(가로 640)</th>
			<td class="file">	
				<input type="file" name="" value="" class="file" size="80" title="첨부파일" />
				<br />
				<a href="" target="_blank"><img src="/img/mobile/main/img_main.jpg" width="100" height="100" alt="thumbnail" /></a>
				<span>|</span>
				<input type="checkbox" name="" value="" title="파일삭제" />
				<label>기존파일삭제</label>
				Test.png (150.5KB, 0회)
				<a href="" class="sButton tiny" target="_blank" title="다운로드">다운로드</a>						
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
