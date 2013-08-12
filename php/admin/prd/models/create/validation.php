<?
	// Check for a product name:
	if(isset($_POST['nme']))
	{
	  if (preg_match ('/^[0-9A-Záâãéêíóôúç," \'.-]{2,100}$/i', $_POST['nme'])) {
		$nme = mysqli_real_escape_string ($dbc, $_POST['nme']);
	  } else {
		$reg_errors['nme'] = 'Por favor, entre com o nome do produto!';
      }
    }

	if(isset($_POST['prc']))
	{
	  if (preg_match ('/^[.0-9]{1,30}$/i', $_POST['prc'])) {
		$prc = mysqli_real_escape_string ($dbc, $_POST['prc']);
	  } else {
		$reg_errors['prc'] = 'Por favor, entre com o preço do produto!';
      }
    }
    
	if(isset($_POST['dsc']))
	{
      if (!empty($_POST['dsc']))
      {
        $dsc = mysqli_real_escape_string ($dbc, $_POST['dsc']);
      } 
      else 
      {
	    $reg_errors['dsc'] = 'Por favor, entre com a descrição do produto!';
      }
    }

    
	if(isset($_POST['ctg']))
	{
      if (!empty($_POST['ctg']))
      {
        $ctg = mysqli_real_escape_string ($dbc, $_POST['ctg']);
      }
      else
      {
        $reg_errors['ctg'] = 'Por favor, entre com a categoria do produto!';
      }
    }
    
	if(isset($_POST['stq']))
	{
	  if (preg_match ('/^[.0-9]{1,30}$/i', $_POST['stq'])) {
		$stq = mysqli_real_escape_string ($dbc, $_POST['stq']);
	  } else {
		$reg_errors['stq'] = 'Por favor, entre com a quantidade em estoque do produto!';
      }
    }
    
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if (!empty($_FILES['img']['name'])) 
{

  // Pasta onde o arquivo vai ser salvo
  $_UP['pasta'] = '../../../uploads/';

  // Tamanho máximo do arquivo (em Bytes)
  $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

  // Array com as extensões permitidas
  $_UP['extensoes'] = array('jpg', 'png', 'gif');

  // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
  $_UP['renomeia'] = true;

  // Array com os tipos de erros de upload do PHP
  $_UP['erros'][0] = 'Não houve erro';
  $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
  $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
  $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
  $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

  
  // Faz a verificação da extensão do arquivo
  $tmp = explode('.', $_FILES['img']['name']);
  $extensao = strtolower(end($tmp));
  if (array_search($extensao, $_UP['extensoes']) === false) 
  {
    $reg_errors['img'] = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
  }

  // Faz a verificação do tamanho do arquivo
  else if ($_UP['tamanho'] < $_FILES['img']['size']) 
  {
    $reg_errors['img'] = "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
  }

  // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
  else 
  {
    // Primeiro verifica se deve trocar o nome do arquivo
    if ($_UP['renomeia'] == true) 
    {
      // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
      $nome_final = time().'.'.$extensao;
    } 
    else 
    {
      // Mantém o nome original do arquivo
      $nome_final = $_FILES['img']['name'];
    }

    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($_FILES['img']['tmp_name'], $_UP['pasta'] . $nome_final)) 
    {
      // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
      //echo "Upload efetuado com sucesso!";
      //echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
      $img = 'uploads/'.$nome_final;
    } 
    else 
    {
      // Não foi possível fazer o upload, provavelmente a pasta está incorreta
      $reg_errors['img'] = "Não foi possível enviar o arquivo, tente novamente";
    }

  }  
}
else
{
  $reg_errors['img'] = 'Por favor, entre com a imagem do produto!';
}



        
