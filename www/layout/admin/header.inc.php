<?
if(!defined('_INPLUS_')) { exit; } 

if(!$doc_title) { 	$doc_title = '메인'; }
if(!$page_no1) { $main_class = 'main'; }
if(!$layout_size) { $layout_size = 'small'; }
?>
</head>
<body class="layout-<?=$layout_size?>">
<div id="skipToContainer">
	<a href="#container" class="accessibility">본문 바로가기</a>
</div>

<!-- wrap -->
<div id="wrap">

	<!-- header -->
	<div id="header">
        <h1><a href="<?=_BASE_URI_?>/webadmin/page/main.html">예약박스 관리자 모드</a></h1>

		<h2 class="hidden">상단영역</h2>

        <ul class="header_qm">
		<!--li><a href="http://cs.inplusweb.com" target="_blank">인플러스 CS센터</a></li-->
		<!--
		<li><a href="#">관리자정보</a></li>
		<li><a href="#">기본환경</a></li>
		<li><a href="#">부가서비스</a></li>
		-->
		<li><a href="<?=_BASE_URI_?>/webadmin/member/modify_password.html"><strong>비밀번호변경</strong></a></li>
		<li><a href="<?=_BASE_URI_?>/webadmin/member/process.html?mode=logout&return_url=<?=urlencode('/webadmin/member/login.html')?>"><strong>로그아웃</strong></a></li>
        </ul>

        <!--a href="#" class="btn_cscenter"><img src="<?=$layout_uri?>/img/btn/btn_inplus_customer.png" alt="인플러스 고객관리센터" /></a-->
        <div id="gnb">
            <ul>
			<?=$gnb?>			
            </ul>
        </div>

		<div id="sub_nav">
			<ul>
			<?=$sub_nav?>
			</ul>
		</div>
    </div>
	<!-- //header -->

	<!-- container -->    
    <div id="container">

		<h2 class="hidden">본문영역</h2>

		<!-- aside -->
    	<div id="aside">
        	<div class="member_info">
            	<p>
                	<em><strong><?=$member['mb_name']?></strong>님,</em>
                    환영합니다.<br />
                    회원등급 : <?=$member['txt_mb_level']?><br />
                    접속아이피 : <span><?=$_SERVER['REMOTE_ADDR']?></span>
                </p>
            </div>

            <div id="snb">
                <ul>
				<?=$gnb?>
                </ul>
            </div>

			<!--div class="inplus">
				<ul>
				<li class="homepage"><a href="http://www.inplusweb.com" target="_blank">인플러스 홈페이지</a></li>
				<li class="cscenter"><a href="http://cs.inplusweb.com" target="_blank">인플러스 고객관리센터</a></li>
				<li class="remote"><a href="http://helpu.kr/inplus" target="_blank">원격지원 요청하기</a></li>
				</ul>
			</div-->
        </div>
		<!-- //aside -->

		<!-- content -->
		<div id="content">
			<h3><?=$doc_title?></h3>
		