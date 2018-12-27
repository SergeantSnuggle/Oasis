<!DOCTYPE html>
<html lang="en">
<head>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/bootstrap-select/dist/bootstrap-select.min.css">



  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" type="text/css">
  <style>
  </style>
</head>
<body>
  <?php
    include 'navbar.php';
    $pasquery = $mysqli->query("SELECT * FROM passen");
    while($row = $pasquery->fetch_array(MYSQLI_ASSOC)){
      $passen[] = $row;
    }
    $klantquery = $mysqli->query("SELECT klantNr, klantNaam FROM klantgegevens");
    while($row = $klantquery->fetch_array(MYSQLI_ASSOC)){
      $klanten[] = $row;
    }
    $errors = 0;
    if (empty($_POST) === false) {
      $verblijf = explode("-", $_POST['verblijf']);
      $yy = $verblijf[0];
      $mm = $verblijf[1];
      $dd = $verblijf[2];
      $verblijf = mktime( 0, 0, 0, $mm, $dd, $yy );
      $vandaag = strtotime("now"); 
      if ( $verblijf < $vandaag ){
          $errors = 1;
          $error[] = "Geen geldige verblijf datum";
      }
      $pasnummer = $_POST['pasNr'];
      $klantnummer = $_POST['klantNr'];
      $verblijf = $_POST['verblijf'];
      $kamernummer = $_POST['kamerNr'];
      $update = "UPDATE passen 
                SET klantNr = '$klantnummer', verblijfTot = '$verblijf', kamerNr = '$kamernummer'
                WHERE pasNr = '$pasnummer'";
      if ($errors == 0) {
        if ($mysqli->query($update) === TRUE) {
            echo "Klant succesvol toegevoegd";
        } else {
            echo "Error: " . $update . "<br>" . $mysqli->error;
        }
      }
    }
  ?>
  <div class="card">
    <h5 class="card-header">Pas koppelen</h3>
    <div class="card-body">
      <form role="form" method="POST">
        <?php
          if(empty($_POST) === false && $errors ===1){
            echo error($error);
          }
        ?>
        <div class="form-row">
          <div class="form-group col-md-5">
            <label for="inputAddress">Passen</label>
            <select class="custom-select" name="pasNr">
              <option selected></option>
              <?php
                foreach ($passen as $option) {
                  ?><option value=<?php echo $option['pasNr'] ?>><?php echo $option['pasNr'] ?></option><?php
                }
              ?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <p class="text-center">
              Koppelen aan -»
            </p>
          </div>
          <div class="form-group col-md-5">
            <label for="klantNr">Klanten</label>
            <select class="custom-select" name="klantNr">
              <option selected></option>
              <?php
                foreach ($klanten as $option) {
                  ?><option value=<?php echo $option['klantNr'] ?>><?php echo $option['klantNaam'] ?></option><?php
                }
              ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="verblijf">Verblijf tot (Jaar-Maand-Dag)</label>
            <input class="form-control"data-date-format="yyyy-mm-dd" id="datepicker" name="verblijf">
          </div>
          <div class="form-group col-md-6">
            <label for="kamerNr">Kamernummer</label>
            <input type="text" class="form-control" name="kamerNr" placeholder="Kamernummer" required>
          </div>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" required>
            <label class="form-check-label" for="gridCheck">
             Alle gegevens zijn correct ingevuld?
            </label>
          </div>
        </div>
        <div class="form-row">
          <button type="submit" class="btn btn-primary">Voeg toe</button>
        </div>
      </form>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap-select/dist/bootstrap-select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript">
    $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());
  </script>
</body>
</html>