<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	include('./head.php');
	
	echo "
	<body>
		<div>";
	
	if(!(empty($_POST['password']) && empty($_POST['username'])))
	{
		$salt = bin2hex(mcrypt_create_iv(32));
		$install = array();
		$install['username'] = $_POST['username'];
		$install['password'] = saltPassword($_POST['password'], $salt);
	}
	
	$mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
	
	$sql_db = "CREATE DATABASE IF NOT EXISTS ".MYSQL_DATABASE."
				DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
	
	$sql_entries = "CREATE TABLE IF NOT EXISTS ".MYSQL_DATABASE.".`entries` (
				`id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`name` VARCHAR(20) NULL,
				`subject` VARCHAR(150) NULL,
				`date` DATETIME NOT NULL,
				`entrie` TEXT)
				ENGINE = InnoDB;";
	
	$sql_admins = "CREATE TABLE IF NOT EXISTS ".MYSQL_DATABASE.".`admins` (
				`id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`username` VARCHAR(20) NULL UNIQUE,
				`password` VARCHAR(128) NULL,
				`salt` VARCHAR(128) NULL)
				ENGINE = InnoDB;";
	
	$sql_admin = "INSERT INTO ".MYSQL_DATABASE.".`admins` SET `username`='".$install['username']."', password='".$install['password']."', salt='".$salt."'";
	
	$db = $mysqli->query($sql_db);
	$entries = $mysqli->query($sql_entries);
	$admins = $mysqli->query($sql_admins);
	$admin = $mysqli->query($sql_admin);
			
	$mysqli->close();
	
	if($db && $entries && $admins && $admin)
	{
		echo "
			G&auml;stebuch installiert.<br />
			Bitte das install-Verzeichnis l&ouml;schen.<br />
			<input type=\"button\" name=\"guestbook\" value=\"Zum G&auml;stebuch\" onclick=\"window.location.href='../index.php'\" />
		</div>";
	
		include('./footer.php');
	}
	else
	{
		exit("Fehler!");
	}
?>