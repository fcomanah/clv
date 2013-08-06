<?
	// Check for a first name:
   if ($_POST['first_name'] != '')
	{
	if (preg_match ('/^[A-Záâãéêíóôúç\'.-]{2,20}$/i', $_POST['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $_POST['first_name']);
	} else {
		$reg_errors['first_name'] = 'Please enter your first name!';
	}
   }
	
	// Check for a last name:
	if ($_POST['last_name'] != '')
	{
	if (preg_match ('/^[A-Záâãéêíóôúç\'.- ]{2,40}$/i', $_POST['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $_POST['last_name']);
	} else {
		$reg_errors['last_name'] = 'Please enter your last name!';
	}
   }
	
	// Check for a password and match against the confirmed password:
	if ($_POST['pass1'] != '')
	{
	if (preg_match ('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z)])\w*){6,20}$/', $_POST['pass1']) ) {
		if ($_POST['pass1'] == $_POST['pass2']) {
			$p = mysqli_real_escape_string ($dbc, $_POST['pass1']);
		} else {
			$reg_errors['pass2'] = 'As senhas não conferem!';
		}
	} else {
		$reg_errors['pass1'] = 'Por favor, entre com uma senha válida!';
	}
   }
