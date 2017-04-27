<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	$title = "Login";
	
	include('./head.php');
	
	echo "
	<body>
		<div class=\"content\">";
	
	if(isset($_POST['submit_login']))
	{
		if(!(empty($_POST['username']) && empty($_POST['password'])))
		{
			$login = array();
			$login['username'] = $_POST['username'];
			$login['password'] = $_POST['password'];
		}
			
		$mysqli = mysqli_open();

		$sql = "SELECT * FROM admins WHERE username = '".$login['username']."'";
			
		$query = $mysqli->query($sql);
				
		$daten = $query->fetch_assoc();
			
		$mysqli->close();
			
		$pwhash = saltPassword($login['password'], $daten['salt']);
			
		if($pwhash == $daten["password"])
		{
			$_SESSION['login'] = true;
			$_SESSION['username'] = $daten['username'];
				
			echo "Login erfolgreich.<br />
		Sie werden automatisch weitergeleitet.
		<meta http-equiv=\"refresh\" content=\"3; URL=".$_SERVER['PHP_SELF']."\">";
		}
		else
		{
			echo "Kombination aus Benutzername und Passwort falsch.<br />
			Sie werden automatisch weitergeleitet.
			<meta http-equiv=\"refresh\" content=\"3;\">";
		}
	}
	else
	{
		echo "
			<fieldset>
				<form action=\"".$_SERVER['PHP_SELF']."?action=login\" method=\"POST\" name=\"login\" onsubmit=\"return chkLogin();\">
					<table>
						<tr>
							<td class=\"td1\">Benutzername:</td>
							<td><input type=\"text\" name=\"username\" size=\"30\" maxlength=\"30\" tabindex=\"1\" required=\"required\" /></td>
						</tr>
						<tr>
							<td class=\"td1\">Passwort:</td>
							<td><input type=\"password\" name=\"password\" size=\"30\" maxlength=\"30\" tabindex=\"2\" required=\"required\" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<table>
									<tr>
										<td class=\"td2\"><input type=\"submit\" name=\"submit_login\" value=\"Login\" tabindex=\"3\" /></td>
									<td class=\"td2\"><input type=\"button\" name=\"close\" value=\"Abbrechen\" onclick=\"window.location.href='".$_SERVER['PHP_SELF']."'\" tabindex=\"4\" /></td>
									</tr>
								</table>
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</form>
			</fieldset>";
	}
	
	include('./footer.php');
?>