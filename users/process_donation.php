<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login_register.php");
    exit();
}

include '../users/config.php'; // Update with your DB connection file

$user_id = $_SESSION['user_id'];
$amount = $_POST['amount'];
$cause = $_POST['cause'];
$contact_info = $_POST['contact_info'];
$message = $_POST['message'] ?? '';

$stmt = $conn->prepare("INSERT INTO donations (user_id, amount, cause, contact_info, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("idsss", $user_id, $amount, $cause, $contact_info, $message);

if ($stmt->execute()) {
    header("Location: donate.php?status=success");
} else {
    header("Location: donate.php?status=fail&message=" . urlencode("Donation failed. Try again."));
}
?>