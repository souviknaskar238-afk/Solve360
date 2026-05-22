<?php
session_start();
include '../users/config.php';

if (!isset($_SESSION['ngo_id'])) {
    header("Location: ../login.php");
    exit();
}

$ngo_id = $_SESSION['ngo_id'];
$issue_id = $_POST['issue_id'] ?? null;

if ($issue_id) {
    $stmt = $conn->prepare("UPDATE issues SET resolution_status = 'pending', pending_ngo_id = ? WHERE id = ? AND resolution_status = 'unresolved' AND pending_ngo_id IS NULL");
    $stmt->bind_param("ii", $ngo_id, $issue_id);
    $stmt->execute();
}

$_SESSION['success_msg'] = "Resolution request has been sent to admin successfully.";
header("Location: assigned_issues.php");
exit();
?>