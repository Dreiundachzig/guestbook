<?php
	session_start();
	
	if(!isset($_SESSION['initiated']))
	{
		session_regenerate_id();
		$_SESSION['initiated'] = true;
	}
	
	define("_ISLOADED", 1);
	
	include('../misc/config.php');
	include('../misc/functions.php');

	if(isset($_POST['install']))
	{
		include('./install.php');
	}
	else
	{
		include('./form.php');
	}
?>