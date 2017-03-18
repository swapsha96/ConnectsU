<?php

$c = mysqli_connect("localhost", "root", "") or die("Cannot connect.");
mysqli_select_db($c, "alphago") or die("Cannot select database.");

?>