<?
if(!defined('_INPLUS_')) { exit; }

if(!$back_type) { $back_type = 'prev'; }
if(!$back_url) { $back_url = '#'; }
?>
</head>
<body>
<div id="wrap" class="wrap">
	<div class="location">
    	<h2><?=$doc_title?></h2>
		<a href="<?=$back_url?>" id="btn_back" class="btn_go_back location_<?=$back_type?>"><i class="<? if($back_type == 'prev') { ?>xi-angle-left<? } else if($back_type == 'close') { ?>xi-close<? } ?>"></i></a>
    </div>
