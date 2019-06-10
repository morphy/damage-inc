<?php

  function redirect($url)
  {
    header('location: '.$url);
  }

  function url($u)
  {
    if(HTACCESS == true)
    {
      return APP_HOST.APP_DIR.$u;
    }
    else
    {
      return 'wip';
    }
  }

?>
