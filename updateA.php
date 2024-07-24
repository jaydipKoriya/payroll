<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['emp_id'];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $marital_status = $_POST["marital_status"];
    $nationality = $_POST["nationality"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $identity_document = $_POST["identity_document"];
    $identity_no = $_POST["identity_no"];
    $employment_type = $_POST["employment_type"];
    $joining_date = $_POST["joining_date"];
    $designation = $_POST["designation"];
    $department = $_POST["department"];
    $pan = $_POST["pan"];
    $bank_name = $_POST["bank_name"];
    $bank_account_no = $_POST["bank_account_no"];
    $ifsc_code = $_POST["ifsc_code"];
    // Rest of your code to retrieve form data...

    // Create the SQL query using a prepared statement
    $sql = "UPDATE employee SET 
            first_name=?, last_name=?, dob=?, gender=?, city=?, state=?, country=?,
            marital_status=?, nationality=?, email=?, mobile=?, identity_document=?, 
            identity_no=?, employment_type=?, joining_date=?, designation=?, department=?, 
            pan=?, bank_name=?, bank_account_no=?, ifsc_code=?
        WHERE employee_id=?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "ssssssssssssssssssssss",
            $first_name,
            $last_name,
            $dob,
            $gender,
            $city,
            $state,
            $country,
            $marital_status,
            $nationality,
            $email,
            $mobile,
            $identity_document,
            $identity_no,
            $employment_type,
            $joining_date,
            $designation,
            $department,
            $pan,
            $bank_name,
            $bank_account_no,
            $ifsc_code,
            $employee_id
        );

        //     if ($stmt->execute()) {
        //         // Data updated successfully
        //         echo '<script type="text/javascript">
        //             alert("Data Updated successfully!");
        //             window.location.href = "editProfile.php"; // Redirect to employe.php
        //         </script>';
        //     } else {
        //         echo "Error updating data: " . $stmt->error;
        //     }

        //     $stmt->close();
        // } else {
        //     echo "Error in preparing the SQL statement: " . $conn->error;
        // }
        if ($stmt->execute()) {
            //     // Data updated successfully
            //     header("Location: editProfile.php");
            // } else {
            //     echo "Error updating data: " . $stmt->error;

            echo '<script type="text/javascript">
        
            alert("Data Updated successfully!");
            window.location.href = "admin.php"; // Redirect to employe.php
        </script>';
        } else {
            echo "Error updating data: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>