<?php
	$mysqli = new mysqli("oege.ie.hva.nl", "winsens", 'Zy$GNu/IDQi#JA', "zwinsens");
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
?>