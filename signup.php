
<?php
session_start();
include("connection.php");
include("functions.php");

// Check if the user is already logged in, redirect to index.php
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // save to database
        $query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    } else {
        echo "Please enter valid information";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track.X | Incomes</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    #text{
        height: 25px;
        border-radius:5px;
        padding: 4px;
        border: solid thin #aaa;
        width: 100%;
    }
    #button{
        padding: 10px;
        width: 100px;
        color: white;
        background-color: Lightblue;
        border: none;
        cursor: pointer;
    }
    #box{
        background-color: rgba(130, 130, 130, 0.4);
        border-radius: 7px;
        margin: 50px auto;
        width: 300px;
        padding: 20px;
    }
</style>
<body>
    <div class="container">
        <div id="box">
            <form action="" method="post">
                <div style="font-size:20px; margin:10px; ">Signup</div>
                <input id="text" type="text" name=name><br><br>
                <input id="text" type="text" name=email><br><br>
                <input id="text" type="password" name=password><br><br>
                <input id="button" type="submit" value=Signup><br><br>
                <a href="login.php">Login</a>
            </form>
        </div>

        <div class="inc_exp_display">
            <div class="inc_display">
                <form action="" method="post">
                    
                </form>
            </div>
            <div class="exp_display"></div>
        </div>
    </div>

    <script src="index.js"></script>
</body>
</html>