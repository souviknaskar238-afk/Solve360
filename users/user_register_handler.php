<?php
session_start();
include 'config.php';

$name     = $_POST['name'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone    = $_POST['phone'];
$address  = $_POST['address'];

$sql = "INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $password, $phone, $address);

if ($stmt->execute()) {
    $_SESSION['register_success'] = "Registered successfully! Please log in.";
    header("Location: user_login_register.php?registered=1#login");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>