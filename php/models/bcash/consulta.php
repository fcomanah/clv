<?
  function get_iterative($obj)
  {
    $str = '';

    foreach($obj as $key1 => $arr1)
    {
      $str .= $key1.'</br>';
      foreach($arr1 as $key2 => $arr2)
      {
		if(!is_array($arr2))
		{
		  $str .= $key2.': '.$arr2 .'</br>';
	    }
        foreach($arr2 as $key3 => $arr3)
        {
	      $str .= $key3.'</br>';
          foreach($arr3 as $key4 => $arr4)
          {
             if(!is_array($arr4))
		     {
		      $str .= $key4.': '.$arr4 .'</br>';
	         }
		  }
	    }
	  }
   }
   return $str;
  }

  function get_recursive($obj, $key, &$str)
  {
	  if(is_array($obj))
	  {
	    if($key)  $str .= $key.'</br>';
            foreach($obj as $key => $arr)
            {
	       get_recursive($arr, $key, $str);
	    }
	  }
	  else
	  {
            $str .= $key.': '.$obj .'</br>';
	  }	  
  }


  function echo_iterative($obj)
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
  
  function echo_recursive($obj,$key)
  {
	  if(is_array($obj))
	  {
	    if($key) echo $key.'</br>';
            foreach($obj as $key => $arr)
            {
	       echo_recursive($arr,$key);
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
  $pedidoId = ''; //$_GET['id_pedido']; 
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
  	/*
    echo '<pre>';
      echo '$json is ';
      if(!is_array($json)) echo 'not ';
      echo 'an array:</br>';
      var_dump($json);
    echo '</pre>';
    */
    
    $obj = json_decode($json,true);
    
    /*
    echo '<pre>';
      echo '$obj is ';
      if(!is_array($obj)) echo 'not ';
      echo 'an array:</br>';
      var_dump($obj);
    echo '</pre>';
    exit();
    */
    
    //echo_iterative($obj);
   
    //echo_recursive($obj, '');
    
    //echo get_iterative($obj);
    
    //get_recursive($obj, '', $str);
    //echo $str;

    /*
    echo $obj['transacao']['data_transacao'];
    echo '</br>';    
    echo $obj['transacao']['id_transacao'];
    echo '</br>';
    echo $obj['transacao']['status'];
    echo '</br></br>';
    
    $i=0;
    while(isset($obj['transacao']['pedidos'][$i]['nome_produto']))
    {
      echo $obj['transacao']['pedidos'][$i]['nome_produto'];
      echo '</br>';
      echo $obj['transacao']['pedidos'][$i]['qtde'];
      echo '</br>';
      echo $obj['transacao']['pedidos'][$i]['valor_total'];
      echo '</br></br>';
      ++$i;
    }
    */
    
    $trs = array();

    $trs['data_transacao'] = $obj['transacao']['data_transacao'];
    $trs['id_transacao'] = $obj['transacao']['id_transacao'];
    $trs['status'] = $obj['transacao']['status'];
    
    $i=0;
    while(isset($obj['transacao']['pedidos'][$i]['nome_produto']))
    {
      $trs[$i]['codigo_produto'] = $obj['transacao']['pedidos'][$i]['codigo_produto'];
      $trs[$i]['nome_produto'] = $obj['transacao']['pedidos'][$i]['nome_produto'];
      $trs[$i]['qtde'] = $obj['transacao']['pedidos'][$i]['qtde'];
      $trs[$i]['valor_total'] = $obj['transacao']['pedidos'][$i]['valor_total'];
      ++$i;
    }
    $trs['qtd_prds'] = $i;
    
    /*    
    echo '<pre>';
      echo '$trs is ';
      if(!is_array($trs)) echo 'not ';
      echo 'an array:</br>';
      var_dump($trs);
    echo '</pre>';
    */
    
  } 
?>
