<? if(!defined('_INPLUS_')) { exit; } 
$html_title = '최고관리자모드 :: 예약박스';

$page_no1 = $page_no[0];
$page_no2 = $page_no[1];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>" />
<? if($is_mobile) { ?>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

<? } ?>
<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="Ma Yong Min(milgam12@inplusweb.com)" />
<meta name="copyright" content="COPYRIGHT &copy; 2014 inplusweb.com ALL RIGHT RESERVED." />
<meta name="language" content="ko" />
<title><?=$html_title?></title>
<link rel="stylesheet" type="text/css" href="<?=$layout_uri?>/styles.css" />
<link rel="stylesheet" type="text/css" href="<?=$js_uri?>/jquery-ui-1.11.1.custom/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?=$js_uri?>/uniform/uniform.css" />
<script type="text/javascript" src="<?=$js_uri?>/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/jquery-ui-1.11.1.custom/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/uniform/jquery.uniform-2.1.1.min.js"></script>

<script type="text/javascript" src="<?=$js_uri?>/jquery.smenu-0.1.2.min.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/inplus.util.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/inplus.validate.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/inplus.msg.js"></script>
<script type="text/javascript" src="<?=$js_uri?>/inplus.common.js"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	
	// GNB
	$("#gnb").sMenu({		
		on_menu1	: "<?=$page_no1?>",
		on_menu2	: "",
		hover_class : "hover",
	});	

	$("#snb").sMenu({		
		on_menu1	: "<?=$page_no1?>",
		on_menu2	: "<?=$page_no2?>",
		hover_class : "hover",
		is_snb		: true,
		hoverCall	: function(obj, depth) {
			obj.removeClass("hover");
			if(!obj.hasClass("on")) {
				obj.addClass("on");				
			}
			else {
				obj.removeClass("on");				
			}
		}
	});	

	initContent(document);
	
});

var layout = "<?=$layout?>";
var base_uri = "<?=_BASE_URI_?>";
//]]>
</script>
