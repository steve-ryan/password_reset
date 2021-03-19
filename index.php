<?php
session_start();
require 'db_connection.php';
require 'login.php';
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
    <title>Login - Footmarkz.com</title>
    <link rel="stylesheet" href="style.css" media="all" type="text/css">
</head>

<body>

    <form action="" method="post">
        <h2>User Login</h2>

        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter email" id="email" name="user_email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter password" id="password" name="user_password" required>

            <button type="submit">Login</button>
            <small class="link">
                <a href="forgotpwd.php" style="text-decoration: none;
    cursor: pointer;">forgot password?</a>
            </small>
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
            <a href="signup.php"><button type="button" class="Regbtn">Create an account</button></a>
        </div>
    </form>
</body>

</html>