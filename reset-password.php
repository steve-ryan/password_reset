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
         if($_GET['key'] && $_GET['token'])
                            {
                             require("db_connection.php");
                             $email = $_GET['key'];
                             $token = $_GET['token'];
                             $query = mysqli_query($db_connection,
                             "SELECT * FROM `users` WHERE `reset_link_token`='".$token."' and `user_email`='".$email."';"
                             );
                             $curDate = date("Y-m-d H:i:s");
                              if (mysqli_num_rows($query) > 0) {
                                $row= mysqli_fetch_array($query);
                                 if($row['exp_date'] >= $curDate){ ?>
    <form action="update-forget-password.php" method="post">
        <h2>Reset Password Now!!</h2>

        <div class="container">
            <input type="hidden" name="user_email" value="<?php echo $email;?>">
            <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter password" id="password" name="passwordreset" required>

            <label for="password"><b>Confirm Password</b></label>
            <input type="password" placeholder="Enter password" id="password-confirm" name="passwordconf" required>

            <button type="submit">Submit</button>

        </div>

    </form>
    <?php } 
                                 } else{
                                  echo "<div style='success_message;'>This reset link has expired</div>";
                                 }
                            }
                              ?>
</body>

</html>