<?php

  abstract class Controller
  {
    public $model;

    function __construct($model)
    {
      $this->model = $model;
    }

    function __destruct()
    {
      $this->model = null;
    }
  }

?>
