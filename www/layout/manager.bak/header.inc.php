<? if(!defined('_INPLUS_')) { exit; } ?>

</head>
<body>
<div id="wrap">
	<!-- header -->
	<div id="header">
		<h1><a href="/webmanager"><img src="<?=$layout_uri?>/img/logo.jpg" alt="Reservation box" /></a></h1>

		<!-- global -->
		<div id="global">
			<h2 class="hidden">전역영역</h2>
			<div class="account">
				<p>
					<span class="icon"><img src="<?=$layout_uri?>/img/ico_person.jpg" alt="사람" /></span>
					<strong><?=$member['mb_name']?>(<?=$member['mb_id']?>)</strong> 님
				</p>
			</div>

			<div class="ip">
				<p>
					<span class="icon"><img src="<?=$layout_uri?>/img/ico_checkbox.jpg" alt="체크" /></span>
					<strong>접속아이피 : </strong><?=$_SERVER['REMOTE_ADDR']?>
				</p>
			</div>

			<div class="logout">
				<p>
					<a href="<?=_BASE_URI_?>/webmanager/member/process.html?mode=logout&return_url=<?=urlencode('/webmanager/member/login.html')?>">
						<img src="<?=$layout_uri?>/img/ico_secret.jpg" alt="자물쇠" />
						<strong>LOGOUT</strong>
					</a>
				</p>
			</div>
		</div>
		<!-- //global -->
	</div>
	<!-- //header -->

	<!-- container -->
	<div id="container">

		<!-- aside -->
		<div id="aside">
			<h2 class="hidden">측면영역</h2>

			<div class="date_info">
				<dl>
				<dt>Today</dt>
				<dd><?=date('Y-m-d')?></dd>
				</dl>
			</div>

			<div id="gnb">
				<h3 class="hidden">주메뉴</h3>
				<ul>
				<?=$gnb?>
				</ul>
			</div>
		</div>
		<!-- //aside -->

		<!-- content -->
		<div id="content"<?if($content_size){?> class="<?=$content_size?>"<?}?>>			
			<h2 class="hidden">본문영역</h2>

			<div class="doc_title">
				<h3><?=$doc_title?></h3>
			</div>

			<!-- article -->
			<div id="article">
