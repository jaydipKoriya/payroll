<?php
include 'connection.php';
session_start();


if ($_SESSION['role'] == 'admin') {
    // If the user is an admin, they will be redirected to the admin page
    header("Location: admin.php");
    exit;
} elseif ($_SESSION['role'] == 'employee') {
    // If the user is an employee, they will be shown the employee section
    // Your existing code for displaying the employee section goes here
    header("Location: profile.php");
} 
elseif ($_SESSION['role'] == 'finance') {
    // If the user is an employee, they will be shown the employee section
    // Your existing code for displaying the employee section goes here
    header("Location: fteam.php");
}
?>