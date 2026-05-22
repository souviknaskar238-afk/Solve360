<?php
session_start();
include '../users/config.php'; // This file should connect to your database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Query to check admin credentials
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If admin exists
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
       



        // Verify password
        if (password_verify($password, $admin['password'])) {
            // Set admin session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];
            $_SESSION['admin_name'] = $admin['name'];

            // Redirect to admin dashboard
            header('Location: admin_dash.php');
            exit();
        } else {
            $_SESSION['admin_login_error'] = "Invalid password.";
            header('Location: admin_login.php');
            exit();
        }
    } else {
        $_SESSION['admin_login_error'] = "Admin account not found.";
        header('Location: admin_login.php');
        exit();
    }
} else {
    header('Location: admin_login.php');
    exit();
}
?>