<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	$title = "Beitrag l&ouml;schen";
	
	include('./head.php');
	
	echo "
	<body>
		<div class=\"content\">";
	
	if(isset($_SESSION['login']) && $_SESSION['login'] == true)
	{
		if(isset($_GET['id']))
		{
			$id = (int)($_GET['id']);
				
			$mysqli = mysqli_open();
				
			$sql = "SELECT `id` FROM `entries`";
				
			$query = $mysqli->query($sql);
				
			$anzahl_eintraege = $query->num_rows;
				
			while($daten = $query->fetch_assoc())
			{
				if($daten['id'] == $id)
				{
					$is_id = true;
					break;
				}
				else
				{
					$is_id = false;
				}
			}
				
			$mysqli->close();
				
			if($is_id)
			{
				if(isset($_POST['submit_delete']))
				{
					$mysqli = mysqli_open();
				
					$sql = "DELETE FROM `entries` WHERE id='".$id."'";
			
					$mysqli->query($sql);
					
					$mysqli->close();
			
					echo "Beitrag gel&ouml;scht.<br />";
					echo "Sie werden automatisch weitergeleitet.";
					echo "<meta http-equiv=\"refresh\" content=\"3; URL=".$_SERVER['PHP_SELF']."\">";
				}
				else
				{
					echo "
			<form action=\"".$_SERVER['PHP_SELF']."?action=delete&id=".$id."\" method=\"POST\" name=\"delete\">
				<table>
					<tr>
						<td class=\"td2\">Beitrag wirklich l&ouml;schen?</td>
					</tr>
					<tr>
						<td class=\"td2\"><input type=\"submit\" name=\"submit_delete\" value=\"L&ouml;schen\" tabindex=\"1\" /><input type=\"button\" name=\"close\" value=\"Abbrechen\" onclick=\"window.location.href='".$_SERVER['PHP_SELF']."'\" tabindex=\"2\" /></td>
					</tr>
				</table>
			</form>";
				}
			}
			else
			{
				exit("ID ung&uuml;ltig!");
			}
		}
		else
		{
			exit("Seite ung&uuml;ltig!");
		}
	
		include('./footer.php');
	}
	else
	{
		exit("Zutritt verweigert!");
	}
?>