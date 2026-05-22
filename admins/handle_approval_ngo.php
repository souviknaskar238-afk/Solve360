<?php
session_start();
include '../users/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ngo_id = intval($_POST['ngo_id']);
    $action = $_POST['action'];

    if ($action == 'verify') {
        $sql = "UPDATE ngos SET is_verified = 1 WHERE id = ?";
    } elseif ($action == 'reject') {
        $sql = "DELETE FROM ngos WHERE id = ?";
    } else {
        header("Location: manage_ngo.php");
        exit();
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ngo_id);

    if ($stmt->execute()) {
        $_SESSION['verification_message'] = "Action completed successfully.";
    } else {
        $_SESSION['verification_message'] = "Error. Please try again.";
    }

    $stmt->close();
    $conn->close();

    header("Location: manage_ngo.php");
    exit();
} else {
    header("Location: manage_ngo.php");
    exit();
}
?>