<?php

$dbhost = "localhost";
$dbuseer = "root";
$dbpass = "";
$dbname = "trackx";

if (!$con = mysqli_connect($dbhost, $dbuseer, $dbpass, $dbname)){
    die ("failed to connect");
}

?>