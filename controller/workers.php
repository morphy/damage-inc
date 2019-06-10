<?php

  require('controller.php');

  class ControllerWorkers extends Controller
  {
    function view()
    {
      $users = $this->model->getAllUsers();

      $data['title'] = 'Pracownicy';
      $data['users'] = $users;

      require('view/workersView.php');
    }

    function add()
    {
      $data['title'] = 'Dodaj pracownika';
      $data['deps'] = $this->model->getAllDepartments();

      require('view/workersAdd.php');
    }

    function save()
    {
      $name = $_POST['imie'];
      $surname = $_POST['nazwisko'];
      $dep = $_POST['dzial'];
      $type = $_POST['rodzaj'];

      $this->model->addUser($name, $surname, $dep, $type);

      redirect(url('workers/view'));
    }

    function saveEdit($id)
    {
      $name = $_POST['imie'];
      $surname = $_POST['nazwisko'];
      $dep = $_POST['dzial'];
      $type = $_POST['rodzaj'];

      $this->model->editUser($id, $name, $surname, $dep, $type);

      redirect(url('workers/view'));
    }

    function delete($id)
    {
      $this->model->deleteUser($id);

      redirect(url('workers/view'));
    }

    function edit($id)
    {
      $data['title'] = 'Edytuj pracownika';
      $data['user'] = $this->model->getUser($id);
      $data['deps'] = $this->model->getAllDepartments();

      require('view/workersEdit.php');
    }
  }

?>
