<?php
  // Obtenha seu TOKEN entrando no menu Ferramentas do Bcash
  $token = 'F878CC6FE37BA15012A9B42E1D7BDA78';

  /* Montando as variáveis de retorno */
  $id_transacao = $_POST['id_transacao'];
  $data_transacao = $_POST['data_transacao'];
  $data_credito = $_POST['data_credito'];
  $valor_original = $_POST['valor_original'];
  $valor_loja = $_POST['valor_loja'];
  $valor_total = $_POST['valor_total'];
  $desconto = $_POST['desconto'];
  $acrescimo = $_POST['acrescimo'];
  $tipo_pagamento = $_POST['tipo_pagamento'];
  $parcelas = $_POST['parcelas'];
  $cliente_nome = $_POST['cliente_nome'];
  $cliente_email = $_POST['cliente_email'];
  $cliente_rg = $_POST['cliente_rg'];
  $cliente_data_emissao_rg = $_POST['cliente_data_emissao_rg'];
  $cliente_orgao_emissor_rg = $_POST['cliente_orgao_emissor_rg'];
  $cliente_estado_emissor_rg = $_POST['cliente_estado_emissor_rg'];
  $cliente_cpf = $_POST['cliente_cpf'];
  $cliente_sexo = $_POST['cliente_sexo'];
  $cliente_data_nascimento = $_POST['cliente_data_nascimento'];
  $cliente_endereco = $_POST['cliente_endereco'];
  $cliente_complemento = $_POST['cliente_complemento'];
  $cliente_telefone = $_POST['cliente_telefone'];
  $status = $_POST['status'];
  $cod_status = $_POST['cod_status'];
  $cliente_bairro = $_POST['cliente_bairro'];
  $cliente_cidade = $_POST['cliente_cidade'];
  $cliente_estado = $_POST['cliente_estado'];
  $cliente_cep = $_POST['cliente_cep'];
  $frete = $_POST['frete'];
  $tipo_frete = $_POST['tipo_frete'];
  $informacoes_loja = $_POST['informacoes_loja'];
  $id_pedido = $_POST['id_pedido'];
  $free = $_POST['free'];

  /* Essa variável indica a quantidade de produtos retornados */
  $qtde_produtos = $_POST['qtde_produtos'];

  /* Verificando ID da transação */
  /* Verificando status da transação */
  /* Verificando valor original */
  /* Verificando valor da loja */
  $post = "transacao=$id_transacao" . "&status=$status" . "&cod_status=$cod_status" . "&valor_original=$valor_original" . "&valor_loja=$valor_loja" . "&token=$token";
  $enderecoPost = "https://www.bcash.com.br/checkout/verify/";

  ob_start();
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $enderecoPost);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_exec ($ch);
  $resposta = ob_get_contents();
  ob_end_clean();

  if(trim($resposta)=="VERIFICADO")
  {
    for ($x=1; $x <= $qtde_produtos; $x++) 
    {
      $produto_codigo = $_POST['produto_codigo_'.$x];
      $produto_descricao = $_POST['produto_descricao_'.$x];
      $produto_qtde = $_POST['produto_qtde_'.$x];
      $produto_valor = $_POST['produto_valor_'.$x];
      $produto_extra = $_POST['produto_extra_'.$x];
    }
  }

  $url = 'Location: ../index.php?id_transacao='.$id_transacao;
  header($url);
?>
