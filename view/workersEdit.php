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
    <header>
      <nav class="navbar p-0">
        <a class="navbar-brand m-0" href="<?php echo url('home'); ?>">Damage Inc.</a>
      </nav>
    </header>
    <article class="flex-grow-1 d-flex">
      <aside class="h-100">
        <div class="sidebar h-100">
          <ul class="nav flex-column">
            <li class="nav-item-header">
              <a class="nav-link">Stona główna</a>
            </li>
            <li class="nav-item">
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
            <li class="nav-item active">
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
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Edytuj pracownika</h5>
                </div>
                <div class="card-body">
                  <form action="<?php echo url('workers/saveEdit/'.$data['user'][0]['id_pracownik']);?>" method="post">
                    <div class="form-group">
                      <label for="imie">Imię</label>
                      <input type="text" maxlength="20" class="form-control" id="imie" placeholder="Imię" name="imie" required value="<?php echo $data['user'][0]['imie']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="nazwisko">Nazwisko</label>
                      <input type="text" maxlength="40" class="form-control" id="nazwisko" placeholder="Nazwisko" name="nazwisko" required value="<?php echo $data['user'][0]['nazwisko']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="dzial">Dział</label>
                      <select class="form-control" id="dzial" name="dzial">
                        <?php foreach($data['deps'] as $row): ?>
                          <option <?php if($row['id_dzial'] == $data['user'][0]['id_dzial']) echo 'selected'; ?> value="<?php echo $row['id_dzial']; ?>"><?php echo $row['nazwa']; ?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-radio">
                        <input type="radio" id="normal" name="rodzaj" class="custom-control-input" value="0" <?php if($data['user'][0]['menedzer'] == 0) echo 'checked'; ?>>
                        <label class="custom-control-label" for="normal">Zwykły pracownik</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="manager" name="rodzaj" class="custom-control-input" value="1" <?php if($data['user'][0]['menedzer'] == 1) echo 'checked'; ?>>
                        <label class="custom-control-label" for="manager">Menedżer</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary" type="submit">Zapisz</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </article>
  </body>
</html>
