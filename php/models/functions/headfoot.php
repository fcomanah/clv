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

  function echo_button($display, $href, $data_icon, $name) 
  {
    if ($display)
    {
      echo '<a data-iconpos="notext" href="#' . $href . '" data-role="button" data-icon="' . $data_icon . '">' . $name . '</a>';
    }
    else
    {
      echo '<a></a>';
    }
  }
