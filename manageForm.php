<?php
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// require 'vendor/autoload.php';
require 'vendor/autoload.php';

// session_start();
function generateRandomString($length)
{
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Add user registration logic here
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = generateUsername();

//     // Generate a random string
//     $randomString = generateRandomString(10);

//     // Hash the random string
//     // $hashedPassword = password_hash($randomString, PASSWORD_DEFAULT);
//     $hashedPassword = md5($randomString);

//     // Insert the username and hashed password into the database
//     $sql = "INSERT INTO users (employee_id, password) VALUES (?, ?)";

//     if ($stmt = $conn->prepare($sql)) {
//         $stmt->bind_param('ss', $username, $hashedPassword);
//         if ($stmt->execute()) {
//             echo "User registered successfully. Random password: " . $randomString;
//         } else {
//             echo "Error: " . $conn->error;
//         }
//         $stmt->close();
//     } else {
//         echo "Error: " . $conn->error;
//     }
// }

// function generateUsername() {
//     $baseUsername = '0';

//     // Check if a counter file exists, if not create it
//     $counterFile = 'counter.txt';
//     if (!file_exists($counterFile)) {
//         file_put_contents($counterFile, '0');
//     }

//     // Read the current counter value
//     $counter = intval(file_get_contents($counterFile));

//     // Increment the counter and save it back to the file
//     $counter++;
//     file_put_contents($counterFile, strval($counter));

//     // Generate a 2-digit number with leading zeros
//     $twoDigitNumber = sprintf('%02d', $counter);

//     // Generate a 4-digit random string
//     $randomString = generateRandomString(2);

//     // Combine everything to create the username
//     $username = $baseUsername . $randomString . $twoDigitNumber;

//     return $username;
// }

function generateUsername()
{
    $baseUsername = 'user_';

    // Check if a counter file exists, if not create it
    $counterFile = 'counter.txt';
    if (!file_exists($counterFile)) {
        file_put_contents($counterFile, '0');
    }

    // Read the current counter value
    $counter = intval(file_get_contents($counterFile));

    // Increment the counter and save it back to the file
    $counter++;
    file_put_contents($counterFile, strval($counter));

    // Generate a 2-digit number with leading zeros
    $twoDigitNumber = sprintf('%02d', $counter);

    // Generate a 4-digit random string
    $randomString = generateRandomString(2);

    // Combine everything to create the username
    $username = $baseUsername . $randomString . $twoDigitNumber;

    return $username;
}

function sendEmail($username, $password, $recipient_email)
{
    $mail = new PHPMailer(true); // Create the $mail object within the function


    // echo "<script>alert('$recipient_email')</script>";
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jaydipkoriya04@gmail.com'; // Your Gmail email address
        $mail->Password = 'gxqihtcmwknkufzl'; // Your Gmail password or App Password
        // $mail->Username   = 'mikeypatel64@gmail.com'; // Your Gmail email address
        // $mail->Password   = 'fckoyfbqhpaqffki';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('jaydipkoriya04@gmail.com', 'Mikey');
        $mail->addAddress($recipient_email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Your New Account Information';
        $mail->Body = "Your username is: $username\nYour password is: $password";

        $mail->send();

        return true;
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //echo "<script>alert('The file has been uploadedghfmhghmgghvhgvgh.')</script>"; 

    $target_dir = "upload/";

    $target_file = $target_dir . basename($_FILES["employeePhoto"]["name"]);
    $uploadOk = 1;

    // Generate a unique filename for the uploaded photo
    $fileExtension = pathinfo($_FILES["employeePhoto"]["name"], PATHINFO_EXTENSION);
    $newFileName = uniqid() . "." . $fileExtension;
    $target_file = $target_dir . $newFileName;

    // // rename($_FILES["employeePhoto"]["name"],"200170116037.pdf");
    // if (move_uploaded_file($_FILES["employeePhoto"]["tmp_name"],$target_file))
    //  { 

    //         echo "<script>alert('The file has been uploaded.')</script>"; 
    //         }  
    //         else { 
    //             echo "<script>alert('Sorry, there was an error uploading your file.' )</script>"; 
    //         }

    if (move_uploaded_file($_FILES["employeePhoto"]["tmp_name"], $target_file)) {
        // echo "<script>alert('The file has been uploaded.')</script>";
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
    }

    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $country = $conn->real_escape_string($_POST['country']);
    $marital_status = $conn->real_escape_string($_POST['marital_status']);
    $nationality = $conn->real_escape_string($_POST['nationality']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $identity_document = $conn->real_escape_string($_POST['identity_document']);
    $identity_no = $conn->real_escape_string($_POST['identity_no']);
    $employment_type = $conn->real_escape_string($_POST['employment_type']);
    $joining_date = $conn->real_escape_string($_POST['joining_date']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $department = $conn->real_escape_string($_POST['department']);
    $pan = $conn->real_escape_string($_POST['pan']);
    $bank_name = $conn->real_escape_string($_POST['bank_name']);
    $bank_account_no = $conn->real_escape_string($_POST['bank_account_no']);
    $ifsc_code = $conn->real_escape_string($_POST['ifsc_code']);
    $password = generateRandomString(4);
    $employee_id = generateUsername(4);
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $hashedPassword = md5($password);
    $role = "employee";
    $photo_path = $target_file;



    $photo_path = $target_file; // This assigns the file path to $photo_path
    echo "Target File: $target_file"; // Debugging output to check the file path

    $sql = "INSERT INTO employee(employee_id,first_name, last_name, dob, gender, city, state, country, marital_status, nationality, email, mobile, identity_document, identity_no, employment_type, joining_date, designation, department, pan, bank_name, bank_account_no, ifsc_code,password, photo_path) 
            VALUES ('$employee_id','$first_name', '$last_name', '$dob', '$gender', '$city', '$state', '$country', '$marital_status', '$nationality', '$email', '$mobile', '$identity_document', '$identity_no', '$employment_type', '$joining_date', '$designation', '$department', '$pan', '$bank_name', '$bank_account_no', '$ifsc_code','$hashedPassword', '$photo_path')";

    if ($conn->query($sql) === TRUE) {


        //     // echo '<script type="text/javascript">alert("Data added successfully!");</script>';
        //     // header("Location: empProfile.php");
        //     echo '<script type="text/javascript">

        //     alert("Data added successfully!");
        //     window.location.href = "empProfile.php"; // Redirect to employe.php
        //   </script>';
        $sqlUser = "INSERT INTO users(employee_id,password,role) VALUES ('$employee_id', '$hashedPassword','$role')";
        if ($conn->query($sqlUser) === TRUE) {

            echo '<script type="text/javascript">
            alert("Data added successfully!");
            var redirectOption = confirm("Send USERNAME & PASSWORD");
            if (redirectOption) {
                //window.location.href = "send_email.php"; 
                // Redirect to the login page
            } else {
               // You can add other actions here, like sending an email, or redirecting to a different page
                window.location.href = "empProfile.php";
            }
        </script>';
            // include 'send_email.php';


            try {
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
                $username = $employee_id;
                $password1 = $password;
                // Replace with the actual recipient's email address

                $result = sendEmail($username, $password1, $recipient_email);


                if ($result) {
                    // echo "Email sent successfully!";
                    echo '<script type="text/javascript">
            
                alert("Email sent successfully!");
                window.location.href = "empProfile.php"; // Redirect to employe.php
              </script>';

                } else {
                    // echo "Error sending email.";
                    echo '<script type="text/javascript">
            
                alert("Error sending email.");
                window.location.href = "empProfile.php"; // Redirect to employe.php
              </script>';

                }

            } catch (Exception $e) {
                // Handle exceptions thrown by PHPMailer
                echo "Error sending email: " . $e->getMessage();
            }
        }
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>