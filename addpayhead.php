<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $payheadName = $_POST['payhead_name'];
    $payheadDesc = $_POST['payhead_desc'];
    $payheadType = $_POST['payhead_type'];
    $payheadAmount = $_POST['payhead_amount'];

    // Perform necessary validation here

    // Insert data into the database table
    $sql = "INSERT INTO payhead (payhead_name, payhead_desc, payhead_type, payhead_amount) 
            VALUES ('$payheadName', '$payheadDesc', '$payheadType', $payheadAmount)";

    // Execute the SQL query (make sure to handle errors)
    if ($conn->query($sql) === TRUE) {
        // Data added successfully
        // echo '<script type="text/javascript">alert("Data added successfully!");</script>';
        echo '<script type="text/javascript">
        alert("Data added successfully!");
        window.location.href = "payhead.php"; // Redirect to employe.php
      </script>';
    } else {
        // Error occurred
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}
?>