<?php
session_start();
include '../users/config.php';

if (!isset($_GET['id'])) {
    header("Location: manage_ngos.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM ngos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['message'] = "NGO deleted successfully.";
} else {
    $_SESSION['message'] = "Failed to delete NGO.";
}

header("Location: manage_ngo.php");
exit();
?>