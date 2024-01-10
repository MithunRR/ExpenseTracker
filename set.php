<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$user_fk = $user_data['id'];

// Handling income category form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inc_cat'])) {
    $inc_category = $_POST['inc_cat'];
    $user_fk = $user_data['id'];

    if (!empty($inc_category)) {
        // Save to database 
        $query = "INSERT INTO category (inc_category, user_fk) VALUES ('$inc_category', '$user_fk')";
        mysqli_query($con, $query);
    } else {
        echo "Income category cannot be empty";
    }
}

// Handling expense category form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['exp_cat'])) {
    $exp_category = $_POST['exp_cat'];
    $user_fk = $user_data['id'];

    if (!empty($exp_category)) {
        // Save to database 
        $query = "INSERT INTO categoryx (exp_category, user_fk) VALUES ('$exp_category', '$user_fk')";
        mysqli_query($con, $query);
    } else {
        $emptyX_error = "Expense category cannot be empty";
    }
}

$sqlq = "SELECT id, inc_category FROM category WHERE user_fk = '$user_fk'";
$inc_cat_data = mysqli_query($con, $sqlq);
// No of rows
$row_num = mysqli_num_rows($inc_cat_data);

$sqlx = "SELECT id, exp_category FROM categoryx WHERE user_fk = '$user_fk'";
$exp_cat_data = mysqli_query($con, $sqlx);
// No of rows
$row_numx = mysqli_num_rows($exp_cat_data);

//delete income category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_i'])) {
    $delete_id = $_POST['delete_id_i'];
    $query = "DELETE FROM category WHERE id = '$delete_id' AND user_fk = '$user_fk'";
    mysqli_query($con, $query);
}
// delete expense category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_x'])) {
    $delete_id = $_POST['delete_id_x'];
    $query = "DELETE FROM categoryx WHERE id = '$delete_id' AND user_fk = '$user_fk'";
    mysqli_query($con, $query);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track.X | Settings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="set.css">
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
        <div class="category">
            <div class="inc_cat">
                <h2>Income</h2>
                <form action="" method="post">
                    <input type="text" id="inc_cat" name="inc_cat" placeholder="Enter Category">
                    <button type="submit">Add</button>
                </form>
                <table>
                    <?php
                    $sqlq = "SELECT id, inc_category FROM category WHERE user_fk = '$user_fk'";
                    $inc_cat_data = mysqli_query($con, $sqlq);
                    $row_num = mysqli_num_rows($inc_cat_data);
                    if ($row_num > 0){
                        while ($row = mysqli_fetch_assoc($inc_cat_data)){
                            echo "<tr>";
                            echo "<td>".$row['inc_category']."</td>";
                            echo "<td>
                                <form action='' method='post'>
                                    <input type='hidden' name='delete_id_i' value='".$row['id']."'>
                                    <button type='submit' name='delete_i'>X</button>
                                </form>
                                </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
            <div class="exp_cat">
                <h2>Expense</h2>
                <form action="" method="post">
                    <input type="text" id="exp_cat" name="exp_cat" placeholder="Enter Category">
                    <button type="submit">Add</button>
                </form>
                <table>
                <?php
                    $sqlx = "SELECT id, exp_category FROM categoryx WHERE user_fk = '$user_fk'";
                    $exp_cat_data = mysqli_query($con, $sqlx);
                    $row_numx = mysqli_num_rows($exp_cat_data);
                    if ($row_numx > 0){
                        while ($row = mysqli_fetch_assoc($exp_cat_data)){
                            echo "<tr>";
                            echo "<td>".$row['exp_category']."</td>";
                            echo "<td>
                                    <form action='' method='post'>
                                    <input type='hidden' name='delete_id_x' value='".$row['id']."'>
                                    <button type='submit' name='delete_x'>X</button>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script src="index.js"></script>
</body>
</html>