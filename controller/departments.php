<?php

  require('controller.php');

  class ControllerDepartments extends Controller
  {
    function view()
    {
      $data['title'] = 'Działy';
      $data['deps'] = $this->model->getAllDepartments();

      require('view/departmentsView.php');
    }

    function delete($id)
    {
      $this->model->deleteDepartment($id);

      redirect(url('departments/view'));
    }

    function add()
    {
      $data['title'] = 'Dodaj dział';

      require('view/departmentsAdd.php');
    }

    function save()
    {
      $name = $_POST['nazwa'];
      $audit = $_POST['audyt'];

      $this->model->addDepartment($name, $audit);

      redirect(url('departments/view'));
    }

    function edit($id)
    {
      $data['title'] = 'Edytuj dział';
      $data['dep'] = $this->model->getDepartment($id);

      require('view/departmentsEdit.php');
    }

    function saveEdit($id)
    {
      $name = $_POST['nazwa'];
      $audit = $_POST['audyt'];

      $this->model->editDepartment($id, $name, $audit);

      redirect(url('departments/view'));
    }
  }

?>
