<?php

  define('APP_HOST', 'http://localhost/');
  define('APP_DIR', 'damage-inc/');
  define('HTACCESS', true);

  require_once('sql.php');
  require_once('model/model.php');
  require_once('functions.php');

  $url = $_SERVER['REQUEST_URI'];
  $url = trim($url, '/');
  $pref = trim(APP_DIR, '/');

  if(substr($url, 0, strlen($pref)) == $pref)
  {
    $url = substr($url, strlen($pref));
  }

  $explode_url = explode('/', trim($url, '/'));

  if((count($explode_url) == 0) or (count($explode_url) == 1))
  {
    $controller = 'home';
    $action = 'show';
    $value = '0';
  }
  else if(count($explode_url) == 2)
  {
    $controller = $explode_url[0];
    $action = $explode_url[1];
    $value = '0';
  }
  else if(count($explode_url) == 3)
  {
    $controller = $explode_url[0];
    $action = $explode_url[1];
    $value = $explode_url[2];
  }
  else
  {
    die('nie baw sie no');
  }

  if(is_file('controller/'.$controller.'.php'))
  {
    require('controller/'.$controller.'.php');
    $c_name = 'Controller'.$controller;
    $c = new $c_name(new Model($sql));

    if(method_exists($c, $action))
    {
      $c->$action($value);
    }
    else
    {
      $controller = 'home';
      $action = 'show';
      $value = '0';
    }
  }
  else
  {
    $controller = 'home';
    $action = 'show';
    $value = '0';
  }

?>
