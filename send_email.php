<?php
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
require 'vendor/autoload.php';


// Function to send an email
function sendEmail($username, $password, $recipient_email) {

    // send email function undo this when sending email
function sendEmail($username, $password, $recipient_email) {
    $mail = new PHPMailer(true); // Create the $mail object within the function
 
    
    // echo "<script>alert('$recipient_email')</script>";
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jaydipkoriya04@gmail.com'; // Your Gmail email address
        $mail->Password   = 'gxqihtcmwknkufzl';      // Your Gmail password or App Password
        // $mail->Username   = 'mikeypatel64@gmail.com'; // Your Gmail email address
        // $mail->Password   = 'fckoyfbqhpaqffki';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('jaydipkoriya04@gmail.com', 'Mikey');
        $mail->addAddress($recipient_email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Your New Account Information';
        $mail->Body    = "Your username is: $username\nYour password is: $password";

        $mail->send();

        return true;
    } catch (Exception $e) {
        return false;
    }
}
}
// Main code

    try{
    $mail = new PHPMailer(true);

    // $client_email=;
    //  echo "<script type='text/javascript'>alert('Email: $email');</script>";
    // echo "<script type='text/javascript'>alert('Email: $client_email');</script>";
    // echo "<script>alert('Recipient Email: $recipient_email')</script>";
    // echo "<script>alert('Username: $username')</script>";
    // echo "<script>alert('Password: $password')</script>";

    //   echo '<script type="text/javascript">
    //       alert(" hjhjhjhjhjhjhj");
    //       window.location.href = "empProfile.php"; // Redirect to employe.php
    //     </script>';
    
    $recipient_email = $email;
    $username=$employee_id;
    $password1=$password;
     // Replace with the actual recipient's email address

        $result = sendEmail($username, $password,$recipient_email);


    if ($result) {
        // echo "Email sent successfully!";
        echo '<script type="text/javascript">
        
            alert("Email sent successfully!");
            window.location.href = "empProfile.php"; // Redirect to employe.php
          </script>';
    
            }
     else {
        // echo "Error sending email.";
        echo '<script type="text/javascript">
        
            alert("Error sending email.");
            window.location.href = "empProfile.php"; // Redirect to employe.php
          </script>';
    
            }
 
        }  
catch (Exception $e) {
    // Handle exceptions thrown by PHPMailer
    echo "Error sending email: " . $e->getMessage();
    }


?>