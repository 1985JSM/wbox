<?
if(!defined('_INPLUS_')) { exit; }

function printSelectOption($arr, $val, $opt = 0) {

	foreach($arr as $k => $v) {
		$value = $v;
		$text = $v;
		$selected = '';

		if($opt == 1) { $value = $k; }
		else if($opt == 2) { $value = $v; $text = $k; }

		if($val == $value) { $selected = ' selected="selected"'; }

		echo '<option value="'.$value.'"'.$selected.'>'.$text.'</option>';
	}
}

function printRadio($name, $arr, $val, $opt = 0) {	
	$cnt = 1;
	foreach($arr as $k => $v) {
		$value = $v;
		$text = $v;
		$checked = '';
		$id = $name.'_'.$cnt;

		if($opt == 1) { 
			$value = $k; 
		}
		else if($opt == 2) {
			$value = $v;
			$text = $k;
		}

		if($val == $value) {
			$checked = ' checked="checked"';
		}	

		echo '<input type="radio" name="'.$name.'" id="'.$id.'" class="'.$name.'" value="'.$value.'"'.$checked.' /> <label for="'.$id.'">'.$text.'</label> ';
		$cnt++;
	}
}

function printCheckBox($name, $arr, $val, $opt = 0) {
	$cnt = 1;
	$v_arr = explode('|', $val);

	foreach($arr as $k => $v) {
		$value = $v;
		$text = $v;
		$checked = '';
		$id = $name.'_'.$cnt;

		if($opt == 1) {
			$value = $k;
		}
		else if($opt == 2) {
			$value = $v;
			$text = $k;
		}

		for($i = 0 ; $i < sizeof($v_arr) ; $i++) {
			if($v_arr[$i] == $value) {
				$checked = ' checked="checked"';
				break;
			}	
		}

		echo '<input type="checkbox" name="'.$name.'[]" id="'.$id.'" class="'.$name.'" value="'.$value.'"'.$checked.' /> <label for="'.$id.'">'.$text.'</label> ';
		$cnt++;
	}	
}

function printEmail($name, $val, $input_class = '', $select_class = '') {
	$tmp = 'naver.com,chol.com,dreamwiz.com,empal.com,freechal.com,gmail.com,hanafos.com,hanmail.net,hanmir.com,hitel.net,hotmail.com,korea.com,lycos.co.kr,nate.com,netian.com,paran.com,yahoo.com,yahoo.co.kr';
	$tmp_arr = explode(',', $tmp);
	unset($email_arr);
	for($i = 0 ; $i < sizeof($tmp_arr) ; $i++) { $email_arr[$tmp_arr[$i]] = $tmp_arr[$i]; }	
	$email_arr["self"] = '직접입력';

	$v_arr = explode('@', $val);
	$email_id = $v_arr[0];
	$email_host = $v_arr[1];

	$email_select = $email_host;
	if(($email_select && !in_array($email_select, $email_arr)) || !$email_host) { $email_select = 'self'; }
	?>
<input type="text" name="<?=$name?>_id" value="<?=$email_id?>" class="email_id <?=$input_class?>" size="20" title="이메일 아이디" />
@
<input type="text" name="<?=$name?>_host" value="<?=$email_host?>" class="email_host <?=$input_class?>" size="20" title="이메일 호스트" />
<select name="<?=$name?>_select" class="email_select <?=$select_class?>" title="이메일 호스트">
<option value="">선택</option>
<? printSelectOption($email_arr, $email_select, 1) ?>
</select>
	<?
}

function printTel($name, $val, $input_class = '', $select_class = '') {
	$tmp = '02,031,032,033,041,042,043,044,051,052,053,054,055,061,062,063,064,070,010';
	$tel_arr = explode(',', $tmp);

	$v_arr = explode('-', $val);
	?>
<select name="<?=$name?>_1" class="tel_select <?=$select_class?>" title="전화번호 첫자리">
<option value="">선택</option>
<? printSelectOption($tel_arr, $v_arr[0]) ?>
</option>
</select>
-
<input type="text" name="<?=$name?>_2" value="<?=$v_arr[1]?>" class="tel number <?=$input_class?>" size="7" maxlength="4" title="전화번호 중간자리" />
-
<input type="text" name="<?=$name?>_3" value="<?=$v_arr[2]?>" class="tel number <?=$input_class?>" size="7" maxlength="4" title="전화번호 끝자리" />
	<?
}

function printHp($name, $val, $input_class = '', $select_class = '') {
	$tmp = '010,011,016,017,018,019,070';
	$hp_arr = explode(',', $tmp);

	$v_arr = explode('-', $val);
	?>
<select name="<?=$name?>_1" class="hp_select <?=$select_class?>" title="휴대폰번호 첫자리">
<option value="">선택</option>
<? printSelectOption($hp_arr, $v_arr[0]) ?>
</option>
</select>
-
<input type="text" name="<?=$name?>_2" value="<?=$v_arr[1]?>" class="hp number <?=$input_class?>" size="7" maxlength="4" title="휴대폰번호 중간자리" />
-
<input type="text" name="<?=$name?>_3" value="<?=$v_arr[2]?>" class="hp number <?=$input_class?>" size="7" maxlength="4" title="휴대폰번호 끝자리" />
	<?
}

function printDefaultHtml($title, $content) {
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=_HOMEPAGE_CHARSET_?>" />
<title><?=$title?> :: <?=_HOMEPAGE_TITLE_?></title>
<link rel="stylesheet" type="text/css" href="<?=_CSS_URI_?>/reset.css" />
<script type="text/javascript" src="<?=_JS_URI_?>/jquery-1.8.3.min.js"></script>
</head>
<body>
<?=$content?>
</body>
</html>
	<?
	exit;
}

function printError($msg) {
	printDefaultHtml('Error', $msg);	
}

function movePage($url, $flag_top = true) {
	ob_start();	
	?>
<script type="text/javascript">
//<![CDATA[
<? if($flag_top) { ?>
top.location.replace("<?=$url?>");
<? } else { ?>
location.replace("<?=$url?>");
<? } ?>
//]]>
</script>
<noscript>
<p>	
	이동할 페이지 : <?=$url?><br />
	<a href="<?=$url?>" title="페이지 이동">이동하기</a>
</p>
</noscript>
	<?
	$content = ob_get_contents();
	ob_end_clean();

	printDefaultHtml('페이지이동', $content);
}

function alert($msg, $url = '') {
	$content = nl2br($msg);
	ob_start();

	$msg = str_replace("\n", "\\n", $msg);
?>
<script type="text/javascript">
//<![CDATA[
var url = "<?=$url?>";
alert("<?=$msg?>");
<? if($url != 'none') { ?>
if(url) { top.location.replace(url); }
else { history.back(-1); }
<? } ?>
//]]>
</script>
<noscript>
<p>	
	<?=$content?>
	<? if($url) { ?><br />
	이동할 페이지 : <?=$url?><br />
	<a href="<?=$url?>" title="페이지 이동">이동하기</a>
	<? } ?>
</p>
</noscript>
<?
$content = ob_get_contents();
ob_end_clean();

printDefaultHtml('알림', $content);
}

function callNative($native_url, $return_url = '') {
	ob_start();	
	?>
<script type="text/javascript">
//<![CDATA[
<? if(_IS_WEBVIEW_) { ?>
location.replace("native://<?=$native_url?>/<?=urlencode($return_url)?>");
<? } else { ?>
location.replace("<?=$return_url?>");
<? } ?>
//]]>
</script>
	<?
	$content = ob_get_contents();
	ob_end_clean();

	printDefaultHtml('페이지이동', $content);
}

function alertCode($code, $url = '') {
	ob_start();
?>
<script type="text/javascript" src="<?=_JS_URI_?>/inplus.msg.js"></script>
<script type="text/javascript">
//<![CDATA[
var msg = msg_arr["<?=$code?>"];
var url = "<?=$url?>";

alert(msg);
if(url) { top.location.replace(url); }
else { history.back(-1); }
//]]>
</script>
<noscript>
<p>	
	<?=$code?>
	<? if($url) { ?><br />
	이동할 페이지 : <?=$url?><br />
	<a href="<?=$url?>" title="페이지 이동">이동하기</a>
	<? } ?>
</p>
</noscript>
	<?
	$content = ob_get_contents();
	ob_end_clean();

	printDefaultHtml('알림', $content);
}

function printNoData($colspan, $msg = '') {
	if(!$msg) { $msg = '등록 또는 검색된 데이터가 없습니다.'; }
	?>
<tr>
	<td class="no_data" colspan="<?=$colspan?>"><?=$msg?></td>
</tr>
	<?
}

function printPagination($arr, $query_string = '') {
	$query_string = preg_replace('/page=[0-9]+/', '', $query_string);
	
	for($i = 0 ; $i < sizeof($arr) ; $i++) 
	{ ?>
<li<?if($arr[$i]['class']){?> class="<?=$arr[$i]['class']?>"<?}?>><a href="?page=<?=$arr[$i]['page']?><?=$query_string?>" title="<?=$arr[$i]['title']?> 페이지"><?=$arr[$i]['title']?></a></li>
	<? }
}

function printAjaxPagination($arr, $query_string = '', $href = '', $target = '', $title = '') {
	$query_string = preg_replace('/page=[0-9]+/', '', $query_string);
	
	for($i = 0 ; $i < sizeof($arr) ; $i++) 
	{ ?>
<li<?if($arr[$i]['class']){?> class="<?=$arr[$i]['class']?>"<?}?>><a href="<?=$href?>?page=<?=$arr[$i]['page']?><?=$query_string?>" class="btn_ajax" target="<?=$target?>" title="<?=$title?>"><?=$arr[$i]['title']?></a></li>
	<? }
}

function cutString($str, $len, $suffix = '..') {
    $arr_str = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    $str_len = count($arr_str);

    if($str_len >= $len) {
        $slice_str = array_slice($arr_str, 0, $len);
        $str = join("", $slice_str);

        return $str . ($str_len > $len ? $suffix : '');
    }
	else {
        $str = join("", $arr_str);
        return $str;
    }
}

function printTr($th, $td, $flag_required = false, $colspan = 0) {
	?>
<tr>
	<th<?if($flag_required){?> class="required"<?}?>><?=$th?></th>
	<td<?if($colspan>0){?> colspan="<?=$colspan?>"<?}?>>
		<?=$td?>
	</td>
</tr>
	<?
}

function printInputText($name, $title = '', $value= '', $class = '', $size = 0, $maxlength = 0) {
	if($title)	{ $title = 'title="'.$title.'" '; }
	if($class)	{ $class = ' '.$class; }
	if($size)	{ $size = 'size="'.$size.'" '; }
	if($maxlength) { $maxlength = 'maxlength="'.$maxlength.'" '; }	

	echo'<input type="text" name="'.$name.'" value="'.$value.'" class="text'.$class.'" '.$size.$maxlength.$title.'/>';
}

function printTextarea($name, $title = '', $value= '', $class = '', $rows = 0, $cols = 0) {
	if($title)	{ $title = 'title="'.$title.'" '; }
	if($class)	{ $class = ' '.$class; }
	if($rows)	{ $rows = 'rows="'.$rows.'" '; }
	if($cols)	{ $cols = 'cols="'.$cols.'" '; }	

	echo'<textarea name="'.$name.'" class="textarea'.$class.'" '.$rows.$cols.$title.'>'.$value.'</textarea>';
}

function printWriteInput($title, $name, $value = '', $class = '', $size = 0, $maxlength = 0, $colspan = 0) {
	$th = $title;

	ob_start();
	printInputText($name, $title, $value, $class, $size, $maxlength);
	$td = ob_get_contents();
	ob_end_clean();

	$flag_required = false;
	if(strpos($class, 'required') > -1) { $flag_required = true; }

	printTr($th, $td, $flag_required, $colspan);
}

function printWriteTextarea($title, $name, $value = '', $class = '', $rows = 0, $cols = 0, $colspan = 0) {
	$th = $title;

	ob_start();
	printTextarea($name, $title, $value, $class, $rows, $cols);
	$td = ob_get_contents();
	ob_end_clean();

	$flag_required = false;
	if(strpos($class, 'required') > -1) { $flag_required = true; }

	printTr($th, $td, $flag_required, $colspan);
}

function getWithoutNull($str, $null = '-') {
	if(!$str || $str == '--' || $str == '0000-00-00' || $str == '0000-00-00 00:00:00') { $str = $null; }
	return $str;
}

function checkRecipeAuth() {
	global $member;

	$flag = true;
	if($member['mb_level'] == '4' && $member['flag_recipe'] != 'Y') {
		$flag = false;
	}

	return $flag;
}

function getRefererInArray($arr) {

	$referer = $_SERVER['HTTP_REFERER'];

	$flag = false;

	for($i = 0 ; $i < sizeof($arr) ; $i++) {
		if(strpos($referer, $arr[$i]) > -1) {
			$flag = true;
			break;
		}
	}

	if($flag) {
		setCookieValue('referer', $referer);
	}
	else {
		$referer = getCookieValue('referer');
		if(!$referer) {
			$referer = $_SERVER['HTTP_REFERER'];
		}
	}

	return $referer;
}
?>