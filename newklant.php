<!doctype html>
<html lang="en">
<head>

  <!-- Required meta tags -->
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


  <title>Oasis dashboard</title>
</head>
<body>
  <header id="header" class="header">
    <?php
      include "navbar.php";
    ?>
  </header>
    <?php
      $errors = 0;
      if (empty($_POST) === false) {
        $geslacht = $_POST['geslacht'];
        if(!$geslacht == "Man" || !$geslacht == "Vrouw"){
          $errors = 1;
          $error[]= "Geen geldig geslacht";

        }
        if ($_POST['geslacht'] == "Man") {
          $geslacht = "M";
        }
        if ($_POST['geslacht'] == "Vrouw") {
          $geslacht = "V";
        }
        $geboortedatum = explode("-", $_POST['geboortedatum']);
        $yy = $geboortedatum[0];
        $mm = $geboortedatum[1];
        $dd = $geboortedatum[2];
        $geboortedatum = mktime( 0, 0, 0, $mm, $dd, $yy );
        $vandaag = strtotime("now"); 
        if ( $geboortedatum > $vandaag ){
            $errors = 1;
            $error[] = "Geen geldige geboortedatum";
        }
        print_r($_POST);
        $klantnaam = $_POST['naam'];
        $geboortedatum = $_POST['geboortedatum'];
        $land = $_POST['land'];
        $invoegen = "INSERT INTO klantgegevens (klantNaam, geboorteDatum, land, geslacht)
                VALUES ('$klantnaam', '$geboortedatum', '$land', '$geslacht')";
        if ($mysqli->query($invoegen) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $invoegen . "<br>" . $mysqli->error;
        }
      }
    ?>
  <div class="card">
    <h5 class="card-header">Klant toevoegen</h3>
    <div class="card-body">
      <form role="form" method="POST">
        <?php
          if(empty($_POST) === false && $errors ===1){
            echo error($error);
          }
        ?>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Naam</label>
            <input type="text" class="form-control" id="inputEmail4" name="naam" placeholder="Klant naam" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputPassword4">Geboortedatum (Jaar-Maand-Dag)</label>
            <input class="form-control"data-date-format="yyyy-mm-dd" id="datepicker" name="geboortedatum">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputAddress">Land van herkomst</label>
            <select class="selectpicker countrypicker form-control" name="land" data-default="Netherlands" data-flag="true" ></select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
          <label for="inputAddress2">Geslacht</label>
          <select id="basic" class="selectpicker form-control" name="geslacht">
            <option></option>
            <option>Vrouw</option>
            <option>Man</option>
          </select>
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
      </form>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/Chart.min.js"></script>
  <script type="text/javascript" src="assets/js/chart.js"></script>
  <script src="assets/bootstrap-select/dist/bootstrap-select.min.js"></script>
  <script src="assets/js/countrypicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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