function chkAdd()
{
	/* Ueberpruefen des Betreff-Feldes auf Inhalt */
	if(document.add.subject.value == '')
	{
		alert("Bitte einen Betreff eingeben!");
		document.add.subject.focus();
		return false;
	}
				
	/* Ueberpruefen des Nachrichten-Feldes auf Inhalt */
	if(document.add.entrie.value == '')
	{
		alert("Bitte eine Nachricht hinterlassen!");
		document.add.entrie.focus();
		return false;
	}
}
			
function chkLogin()
{
	/* Ueberpruefen des Benutzernamen-Feledes auf Inhalt */
	if(document.login.username.value == '')
	{
		alert("Bitte einen Benutzernamen eintragen!");
		document.login.username.focus();
		return false;
	}
				
	/* Ueberpruefen des Passwort-Feledes auf Inhalt */
	if(document.login.password.value == '')
	{
		alert("Bitte ein Password eingeben!");
		document.login.password.focus();
		return false;
	}
}

function chkInstall()
{
	/* Ueberpruefen des Benutzernamen-Feledes auf Inhalt */
	if(document.install.username.value == '')
	{
		alert("Bitte einen Benutzernamen eintragen!");
		document.install.username.focus();
		return false;
	}
				
	/* Ueberpruefen des Passwort-Feledes auf Inhalt */
	if(document.install.password.value == '')
	{
		alert("Bitte ein Password eingeben!");
		document.install.password.focus();
		return false;
	}
}

function chkPW()
{
	/* Ueberpruefen des Benutzernamen-Feledes auf Inhalt */
	if(document.password.old_password.value == '')
	{
		alert("Bitte das alte Passwort eintragen!");
		document.password.old_password.focus();
		return false;
	}
				
	/* Ueberpruefen des Passwort-Feledes auf Inhalt */
	if(document.password.new_password_1.value == '')
	{
		alert("Bitte ein neues Password eingeben!");
		document.install.new_password_1.focus();
		return false;
	}
	
	/* Ueberpruefen des Passwort-Feledes auf Inhalt */
	if(document.password.new_password_2.value == '')
	{
		alert("Bitte das neue Password wiederholen!");
		document.install.new_password_2.focus();
		return false;
	}
}