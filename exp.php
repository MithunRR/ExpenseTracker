
<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$user_fk = $user_data['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = $_POST['name'];
    $category =  $_POST['category'];
    $amount = $_POST['amount'];
    $date = date('Y-m-d', strtotime($_POST['date']));
    $note = $_POST['note'];
    $user_fk = $user_data['id'];

    if (!empty($name)) {
        $query = "INSERT INTO expenses (name, category, amount, date, note, user_fk) VALUES ('$name', '$category', '$amount', '$date', '$note', '$user_fk')";
        mysqli_query($con, $query);
    } else {
        echo "Name cannot be empty";
    }
}

//delete row from expenses table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_i'])) {
    $delete_id = $_POST['delete'];
    $query = "DELETE FROM expenses WHERE id = '$delete_id' AND user_fk = '$user_fk'";
    mysqli_query($con, $query);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track.X | Incomes</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/inc.css">
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
        <div class="inc_exp_display">
            <div class="inc_display">
                <div class="inc_form" style="display:none;" id="add_income">
                    <div class="form_header">
                        <h2>Add Income Details</h2>
                        <div class="close_form">
                            <button onclick="openForm()" id="close_form">X</button>
                        </div>
                    </div>
                    
                    <form action="" method="post">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name">

                        <label for="category">Category:</label>
                        <select id="category" name="category">
                        <!-- <option value="Select Category">Select Category</option> -->
                            <?php
                            $sqlx = "SELECT id, exp_category FROM categoryx WHERE user_fk = '$user_fk'";
                            $exp_cat_data = mysqli_query($con, $sqlx);
                            $row_numx = mysqli_num_rows($exp_cat_data);
                            if ($row_numx > 0){
                                while ($rowx = mysqli_fetch_assoc($exp_cat_data)){
                                    echo "<option name=".$rowx['exp_category']." value=".$rowx['exp_category'].">".$rowx['exp_category']."</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="amount">Amount:</label>
                        <input type="text" id="amount" name="amount">

                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date">

                        <label for="note">Note:</label>
                        <textarea name="note"></textarea>

                        <button type="submit">Add</button>
                    </form>
                </div>

                <div class="inc_table">
                    <div class="head_btn">
                        <h1>Expenses Entries</h1>
                        <button onclick="openForm()">Add Expenses</button>
                    </div>
                    <table>
                        <tr>
                            <th>Sr. No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Note</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                            $sql = "SELECT id, name, category, amount, date, note FROM expenses WHERE user_fk='$user_fk'";
                            $expense_data = mysqli_query($con, $sql);
                            $expense_row = mysqli_num_rows($expense_data);
                            
                            if($expense_row>0){
                                while ($row_exp = mysqli_fetch_assoc($expense_data)){
                                    echo "<tr>";
                                    echo "<td>1</td>";
                                    echo "<td>".$row_exp['name']."</td>";
                                    echo "<td>".$row_exp['category']."</td>";
                                    echo "<td>".$row_exp['amount']."</td>";
                                    echo "<td>".$row_exp['date']."</td>";
                                    echo "<td style='text-align:left; padding-left:5px;'>".$row_exp['note']."</td>";
                                    echo "<td><button>Edit</button></td>";
                                    echo "<td>
                                    <form action='' method='post'>
                                        <input type='hidden' name='delete' value='".$row_exp['id']."'>
                                        <button type='submit' name='delete_i'>X</button>
                                    </form>
                                    </td>";
                                    echo "<tr>";
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="exp_display"></div>
        </div>
    </div>

    <br>
    <br>

    <script src="static/js/inc.js"></script>
</body>
</html>