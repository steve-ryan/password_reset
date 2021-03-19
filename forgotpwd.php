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

    <form action="password-reset-token.php" method="post">
        <h2>Password Reset</h2>

        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter email" id="email" name="user_email" required>
        </div>
 
        <div class="container" style="background-color:#f1f1f1">
            <input type="submit" name="password-reset-token" class="Regbtn">
        </div>
    </form>
</body>

</html>