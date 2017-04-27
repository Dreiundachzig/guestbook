<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	echo "<!DOCTYPE html>
<html>
	<head>
		<title>G&auml;stebuch | ".$title."</title>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/bootstrap.css\" />
		<script language=\"JavaScript\" src=\"./js/jquery.js\"></script>
		<script language=\"JavaScript\" src=\"./js/bootstrap.js\"></script>
		<script language=\"JavaScript\" src=\"./misc/functions.js\"></script>";
	
	$browser=getBrowser();
	
	switch($browser['name'])
	{
		case 'Internet Explorer':
			if($browser['version'] < 10) $browser_old = true;
			break;
		case 'Mozilla Firefox':
			if($browser['version'] < 20) $browser_old = true;
			break;
		case 'Google Chrome':
			if($browser['version'] < 20) $browser_old = true;
			break;
		default:
			$not_supported = true;
			break;
	}
	
	if(isset($browser_old) && $browser_old)
	{
		echo "
					<div class=\"alert alert-error\">
						<button class=\"close\" data-dismiss=\"alert\" type=\"button\"><i class=\" icon-remove\"></i></button>
						Ihr Browser ist veraltet und unterst&uuml;tzt gegebenfalls nicht alle Funktionen.<br />
						Bitte aktualisieren Sie Ihren Browser.
					</div>";
	}
	if(isset($not_supported) && $not_supported)
	{
		echo "
					<div class=\"alert alert-error\">
						<button class=\"close\" data-dismiss=\"alert\" type=\"button\"><i class=\" icon-remove\"></i></button>
						Ihr Browser wird offiziell nicht unterstützt.<br />
						Eventuell werden nicht alle Funktionen unterst&uuml;tzt.
					</div>";
	}
	
	echo "
	</head>";
?>