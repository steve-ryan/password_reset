<?php
if(isset($_POST['gender'], $_POST['fname'], $_POST['lname'], $_POST['user_email'], $_POST['user_password'])){

    // CHECK IF FIELDS ARE NOT EMPTY
    if(!empty(trim($_POST['fname'])) && !empty(trim($_POST['lname'])) && !empty(trim($_POST['gender'])) && !empty(trim($_POST['user_email'])) && !empty($_POST['user_password'])){

        // Escape special characters.
        $fname = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['fname']));
        $lname = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['lname']));
        $gender = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['gender']));
        $user_email = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_email']));

        // IF EMAIL IS VALID
        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {  

            // CHECK IF EMAIL IS ALREADY REGISTERED
            $stmt = $db_connection->prepare("SELECT `user_email` FROM `users` WHERE user_email = ?");
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){    
                $error_message = "This Email Address is already registered. Please Try another.";
            } else {
                // IF EMAIL IS NOT REGISTERED
                $user_hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

                // INSERT USER INTO THE DATABASE
                $stmt = $db_connection->prepare("INSERT INTO `users` (firstname,lastname,gender, user_email, user_password) 
                VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $fname, $lname, $gender, $user_email, $user_hash_password);
                $stmt->execute();

                if($stmt->affected_rows === 1){
                    $success_message = "Thanks! You have successfully signed up.";
                } else {
                    $error_message = "Oops! something wrong.";
                }
            }    
        } else {
            // IF EMAIL IS INVALID
            $error_message = "Invalid email address";
        }
    } else {
        // IF FIELDS ARE EMPTY
        $error_message = "Please fill in all the required fields.";
    }
}
?>