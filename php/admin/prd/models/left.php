<?php
  if ($display_left_panel)
  {
    $left_content = array();
    $left  =array();
    
    $left['nme']="Usuários";
    $left['href']="../usr/";
    array_push($left_content, $left);
    
    $left['nme']="Produtos";
    $left['href']="../prd/";
    array_push($left_content, $left);
    
    $left['nme']="Transações";
    $left['href']="../trs/";
    array_push($left_content, $left);
    
    include('./views/left.html');
  }
