<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	$title = "Beitrag hinzuf&uuml;gen";
	
	include('./head.php');
	
	echo "
	<body>
		<div class=\"row\">
		<div class=\"span12 offset2\">
		<div class=\"well container-fluid\">";
	
	if(isset($_POST['submit_add']))
	{
		if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
		{
			$captcha_msg = "Der Sicherheitscode stimmt nicht &uuml;berein!";
		}
		
		if((empty($_POST['subject']) || empty($_POST['entrie'])) || ($_POST['subject'] === "" || $_POST['entrie'] === ""))
		{
			$required_msg = "Es wurden nicht alle Pflichtfelder ausgef&uuml;llt!";
		}
		
		if(isset($captcha_msg) || isset($required_msg))
		{
			if(isset($captcha_msg))
			{
				echo "
					<div class=\"alert alert-error\">
						<button class=\"close\" data-dismiss=\"alert\" type=\"button\"><i class=\" icon-remove\"></i></button>".$captcha_msg."
					</div>";
			}
		
			if(isset($required_msg))
			{
				echo "
					<div class=\"alert alert-error\">
						<button class=\"close\" data-dismiss=\"alert\" type=\"button\"><i class=\" icon-remove\"></i></button>".
						$required_msg."
					</div>";
			}
		
			echo "
			<fieldset>
				<legend>Neuer Beitrag</legend>
					<form action=\"".$_SERVER['PHP_SELF']."?action=add\" method=\"POST\" name=\"add\" onsubmit=\"return chkAdd();\">
				<table>";
			if(isset($_SESSION['username']))
			{
				echo "
						<tr>
							<td class=\"td1\">Name:</td>
							<td><input type=\"hidden\" name=\"name\" value=\"".$_SESSION['username']."\" />".$_SESSION['username']."</td>
						</tr>";
			}
			else
			{
				echo "
						<tr>
							<td class=\"td1\">Name:</td>
							<td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"30\" tabindex=\"1\" value=\"".$_POST['name']."\" /></td>
						</tr>";
			}
			echo "
						<tr>
							<td class=\"td1\">Betreff:<font color=\"red\">*</font></td>
							<td><input type=\"text\" name=\"subject\" size=\"30\" maxlength=\"30\" tabindex=\"2\" required=\"required\" value=\"".$_POST['subject']."\" /></td>
						</tr>
						<tr>
							<td colspan=\"2\">&nbsp;</td>
						</tr>
						<tr>
							<td class=\"td1\">Nachricht:<font color=\"red\">*</font></td>
							<td><textarea name=\"entrie\" cols=\"50\" rows=\"10\" tabindex=\"3\" required=\"required\">".$_POST['entrie']."</textarea></td>
						</tr>
						<tr>
							<td><font color=\"red\">*</font>: Pflichtfelder</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><img src=\"./misc/captcha.php?rand=".rand()."\" id=\"captchaimg\"><br />
								<input id=\"6_letters_code\" name=\"6_letters_code\" type=\"text\"><br />
								<br>
Can't read the image? click <a href=\"javascript:refreshCaptcha();\">here</a> to refresh
						<tr>
							<td>
								<table>
									<tr>
										<td class=\"td2\"><input type=\"submit\" name=\"submit_add\" value=\"Eintragen\" tabindex=\"4\"></td>
										<td class=\"td2\"><input type=\"button\" name=\"close\" value=\"Abbrechen\" onclick=\"window.location.href='".$_SERVER['PHP_SELF']."'\" tabindex=\"5\" /></td>
									</tr>
								</table>
							</td>
							<td>&nbsp;</td>
						</tr>
				</table>
					</form>
			</fieldset>
			</div>
			</div>
			</div>
			<script type=\"text/javascript\">
				function refreshCaptcha()
				{
				var img = document.images['captchaimg'];
				img.src = img.src.substring(0,img.src.lastIndexOf(\"?\"))+\"?rand=\"+Math.random()*1000;
				}
			</script>";
		}
		else
		{
			if(!empty($_POST['name']))
			{
				$entrie = array();
				$entrie['name'] = $_POST['name'];
				$entrie['subject'] = $_POST['subject'];
				$entrie['entrie'] = $_POST['entrie'];
			}
			elseif(empty($_POST['name']))
			{
				$entrie = array();
				$entrie['name'] = 'Anonym';
				$entrie['subject'] = $_POST['subject'];
				$entrie['entrie'] = $_POST['entrie'];
			}
			
			$mysqli = mysqli_open();

			$sql = "INSERT INTO entries
					SET name='".$entrie['name']."', subject='".$entrie['subject']."', date='".date("Y-m-d H:i:s")."', entrie='".$entrie['entrie']."'";
						
			$mysqli->query($sql);
					
			$mysqli->close();
					
			echo "Vielen Dank f&uuml;r Ihren Eintrag<br>";
			echo "Sie werden automatisch weitergeleitet.";
			echo "<meta http-equiv=\"refresh\" content=\"3; URL=".$_SERVER['PHP_SELF']."\">";
		}
	}
	else
	{
		echo "
			<fieldset>
				<legend>Neuer Beitrag</legend>
					<form action=\"".$_SERVER['PHP_SELF']."?action=add\" method=\"POST\" name=\"add\" onsubmit=\"return chkAdd();\">
				<table>";
		if(isset($_SESSION['username']))
		{
			echo "
						<tr>
							<td class=\"td1\">Name:</td>
							<td><input type=\"hidden\" name=\"name\" value=\"".$_SESSION['username']."\" />".$_SESSION['username']."</td>
						</tr>";
		}
		else
		{
			echo "
						<tr>
							<td class=\"td1\">Name:</td>
							<td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"30\" tabindex=\"1\" /></td>
						</tr>";
		}
		echo "
						<tr>
							<td class=\"td1\">Betreff:<font color=\"red\">*</font></td>
							<td><input type=\"text\" name=\"subject\" size=\"30\" maxlength=\"30\" tabindex=\"2\" required=\"required\" /></td>
						</tr>
						<tr>
							<td colspan=\"2\">&nbsp;</td>
						</tr>
						<tr>
							<td class=\"td1\">Nachricht:<font color=\"red\">*</font></td>
							<td><textarea name=\"entrie\" cols=\"50\" rows=\"10\" tabindex=\"3\" required=\"required\"></textarea></td>
						</tr>
						<tr>
							<td><font color=\"red\">*</font>: Pflichtfelder</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><img src=\"./misc/captcha.php?rand=".rand()."\" id=\"captchaimg\"><br />
								<input id=\"6_letters_code\" name=\"6_letters_code\" type=\"text\"><br />
								<br>
Can't read the image? click <a href=\"javascript:refreshCaptcha();\">here</a> to refresh
						<tr>
							<td>
								<table>
									<tr>
										<td class=\"td2\"><input type=\"submit\" name=\"submit_add\" value=\"Eintragen\" tabindex=\"4\"></td>
										<td class=\"td2\"><input type=\"button\" name=\"close\" value=\"Abbrechen\" onclick=\"window.location.href='".$_SERVER['PHP_SELF']."'\" tabindex=\"5\" /></td>
									</tr>
								</table>
							</td>
							<td>&nbsp;</td>
						</tr>
				</table>
					</form>
			</fieldset>
			</div>
			</div>
			</div>
			<script type=\"text/javascript\">
				function refreshCaptcha()
				{
				var img = document.images['captchaimg'];
				document.getElementById(\"6_letters_code\").value = '';
				img.src = img.src.substring(0,img.src.lastIndexOf(\"?\"))+\"?rand=\"+Math.random()*1000;
				}
			</script>";
	}
	
	include('./footer.php');
?>