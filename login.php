<?php
if(isset($_POST['user_email'], $_POST['user_password'])){

    $user_email = trim($_POST['user_email']);
    $user_password = trim($_POST['user_password']);

    if(!empty($user_email) && !empty($user_password)){

        $user_email = htmlspecialchars($user_email);

        $stmt = $db_connection->prepare("SELECT * FROM `users` WHERE user_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){

            $row = $result->fetch_assoc();
            $user_db_pass = $row['user_password'];

            if(password_verify($user_password, $user_db_pass)){

                session_regenerate_id(true);
                $_SESSION['user_email'] = $user_email;  
                header('Location: home.php');
                exit;

            }
            else{
                $error_message = "Incorrect Email Address or Password.";
            }

        }
        else{
            $error_message = "Incorrect Email Address or Password.";
        }

    }
    else{
        $error_message = "Please fill in all the required fields.";
    }

}