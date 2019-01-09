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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
  .card-inside{
    padding: 10px;
  }
</style>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" type="text/css">
</head>
<body>
  <?php
  include 'navbar.php';
  $hoevaakUurQuery = $mysqli->query("SELECT extract(hour from boekingTijd) as Uur, count(*) as Hoevaak
                                    FROM boekingen
                                    GROUP BY Uur
                                    ORDER BY Hoevaak DESC");
  while($row = $hoevaakUurQuery->fetch_array(MYSQLI_ASSOC)){
    $hoevaakUur[]=$row;
  }
  $hoevaakBinnenTempQuery = $mysqli->query("SELECT binnenTemp, COUNT(*) as Hoevaak
                                            FROM boekingen
                                            GROUP BY binnenTemp
                                            ORDER BY Hoevaak DESC");
  while($row = $hoevaakBinnenTempQuery->fetch_array(MYSQLI_ASSOC)){
    $hoevaakBinnenTemp[]=$row;
  }
  $hoevaakBuitenTempQuery = $mysqli->query("SELECT buitenTemp, COUNT(*) as Hoevaak
                                            FROM boekingen
                                            GROUP BY buitenTemp
                                            ORDER BY Hoevaak DESC");
  while($row = $hoevaakBuitenTempQuery->fetch_array(MYSQLI_ASSOC)){
    $hoevaakBuitenTemp[]=$row;
  }

  ?>
  <div class="card">
    <h5 class="card-header">Statistieken</h5>
      <div class="row">
        <div class="col-4 card-inside"">
          <h5 class="card-header">Hoevaak per uur boeking geplaatst</h5>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Uur</th>
                <th scope="col">Hoevaak</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for($i =0; $i<5; $i++) {
                ?>
                <tr>
                  <td><?php echo$hoevaakUur[$i]['Uur']; ?></td>
                  <td><?php echo$hoevaakUur[$i]['Hoevaak']; ?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="col-4 card-inside"">
          <h5 class="card-header">Hoevaak per binnen temperatuur</h5>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Binnen Temperatuur</th>
                <th scope="col">Hoevaak</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for($i =0; $i<5; $i++) {
                ?>
                <tr>
                  <td><?php echo$hoevaakBinnenTemp[$i]['binnenTemp']; ?></td>
                  <td><?php echo$hoevaakBinnenTemp[$i]['Hoevaak']; ?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="col-4 card-inside"">
          <h5 class="card-header">Hoevaak per buiten temperatuur</h5>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Buiten temperatuur</th>
                <th scope="col">Hoevaak</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for($i =0; $i<5; $i++) {
                ?>
                <tr>
                  <td><?php echo$hoevaakBuitenTemp[$i]['buitenTemp']; ?></td>
                  <td><?php echo$hoevaakBuitenTemp[$i]['Hoevaak']; ?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
</body>
</html>