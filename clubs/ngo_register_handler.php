<?php
session_start();
include '../users/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name         = $_POST['name'];
    $email        = $_POST['email'];
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone        = $_POST['phone'];
    $location     = $_POST['location'];
    $service_area = $_POST['service_area'];
    $latitude     = $_POST['latitude'];
    $longitude    = $_POST['longitude'];

    $sql = "INSERT INTO ngos (name, email, password, phone, location, service_area, latitude, longitude) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdd", $name, $email, $password, $phone, $location, $service_area, $latitude, $longitude);

    if ($stmt->execute()) {
        $_SESSION['register_success'] = "Registered successfully! Please login.";
        header("Location: ngo_login_register.php#login");
        exit();
    } else {
        $_SESSION['register_success'] = "Error: " . $stmt->error;
        header("Location: ngo_login_register.php#register");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ngo_login_register.php");
    exit();
}
?>