<?php
include 'connect.php';
function loggedOn($mysqli){
	$result = $mysqli->query("SELECT * FROM klantgegevens WHERE ingelogd = 1");

	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$rows[] = $row;
	}

	$count = 0;
	foreach ($rows as $row) {
		$count++;
	}
	return $count;
}
function profit($mysqli){
	$rows=[];
	$result = $mysqli->query("SELECT `boekingen`.*, `activiteit`.`kosten`
							FROM `boekingen`, `activiteit`
							WHERE `boekingen`.`activiteitNr` = `activiteit`.`activiteitNr`;");

	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$rows[] = $row;
	}
	$count = 0;
	foreach ($rows as $row) {
		$count += $row['kosten']; 
	}
	return "€" . $count;
}
function error($error){
	return "<ul class='list-group'><li class='list-group-item list-group-item-danger'>" . implode("</li><li class='list-group-item list-group-item-danger'> ", $error) . "</li></ul>";
}

?>