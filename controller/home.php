<?php

  require('controller.php');

  class ControllerHome extends Controller
  {
    function show($a)
    {
      $data['title'] = 'Home';
      $data['users-in-deps'] = $this->model->users_in_deps();
      $data['m-in-deps'] = $this->model->m_in_deps();

      require('view/home.php');
    }
  }

?>
