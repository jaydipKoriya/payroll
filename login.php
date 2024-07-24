<?php
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["employee_id"];
    $password = md5(trim($_POST["password"]));
    $role = $_POST["role"];

    // Check if a valid username and password were provided
    if (!empty($user_id) && !empty($password)) {
        // Query the database to retrieve the hashed password for the given user
        $sql = "SELECT password FROM users WHERE role = ? AND employee_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $role, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // User exists in the database
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            // Verify the provided password against the hashed password
            if ($password == $hashedPassword) {
                // Passwords match, set session variables and redirect
                $_SESSION['employee_id'] = $user_id;
                $_SESSION['role'] = $role;
                echo "Login successful.";
                header("Location: check.php"); // Redirect to dashboard or user-specific page
            } else {
                echo '<script type="text/javascript">
                    alert("Login failed. Please check your credentials!");
                    window.location.href = "login.html"; // Redirect to login page
                </script>';
            }
        } else {
            echo '<script type="text/javascript">
                alert("Login failed. User not found.");
                window.location.href = "login.html"; // Redirect to login page
            </script>';
        }
    }
}
?>
<!-- if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            echo "Login successful.";
        } else {
            echo "Invalid username or password.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} -->