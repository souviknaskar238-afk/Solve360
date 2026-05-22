<?php
session_start();
include '../users/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from_type = $_POST['from'];
    $rating = intval($_POST['rating']);
    $message = trim($_POST['feedback']);

    if ($rating < 1 || $rating > 5 || empty($message)) {
        $_SESSION['feedback_error'] = "Please provide a valid rating and feedback message.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $stmt = null;

    if ($from_type === 'user' && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("INSERT INTO feedback (from_type, user_id, rating, message) VALUES ('user', ?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $rating, $message);

    } elseif ($from_type === 'ngo' && isset($_SESSION['ngo_id'])) {
        $ngo_id = $_SESSION['ngo_id'];
        $stmt = $conn->prepare("INSERT INTO feedback (from_type, ngo_id, rating, message) VALUES ('ngo', ?, ?, ?)");
        $stmt->bind_param("iis", $ngo_id, $rating, $message);

    } else {
        $_SESSION['feedback_error'] = "Unauthorized access.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if ($stmt && $stmt->execute()) {
        $_SESSION['feedback_success'] = "Feedback submitted successfully!";
    } else {
        $_SESSION['feedback_error'] = "Error submitting feedback. Please try again.";
    }

    $stmt->close();
    $conn->close();

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>