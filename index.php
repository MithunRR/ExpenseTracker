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
    <link rel="stylesheet" href="static/css/style.css">
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
                <div class="in_display">
                    <h1>Total Income: &#8377; 
                        <?php
                        $in_sum_query = "SELECT SUM(amount) AS totalexp FROM incomes WHERE user_fk='$user_fk'";
                        $inc_sum_data = mysqli_query($con, $in_sum_query);
                        $inc_sum_row = mysqli_num_rows($inc_sum_data);
                        if ($inc_sum_row > 0) {
                            $in_row_sum = mysqli_fetch_assoc($inc_sum_data);
                            echo $in_row_sum['totalexp'];
                        }
                        ?>
                    </h1>
                </div>
                <div class="ex_display">
                    <h1>Total Expenses: &#8377; 
                        <?php
                        $ex_sum_query = "SELECT SUM(amount) AS totalexp FROM expenses WHERE user_fk='$user_fk'";
                        $exp_sum_data = mysqli_query($con, $ex_sum_query);
                        $exp_sum_row = mysqli_num_rows($exp_sum_data);
                        if ($exp_sum_row > 0) {
                            $ex_row_sum = mysqli_fetch_assoc($exp_sum_data);
                            echo $ex_row_sum['totalexp'];
                        }
                        ?>
                    </h1>
                </div>
                <div class="balance_display">
                    <h1>Balance: &#8377; 
                        <?php
                            $bal = $in_row_sum['totalexp'] - $ex_row_sum['totalexp'];
                            echo $bal;
                        ?>
                    </h1>
                </div>
        </div>
    </div>

    <script src="static/js/index.js"></script>
</body>
</html>