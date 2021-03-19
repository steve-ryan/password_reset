<?php 
session_start();
require 'db_connection.php';
require 'insert_user.php';
// IF USER LOGGED IN
if(isset($_SESSION['user_email'])){
header('Location: home.php');
exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Footmarkz.com</title>
    <link rel="stylesheet" href="style.css" media="all" type="text/css">
</head>

<body>

    <form action="" method="post">
        <h2>Create an account</h2>

        <div class="container">
            <label for="gender"><b>Gender</b></label>
            <select name="gender" id="gender">
                <option selected disabled>Select gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>

            <label for="firstname"><b>Firstname:</b></label>
            <input type="text" placeholder="Enter firstname" id="fname" name="fname" required>

            <label for="lastname"><b>Lastname:</b></label>
            <input type="text" placeholder="Enter lastname" id="lname" name="lname" required>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter email" id="email" name="user_email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter password" id="password" name="user_password" required>

            <button type="submit">Sign Up</button>
        </div>
        <?php
if(isset($success_message)){
echo '<div class="success_message">'.$success_message.'</div>'; 
}
if(isset($error_message)){
echo '<div class="error_message">'.$error_message.'</div>'; 
}
?>
        <div class="container" style="background-color:#f1f1f1">
            <a href="index.php"><button type="button" class="Regbtn">Login</button></a>
        </div>
    </form>
</body>

</html>