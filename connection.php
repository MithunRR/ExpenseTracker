<?php

$dbhost = "monorail.proxy.rlwy.net";
$dbuseer = "root";
$dbpass = "2aGBaaah1hGEcCEFCAACcfh42eGD6dEF";
$dbname = "railway";

if (!$con = mysqli_connect($dbhost, $dbuseer, $dbpass, $dbname)){
    die ("failed to connect");
}

?>