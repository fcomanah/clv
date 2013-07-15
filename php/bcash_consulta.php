<?php
  function print_iterative($obj)
  {
    foreach($obj as $key1 => $arr1)
    {
	  echo $key1.'</br>';
      foreach($arr1 as $key2 => $arr2)
      {
		if(!is_array($arr2))
		{
		  echo $key2.': '.$arr2 .'</br>';
	    }
        foreach($arr2 as $key3 => $arr3)
        {
	      echo $key3.'</br>';
          foreach($arr3 as $key4 => $arr4)
          {
             if(!is_array($arr4))
		     {
		      echo $key4.': '.$arr4 .'</br>';
	         }
		  }
	    }
	  }
	}
  }
  
  function print_recursive($obj,$key)
  {
	  if(is_array($obj))
	  {
	    if($key) echo $key.'<br>';
        foreach($obj as $key => $arr)
        {
		  print_recursive($arr,$key);
	    }
	  }
	  else
	  {
         echo $key.': '.$obj .'</br>';
	  }
  }
  
  $email = 'manaphys@gmail.com';
  $token = 'F878CC6FE37BA15012A9B42E1D7BDA78';  
 
  $urlPost = 'https://www.pagamentodigital.com.br/transacao/consulta/'; 
  $transacaoId = $_GET['id_transacao'];
  $pedidoId = $_GET['id_pedido']; 
  $tipoRetorno = '2'; 
  $codificacao = '1'; 
 
  ob_start(); 
    $ch = curl_init(); 
      curl_setopt($ch, CURLOPT_URL, $urlPost); 
      curl_setopt($ch, CURLOPT_POST, 1); 
      curl_setopt($ch, CURLOPT_POSTFIELDS,array('id_transacao'=>$transacaoId, 'id_pedido'=>$pedidoId,'tipo_retorno'=>$tipoRetorno,'codificacao'=>$codificacao)); 
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($email.':'.$token))); 
    curl_exec($ch); 
    $json = ob_get_contents(); 
  ob_end_clean(); 
  

  /* Capturando o http code para tratamento dos erros na requisição*/  
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
  curl_close($ch); 


  if($httpCode != '200')
  { 
    switch ($httpCode) 
    {
      case 400:
        echo 'Requisição com parâmetros obrigatórios vazios ou inválidos';
        break;
      case 401:
        echo 'Falha na autenticação ou sem acesso para usar o serviço';
        break;
      case 405:
        echo 'Método não permitido, o serviço suporta apenas POST';
        break;
      case 500:
        echo 'Erro fatal na aplicação, executar a solicitação mais tarde';
        break;
    }
  }
  else
  {
    $obj = json_decode($json,true);
    print_recursive($obj);
  } 

?>
