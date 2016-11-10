<?
if(!defined('_INPLUS_')) { exit; }

unset($dir);

$dir['DATA']	= 'data';
	$dir['LOG']			= $dir['DATA'].'/log';
	$dir['SESSION']		= $dir['DATA'].'/session';
	$dir['UPLOAD']		= $dir['DATA'].'/upload';

$dir['LAYOUT']	= 'layout';

$dir['LIB']		= 'lib';

$dir['MODULE']	= 'module';

$dir['PLUGIN']	= 'plugin';
	$dir['GABIA_SMS']	= $dir['PLUGIN'].'/gabia.sms';

$dir['SHARE']	= 'share';
	$dir['CSS']			= $dir['SHARE'].'/css';
	$dir['JS']			= $dir['SHARE'].'/js';
?>