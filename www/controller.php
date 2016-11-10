<?
define('_INPLUS_', true);
include_once('./common.php');

# 레이아웃 설정 초기화
$auth_layout = array(
	'front'		=> true,
	'user'		=> true,
	'staff'		=> false,
	'manager'	=> false,
	'admin'		=> false
);
$flag_use_head = true;
$flag_use_header = true;
$flag_use_footer = true;
$flag_use_footer_nav = true;

# 레이아웃, 모듈, 서비스
$layout = $_GET['la'];
$module = $_GET['md'];
$service = $_GET['sv'];

# 로그인 정보
$mb_class_file = _MODULE_PATH_.'/member/member.'.$layout.'.class.php';
if(!file_exists($mb_class_file)) {
	$content = '<strong>Module error</strong>';
	if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
		$content .= '<br />';
		$content .= 'module_file : '.$mb_class_file;
	}
	printError($content);
	exit;
}
include_once($mb_class_file);

$mb_class_name = 'member'.ucfirst($layout);
$lambda_member = create_function('', "return new {$mb_class_name}();");
$oMember = $lambda_member();
$oMember->init();
$member = $oMember->getLoginMember();

$is_admin	= false;	// 최고관리자
$is_manager	= false;	// 가맹점관리자
$is_staff	= false;	// 가맹점담당자(스탭)
$is_user	= false;	// 사용자
$is_guest	= true;		// 비회원

# 권한
if($member['mb_id'] && $member['mb_level'] > 2) {
	if(defined('_FLAG_OTHER_SESSION_') && _FLAG_OTHER_SESSION_) {
		if($layout == 'admin') { $is_admin = true; }
		else if($layout == 'manager') { $is_manager = true; }
		else if($layout == 'staff') { $is_staff = true; }
		else if($layout == 'user') { $is_user = true; }
		else if($layout == 'front' && $member['flag_auth'] == 'Y') { $is_user = true; }
	}
	else {
		//$is_member = true;
		//if($member['mb_level'] > 7) { $is_admin = true; }		
	}
	$is_guest = false;
}

# 레이아웃 권한 검사
if($service == 'login' || $service == 'join' || $service == 'join_result' || $service == 'ajax_find_password' || $service == 'ajax_find_password_result' || $service == 'upload_from_app' || 
	$mode == 'login' || $mode == 'logout' || $mode == 'check_member_id' || $mode == 'check_member_email' || $mode == 'check_member_nick' || $mode == 'login_from_app' ||
	($layout == 'manager' && $service == 'process' && $mode == 'insert')) {
	$auth_layout['admin'] = true;
	$auth_layout['manager'] = true;
	$auth_layout['staff'] = true;
}
else {	
	if($layout == 'admin') {
		// 관리자모드
		if($is_admin) { $auth_layout['admin'] = true; }
		else { 
			$return_url = urlencode($_SERVER['REQUEST_URI']);
			if($module == 'page' && $service == 'main') {
				movePage(_BASE_URI_.'/webadmin/member/login.html?return_url='.$return_url);
			}
			else {
				alert('권한이 없습니다.', _BASE_URI_.'/webadmin/member/login.html?return_url='.$return_url);
			}
		}
	}
	else if($layout == 'manager') {
		// 가맹점관리자모드
		if($is_manager) { $auth_layout['manager'] = true; }
		else {
			$return_url = urlencode($_SERVER['REQUEST_URI']);
			if($module == 'page' && $service == 'main') {
				movePage(_BASE_URI_.'/webmanager/member/login.html?return_url='.$return_url);
			}
			else {
				alert('권한이 없습니다.', _BASE_URI_.'/webmanager/member/login.html?return_url='.$return_url);
			}
		}
	}
	else if($layout == 'staff') {
		// 스탭모드
		if($is_staff) { $auth_layout['staff'] = true; }
		else {
			$return_url = urlencode($_SERVER['REQUEST_URI']);
			if($module == 'page' && $service == 'main') {
				movePage(_BASE_URI_.'/webstaff/member/login.html?return_url='.$return_url);
			}
			else {
				alert('권한이 없습니다.', _BASE_URI_.'/webstaff/member/login.html?return_url='.$return_url);
			}
		}
	}
}

# 현재 URI
if(!$this_uri) {
	if (isset($_SERVER['SCRIPT_URL'])) {
		$this_uri = $_SERVER['SCRIPT_URL'];
	} else {
		$this_uri = $_SERVER['REQUEST_URI'];
	}
}

# 모듈 클래스 검사
$module_class_file = _MODULE_PATH_.'/'.$module.'/'.$module.'.'.$layout.'.class.php';
if(!file_exists($module_class_file)) {
	$content = '<strong>Module error</strong>';
	if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
		$content .= '<br />';
		$content .= 'module_class_file : '.$module_class_file;
	}
	printError($content);
	exit;
}

# 모듈 경로
$module_uri = '';
if($layout != 'front') {
	$module_uri .= '/web'.$layout;
}
$module_uri .= '/'.$module;
include_once($module_class_file);

# 서비스 처리
$service_file = _MODULE_PATH_.'/'.$module.'/'.$layout.'/'.$service.'.php';
if(!file_exists($service_file)) {
	$content = '<strong>Service error</strong>';
	if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
		$content .= '<br />';
		$content .= 'service_file : '.$service_file;
	}
	printError($content);
	exit;
}

# 뷰에서 사용할 변수 설정
$layout_uri = _LAYOUT_URI_.'/'.$layout;
$js_uri = _JS_URI_;
$css_uri = _CSS_URI_;
$img_uri = _BASE_URI_.'/web'.$layout.'/'.$module.'/img';
$charset = _HOMEPAGE_CHARSET_;

# base_uri
$base_uri = _BASE_URI_;
if($layout != 'front') { $base_uri .= '/web'.$layout; }

# 모바일일 경우 (예약박스만 예외처리)
if($layout == 'user' || $layout == 'staff') {
	$js_uri .= '-mobile';
	$css_uri .= '-mobile';
	$img_uri = _BASE_URI_.'/img/mobile';
}

# 서비스 실행
ob_start();
include_once($service_file);
$content = ob_get_contents();
ob_end_clean();

# ajax json
$flag_json = ($_POST['flag_json']) ? $_POST['flag_json'] : $_GET['flag_json'];
if($flag_json) {
	$result = array(
		'code'		=> 'ok',
		'content'	=> $content
	);

	if($json_etc) {
		$result['json_etc'] = $json_etc;
	}

	if($flag_json == 2) {
		$result['tooltip_width'] = $tooltip_width;
	}

	echo json_encode($result);
	exit;
}

# 레이아웃 검사
if(!$auth_layout[$layout]) {
	$content = '<strong>Layout error</strong>';
	if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
		$content .= '<br />';
		$content .= 'layout : '.$layout;
		$content .= '<br />';
		$content .= 'auth : '.$auth_layout[$layout];
	}
	printError($content);
	exit;
}

$layout_path = _LAYOUT_PATH_.'/'.$layout;

if(!$head_file) { $head_file = 'head.inc.php'; }
if(!$header_file) { $header_file = 'header.inc.php'; }
if(!$footer_file) { $footer_file = 'footer.inc.php'; }

if($service == 'process') {
	$flag_use_head = false;
	$flag_use_header = false;
	$flag_use_footer = false;
}

if($flag_use_head &&!file_exists($layout_path.'/'.$head_file)) {
	$content = '<strong>Layout error</strong>';
	if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
		$content .= '<br />';
		$content .= 'layout_file : '.$layout_path.'/'.$head_file;
	}
	printError('Layout error');
	exit;
}

if($flag_use_header && !file_exists($layout_path.'/'.$header_file)) {
	$content = '<strong>Layout error</strong>';
	if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
		$content .= '<br />';
		$content .= 'layout_file : '.$layout_path.'/'.$header_file;
	}
	printError('Layout error');
	exit;
}

if($flag_use_footer && !file_exists($layout_path.'/'.$footer_file)) {
	$content = '<strong>Layout error</strong>';
	if(defined('_FLAG_DEBUG_') && _FLAG_DEBUG_) {
		$content .= '<br />';
		$content .= 'layout_file : '.$layout_path.'/'.$footer_file;
	}
	printError('Layout error');
	exit;	
}

# 메뉴 정보
if($flag_use_head || $flag_use_header) {
	include_once($layout_path.'/menu.inc.php');

	// 메뉴 정보 파악
	include_once(_LIB_PATH_.'/menu.class.php');

	$oMenu = new Menu();
	$oMenu->init($menu, $this_uri);	
	$page_no = $oMenu->getPageNo();	

	//print_R($menu); exit;

	/*
	if($doc_title) { $html_title = $doc_title.' :: '._HOMEPAGE_TITLE_; }
	else {
		$html_title = ($html_title) ? $html_title : $oMenu->getHtmlTitle(_HOMEPAGE_TITLE_);
		$title_path = $oMenu->getTitlePath('<a href="/">Home</a>');
		$doc_title = $oMenu->getDocTitle();
		$gnb = $oMenu->getGnb();
		$sub_nav = $oMenu->getSubNav($page_no);
	}
	*/
	if($doc_title) { 
		$html_title = $doc_title.' :: '._HOMEPAGE_TITLE_; 
		$gnb = $oMenu->getGnb();
		$sub_nav = $oMenu->getSubNav($page_no);
	}
	else {
		$html_title = ($html_title) ? $html_title : $oMenu->getHtmlTitle(_HOMEPAGE_TITLE_);
		$title_path = $oMenu->getTitlePath('<a href="/">Home</a>');
		$doc_title = $oMenu->getDocTitle();
		$gnb = $oMenu->getGnb();
		$sub_nav = $oMenu->getSubNav($page_no);
	}
}

# head 출력
if($flag_use_head) {
	ob_start();
	include_once($layout_path.'/'.$head_file);
	$head_buffer = ob_get_contents();
	ob_end_clean();

	# 모듈 CSS 파일
	if(file_exists(_MODULE_PATH_.'/'.$module.'/css.php')) {
		// 삽입될 위치 결정
		preg_match('#<script(.*)</script>#i', $head_buffer, $first_js);
		$first_js = $first_js[0];

		// css link
		$css_link = '<link rel="stylesheet" type="text/css" href="'._BASE_URI_.'/';
		if($layout != 'front') { $css_link .= 'web'.$layout.'/'; }
		$css_link .= $module.'/style.css" />';

		$head_buffer = str_replace($first_js, $css_link."\n".$first_js, $head_buffer);
	}

	# 모듈 JS 파일
	$module_js = $module.'.js';
	if(file_exists(_MODULE_PATH_.'/'.$module.'/js.php')) {
		$js_link ='<script type="text/javascript" src="'._BASE_URI_.'/';
		if($layout != 'front') { $js_link .= 'web'.$layout.'/'; }
		$js_link .=  $module.'/common.js"></script>';
		$head_buffer .= "\n".$js_link;
	}
	echo $head_buffer;
}

# header 출력
if($flag_use_header) {
	include_once($layout_path.'/'.$header_file);
}

# 본문 출력
echo $content;

# footer 출력
if($flag_use_footer) {
	include_once($layout_path.'/'.$footer_file);
}
?>