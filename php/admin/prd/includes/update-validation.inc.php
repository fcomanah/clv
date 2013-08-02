<?
	// Check for a product name:
	if($_POST['nme'] != '')
	{
	if (preg_match ('/^[A-Záâãéêíóôúç -0-9]{2,30}$/i', $_POST['nme'])) {
		$n = mysqli_real_escape_string ($dbc, $_POST['nme']);
	} else {
		$reg_errors['nme'] = 'Por favor, entre com o nome de usuário!';
	}
   }