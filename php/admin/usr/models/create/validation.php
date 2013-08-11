<?
	// Check for a username:
	if(isset($_POST['nme']))
	{
	if (preg_match ('/^[A-Z0-9]{2,30}$/i', $_POST['nme'])) {
		$u = mysqli_real_escape_string ($dbc, $_POST['nme']);
	} else {
		$reg_errors['nme'] = 'Por favor, entre com o nome de usuário!';
	}
   }
	
	// Check for an email address:
	if(isset($_POST['email']))
	{
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $_POST['email']);
	} else {
		$reg_errors['email'] = 'Por favor, digite um email válido!';
	}
   }

	// Check for a password and match against the confirmed password:
	if(isset($_POST['pass1'])&&isset($_POST['pass2']))
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