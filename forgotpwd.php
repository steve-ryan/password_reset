<?php
session_start();
require 'db_connection.php';
require 'login.php';

// Check if user is already logged in
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
//// End Code Snippet ////


//// Begin Code Explanation ////
## Summary
The code snippet is a PHP script that handles the password reset functionality. It checks if the user is already logged in and redirects them to the home page if they are. Otherwise, it displays a form where the user can enter their email to request a password reset.

## Code Analysis
### Inputs
- None
___
### Flow
1. The code starts by calling the `session_start()` function to initialize the session.
2. It includes the 'db_connection.php' and 'login.php' files, which are likely responsible for establishing a database connection and handling user login functionality.
3. It checks if the `$_SESSION['user_email']` variable is set, which would indicate that the user is already logged in.
4. If the user is logged in, the code redirects them to the 'home.php' page using the `header()` function and exits the script.
5. If the user is not logged in, the code displays an HTML form where the user can enter their email to request a password reset.
6. The form submits the data to the 'password-reset-token.php' page using the POST method.
___
### Outputs
- None
___
//// End Code Explanation ////