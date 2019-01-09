<?php
  include "connect.php";
  include 'functions.php';
  session_start();
  if(isset($_SESSION['username']) === false){
    header("Location: login.php");

  }
  if(isset($_GET['a']) && $_GET['a'] === "uitlog"){
    session_destroy();
    header("Location: login.php");
  }
  $url = $_SERVER['REQUEST_URI'];
  $url = explode("/", $url);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a href="index.php" class="navbar-brand">
    <svg width="32" height="32">
      <image xlink:href="favicon.ico" width="30" width="30"/>
    </svg>
    Oasis
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <?php if($url[2] == "index.php"){?><li class="nav-item active"><?php }else{?>
      <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <?php if($url[2] == "klant.php"){?><li class="nav-item active"><?php }else{?>
      <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="klant.php">Alle klanten</a>
      </li>
      <?php if($url[2] == "newklant.php"){?><li class="nav-item active"><?php }else{?>
      <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="newklant.php">Klant toevoegen</a>
      </li>
      <?php if($url[2] == "pasadd.php"){?><li class="nav-item active"><?php }else{?>
      <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="pasadd.php">Pas koppelen</a>
      </li>
      <?php if($url[2] == "statistics.php"){?><li class="nav-item active"><?php }else{?>
      <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="statistics.php">Statistieken</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Servo besturen</a>
      </li>
    </ul>
    <ul class ="navbar-nav">
      <li class="navbar-item">
        <a class="nav-link" href="?a=uitlog">Uitloggen</a>
      </li>
    </ul>
  </div>
</nav>  