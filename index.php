<?php
	session_start();

	if(!isset($_SESSION['initiated']))
	{
		session_regenerate_id();
		$_SESSION['initiated'] = true;
	}

	define("_ISLOADED", 1);

	include('./misc/config.php');
	include('./misc/functions.php');

	if(isset($_GET['action']))
	{
		if($_GET['action'] == 'add')
		{
			include('./add.php');
		}
		elseif($_GET['action'] == 'delete')
		{
			include('./delete.php');
		}
		elseif($_GET['action'] == 'login')
		{
			include('./login.php');
		}
		elseif($_GET['action'] == 'password')
		{
			include('./password.php');
		}
		elseif($_GET['action'] == 'logout')
		{
			include('./logout.php');
		}
		else
		{
			include('./entries.php');
		}
	}
	else
	{
		include('./entries.php');
	}
?>