<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "connect.php";
    include 'functions.php';
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smoelenboek</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/themify-icons/css/themify-icons.css">


  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" type="text/css">
  <style>
    body {
      padding-top: 10%;
    }
    table{
      border-top-width: 0px;
    }
    #inloggen {
      border-color: #5cb85c;
      background-color: #5cb85c;
    }
    .row-buffer-5{
      padding: 5px;
    }
  </style>
</head>
<body>
    <?php
      $errors = 0;
      if(empty($_POST) === false){
        $username = $_POST['gebruikersnaam'];
        $password = $_POST['wachtwoord'];
        $result = $mysqli -> query("SELECT * FROM inlogadmin WHERE username = '$username'");
        $rows = [];
        $row = mysqli_fetch_array($result);
        print_r($row);
        if(md5($password) !== $row['password']){
          $error[]= "Gebruikersnaam of wachtwoord klopt niet";
          $errors = 1;
        }
      }
    ?>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4" style=" margin-left: 33.33333%">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Oasis dashboard login</h3>
          </div>
          <div class="panel-body">
            <form accept-charset="UTF-8" role="form" method="POST">
              <?php
                if(empty($_POST) === false && $errors ===1){
                  echo error($error);
                }elseif (empty($_POST) === false && $errors === 0) {
                  session_start();
                  $_SESSION["username"] = $row["username"];
                  if(isset($_SESSION["username"]) && $_SESSION["username"]){
                    header("Location: index.php");
                  }
                  else{
                    echo "gkodfnjgnd";
                  }

                }
              ?>
                <div class="form-group">
                  <input class="form-control" placeholder="Gebruikersnaam" name="gebruikersnaam" type="text" required autofocus>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Wachtwoord" name="wachtwoord" type="password" value="" required>
                </div>
                <div>
                    <div width="100%">
                      <a href="#" style="text-decoration:none">
                        <button id="inloggen" type="submit" class="btn btn-primary btn-block">
                          Inloggen
                        </button>
                      </a>
                  <div class="row-buffer-5"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>