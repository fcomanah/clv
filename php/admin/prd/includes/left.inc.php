<?php
  if ($display_left_panel)
  {
    $left_content = array();
    $row = array();
    $row['href']='../';
    $row['nme']='admin';
    array_push($left_content, $row);
  	 include('./views/left.html');
  }
