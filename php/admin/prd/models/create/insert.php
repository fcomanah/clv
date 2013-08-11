<?
  require(DBC);
 
  $q = "SELECT email, nme FROM usr WHERE email='$e' OR nme='$u'";
  $r = mysqli_query ($dbc, $q);

  $rows = mysqli_num_rows($r);
	
  if ($rows == 0) 
  {
    $q = "INSERT INTO usr (nme, email, pass, date_expires) VALUES ('$u', '$e', '"  .  get_password_hash($p) .  "', ADDDATE(NOW(), INTERVAL 1 MONTH) )";
    $r = mysqli_query ($dbc, $q);

    if (mysqli_affected_rows($dbc) == 1)
    { 
      $string = 'Location: read.php?id=';
      $string .= mysqli_insert_id($dbc);
      $string .= '&hgm=Create executado com sucesso!';
      header($string);
      exit();
    }
    else
    { 
      $string = 'Location: read.php?id=';
      $string .= mysqli_insert_id($dbc);
      $string .= '&hgm=Não foi possível o registro por conta de uma falha no sistema.';
      header($string);
      exit();
    }
  } 
  else 
  { 
    if ($rows == 2)
    {
      $reg_errors['email'] = 'Esse email já foi registrado.';			
      $reg_errors['nme'] = 'Esse nome de usuário já existe. Tente outro.';			
    }
    else 
    {
      $row = mysqli_fetch_array($r, MYSQLI_NUM);
				
      if( ($row[0] == $_POST['email']) && ($row[1] == $_POST['nme'])) 
      {
        $reg_errors['email'] = 'Esse email já foi registrado.';	
        $reg_errors['nme'] = 'Esse nome de usuário já existe. Tente outro.';
      }
      elseif ($row[0] == $_POST['email']) 
      {
        $reg_errors['email'] = 'Esse email já foi registrado.';
      } 
      elseif ($row[1] == $_POST['nme']) 
      {
        $reg_errors['nme'] = 'Esse nome de usuário já existe. Tente outro.';
      }			
    }		
  } 
