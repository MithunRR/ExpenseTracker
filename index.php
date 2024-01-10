<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$user_fk = $user_data['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track.X | Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <p><a style="font-size: 34px;" href="index.php">Track.X</a></p>
            </div>
            <div class="inc">
                <button><a href="inc.php">Incomes</a></button>
            </div>
            <div class="exp">
                <button><a href="exp.php">Expenses</a></button>
            </div>
            <div class="set">
                <button><a href="set.php">Settings</a></button>
            </div>
            <div class="set">
                <div> 
                <?php 
                    if ($_SESSION['email']){
                        echo $user_data['name'];
                        echo '  | <a href="logout.php">Logout</a>';
                        
                    }
                    else{
                        header("Location: login.php");
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="in_ex_display">
            <div class="in_ex">
                <div class="in_display">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, aperiam!</p>
                </div>
                <div class="ex_display">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo culpa excepturi asperiores?</p>
                </div>
            </div>
            <div class="balance_display">
                    <button><a href="inc.php">Incomes</a></button>
                    <button><a href="inc.php">Expenses</a></button>
                    <div class="balance">
                        <p>Balance: </p>
                    </div>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
</body>
</html>