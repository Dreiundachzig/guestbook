<?php
	if(!defined('_ISLOADED'))
	{
		exit("Kein Direktzugriff erlaubt!");
	}
	
	$title = "&Uuml;bersicht";
	
	include('./head.php');
	
	echo "
	<body>
		<div class=\"row\">
		<div class=\"span12 offset2\">
		<div class=\"well container-fluid\">";

	$page = isset($_GET['page'])?(int)$_GET['page']:1;
	
	$per_page = 10;
	
	$start = ($page*$per_page)-$per_page;
	
	$mysqli = mysqli_open();
	
	$sql_count = "SELECT * FROM entries ORDER BY date DESC";
	
	$count_query = $mysqli->query($sql_count);
	
	$anzahl_eintraege = $count_query->num_rows;
	
	$sql_entries = "SELECT * FROM entries ORDER BY date DESC LIMIT ".$start.", ".$per_page;
	
	$daten_query = $mysqli->query($sql_entries);
	
	if($anzahl_eintraege > 0)
	{
		$num_pages = ceil($anzahl_eintraege/$per_page);
		
		if($page < 1)
		{
			$page = 1;
		}
		if($page > $num_pages)
		{
			$page = $num_pages;
		}
	}
	
	echo "
			<p><input type=\"button\" class=\"btn\" name=\"neu\" value=\"Neuer Eintrag\" onclick=\"window.location.href='?action=add'\" />";
	if(isset($_SESSION['login']) && ($_SESSION['login'] == true))
	{
		echo "
			<input type=\"button\" class=\"btn\" name=\"password\" value=\"Passwort &auml;ndern\" onclick=\"window.location.href='?action=password'\" /><input type=\"button\" name=\"logout\" value=\"Logout\" onclick=\"window.location.href='?action=logout'\" /><br /></p>";
	}
	else
	{
		echo "
			<input type=\"button\" class=\"btn\" name=\"login\" value=\"Administration\" onclick=\"window.location.href='?action=login'\" /></p>";
	}
	if($anzahl_eintraege == 0)
	{
		echo "
			<p>Keine Eintr&auml;ge vorhanden!</p>";
	}
	else
	{
		
		if($num_pages > 1)
		{
			if($page > 1)
			{
				echo "<a href=\"?page=".($page-1)."\">&lt;</a> ";
			}
			for($i = 1; $i <= $num_pages; $i++)
			{
				if($i == $page)
				{
					echo $i." ";
				}
				else
				{
					echo "<a href=\"?page=".$i."\">".$i."</a> ";
				}
			}
			if($page < $num_pages)
			{
				echo " <a href=\"?page=".($page+1)."\">&gt;</a>";
			}
		}
		
		while($daten = $daten_query->fetch_assoc())
		{
			$date = "SELECT DATE_FORMAT(date, '%d.%m.%Y %H:%i:%s') as newdate FROM entries WHERE ID=".$daten['id'];
			
			$datum_query = $mysqli->query($date);
		
			$date = $datum_query->fetch_assoc();
			
			$date = explode(' ', $date['newdate']);
		
			echo "
			<fieldset>
				<legend>#".$daten['id']." verfasst am ".$date[0]." um ".$date[1]."</legend>
				<table class=\"t1\">
					<tr>
						<td class=\"td1\">Name:</td>
						<td>".$daten['name']."</td>
					</tr>
					<tr>
						<td class=\"td1\">Betreff:</td>
						<td>".$daten['subject']."</td>
					</tr>
					<tr>
						<td class=\"td1\">Nachricht:</td>
						<td>".$daten['entrie']."</td>
					</tr>";
			if(isset($_SESSION['login']) && ($_SESSION['login'] == true))
			{
				echo "
					<tr>
						<td colspan=\"2\">&nbsp;</td>
					</tr>
					<tr>
						<td colspan=\"2\"><a href=\"?action=delete&id=".$daten['id']."\">Beitrag L&ouml;schen</a></td>
					</tr>";
			}
			echo "
				</table>
			</fieldset>
			<p>";
		}
		if($num_pages > 1)
		{
			if($page > 1)
			{
				echo "<a href=\"?page=".($page-1)."\">&lt;</a> ";
			}
			for($i = 1; $i <= $num_pages; $i++)
			{
				if($i == $page)
				{
					echo $i." ";
				}
				else
				{
					echo "<a href=\"?page=".$i."\">".$i."</a> ";
				}
			}
			if($page < $num_pages)
			{
				echo " <a href=\"?page=".($page+1)."\">&gt;</a>";
			}
		}
		
		$mysqli->close();
	}
	
	echo "</p>
	</div>
	</div>
	</div>";
	
	include('./footer.php');
?>