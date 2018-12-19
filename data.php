<?php
//setting header to json
	header('Content-Type: application/json');

	include 'connect.php';

  function getLastDays($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = "" . date($format, mktime(0,0,0,$m,($de-$i),$y)) . ""; 
    }
    return array_reverse($dateArray);
    }
  $days = getLastDays(7, 'Y-m-d');
  $searchquerry = implode("', '", $days);

  //query to get data from the table
  $query = "SELECT `inlogdatum`, COUNT(`inlogdatum`) 'hoevaak' FROM `inlogdata` WHERE inlogDatum IN  ('". $searchquerry ."') GROUP BY `inlogDatum`";
  $result = $mysqli -> query($query);
  // $data = array();
  $data = [];
  foreach ($result as $row) {
    $data[] = $row;
  }
  $dagen = array_column($data, 'inlogdatum');
  $aantal = array_column($data, 'hoevaak');
  $j = 0;
  for ($i=0; $i < count($days); $i++) {

    if (in_array($days[$i], $dagen)) {
      $datas[$i] = $aantal[$j];
      $j++;
    }else{
      $datas[$i] = 0;
    }
  }
	//free memory associated with result
	$result->close();

	//close connection
	$mysqli->close();

	//now print the data
	print json_encode($datas);
?>