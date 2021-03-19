<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['password-reset-token']) && $_POST['user_email'])
{
   require ("./db_connection.php");
   
     
    $emailId = $_POST['user_email'];
 
    $result = mysqli_query($db_connection ,"SELECT * FROM users WHERE user_email='" . $emailId . "'");
 
    $row= mysqli_fetch_array($result);
 
  if($row)
  {
     
     $token = md5($emailId).rand(10,9999);
 
     $expFormat = mktime(
     date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
     );
 
    $expDate = date("Y-m-d H:i:s",$expFormat);
 
    $update = mysqli_query($db_connection,"UPDATE users set reset_link_token='" . $token . "' ,
    exp_date='" . $expDate . "' WHERE user_email='" . $emailId . "'");
 
    $link = "
    <a href='http://localhost/password_reset/reset-password.php?key=".$emailId."&token=".$token."'>
    Click To Reset password</a>";
    
   require 'vendor/autoload.php';

   require 'vendor/phpmailer/phpmailer/src/Exception.php';
   require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
   require 'vendor/phpmailer/phpmailer/src/SMTP.php';
 
    $mail = new PHPMailer();
 
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "testd@gmail.com"; //set your gmail here
    // GMAIL password
    $mail->Password = "Gmail_password_here"; //set the password
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='test@gmail.com'; //replace this with what you inserted on line 47
    $mail->FromName='Steve';  //replace this with name you want to appear on receiver side as sender name
    $mail->SMTPDebug = 0;
    $mail->AddAddress($emailId, $row['firstname']); //on this we set receiver name and the second part is optional but that gets receiver name
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
    if($mail->Send())
    {
      echo "<p style='text-align:center;' >Check Your Email and Click on the link sent to your email</p>";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }else{
    echo "<p style='text-align:center;'>Invalid Email Address</p>";
    
  }
}
?>