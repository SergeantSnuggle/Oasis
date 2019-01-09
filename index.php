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


  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" type="text/css">
<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style>


  <title>Oasis dashboard</title>
</head>
<body>
  <header id="header" class="header">
    <?php
      include "navbar.php";
    ?>
  </header>

  <div class="row">
    <div class="col-12 col-md-8">
      <div class="content mt-3">
       <div class="col-sm-12 col-lg-12">
        <div class="card text-white bg-flat-color-1">
          <div class="card-body pb-0">
            <h4 class="mb-0">
              <span class="count">
                <?php
                  echo loggedOn($mysqli);                
                ?>
              </span>
            </h4>
            <p class="text-light">Gebruikers online</p>
          </div>
        </div>
      </div>
    </div>
    <div class="content mt-3">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-3">Logins laatste 7 dagen</h4>
            <canvas id="login-chart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-4">
    <div class="content mt-3"> 
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-one">
              <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
              <div class="stat-content dib">
                <div class="stat-text">Totaal uitgegeven</div>
                <div class="stat-digit">
                  <?php
                    echo profit($mysqli);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content mt-3"> 
      <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Landen</strong>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Land</th>
                            <th scope="col">Hoeveelheid</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $result = $mysqli->query("SELECT `land`, COUNT(`land`) hoeveelheid 
                                            FROM klantgegevens 
                                            GROUP BY `land`
                                            ORDER BY `hoeveelheid` DESC");
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                          $rows[] = $row;
                        }
                        foreach ($rows as $key) {
                          ?>
                            <tr>
                              <td><?php echo$key['land']; ?></td>
                              <td><?php echo$key['hoeveelheid']; ?></td>
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
  </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/Chart.min.js"></script>
  <script type="text/javascript" src="assets/js/chart.js"></script>
</body>
</html>