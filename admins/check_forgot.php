<?php
session_start();
include '../users/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $type = $_POST['account_type'];

    $table = ($type === 'ngo') ? 'ngos' : 'users';

    $stmt = $conn->prepare("SELECT * FROM $table WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $_SESSION['success'] = "A reset link has been sent to your email.";
    } else {
        $_SESSION['error'] = "No account found with that email.";
    }

    $stmt->close();
    $conn->close();
}

header("Location: forgot_password.php");
exit;