<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	$title = "Passwort &auml;ndern";
	
	include('./head.php');
	
	echo "
	<body>
		<div class=\"content\">";

	if(isset($_POST['new_password']))
	{
		if(!(empty($_POST['old_password']) && empty($_POST['new_password_1']) && empty($_POST['new_password_2'])))
		{
			$password = array();
			$password['old_password'] = $_POST['old_password'];
			$password['new_password_1'] = $_POST['new_password_1'];
			$password['new_password_2'] = $_POST['new_password_2'];
		}
			
		$mysqli = mysqli_open();

		$sql = "SELECT * FROM `admins` WHERE `username` = '".$_SESSION['username']."'";
			
		$query = $mysqli->query($sql);
				
		$daten = $query->fetch_assoc();
			
		$mysqli->close();
			
		$pwhash = saltPassword($password['old_password'], $daten['salt']);
		$new_password = saltPassword($password['new_password_1'], $daten['salt']);
			
		if($password['new_password_1'] == $new_password)
		{
			echo "Bitte nicht das alte Passwort erneut verwenden!<br />
		Sie werden automatisch weitergeleitet.
		<meta http-equiv=\"refresh\" content=\"3\";>";
		}
		else if(($pwhash == $daten["password"]) && ($password['new_password_1'] == $password['new_password_2']))
		{
			$salt = bin2hex(mcrypt_create_iv(32));
			$new_password = saltPassword($password['new_password_1'], $salt);
			
			$mysqli = mysqli_open();
			
			$sql = "UPDATE `admins` SET `password` = '".$new_password."', `salt` = '".$salt."'";
			
			$mysqli->query($sql);
			
			$mysqli->close();
				
			echo "Passwort erfolgreich ge&auml;ndert.<br />
		Sie werden automatisch weitergeleitet.
		<meta http-equiv=\"refresh\" content=\"3; URL=".$_SERVER['PHP_SELF']."\">";
		}
		else if(!($pwhash == $daten["password"]))
		{
			echo "Das Passwort stimmt nicht &uuml;berein.<br />
			Sie werden automatisch weitergeleitet.
			<meta http-equiv=\"refresh\" content=\"3;\">";
		}
		else if(!($password['new_password_1'] == $password['new_password_2']))
		{
			echo "Die neuen Passw&ouml;rter stimmen nicht &uuml;berein.<br />
			Sie werden automatisch weitergeleitet.
			<meta http-equiv=\"refresh\" content=\"3;\">";
		}
		else
		{
			exit("Fehler!");
		}
	}
	else
	{
		echo"
			<fieldset>
				<form action=\"".$_SERVER['PHP_SELF']."?action=password\" name=\"password\" method=\"POST\" onSubmit=\"chkPW();\">
					<table>
						<tr>
							<td class=\"td1\">Altes Passwort:</td>
							<td><input type=\"password\" name=\"old_password\" size=\"30\" maxlength=\"30\" required=\"required\" tabindex=\"1\" /></td>
						</tr>
						<tr>
							<td class=\"td1\">Neues Passwort:</td>
							<td><input type=\"password\" name=\"new_password_1\" size=\"30\" maxlength=\"30\" required=\"required\" tabindex=\"2\" /></td>
						</tr><tr>
							<td class=\"td1\">Neues Passwort wiederholen:</td>
							<td><input type=\"password\" name=\"new_password_2\" size=\"30\" maxlength=\"30\" required=\"required\" tabindex=\"3\" /></td>
						</tr>
						<tr>
							<td class=\"td3\" colspan=\"2\"><input type=\"submit\" name=\"new_password\" value=\"Passwort &auml;ndern\" tabindex=\"4\" /></td>
						</tr>
					</table>
				</form>
			</fieldset>";
	}
	
	include('./footer.php');
?>