<?php
  function echo_title($page_title) 
  {
    if (isset($page_title)) 
    { 
      echo $page_title; 
    } 
    else 
    { 
      echo 'Construindo Lojas Virtuais'; 
    } 
  }
