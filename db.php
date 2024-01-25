<?php

$con = mysqli_connect("localhost", "root", "", "musicdb");
if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}
?>