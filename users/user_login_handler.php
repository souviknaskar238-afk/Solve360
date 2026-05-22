<?php
session_start();
include 'config.php';

$email    = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: user_dash.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Incorrect password.";
        header("Location: user_login_register.php?login=error#login");
        exit();
    }
} else {
    $_SESSION['login_error'] = "No user found with that email.";
    header("Location: user_login_register.php?login=error#login");
    exit();
}

$stmt->close();
$conn->close();
?>