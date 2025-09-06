<?php

$con = mysqli_connect("localhost", "root", "", "farmers_market");


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
