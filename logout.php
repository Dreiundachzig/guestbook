<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	session_destroy();
	
	$title = "Logout";
	
	include('./head.php');
	
	echo "
	<body>
		<div class=\"content\">
			Erfolgreich ausgeloggt.<br />
			Sie werden automatisch weitergeleitet.
			<meta http-equiv=\"refresh\" content=\"3; URL=".$_SERVER['PHP_SELF']."\">";
	
	include('./footer.php');
?>