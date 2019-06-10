<?php

  class Model
  {
    protected $conn;

    function __construct($sql)
    {
      $host = $sql->host;
      $db = $sql->db;
      $user = $sql->user;
      $pass = $sql->pass;
      $charset = $sql->charset;
      $driver = $sql->driver;
      $port = $sql->port;

      if($driver == 'mysql')
      {
        $dsn = "$driver:host=$host;dbname=$db;charset=$charset";
        $opt = [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ];

        try
        {
          $this->conn = new PDO($dsn, $user, $pass, $opt);
        }
        catch(PDOException $e)
        {
          throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
      }
      else if($driver == 'pgsql')
      {
        $dsn = "$driver:host=$host;dbname=$db;port=$port;user=$user;password=$pass";

        try
        {
          $this->conn = new PDO($dsn);
        }
        catch(PDOException $e)
        {
          throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
      }
      else
      {
        die('unknown driver');
      }
    }

    function __destruct()
    {
      $this->conn = null;
    }

    function query($sql)
    {
      $result = $this->conn->query($sql);
      return $result;
    }

    function users_in_deps()
    {
      $query = $this->conn->prepare("SELECT * FROM pwd_view");

      $query->execute();

      $result = array();

      while($data = $query->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    function m_in_deps()
    {
      $query = $this->conn->prepare("SELECT * FROM mwd_view");

      $query->execute();

      $result = array();

      while($data = $query->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    /* Users */

    function getAllUsers()
    {
      $sql = "SELECT * FROM pracownicy LEFT JOIN dzialy ON pracownicy.id_dzial=dzialy.id_dzial";
      $statement = $this->conn->query($sql);

      $result = array();

      while($data = $statement->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    function getUser($id)
    {
      $query = $this->conn->prepare("SELECT * FROM pracownicy LEFT JOIN dzialy ON pracownicy.id_dzial=dzialy.id_dzial WHERE pracownicy.id_pracownik=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);

      $query->execute();

      $result = array();

      while($data = $query->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    function addUser($name, $surname, $dep, $type)
    {
      $query = $this->conn->prepare("INSERT INTO pracownicy (imie, nazwisko, id_dzial, menedzer) VALUES (:imie, :nazwisko, :dzial, :menedzer)");

      $query->bindValue('imie', $name, PDO::PARAM_STR);
      $query->bindValue('nazwisko', $surname, PDO::PARAM_STR);
      $query->bindValue('dzial', $dep, PDO::PARAM_INT);
      $query->bindValue('menedzer', $type, PDO::PARAM_BOOL);

      $query->execute();
    }

    function editUser($id, $name, $surname, $dep, $type)
    {
      $query = $this->conn->prepare("UPDATE pracownicy SET imie=:imie, nazwisko=:nazwisko, id_dzial=:dzial, menedzer=:menedzer WHERE id_pracownik=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);
      $query->bindValue('imie', $name, PDO::PARAM_STR);
      $query->bindValue('nazwisko', $surname, PDO::PARAM_STR);
      $query->bindValue('dzial', $dep, PDO::PARAM_INT);
      $query->bindValue('menedzer', $type, PDO::PARAM_BOOL);

      $query->execute();
    }

    function deleteUser($id)
    {
      $query = $this->conn->prepare("DELETE FROM pracownicy WHERE id_pracownik=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);

      $query->execute();
    }

    /* Departments */

    function getAllDepartments()
    {
      $sql = "SELECT * FROM dzialy";
      $statement = $this->conn->query($sql);

      $result = array();

      while($data = $statement->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    function deleteDepartment($id)
    {
      $query = $this->conn->prepare("DELETE FROM dzialy WHERE id_dzial=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);

      $query->execute();
    }

    function addDepartment($name, $audit)
    {
      $query = $this->conn->prepare("INSERT INTO dzialy (nazwa, audyt) VALUES (:nazwa, :audyt)");

      $query->bindValue('nazwa', $name, PDO::PARAM_STR);
      $query->bindValue('audyt', $audit, PDO::PARAM_BOOL);

      $query->execute();
    }

    function getDepartment($id)
    {
      $query = $this->conn->prepare("SELECT * FROM dzialy WHERE id_dzial=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);

      $query->execute();

      $result = array();

      while($data = $query->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    function editDepartment($id, $name, $audit)
    {
      $query = $this->conn->prepare("UPDATE dzialy SET nazwa=:nazwa, audyt=:audyt WHERE id_dzial=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);
      $query->bindValue('nazwa', $name, PDO::PARAM_STR);
      $query->bindValue('audyt', $audit, PDO::PARAM_BOOL);

      $query->execute();
    }

    /* Jobs */

    function addJob($name, $desc, $date, $finished)
    {
      $query = $this->conn->prepare("INSERT INTO zlecenia (nazwa, opis, data, ukonczone) VALUES (:nazwa, :opis, :data, :ukonczone)");

      $query->bindValue('nazwa', $name, PDO::PARAM_STR);
      $query->bindValue('opis', $desc, PDO::PARAM_STR);
      $query->bindValue('data', $date, PDO::PARAM_STR);
      $query->bindValue('ukonczone', $finished, PDO::PARAM_BOOL);

      $query->execute();
    }

    function getAllJobs()
    {
      $sql = "SELECT * FROM zlecenia";
      $statement = $this->conn->query($sql);

      $result = array();

      while($data = $statement->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    function deleteJob($id)
    {
      $query = $this->conn->prepare("DELETE FROM zlecenia WHERE id_zlecenie=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);

      $query->execute();
    }

    function getJob($id)
    {
      $query = $this->conn->prepare("SELECT * FROM zlecenia WHERE id_zlecenie=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);

      $query->execute();

      $result = array();

      while($data = $query->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    function editJob($id, $name, $desc, $date, $finished)
    {
      $query = $this->conn->prepare("UPDATE zlecenia SET nazwa=:nazwa, opis=:opis, data=:data, ukonczone=:ukonczone WHERE id_zlecenie=:id");

      $query->bindValue('id', $id, PDO::PARAM_INT);
      $query->bindValue('nazwa', $name, PDO::PARAM_STR);
      $query->bindValue('opis', $desc, PDO::PARAM_STR);
      $query->bindValue('data', $date, PDO::PARAM_STR);
      $query->bindValue('ukonczone', $finished, PDO::PARAM_BOOL);

      $query->execute();
    }

    function saveJobAssignment($worker, $job)
    {
      $query = $this->conn->prepare("INSERT INTO przydzialy (id_zlecenie, id_pracownik) VALUES (:id_zlecenie, :id_pracownik)");

      $query->bindValue('id_zlecenie', $job, PDO::PARAM_INT);
      $query->bindValue('id_pracownik', $worker, PDO::PARAM_INT);

      $query->execute();
    }

    function getAllAssignments()
    {
      $sql = "SELECT * FROM przydzialy, zlecenia, pracownicy WHERE przydzialy.id_pracownik=pracownicy.id_pracownik AND przydzialy.id_zlecenie=zlecenia.id_zlecenie";
      $statement = $this->conn->query($sql);

      $result = array();

      while($data = $statement->fetch(PDO::FETCH_ASSOC))
      {
        $result[] = $data;
      }

      return $result;
    }

    function deleteAssignment($job, $worker)
    {
      $query = $this->conn->prepare("DELETE FROM przydzialy WHERE id_zlecenie=:id_zlecenie AND id_pracownik=:id_pracownik");

      $query->bindValue('id_zlecenie', $job, PDO::PARAM_INT);
      $query->bindValue('id_pracownik', $worker, PDO::PARAM_INT);

      $query->execute();
    }


  }

?>
