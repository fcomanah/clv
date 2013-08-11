<?php
  if ($display_right_panel)
  {
    $right_content = array();
    $right  =array();
    
    $right['nme']="Atualizar Usuário";
    $right['href']="../usr/create.php";
    array_push($right_content, $right);
    
    $right['nme']="Remover Produto";
    $right['href']="../prd/update.php";
    array_push($right_content, $right);
    
    $right['nme']="Consultar Transação";
    $right['href']="../trs/read.php";
    array_push($right_content, $right);
    
    include('./views/right.html');
  }
