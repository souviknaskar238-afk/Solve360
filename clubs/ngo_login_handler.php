<?php
session_start();
include '../users/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM ngos WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $ngo = $result->fetch_assoc();

        // Check if NGO is verified
        if ($ngo['is_verified'] == 1) {
            if (password_verify($password, $ngo['password'])) {
                $_SESSION['ngo_id']   = $ngo['id'];
                $_SESSION['ngo_name'] = $ngo['name'];
                header("Location: ngo_dash.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Incorrect password.";
                header("Location: ngo_login_register.php#login");
                exit();
            }
        } else {
            $_SESSION['login_error'] = "Your account is not verified yet. Please wait for admin approval.";
            header("Location: ngo_login_register.php#login");
            exit();
        }

    } else {
        $_SESSION['login_error'] = "No NGO found with that email.";
        header("Location: ngo_login_register.php#login");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ngo_login_register.php");
    exit();
}
?>