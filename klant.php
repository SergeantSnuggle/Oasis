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
  <style type="text/css">
    .table-row{
      cursor:pointer;
      }
  </style>


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
    if(isset($_GET["k"])){
      $klantnr = $_GET["k"];
      $activiteiten = [];
      $klantquery = $mysqli->query("SELECT *
                                FROM klantgegevens
                                WHERE klantNr = '$klantnr'");
      $activiteitquery = $mysqli->query("SELECT boekingen.*, activiteit.`activiteitNm`, activiteit.`kosten`
                                      FROM boekingen
                                      JOIN activiteit ON activiteit.activiteitNr = boekingen.activiteitNr
                                      WHERE boekingen.klantNr = '$klantnr'
                                      ORDER BY boekingen.boekingDatum DESC");
      while($row = $klantquery->fetch_array(MYSQLI_ASSOC)){
        $klanten[] = $row;
      }
      foreach ($klanten as $klant) {

      }
      while($row = $activiteitquery->fetch_array(MYSQLI_ASSOC)){
        $activiteiten[] = $row;
      }
      $count = 0;
      foreach ($activiteiten as $activiteit) {
        $count += $activiteit['kosten']; 
      }      
      
  ?>
  <div class="card">
    <h5 class="card-header"><?php echo$klant['klantNaam']?></h3>
      <div class="card-body">
        <table>
          <?php
          foreach ($klanten as $klant) {
            echo "<tr>" . "<td>" . "Naam: </td><td>" . $klant['klantNaam'] . "</td></tr>";
            echo "<tr>" . "<td>" . "Leeftijd: </td><td>";
            $from = new DateTime($klant["geboorteDatum"]);
            $to   = new DateTime('today');
            echo $from->diff($to)->y . " jaar</td></tr>";
            echo "<tr>" . "<td>" . "Land van herkomst: </td><td>" . $klant["land"] . "</td></tr>";
            echo "<tr>" . "<td>" . "Geslacht: </td><td>";
            if($klant['geslacht'] == "M"){
              echo "Man";
            }
            if($klant['geslacht'] == "V"){
              echo "Vrouw";
            }
            echo  "</td></tr>";
            echo "<tr>" . "<td>" . "Momenteel online: </td><td>";
            if($klant['ingelogd'] == 1){
              echo "Ja";
            }
            if($klant['ingelogd'] == 0){
              echo "Nee";
            }
            echo  "</td></tr>";
            echo "<tr>" . "<td>" . "Totaal uitgegeven: </td><td>" ."€". $count . "</td></tr>";
          }
          ?>
        </table>
        <?php
          if(empty($activiteit)){
            echo "Klant geeft nog niks geboekt";
          }else{
        ?>
        <table class="table table-hover sortable">
          <thead class="thead-light">
            <tr>
              <th scope="col">Activiteit</th>
              <th scope="col">Datum</th>
              <th scope="col">Kosten</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($activiteiten as $activiteit) {

                  ?>
                  <tr>
                    <td><?php echo$activiteit["activiteitNm"];?></td>
                    <td><?php echo$activiteit["boekingDatum"]; ?></td>
                    <td><?php echo"€".$activiteit["kosten"]; ?></td>
                  </tr>
                  <?php
                }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php
    }}else{
  ?>
  <div class="card">
    <h5 class="card-header">Klanten</h3>
    <div class="card-body">
    <table class="table table-hover sortable">
      <thead class="thead-light">
        <tr>
          <th scope="col">Klantnummer</th>
          <th scope="col">Klantnaam</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = $mysqli->query("SELECT `klantNr`, `klantNaam`
                                  FROM klantgegevens");

          while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $rows[] = $row;
          }
          foreach ($rows as $key) {
              ?>
              <tr class="table-row" data-href=<?php echo '"?k=' . $key['klantNr'] .'"';?>>
                <td><?php echo$key['klantNr']; ?></td>
                <td><?php echo$key["klantNaam"]; ?></td>
              </tr>
              <?php
            }
            ?>


      </tbody>
    </table>
  </div>
  </div>
<?php } ?>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/Chart.min.js"></script>
  <script type="text/javascript" src="assets/js/chart.js"></script>
  <script type="text/javascript">
    $(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
        });
    });
  </script>
</body>
</html>