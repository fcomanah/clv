<?
	if(isset($_POST['status']))
	{
      if (!empty($_POST['status']))
      {
        $status = mysqli_real_escape_string ($dbc, $_POST['status']);
      }
      else
      {
        $reg_errors['status'] = 'Por favor, entre com o status da transação!';
      }
    }
