
<?php
session_start();
    
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)){
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($con, $query);
        if ($result){
            if ($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password){
                    $_SESSION['email'] = $user_data['email'];
                    header("Location: index.php");
                    die;
                }
            }
        }

        echo "Please enter valid informantion";
    }
    else{
        echo "Please enter valid informantion";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track.X | Incomes</title>
    <link rel="stylesheet" href="static/css/style.css">
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
                <div style="font-size:20px; margin:10px; ">Login</div>
                <input id="text" type="text" placeholder="Enter email" name=email ><br><br>
                <input id="text" type="password" placeholder="Enter password" name=password ><br><br>
    
                <input id="button" type="submit" value=Login><br><br>
                <a href="signup.php">Signup</a>
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

    <script src="static/js/index.js"></script>
</body>
</html>