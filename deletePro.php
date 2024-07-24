<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];
} else {
    echo "Invalid employee ID.";
    exit;
}

// Begin a transaction
$conn->begin_transaction();

// SQL statements for deleting from all three tables
$sql_employee = "DELETE FROM employee WHERE employee_id = '$employee_id'";
$sql_salary_info = "DELETE FROM salary_info WHERE employee_id = '$employee_id'";
$sql_user = "DELETE FROM users WHERE employee_id = '$employee_id'";

// Prepare and execute the employee deletion query
$stmt_employee = $conn->prepare($sql_employee);
$stmt_employee->bind_param("i", $employee_id);
$employee_deleted = $stmt_employee->execute();

// Prepare and execute the salary_info deletion query
$stmt_salary_info = $conn->prepare($sql_salary_info);
$stmt_salary_info->bind_param("i", $employee_id);
$salary_info_deleted = $stmt_salary_info->execute();

// Prepare and execute the user deletion query
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $employee_id);
$user_deleted = $stmt_user->execute();

if ($employee_deleted && $salary_info_deleted && $user_deleted) {
    // All records have been successfully deleted.
    $conn->commit();
    echo "<script>alert('Employee with ID $employee_id, related salary info, and user have been deleted.');</script>";
} else {
    // An error occurred during deletion.
    $conn->rollback();
    echo "<script>alert('Error deleting the employee, salary info, and user: " . $stmt_employee->error . "');</script>";
}

// Close the prepared statements
$stmt_employee->close();
$stmt_salary_info->close();
$stmt_user->close();

if ($_SESSION['role'] == 'admin') {
    // If the user is an admin, they will be redirected to the admin page
    header("Location: admin.php");
    exit;
} elseif ($_SESSION['role'] == 'finance') {
    // If the user is an employee, they will be shown the employee section
    // Your existing code for displaying the employee section goes here
    header("Location: fteam.php");
} 

?>


  
   