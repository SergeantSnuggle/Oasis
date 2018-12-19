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
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="klant.php">Alle klanten</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="newklant.php">Klant toevoegen</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pas koppelen</a>
      </li>
    </ul>
    <ul class ="navbar-nav">
      <li class="navbar-item">
        <a class="nav-link" href="?a=uitlog">Uitloggen</a>
      </li>
    </ul>
  </div>
</nav>  