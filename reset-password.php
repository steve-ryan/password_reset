<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" media="all" type="text/css">
    <title>Document</title>
</head>

<body>
    <?php
    // Check if 'key' and 'token' parameters are present in the URL query string
    if (isset($_GET['key']) && isset($_GET['token'])) {
        require("db_connection.php");
        $email = $_GET['key'];
        $token = $_GET['token'];
    
        // Prepare the SQL statement
        $stmt = $db_connection->prepare("SELECT * FROM `users` WHERE `reset_link_token`=? AND `user_email`=?");
        
        // Bind parameters
        $stmt->bind_param("ss", $token, $email);
    
        // Execute the statement
        $stmt->execute();
    
        // Get the result
        $result = $stmt->get_result();
    
        $curDate = date("Y-m-d H:i:s");
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    
            // Check if the token has not expired
            if ($row['exp_date'] >= $curDate) {
                ?>
                <form action="update-forget-password.php" method="post">
                    <h2>Reset Password Now!!</h2>

                    <div class="container">
                        <input type="hidden" name="user_email" value="<?php echo $email; ?>">
                        <input type="hidden" name="reset_link_token" value="<?php echo $token; ?>">

                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="Enter password" id="password" name="passwordreset" required>

                        <label for="password"><b>Confirm Password</b></label>
                        <input type="password" placeholder="Enter password" id="password-confirm" name="passwordconf" required>

                        <button type="submit">Submit</button>
                    </div>
                </form>
    <?php
            }
        } else {
            echo "<div style='success_message;'>This reset link has expired</div>";
        }
    }
    ?>
</body>

</html>