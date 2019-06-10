<?php

  require('controller.php');

  class ControllerJobs extends Controller
  {
    function view()
    {
      $data['title'] = 'Zlecenia';
      $data['jobs'] = $this->model->getAllJobs();

      require('view/jobsView.php');
    }

    function add()
    {
      $data['title'] = 'Dodaj zlecenie';

      require('view/jobsAdd.php');
    }

    function save()
    {
      $name = $_POST['nazwa'];
      $desc = $_POST['opis'];
      $date = $_POST['data'];
      $finished = $_POST['ukonczone'];

      $this->model->addJob($name, $desc, $date, $finished);

      redirect(url('jobs/view'));
    }

    function delete($id)
    {
      $this->model->deleteJob($id);

      redirect(url('jobs/view'));
    }

    function edit($id)
    {
      $data['title'] = 'Edytuj zlecenie';
      $data['job'] = $this->model->getJob($id);

      require('view/jobsEdit.php');
    }

    function saveEdit($id)
    {
      $name = $_POST['nazwa'];
      $desc = $_POST['opis'];
      $date = $_POST['data'];
      $finished = $_POST['ukonczone'];

      $this->model->editJob($id, $name, $desc, $date, $finished);

      redirect(url('jobs/view'));
    }

    function assign()
    {
      $data['title'] = 'Przydziel zlecenie';
      $data['workers'] = $this->model->getAllUsers();
      $data['jobs'] = $this->model->getAllJobs();

      require('view/jobsAssign.php');
    }

    function saveAssignment()
    {
      $worker = $_POST['pracownik'];
      $job = $_POST['zlecenie'];

      $this->model->saveJobAssignment($worker, $job);

      redirect(url('jobs/viewAssignments'));
    }

    function viewAssignments()
    {
      $data['title'] = 'Lista przydziałów';
      $data['assignments'] = $this->model->getAllAssignments();

      require('view/jobsViewAssignments.php');
    }

    function deleteAssignment($id)
    {
      $explode_id = explode('-', $id);
      $job = $explode_id[0];
      $worker = $explode_id[1];

      $this->model->deleteAssignment($job, $worker);

      redirect(url('jobs/viewAssignments'));
    }
  }

?>
