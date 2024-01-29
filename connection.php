<?php

$dbhost = "monorail.proxy.rlwy.net";
$dbuseer = "root";
$dbpass = "bhA52G4ce3Dgaa6b6gf-g4gF5ca5deb5";
$dbname = "railway";

if (!$con = mysqli_connect($dbhost, $dbuseer, $dbpass, $dbname)){
    die ("failed to connect");
}

?>