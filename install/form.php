<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	include('./head.php');
	
	echo "
	<body>
		<div>";

	echo"
			<header>
				<p>Bitte w&auml;hlen Sie einen Benutzernamen und ein Passwort f&uuml;r die Administration des G&auml;stebuchs.</p>
			</header>
			<fieldset>
			<form action=\"".$_SERVER['PHP_SELF']."\" name=\"install\" method=\"POST\" onSubmit=\"chkInstall();\">
				<table>
					<tr>
						<td class=\"td1\">Benutzername:</td>
						<td><input type=\"text\" name=\"username\" size=\"30\" maxlength=\"30\" required=\"required\" tabindex=\"1\" /></td>
					</tr>
					<tr>
						<td class=\"td1\">Passwort:</td>
						<td><input type=\"password\" name=\"password\" size=\"30\" maxlength=\"30\" required=\"required\" tabindex=\"2\" /></td>
					</tr>
					<tr>
						<td class=\"td3\" colspan=\"2\"><input type=\"submit\" name=\"install\" value=\"Installieren\" tabindex=\"3\" /></td>
					</tr>
				</table>
			</form>
			</fieldset>
		</div>";
	
	include('./footer.php');
?>