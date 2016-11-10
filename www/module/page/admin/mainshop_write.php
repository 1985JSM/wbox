<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'tiny';
$doc_title = '추천샵 관리';
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
				<input type="text" name="" class="text" value="" size="80" maxlength="10" title="제목" />
				<br />
				<span class="comment">추천 샵의 제목입니다. <strong class="info">최대 10자</strong>까지 들어갑니다.</span>
			</td>
		</tr>	
		<tr>
			<th class="required">부제목</th>
			<td>
				<input type="text" name="" class="text" value="" size="80" maxlength="25" title="부제목" />
				<br />
				<span class="comment">추천 샵의 부제목입니다. <strong class="info">최대 25자</strong>까지 들어갑니다.</span>
			</td>
		</tr>	
		<tr class="file">			
			<th class="required">이미지<br />(600 * 290)</th>
			<td class="file">	
				<input type="file" name="" value="" class="file" size="80" title="첨부파일" />
				<br />
				<a href="" target="_blank"><img src="/img/mobile/main/img_main.jpg" width="100" height="48" alt="thumbnail" /></a>
				<span>|</span>
				<input type="checkbox" name="" value="" title="파일삭제" />
				<label>기존파일삭제</label>
				Test.png (150.5KB, 0회)
				<a href="" class="sButton tiny" target="_blank" title="다운로드">다운로드</a>	
				<br />
				<span class="comment">추천 테마의 대표 이미지로 들어갑니다.</span>
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


		<fieldset class="etc">
		<!-- list_top -->
		<div class="list_top">
			<div class="left">
				<strong>추천 가맹점</strong>
			</div>
			<div class="right">
				<button type="button" onclick="" class="sButton tiny info">가맹점추가</button>
				
			</div>
		</div>
		<!-- //list_top -->
		<table class="list_table border" border="1">
		<caption>추천가맹점</caption>
		<colgroup>
		<col width="*" />			
		<col width="100" />
		</colgroup>
		<thead>
		<tr>
			<th>가맹점명</th>
			<th>제거</th>
		</tr>
		</thead>
		<tbody">				
		<tr>
			<td>블루밍스윗</td>
			<td><button type="button" onclick="" class="sButton tiny">삭제</button></td>
		</tr>
		<tr>
			<td class="no_data" colspan="2">등록 또는 검색된 데이터가 없습니다.</td>
		</tr>
		</tbody>
		</table>
		</fieldset>



		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="/webadmin/page/mainvisual_list.html" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="즉시탈퇴처리">삭제</a>
		</p>

		</form>
	</div>
</div>
<!-- //<?=$module?> -->


<!-- 선불제 신규등록 팝업 -->
<div id="layer_popup" style="width: 800px; height: 700px; margin-top: -355px; margin-left: -400px; display:block; z-index:999;">
	<div id="layer_header">
		<h1>선불제 신규 등록</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="/img/common/btn_close_layer.gif" alt="X"></button>
	</div>

	<div id="layer_content" style="height: 590px;">
		<form name="" method="" action="">

		<div class="search">
		<form name="ajax_search_form" method="get" action="./ajax.list.html" class="size_800x700" target="#layer_popup" onsubmit="return submitAjaxSearchForm(this)" title="예약현황">
		<input type="hidden" name="flag_json" value="1">

		<fieldset>
		<legend>검색조건</legend>
		<table class="search_table" border="1">
		<caption>검색조건</caption>
		<colgroup>
		<col width="90px">
		<col width="*">
		</colgroup>
		<tbody>	
		<tr>
			<th>가맹점명</th>
			<td>				
				<input type="text" name="" value="" class="text" size="30" maxlength="30" title="검색어">				
			</td>
		</tr>	
		</tbody>
		</table>
		</fieldset>

		<p class="button">		
			<button type="submit" class="sButton primary">조회</button>
		</p>
		</form>
	</div>


		<div class="list_top">
			<div class="left">
				Total : <strong>0</strong> 건, 현재 : <strong>1</strong> 페이지
			</div>
			<div class="right">
			
			</div>
		</div>

		<div class="list">
			<!-- list_table -->
			<table class="list_table border odd" border="1">
			<colgroup>
			<col width="50">			
			<col width="*">			
			<col width="150">
			</colgroup>
			<thead>
			<tr>
				<th>No</th>
				<th>가맹점명</th>
				<th>선택</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>1</td>
				<td>블루밍스윗</td>
				<td><button type="submit" class="sButton tiny">선택</button></td>
			</tr>
			<tr>
				<td class="no_data" colspan="3">등록 또는 검색된 데이터가 없습니다.</td>
			</tr>
			</tbody>
			</table>	
			<!-- //list_table -->

			<!-- pagination -->
			<div class="pagination">
				<ul>
				<li class="arrow begin"><a href="?page=1" title="처음 페이지"><i class="xi-angle-double-left"></i></a></li>
				<li class="arrow prev"><a href="?page=1" title="이전 페이지"><i class="xi-angle-left"></i></a></li>
				<li class="on"><a href="?page=1" title="1 페이지">1</a></li>
				<li><a href="?page=2" title="2 페이지">2</a></li>
				<li><a href="?page=3" title="3 페이지">3</a></li>
				<li><a href="?page=4" title="4 페이지">4</a></li>
				<li><a href="?page=5" title="5 페이지">5</a></li>
				<li class="arrow next"><a href="?page=6" title="다음 페이지"><i class="xi-angle-right"></i></a></li>
				<li class="arrow end"><a href="?page=9" title="끝 페이지"><i class="xi-angle-double-right"></i></a></li>
				</ul>
			</div>
			<!-- //pagination -->

		</div>
		<form>
		
	</div>	
</div>
<!-- //선불제 신규등록 팝업 -->