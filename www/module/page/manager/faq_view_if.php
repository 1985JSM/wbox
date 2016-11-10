<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* set URI */
$layout_size = 'small';
$doc_title = 'FAQ';
?>

<link rel="stylesheet" type="text/css" href="http://smscore.inplus21.com/common/css/ui.css" />

<!-- <?=$module?> -->
<div id="<?=$module?>">

<!-- faq -->
<div id="faq">

	<!-- board_view -->
	<div class="board_view">
		<dl>
		<dt>크롬에서 상품(콘텐츠) 상세보기 팝업의 내용이 깨져 보여요!</dt>
		<dd>
			<!--span><em>작성자</em>인플러스 (211.35.19.138)</span-->
			<span><em>작성일시</em>2016-08-09 20:09:03</span>
			<span><em>분류</em>사이트이용/오류/기타</span>   
		</dd>	
		<dd class="cont">
			<div>
				크롬(Chrome) 브라우저를 사용하시는 유저분들 중 [네이버 툴바] 확장 프로그램을 사용하게 될 경우<br />
				일부 페이지가 정상적으로 보이지 않을 수 있습니다.<br /><br />
				*크롬 브라우저에서 [네이버 툴바] 사용 해지 방법<br />
				크롬 맞춤 설정 및 제어 클릭 > 도구 더 보기 > 확장 프로그램 > 설치된 확장 프로그램에서 [네이버 툴바] 사용 설정됨 체크 해제<br /><br />
				상기와 같은 버그 및 원인 파악을 위해 네이버 툴바 고객 센터로 문의가 진행 중에 있습니다.<br />
				조속한 해결을 위해 노력하겠습니다.
			</div>
		</dd>
		</dl>
		
		<!-- view_paging -->
		<div class="view_paging">
			<dl class="prev">
			<dt>이전글</dt>
			<dd><a href="">콘텐츠에 사용된 폰트는 어떻게 사용할 수 있나요?</a></dd>
			</dl>
			<dl class="next">
			<dt>다음글</dt>
			<dd>다음글이 없습니다.</dd>
			</dl>
		</div>
		<!-- //view_paging -->
		<!-- button -->
		<div class="button">
			<div class="left">
				<a href="faq_write_if.html" class="sButton" title="수정">수정</a>            
				<a href="" id="btn_delete" class="sButton warning" title="삭제">삭제</a>					
			</div>

			<div class="right">
				<a href="faq_list_if.html" class="sButton active" title="목록">목록</a>				
			</div>
		</div>
		<!-- //button -->
	</div>
	<!-- //board_view -->
</div>
<!-- //faq -->	
	
</div>
<!-- //<?=$module?> -->