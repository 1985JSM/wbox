<? if(!defined('_INPLUS_')) { exit; } 
$html_title = '예약박스 > 사용자모드';
?>
<!doctype html>
<html lang="ko" xml:lang="ko">
<head>
<meta charset="utf-8">
<title><?=$html_title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
<meta name="format-detection" content="telephone=no" />
<meta http-equiv="x-rim-auto-match" content="none">
<link rel="stylesheet" type="text/css" href="<?=$css_uri?>/styles.css">
<script type="text/javascript" src="/share/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://wbox.inplus21.com/layout/manager/styles.css" />
<script type="text/javascript" src="http://wbox.inplus21.com/share/js/jquery-1.8.3.min.js"></script>



<script type="text/javascript">
$(function() {
	var obj1 = $('ul.tab_wrap1');
	$('a.tab_title', obj1).click(function()
	{
		var idx = $('a.tab_title', obj1).index(this);
		$('a.tab_title', obj1).removeClass('hover').eq(idx).addClass('hover');
	
		$('div.tab_content', obj1).hide().eq(idx).show();
	});	
	
});
</script>

<style>
body{ background:#f0f0f0}
.mt_5{ margin-top:5px;}

#page_wrap{padding:40px 0;}
#page_contents{width:800px; padding:100px 100px 150px; margin:0 auto; background:#fff url(/webmanager/member/img/page_logo.png) no-repeat 727px 70px;}
#page_contents h1{ margin-bottom:40px;}
#page_contents .txt01{color:#000;font-size:14px; line-height:24px;font-weight:bold; margin-bottom:20px;}
#page_contents .txt01 span{color:#f3003f}
#page_contents .txt02{color:#000;font-size:11px; line-height:18px; margin-bottom:5px;}
#page_contents .txt03{color:#f3003f;font-size:11px; line-height:18px; margin-bottom:25px;}
#page_contents .txt03 strong{font-weight:bold}


#page_contents .tbl_btn{ margin-top:20px; text-align:center}
#member h4{display:none}

.page_copyright{ padding:70px 0 30px ; text-align:center; font-size:12px; color:#6e6e6e}

/* 탭 */
div.tab ul.tab_wrap1 div.sub01 div.con_ope1{padding-top:30px;}
div.tab ul.tab_wrap1 div.sub01 div.con_ope1 > ul { padding:10px 0; }
div.tab ul.tab_wrap1 div.sub01 div.con_ope1 > ul > li { padding-left:10px; line-height:20px; background:url("/img/content/ico_arrow.gif") 0 50% no-repeat; color:#6e6e6e; }

div.tab ul.tab_wrap1 div.sub01 div.con_ope2{margin-top:30px;}
div.tab ul.tab_wrap1 div.sub01 div.con_ope2 > ul.menu1 {float:left; height:110px; padding: 10px 0 10px 140px; background:url("/img/content/img3_1.jpg") 0 16px no-repeat; }
div.tab ul.tab_wrap1 div.sub01 div.con_ope2 > ul.menu2 {height:110px; margin-left:440px; padding: 10px 0 10px 140px; background:url("/img/content/img3_2.jpg") 0 16px no-repeat; }
div.tab ul.tab_wrap1 div.sub01 div.con_ope2 > ul.menu3 {float:left; height:110px; padding: 10px 0 10px 140px; background:url("/img/content/img3_3.jpg") 0 16px no-repeat; }
div.tab ul.tab_wrap1 div.sub01 div.con_ope2 > ul.menu4 {height:110px; margin-left:440px; padding: 10px 0 10px 140px; background:url("/img/content/img3_4.jpg") 0 16px no-repeat; }

div.tab ul.tab_wrap1 div.sub01 div.con_ope2 > ul > li.title {padding-left:0; line-height:20px; font-weight:600; background:none; color:#3c3c3c; }
div.tab ul.tab_wrap1 div.sub01 div.con_ope2 > ul > li { padding-left:10px; line-height:20px; background:url("/img/content/ico_arrow.gif") 0 8px no-repeat; color:#6e6e6e; }

div.tab ul.tab_wrap1 div.sub02 div.con_ex1 {padding:30px 0;}
div.tab ul.tab_wrap1 div.sub02 div.con_ex1 h4 {padding-bottom:5px;}
div.tab ul.tab_wrap1 div.sub02 div.con_ex1 table.tbl_st1 td.special { background-color:#ffefe6; color:#3c3c3c; }

div.tab ul.tab_wrap1 div.sub02 div.con_ex2 {padding:30px 0;}
div.tab ul.tab_wrap1 div.sub02 div.con_ex2 h4 {padding-bottom:5px;}
div.tab ul.tab_wrap1 div.sub02 div.con_ex2 table.tbl_st1 td.special { background-color:#ffefe6; color:#3c3c3c; }

div.tab ul.tab_wrap1 div.sub03 div.con_ope1{padding-top:30px;}
div.tab ul.tab_wrap1 div.sub03 div.con_ope1 > ul { padding:10px 0; }
div.tab ul.tab_wrap1 div.sub03 div.con_ope1 > ul > li { padding-left:10px; line-height:20px; background:url("/img/content/ico_arrow.gif") 0 50% no-repeat; color:#6e6e6e; }
div.tab ul.tab_wrap1 div.sub03 div.con_ope1 p.check {margin-top:10px;}

/* tab */
div.tab { position:relative; padding-top:80px; }
div.tab ul.tab_wrap1 li { }
div.tab ul.tab_wrap1 li div { line-height:25px; }
div.tab ul.tab_wrap1 li a.tab_title { display:block; overflow:hidden; height:50px; border-image:none; border-style:solid; border-width:1px; border-color:#e6e6e6; font-weight:900; font-size:12px; line-height:50px; text-align:center;  text-decoration:none; -moz-border-bottom-colors:none; -moz-border-left-colors:none; -moz-border-right-colors:none; -moz-border-top-colors:none; background-color:#fff;}
div.tab ul.tab_wrap1 li.tab02 { left:222px; }
div.tab ul.tab_wrap1 li.tab03 { left:444px; }

div.tab ul.tab_wrap1 li.tab01 a.tab_title { position:absolute; top:0; left:0; width:140px;  }
div.tab ul.tab_wrap1 li.tab01 a.hover {border-image:none; border-style:solid; border-width:1px 1px 1px; border-color:#894c9e; line-height:50px; background-color: #894c9e; text-decoration:none; color:#fff;  -moz-border-bottom-colors:none; -moz-border-left-colors:none; -moz-border-right-colors:none; -moz-border-top-colors:none; }
div.tab ul.tab_wrap1 li.tab02 a.tab_title { position:absolute; top:0; left:140px; width:140px; }
div.tab ul.tab_wrap1 li.tab02 a.hover { border-image:none; border-style:solid; border-width:1px 1px 1px; border-color:#894c9e; line-height:50px; background-color: #894c9e; text-decoration:none; color:#fff; -moz-border-bottom-colors:none; -moz-border-left-colors:none; -moz-border-right-colors:none; -moz-border-top-colors:none; }
div.tab ul.tab_wrap1 li.tab03 a.tab_title { position:absolute; top:0; left:280px; width:190px;  }
div.tab ul.tab_wrap1 li.tab03 a.hover { border-image:none; border-style:solid; border-width:1px 1px 1px; border-color:#894c9e; line-height:50px; background-color: #894c9e; text-decoration:none; color:#fff; -moz-border-bottom-colors:none; -moz-border-left-colors:none; -moz-border-right-colors:none; -moz-border-top-colors:none; }

div.tab ul.tab_wrap1 li.tab04 a.tab_title { position:absolute; top:0; left:470px; width:190px;  }
div.tab ul.tab_wrap1 li.tab04 a.hover { border-image:none; border-style:solid; border-width:1px 1px 1px; border-color:#894c9e; line-height:50px; background-color: #894c9e; text-decoration:none; color:#fff; -moz-border-bottom-colors:none; -moz-border-left-colors:none; -moz-border-right-colors:none; -moz-border-top-colors:none; }

div.tab ul.tab_wrap1 li.tab05 a.tab_title { position:absolute; top:0; left:660px; width:160px; }
div.tab ul.tab_wrap1 li.tab05 a.hover { border-image:none; border-style:solid; border-width:1px 1px 1px; border-color:#894c9e; line-height:50px; background-color: #894c9e; text-decoration:none; color:#fff; -moz-border-bottom-colors:none; -moz-border-left-colors:none; -moz-border-right-colors:none; -moz-border-top-colors:none; }

div.tab ul.tab_wrap1 div.tab_content { display:none; position:relative }
div.tab ul.tab_wrap1 div.sub01 { display:block; min-height:100px }
div.tab ul.tab_wrap1 div.sub01 > strong { font-weight:900; color:#4e84c4;}
div.tab ul.tab_wrap1 div.sub02 {min-height:100px}
div.tab ul.tab_wrap1 div.sub02 > strong { font-weight:900; color:#4e84c4; }
div.tab ul.tab_wrap1 div.sub03 {min-height:100px; background: url("/img/content/img3_7.jpg") no-repeat scroll right 0;}
div.tab ul.tab_wrap1 div.sub03 > strong { font-weight:900; color:#4e84c4; }

div.tab_content > div.box {margin-top:50px; font-size:12px; }
div.tab_content > div.box:first-child {margin-top:0; }
div.tab_content > div.box > h3 {font-size:14px; font-weight:bold; color:#444444; }
div.tab_content > div.box > ul > li { }
div.tab_content > div.box > ul > li > ul {padding-left:20px; }
</style>
</head>

<body>
<div id="page_wrap">
	<div id="page_contents">
    	<h1><img src="/img/title/tit01.png" alt="예약박스정책" /></h1>
		<!-- 테스트 -->
		<!-- tab-->
		<div class="tab">		
			<ul class="tab_wrap1">

				<li class="tab01">
					<a class="tab_title hover" href="#this1">서비스이용약관</a>
					<div class="tab_content sub01">
					
						<div class="box">
							<h3>제 1 조 ( 정의 )</h3>
							<p>
								이 이용약관은 필요한 경우 수정될 수 있으며, 모바일 단발기, 이메일 또는 전화를 통해 직접 또는 간접적으로 제공된 모든 온라인 서비스에 적용됩니다. 플랫폼에 상관없이 당사의 애플리케이션을 통해 웹 사이트에 접속, 탐색하거나 이를 이용한 경우 또는 예약을 완료한 경우, 당사는 사용자가 아래의 이용 약관(개인정보 보호정책 포함)에 동의한 것으로 간주합니다. 

							</p>
						</div>

						<div class="box">
							<h3>제 2 조 ( 이용 요금 )</h3>
							<p>
								당사의 서비스는 무료입니다. 예약 수수료도 없으며, 애플리케이션 이용에 따른 서비스 요금도 부과하고 있지 않습니다.
							</p>
						</div>

						<div class="box">
							<h3>제 3 조 ( 용어의 설명 )</h3>
							<ul>
							<li>
								① 이 약관에서 사용하는 용어의 정의는 다음과 같습니다.
								<ul>
								<li>1.‘회사’라 함은 예약박스 서비스를 의미합니다.  </li>
								<li>2.'회원'이라 함은 예약박스 시스템 서비스를 이용하는 이용자를 의미합니다.</li>
								<li>3.'회원번호(ID)'라 함은 회원식별과 회원의 개개인의 서비스 이용을 위하여 회원이 선정하고 회사가 승인하는 영문자와 숫자의 조합을 말합니다.</li>
								<li>4.'비밀번호(pw)'라 함은 회원이 부여 받은 회원번호와 일치된 이용고객 임을 확인하고 회원의 권익보호를 위하여 스스로 선정한 문자와 숫자의 조합을 말합니다.</li>
								<li>5.'탈퇴'라 함은 회사 또는 회원에 의해 이용계약을 해약하는 것을 말합니다.</li>
								</ul>
							</li>
							<li>② 이 약관에서 사용하는 용어의 정의는 제1항에서 정하는 것을 제외하고는 관계법령 및 서비스 별 안내에서 정하는 바에 의합니다.</li>
							</ul>
						</div>

						<div class="box">
							<h3>제 4 조 ( 서비스 이용 신청 - 회원가입 )</h3>
							<ul>
							<li>① 본 서비스를 이용하고자 하는 회원은 회사에서 요청하는 정보(성명, 연락처 등)를 제공하여 회원으로 가입한 후 이용이 가능합니다.</li>
							<li>② 모든 회원은 반드시 휴대전화인증, 이메일인증 중 한 가지 이상의 인증을 거쳐야만 서비스의 이용이 가능하며 실명이 아닐 경우 서비스 이용에 제한을 받으실 수 있습니다. </li>
							<li>③ 회원가입은 반드시 실명을 원칙으로 합니다. 실명이 아닌 것으로 판단될 경우 서비스가 제한될 수 있는 점 양해바랍니다.</li>
							<li>④ 타인의 명의(이름 또는 주민등록번호)를 도용하여 이용신청을 한 회원의 ID는 사전 예고 없이 삭제가 될 수 있으며, 관계법령에 따라 처벌을 받을 수 있습니다.</li>
							<li>⑤ 회사는 본 서비스를 이용하는 회원에 대하여 등급별로 구분하여 서비스의 이용에 차등을 둘 수 있습니다.</li>
							</ul>
						</div>


						<div class="box">
							<h3>제 5 조 ( 서비스 이용제한 )</h3>
							<ul>
							<li>
								① 회사는 회원이 서비스 이용내용에 있어서 다음 각 호에 해당하는 경우 서비스 이용을 제한할 수 있습니다.
								<ul>
								<li>1. 미풍양속을 저해하는 비속한 ID 및 별명 사용</li>
								<li>2. 타 이용자에게 심한 모욕을 주거나, 서비스 이용을 방해한 경우</li>
								<li>3. 기타 정상적인 서비스 운영에 방해가 될 경우</li>
								<li>4. 타인의 기분을 상하게 할 수 있는 댓글, 무분별한 반복성 댓글</li>
								<li>5. 정보통신 윤리위원회 등 관련 공공기관의 시정 요구가 있는 경우</li>
								<li>6. 불법 웹사이트인 경우</li>
								<li>7. 상용소프트웨어나 크랙 파일을 올린 경우</li>
								<li>8. 정보통신윤리위원회의 심의 세칙 제 7조에 어긋나는 음란물을 게재한 경우</li>
								<li>9. 반국가적 행위의 수행을 목적으로 하는 내용을 포함한 경우</li>
								<li>10. 저작권이 있는 글을 무단 복제하거나 mp3를 올린 경우</li>
								<li>11. 정보통신 설비의 오작동이나 정보 등의 파괴를 유발시키는 컴퓨터 바이러스 프로그램 등을 유포하는 경우</li>
								<li>12. 상기 내용을 위반 시, 회원 등급 또는 회사에서 운영하는 온라인 쇼핑몰에서 사용할 수 있는 포인트가 몰수 될 수 있으며, 회원 이용에 제한이 생길 수 있습니다.</li>
								</ul>
							</li>
							<li>② 상기 이용제한 규정에 따라 서비스를 이용하는 회원에게 서비스 이용에 대하여 별도 공지 없이 서비스 이용의 일시 정지, 정지, 이용계약 해지 등을 불량이용자 처리규정에 따라 취할 수 있습니다.</li>
							</ul>
						</div>

						<div class="box">
							<h3>제 6 조 ( 계약 변경 및 해지 )</h3>
							<p>회원이 이용계약을 해지하고자 하는 때에는 회원 본인이 예약박스 웹 내의 "회원탈퇴"메뉴를 이용해 가입 해지를 해야 합니다. 단, 서비스의 신청 등으로 포인트 등의 대가가 회원에게 지급된 경우 탈퇴 시 제한이 있을 수 있고, 적립된 포인트나 발행된 쿠폰은 복구되지 않습니다.</p>
						</div>

						<div>
							<h3>제 7 조 ( 서비스 이용 시간 )</h3>
							<ul>
							<li>① 서비스 이용은 회사의 업무상 또는 기술상 특별한 지장이 없는 한 연중무휴, 1일 24시간 운영을 원칙으로 합니다. 단, 회사는 시스템 정기점검, 증설 및 교체를 위해 회사가 정한 날이나 시간에 서비스를 일시 중단할 수 있으며, 예정되어 있는 작업으로 인한 서비스 일시 중단은 웹을 통해 사전에 공지합니다.</li>
							<li>② 회사는 회사가 통제할 수 없는 사유로 인한 서비스중단의 경우(시스템관리자의 고의, 과실 없는 디스크장애, 시스템다운 등)에 사전통지가 불가능하며 타인(PC통신회사, 기간통신사업자 등)의 고의, 과실로 인한 시스템중단 등의 경우에는 통지하지 않습니다.</li>
							</ul>
						</div>


						<div class="box">
							<h3>제 8 조 ( 게시물의 관리 )</h3>
							<ul>
							<li>
								회사는 다음 각 호에 해당하는 게시물이나 자료를 사전통지 없이 삭제하거나 이동 또는 등록 거부를 할 수 있습니다.
								<ul>
								<li>- 다른 회원 또는 제 3자에게 심한 모욕을 주거나 명예를 손상시키는 내용인 경우</li>
								<li>- 공공질서 및 미풍양속에 위반되는 내용을 유포하거나 링크시키는 경우</li>
								<li>- 불법복제 또는 해킹을 조장하는 내용인 경우</li>
								<li>- 영리를 목적으로 하는 광고일 경우</li>
								<li>- 범죄와 결부된다고 객관적으로 인정되는 내용일 경우</li>
								<li>- 다른 이용자 또는 제 3자의 저작권 등 기타 권리를 침해하는 내용인 경우</li>
								<li>- 회사에서 규정한 게시물 원칙에 어긋나거나, 게시판 성격에 부합하지 않는 경우</li>
								<li>- 기타 관계법령에 위배된다고 판단되는 경우</li>
								</ul>
							</li>
							</ul>
						</div>

						<div class="box">
							<h3>제 9 조 ( 게시물에 대한 저작권 )</h3>
							<ul>
							<li>① 회원은 서비스를 이용하여 취득한 정보를 임의 가공, 판매하는 행위 등 서비스에 게재된 자료를 상업적으로 사용할 수 없습니다.</li>
							<li>② 회사는 회원이 게시하거나 등록하는 서비스 내의 내용물, 게시 내용에 대해 제 8조 각 호에 해당된다고 판단되는 경우 사전통지 없이 삭제하거나 이동 또는 등록 거부할 수 있습니다.</li>
							<li>③ 회사는 회원이 게시한 게시 글에 대하여, 회사 내 서비스의 홍보 활동에 활용할 수 있습니다.</li>
							</ul>
						</div>

						<div class="box">
							<h3>제 10 조 ( 정보의 제공 )</h3>
							<p>회사는 회원이 서비스 이용 도중 필요가 있다고 인정되는 다양한 정보에 대해서 전자우편이나 전화통신 등의 방법으로 회원에게 제공할 수 있습니다.</p>
						</div>

						<div class="box">
							<h3>제 11 조 ( 손해배상의 범위 및 청구 )</h3>
							<ul>
							<li>① 회사는 서비스로부터 회원이 받은 손해가 천재지변 등 불가항력적이거나 회원의 고의 또는 과실로 인하여 발생한 때에는 손해배상을 하지 아니합니다.</li>
							<li>② 회사는 전자상거래 호스팅 및 일반 호스팅의 경우 이에 준하는 서비스 이용회원일 경우 불가항력적으로 발생한 경우 위 1 항의 규정에 따릅니다.</li>
							<li>③ 회원이 서비스를 이용함에 있어 행한 불법행위로 인하여 회사가 당해 회원 이외에 제 3 자로부터 손해배상 청구, 소송을 비롯한 각종의 이의제기를 받는 경우 당해 회원은 회사의 면책을 위하여 노력하여야 하며, 만일 회사가 면책되지 못한 경우는 당해 회원은 그로 인하여 회사에 발생한 모든 손해를 배상하여야 합니다.</li>
							</ul>
						</div>


						<div class="box">
							<h3>제 12 조 ( 면책사항 )</h3>
							<ul>
							<li>① 회사는 천재지변, 전쟁 및 기타 이에 준하는 불가항력으로 인하여 서비스를 제공할 수 없는 경우에는 서비스 제공에 대한 책임이 면제됩니다.</li>
							<li>② 회사는 기간통신 사업자가 전기통신 서비스를 중지하거나 정상적으로 제공하지 아니하여 손해가 발생한 경우 책임이 면제됩니다.</li>
							<li>③ 회사는 서비스용 설비의 보수, 교체, 정기점검, 공사 등 부득이한 사유로 발생한 손해에 대한 책임이 면제됩니다.</li>
							<li>④ 회사는 회원의 귀책사유로 인한 서비스 이용의 장애 또는 손해에 대하여 책임을 지지 않습니다.</li>
							<li>⑤ 회사는 이용자의 컴퓨터 오류에 의해 손해가 발생한 경우, 또는 회원이 신상정보 및 전자우편 주소를 부실하게 기재하여 손해가 발생한 경우 책임을 지지 않습니다.</li>
							<li>⑥ 회사는 회원이 서비스에 게재한 각종 정보, 자료, 사실의 신뢰도, 정확성 등 내용에 대하여 책임을 지지 않습니다.</li>
							<li>⑦ 회사는 회원 상호간 또는 회원과 제 3 자 상호간에 서비스를 매개로 하여 물품거래(무형의 물품 포함)등을 한 경우에 그로부터 발생하는 일체의 손해에 대하여 책임지지 아니합니다.</li>
							<li>⑧ 회사에서 회원에게 무료로 제공하는 서비스의 이용과 관련해서는 어떠한 손해도 책임을 지지 않습니다.</li>
							</ul>
						</div>

						<div class="box">
							<h3>제 13 조 ( 재판권 및 분쟁조정 )</h3>
							<ul>
							<li>① 이 약관에 명시되지 않은 사항은 전기통신사업법 등 관계법령과 상관습에 따릅니다.</li>
							<li>② 서비스 이용과 관련하여 회사와 회원 사이에 분쟁이 발생한 경우, 쌍방 간에 분쟁의 해결을 위해 성실히 협의한 후가 아니면 제소할 수 없습니다.</li>
							<li>③ 서비스 이용으로 발생한 분쟁에 대해 소송이 제기되는 경우 회사의 본사 소재지를 관할하는 법원을 관할 법원으로 합니다.</li>
							</ul>
						</div>

						<div class="box">
							<p>이 약관은 2016년 01월 11일부터 변경/시행합니다.</p>
						</div>
						
						
					</div>
				</li>	

				<li class="tab02">
					<a class="tab_title" href="#this2">개인정보취급방침</a>
					<div class="tab_content sub02">


						<div class="box">
			<h3>제 1 조 ( 용어의 설명 )</h3>
			<ul>
			<li>
				① 이 약관에서 사용하는 용어의 정의는 다음과 같습니다.
				<ul>
				<li>1.‘회사’라 함은 예약박스 서비스를 의미합니다. </li>
				<li>2.'회원'이라 함은 예약박스 시스템 서비스를 이용하는 이용자를 의미합니다.</li>
				<li>3.'회원번호(ID)'라 함은 회원식별과 회원의 개개인의 서비스 이용을 위하여 회원이 선정하고 회사가 승인하는 영문자와 숫자의 조합을 말합니다.</li>
				<li>4.'비밀번호(pw)'라 함은 회원이 부여 받은 회원번호와 일치된 이용고객 임을 확인하고 회원의 권익보호를 위하여 스스로 선정한 문자와 숫자의 조합을 말합니다.</li>
				<li>5.'탈퇴'라 함은 회사 또는 회원에 의해 이용계약을 해약하는 것을 말합니다.</li>

				</ul>
			</li>
			<li>② 이 약관에서 사용하는 용어의 정의는 제1항에서 정하는 것을 제외하고는 관계법령 및 서비스 별 안내에서 정하는 바에 의합니다.</li>
			</ul>
		</div>

		<div class="box">
			<h3>제 2 조 ( 개인정보 수집목적 및 이용 )</h3>
			<p>
				회사는 회원님께 최적의 맞춤화 된 서비스를 제공해드리기 위해 개인정보를 수집하고 있습니다. 회원님께서 제공해주신 개인정보를 바탕으로 하여 새로운 서비스나 신상품, 이벤트 정보 안내 등을 선택적으로 제공하여 더욱 유용하고 가치 있는 정보를 받아보실 수 있게 됩니다. 
			</p>
		</div>

		<div class="box">
			<h3>제 3 조 ( 개인정보의 수집방법 )</h3>
			<ul>
			<li>① 회사는 회원가입 시에 가입 약관에 '동의합니다.' 또는 '동의하지 않습니다.' 버튼 클릭 할 수 있는 절차를 마련하여, '동의합니다.' 버튼을 누르면 개인정보 수집에 대해 동의한 것으로 봅니다.</li>
			<li>② 최초 회원가입을 하실 때 서비스 제공을 위해 가장 필수적인 개인정보를 받고 있습니다. 회원가입 시에 받는 필수적인 정보는 회원님의 아이디(ID), 이름, I-PIN, 이메일 등입니다. 또한, 이 이외에 특정 서비스를 제공하기 위하여 추가적인 정보제공을 요청하고 있습니다.</li>
			</ul>
		</div>

		<div class="box">
			<h3>제 4 조 ( 개인정보의 수집목적 및 수집, 이용목적)</h3>
			<ul>
			<li>① 회사는 이용자의 회원 가입 시 서비스 제공을 위해 필요한 최소한의 개인정보를 수집하고 있습니다. 다만, 이용자등의 기본적 인권 침해의 우려가 있는 민감한 개인정보(인종 및 민족, 사상 및 신조, 출신지 및 본적지, 정치적 성향 및 범죄기록, 건강상태 및 성생활 등)는 수집하지 않습니다.</li>
			<li>
				② 회사가 회원가입 시 수집하는 개인정보 항목과 그 수집 • 이용의 주된 목적은 아래와 같습니다. 
				<dl>
				<dt>필수항목</dt>
				<dd>아이디(ID), 비밀번호, 이름, 닉네임, 생일 : 서비스 이용에 따른 본인 식별 절차에 이용, 가입연령 확인, 불량회원의 부정한 이용 재발 방지, 가입 및 가입횟수 제한 등  </dd>
				<dd>주소, 휴대전화번호, 이메일주소 : 고지사항 전달, 본인의사 확인, 불만처리 등 원활한 의사소통 경로의 확보, 새로운 서비스 및 신상품이나 이벤트 정보 안내, 경품 및 상품배송 등</dd>
				</dl>
				<dl>
				<dt>선택항목 </dt>
				<dd>SMS, 푸시알림, 이메일수신여부 : 추가적인 제품 정보, 이벤트 등의 안내를 위한 자료</dd>
				</dl>
			</li>
			</ul>
		</div>

		<div class="box">
			<h3>제 5 조 ( 개인정보의 활용 )</h3>
			<ul>
			<li>
				회사는 서비스 제공과 관련하여 취득한 회원의 신상정보를 본인의 승낙 없이 제3자에게 누설 또는 배포할 수 없으며 상업적 목적으로 사용할 수 없습니다. 다만, 다음의 각 호에 해당하는 경우에는 그러하지 아니합니다.
				<ul>
				<li>가. 정보통신서비스의 제공에 따른 요금 정산을 위하여 필요한 경우</li>
				<li>나. 통계작성, 학술연구 또는 시장조사를 위하여 필요한 경우로서 특정 개인을 알아볼 수 없는 형태로 가공하여 제공하는 경우 </li>
				<li>다. 관계 법령에 의하여 수사상 목적으로 정해진 절차와 방법에 따라 관계기관의 요구가 있는 경우</li>
				<li>라. 다른 법률에 특별한 규정이 있는 경우</li>
				<li>마. 정보통신윤리위원회가 관계법령에 의하여 요청 경우 </li>
				</ul>
			</li>
			</ul>
		</div>

		<div class="box">
			<h3>제 6 조 ( 개인정보의 제공 및 공유 )</h3>
			<ul>
			<li>① 회사는 원칙적으로 회원님의 개인정보를 타인 또는 타기업•기관에 공개하지 않습니다. 다만 회원님이 공개에 동의한 경우 또는 예약박스의 서비스를 이용하여 타인에게 법적인 피해를 주거나 미풍양속을 해치는 행위를 한 사람 등에게 법적인 조치를 취하기 위하여 개인정보를 공개해야 한다고 판단되는 충분한 근거가 있는 경우는 예외로 합니다. 이 경우에도 개인에게는 제공되지 않으며 규정된 절차에 따라서 수사기관에만 제공할 수 있습니다.</li>
			<li>② 또한 보다 나은 서비스 제공을 위하여 회원님의 개인정보를 제휴사에게 제공하거나 또는 제휴사와 공유할 수 있습니다. 개인정보를 제공하거나 공유할 경우에는 사전에 회원님께 제휴사가 누구인지, 제공 또는 공유되는 개인정보항목이 무엇인지, 왜 그러한 개인정보가 제공되거나 공유되어야 하는지, 그리고 언제까지 어떻게 보호•관리되는지에 대해 개별적으로 전자우편 및 서면을 통해 고지하여 동의를 구하는 절차를 거치게 되며, 회원님께서 동의하지 않는 경우에는 제휴사에게 제공하거나 제휴사와 공유하지 않습니다. </li>
			</ul>
		</div>

		<div>
			<h3>제 7 조 ( 개인정보의 보유 및 이용기간 )</h3>
			<ul>
			<li>
				회사는 원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우에는 아래와 같이 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다. 
				<ul>
				<li>•보존 항목 : 결제기록 </li>
				<li>•보존 근거 : 계약 또는 청약철회 등에 관한 기록 </li>
				<li>•보존 기간 : 3년 </li>
				<li>•계약 또는 청약철회 등에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)</li>
				<li>•대금결제 및 재화 등의 공급에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)</li>
				<li>•소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래등에서의 소비자보호에 관한 법률)</li>
				</ul>
			</li>
			</ul>
		</div>


		<div class="box">
			<h3>제 8 조 ( 개인정보의 열람, 정정, 삭제 ) </h3>
			<ul>
			<li>① 회원님은 언제든지 등록되어 있는 회원님의 개인정보를 열람하거나 정정하실 수 있습니다. </li>
			<li>② 개인정보 열람 및 정정을 하고자 할 경우에 회원가입/수정 버튼을 클릭한 후 열람하거나 입력사항을 수정하여 정정하실 수 있습니다.</li>
			</ul>
		</div>

		<div class="box">
			<h3>제 9 조 ( 개인정보의 파기절차 및 방법 )</h3>
			<ul>
			<li>
				회사는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 파기절차 및 방법은 다음과 같습니다. 
				<dl>
				<dt>파기절차 </dt>
				<dd>회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기되어집니다.별도 DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 보유되어지는 이외의 다른 목적으로 이용되지 않습니다.  </dd>
				</dl>
				<dl>
				<dt>파기방법 </dt>
				<dd>전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다. 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.</dd>
				</dl>
			</li>
			</ul>
		</div>


		<div class="box">
			<h3>제 10 조 ( 개인정보 수집, 이용, 제공에 대한 동의철회 )</h3>
			<p>
			이용자는 개인정보의 수집, 이용 및 제공에 대해 동의한 내용을 언제든지 철회할 수 있습니다. 동의철회(회원탈퇴)는 회사 어플에서 로그인한 후 [MY PAGE]를 클릭하여 회원탈퇴를 클릭 후 직접 동의철회(회원탈퇴)를 하거나, 개인정보 관리책임부서 또는 고객관리부서로 서면, 전화 또는 전자우편(E-mail) 등으로 연락하시면 지체 없이 이용자의 개인정보를 파기하는 등 필요한 조치를 하겠습니다. 

			</p>
		</div>

		<div class="box">
			<h3>제 11 조 ( 개인정보수집에 대한 거부 ) </h3>
			<p>
			회원님께서는 개인정보 수집•동의에 대하여 거부하실 권리가 있습니다. 다만, 개인정보 수집에 대한 동의를 거부하시면 일부 서비스에 대한 이용이 제한될 수 있습니다.

			</p>
		</div>

		<div class="box">
			<h3>제 12 조 ( 홈페이지 이용자 및 법정대리인의 권리와 그 행사방법 )</h3>
			<p>
			회사 홈페이지 이용자는 언제든지 등록되어 있는 자신의 개인정보를 조회하거나 수정할 수 있으며 가입해지를 요청할 수도 있습니다. 이용자들의 개인정보 조회, 수정을 위해서는'개인정보변경'(또는'회원정보수정'등)을 가입해지(동의철회)를 위해서는 "회원탈퇴"를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다. 
혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체 없이 조치하겠습니다. 귀하가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체 없이 통지하여 정정이 이루어지도록 하겠습니다. 

			</p>
		</div>

		<div class="box">
			<h3>제 13 조 ( 개인정보처리방침 변경시 공지의무 )</h3>
			<p>
			개인정보처리방침은 법령,정책 및 회사 내부 운영방침 또는 보안기술의 변경에 따라 내용이 변경될 수 있으며, 이때에는 변경되는 개인정보처리방침을 시행하기 최소 7일전(이용자에게 불리하게 변경된 경우는 30일 전)부터 회사 사이트 첫 페이지에 변경 이유 및 내용 등을 공지하도록 하겠습니다.

			</p>
		</div>

		<div class="box">
			<p>이 약관은 2016년 01월 11일부터 변경/시행합니다.</p>
		</div>
					
						
					</div>
				</li>		

				<li class="tab03">
					<a class="tab_title" href="#this3">개인정보 제3자 제공동의</a>
					<div class="tab_content sub03">


						<div class="box">
							<h3>제 1 조 ( 용어의 설명 )</h3>
							<ul>
							<li>
								① 이 약관에서 사용하는 용어의 정의는 다음과 같습니다.
								<ul>
								<li>1.‘회사’라 함은 예약박스 서비스를 의미합니다. </li>
								<li>2.'회원'이라 함은 예약박스 시스템 서비스를 이용하는 이용자를 의미합니다.</li>
								<li>3.'회원번호(ID)'라 함은 회원식별과 회원의 개개인의 서비스 이용을 위하여 회원이 선정하고 회사가 승인하는 영문자와 숫자의 조합을 말합니다.</li>
								<li>4.'비밀번호(pw)'라 함은 회원이 부여 받은 회원번호와 일치된 이용고객 임을 확인하고 회원의 권익보호를 위하여 스스로 선정한 문자와 숫자의 조합을 말합니다.</li>
								<li>5.'탈퇴'라 함은 회사 또는 회원에 의해 이용계약을 해약하는 것을 말합니다.</li>
								</ul>
							</li>
							<li>② 이 약관에서 사용하는 용어의 정의는 제1항에서 정하는 것을 제외하고는 관계법령 및 서비스 별 안내에서 정하는 바에 의합니다.</li>
							</ul>
						</div>

						<div class="box">
							<h3>제 2 조 개인정보의 보호 및 사용</h3>
							<p>
								회사는 관계법령이 정하는 바에 따라 서비스 이용자의 개인정보를 보호하기 위해 개인정보보호정책을 시행합니다. 이용자 개인정보의 보호 및 사용에 대해서는 관련법령 및 회사의 개인정보 보호정책이 적용됩니다. 그러나, 회사는 이용자의 귀책사유로 인해 노출된 정보에 대해서 일체의 책임을 지지 않습니다. 
							</p>
							<ul>
							<li>								
								1. 회사는 이용자의 정보수집 시 서비스의 제공에 필요한 최소한의 정보를 수집합니다. 다음 사항을 필수사항으로 하며 그 외 사항은 선택사항으로 합니다. 
								<ul>
								<li>① 성명</li>
								<li>② 전화번호</li>
								<li>③ 휴대폰</li>
								</ul>
							</li>
							<li>								
								2. 제공된 개인정보는 당해 이용자의 동의 없이 목적 외의 이용이나 제3자에게 제공할 수 없으며, 이에 대한 모든 책임은 회사가 집니다. 다만, 다음의 경우에는 예외로 합니다.  
								<ul>
								<li>① 통계작성, 학술연구 또는 시장조사를 위하여 필요한 경우로서 특정 개인을 식별할 수 없는 형태로 제공하는 경우 </li>
								<li>② 전기통신기본법 등 법률의 규정에 의해 국가기관의 요구가 있는 경우</li>
								<li>③ 범죄에 대한 수사상의 목적이 있거나 정보통신윤리위원회의 요청이 있는 경우</li>
								<li>④ 기타 관계법령에서 정한 절차에 따른 요청이 있는 경우</li>
								</ul>
							</li>
							<li>3. 이용자는 언제든지 회사가 가지고 있는 자신의 개인정보에 대해 열람 및 오류정정을 요구할 수 있으며 당사는 이에 대해 지체 없이 처리합니다. 이용자가 오류의 정정을 요구한 경우에는 회사는 그 오류를 정정할 때까지 당해 개인정보를 이용하지 않습니다. </li>
							<li>4. 회사의 개인정보보호에 대한 정책은 홈페이지 "가입약관"을 통해 공지하며, 회사는 개인 정보보호를 위한 담당자를 지정하여 관리합니다.</li>
							</ul>
						</div>

						<div class="box">
							<h3>제 3 조 제3자에 대한 정보 제공</h3>
							<p>예약박스는 법령에 근거가 있는 등의 예외적인 경우를 제외하고 이용자의 동의 없이 개인정보를 제3자에게 제공하지 않습니다. 다만 제휴사, 후원사 등에 이용자의 개인정보를 제공할 수 있으나, 이는 이용자에게 최적, 양적의 서비스를 제공하기 위한 목적으로만 행해지는 것이고, 그 경우에도 제공받는 자, 제공받는 자의 이용목적, 제공할 정보의 내용, 제공받는 자의 개인정보보유 및 이용기간을 E-Mail 이나 서면으로 개별 통지하며, 인터넷 사이트에 명시하여 이용자의 동의를 받도록 하겠습니다.</p>
						</div>


						<div class="box">
							<p>이 약관은 2016년 01월 11일부터 변경/시행합니다.</p>
						</div>

					</div>
				</li>	

				<!--li class="tab04">
					<a class="tab_title" href="#this4">위치기반 서비스 이용약관</a>
					<div class="tab_content sub04">

						<div class="box">
							<h3>제 1 조 ( 용어의 설명 )</h3>
							<ul>
							<li>
								① 이 약관에서 사용하는 용어의 정의는 다음과 같습니다.
								<ul>
								<li>1.‘회사’라 함은 예약박스 서비스를 의미합니다. </li>
								<li>2.'회원'이라 함은 예약박스 시스템 서비스를 이용하는 이용자를 의미합니다.</li>
								<li>3.'회원번호(ID)'라 함은 회원식별과 회원의 개개인의 서비스 이용을 위하여 회원이 선정하고 회사가 승인하는 영문자와 숫자의 조합을 말합니다.</li>
								<li>4.'비밀번호(pw)'라 함은 회원이 부여 받은 회원번호와 일치된 이용고객 임을 확인하고 회원의 권익보호를 위하여 스스로 선정한 문자와 숫자의 조합을 말합니다.</li>
								<li>5.'탈퇴'라 함은 회사 또는 회원에 의해 이용계약을 해약하는 것을 말합니다.</li>
								</ul>
							</li>
							<li>② 이 약관에서 사용하는 용어의 정의는 제1항에서 정하는 것을 제외하고는 관계법령 및 서비스 별 안내에서 정하는 바에 의합니다.</li>
							</ul>
						</div>

						<div class="box">
							<h3>제 2 조 ( 개인위치정보의 이용 또는 제공 )</h3>
							<ul>
							<li>① 회사는 서비스 제공을 위하여 고객의 위치정보를 이용할 수 있으며, 고객은 본 약관에 동의함으로써 이에 동의한 것으로 간주됩니다. 회사는 고객이 제공한 개인위치정보를 당해 고객의 동의 없이 서비스 제공 이외의 목적으로 이용하지 아니합니다.</li>
							<li>② 회사는 고객이 제공한 개인위치정보를 당해 고객의 동의 없이 제3자에게 제공하지 아니합니다.</li>
							<li>③ 회사는 고객의 개인위치정보를 고객이 지정하는 제3자에게 제공할 경우 매회 고객에게 제공받는 자, 제공 일시 및 제공목적을 즉시 통보합니다.</li>
							<li>								
								④ 다만, 회사는 고객이 미리 요청한 경우에 한하여 고객이 지정한 이동전화 단말기 또는 전자우편주소로 통보할 수 있습니다. 
								<ul>
								<li>1. 개인위치정보를 수집한 당해 통신단말장치가 문자, 음성 또는 영상의 수신기능을 갖추지 아니한 경우</li>
								<li>2. 개인위치정보 주체가 개인위치정보를 수집한 당해 통신단말장치 외의 통신단말장치 또는 전자우편 주소 등으로 통보할 것을 미리 요청한 경우</li>
								</ul>
							</li>
							</ul>
						</div>


						<div class="box">
							<h3>제 3 조 ( 개인위치정보 이용·제공사실 확인 자료의 보유 )</h3>
							<ul>
							<li>① 회사는 위치정보법 제16조 제2항에 근거하여 고객에 대한 위치정보 이용·제공사실 확인자료를 위치정보시스템에 자동으로 기록하며, 고객 불만 응대를 위하여 기록시점으로부터 6개월간 보존합니다.</li>
							<li>② 회사는 위치정보법 제24조 제4항의 규정에 의하여 고객이 동의의 전부 또는 일부를 철회한 경 우에는 지체 없이 수집된 개인위치정보 및 위치정보 이용제공사실 확인자료(동의의 일부를 철회하는 경우에는 철회하는 부분의 개인위치정보 및 위치정보 이용제공사실 확인자료에 한합니다)를 파기합니다. 다만, 국세기본법, 법인세법, 부가가치세법 기타 관계법령의 규정에 의하여 보존할 필요성이 있는 경우에는 관계법령에 따라 보존합니다. </li>
							</ul>
						</div>


						<div class="box">
							<p>이 약관은 2016년 01월 11일부터 변경/시행합니다.</p>
						</div>
					
					</div>
				</li-->

				<li class="tab04">
					<a class="tab_title" href="#this5">이벤트 소식 수신 동의</a>
					<div class="tab_content sub05">

						<div class="box">
							예약박스서비스(이하“서비스”)와 관련하여 본인은 동의내용을 숙지하였으며, 이에 따라 본인의 개인정보를 아래의 목적으로 귀사가 수집 및 이용하고 본인에게 전자적 전송매체를 통해서 마케팅 등의 목적으로 개인에게 맞춤형 광고 또는 정보를 다음과 같이 전송하는 것에 동의합니다.
						</div>

						<div class="box">
							<h3>수집 및 이용목적</h3>
							<p>서비스 관련 문의 등에 대한 개인맞춤 상담, 정보제공, 신규서비스, 이벤트, 제3자의 상품 또는 서비스 관련 광고/정보 전송, 상품 이용에 대한 조회</p>
						</div>


						<div class="box">
							<h3>수집항목</h3>
							<p>휴대전화번호, 이메일주소, 기타 개인정보(고객이 상담내용에 입력하는 개인정보), 방문기록</p>
						</div>

						<div class="box">
							<h3>보유기간</h3>
							<p>서비스 이용기간</p>
						</div>


						<div class="box">
							<ul>
							<li>※본 동의는 서비스의 선택적 기능 제공을 위한 개인정보 수집/이용에 대한 동의로서, 동의하지 않더라도 서비스 이용이 가능합니다.</li>
							<li>※법령에 따른 개인정보의 수집/이용, 계약의 이행/편의증진을 위한 개인정보 취급위탁 및 개인정보 취급과 관련된 일반 사항은 서비스의 개인정보 취급방침에 따릅니다.</li>
							</ul>
						</div>

						<div class="box">
							<ul>
							<li>1.서비스에서는 고객이 수집 및 이용에 동의한 개인정보를 활용하여, 전자적 전송매체(SMS/MMS/e-mail 등 다양한 전송매체)를 통해서 예약박스 및 제3자의 상품 또는 서비스에 대한 개인 맞춤형 광고/정보를 전송할 수 있습니다.</li>
							<li>2.고객이 본 수신동의를 철회하고자 할 경우 예약박스 고객센터로 연락하거나 서비스 App을 통해서 수신동의 철회요청을 할 수 있습니다.</li>
							</ul>
						</div>
					
					</div>
				</li>
				
				

			</ul>
		</div>
		<!-- tab-->	

		</div>
	</div>
    
    <p class="page_copyright">COPYRIGHT 2015 © Reservation box ALL RIGHT RESERVED.</p>
</div>


</body>
</html>