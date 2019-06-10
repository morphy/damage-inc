<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Mateusz Wasik">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/bootstrap/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/pe-icon-7-stroke/css/helper.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/google-fonts/google-fonts.css'); ?>">
    <script src="<?php echo url('assets/chart.js/Chart.min.js'); ?>"></script>
  </head>
  <body class="d-flex flex-column">
    <div class="loader">
      <div class="loader-block">
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
        <span class="loader-cube"></span>
      </div>
    </div>
    <script>

      window.addEventListener('load',function()
      {
        document.querySelector('.loader').classList.add('hidden');
      });

    </script>
    <header>
      <nav class="navbar p-0">
        <a class="navbar-brand m-0" href="<?php echo APP_HOST.APP_DIR; ?>home">Damage Inc.</a>
      </nav>
    </header>
    <article class="flex-grow-1 d-flex">
      <aside class="h-100">
        <div class="sidebar h-100">
          <ul class="nav flex-column">
            <li class="nav-item-header">
              <a class="nav-link">Stona główna</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo url('home'); ?>">
                <i class="pe-7s-home"></i>
                Home
              </a>
            </li>
            <li class="nav-item-header">
              <a class="nav-link">Pracownicy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url('workers/view'); ?>">
                <i class="pe-7s-home"></i>
                Przegląd
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url('workers/add'); ?>">
                <i class="pe-7s-users"></i>
                Dodaj pracownika
              </a>
            </li>
            <li class="nav-item-header">
              <a class="nav-link">Zlecenia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url('jobs/view'); ?>">
                <i class="pe-7s-home"></i>
                Lista zleceń
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url('jobs/add'); ?>">
                <i class="pe-7s-users"></i>
                Dodaj zlecenie
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url('jobs/assign'); ?>">
                <i class="pe-7s-users"></i>
                Przydziel zlecenie
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url('jobs/viewAssignments'); ?>">
                <i class="pe-7s-home"></i>
                Lista Przydziałów
              </a>
            </li>
            <li class="nav-item-header">
              <a class="nav-link">Działy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url('departments/view'); ?>">
                <i class="pe-7s-home"></i>
                Przegląd
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url('departments/add'); ?>">
                <i class="pe-7s-users"></i>
                Dodaj dział
              </a>
            </li>
          </ul>
        </div>
      </aside>
      <section class="flex-grow-1">
        <div class="container-fluid">
          <div class="row">
            <div class="col-6 pt-3">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Pracownicy w działach</h5>
                </div>
                <div class="card-body">
                  <canvas id="pie"></canvas>
                  <script>

                    var ctx = document.getElementById('pie').getContext('2d');
                    var config = {
                			type: 'bar',
                			data: {
                				datasets: [{
                					data: [
                            <?php

                              foreach($data['users-in-deps'] as $row)
                              {
                                echo $row['count'].',';
                              }

                            ?>
                					],
                					backgroundColor: '#002857',
                          borderWidth: 1,
                          borderColor: '#004282',
                					label: 'Ilość pracowników w dziale'
                				}],
                				labels: [
                          <?php

                            foreach($data['users-in-deps'] as $row)
                            {
                              echo '\''.$row['nazwa'].'\',';
                            }

                          ?>
                				]
                			},
                			options:
                      {
                				responsive: true,
                        scales:
                        {
                          yAxes: [{
                            ticks: {
                              beginAtZero: true,
                              fontColor: '#fff'
                            }
                          }],
                          xAxes: [{
                            ticks: {
                              fontColor: '#fff'
                            }
                          }]
                        }
                			}
                		};

                    var myPieChart = new Chart(ctx, config);

                  </script>
                </div>
              </div>
            </div>
            <div class="col-6 pt-3">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Menedżerowie w działach</h5>
                </div>
                <div class="card-body">
                  <canvas id="pie2"></canvas>
                  <script>

                    var ctx = document.getElementById('pie2').getContext('2d');
                    var config = {
                			type: 'pie',
                			data: {
                				datasets: [{
                					data: [
                            <?php

                              foreach($data['m-in-deps'] as $row)
                              {
                                echo $row['count'].',';
                              }

                            ?>
                					],
                					backgroundColor: '#002857',
                          borderWidth: 1,
                          borderColor: '#004282',
                					label: 'Ilość menedżerów w dziale'
                				}],
                				labels: [
                          <?php

                            foreach($data['m-in-deps'] as $row)
                            {
                              echo '\''.$row['nazwa'].'\',';
                            }

                          ?>
                				]
                			},
                			options:
                      {
                				responsive: true
                			}
                		};

                    var myPieChart = new Chart(ctx, config);

                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </article>
  </body>
</html>
