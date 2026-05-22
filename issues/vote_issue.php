<?php
session_start();
require_once '../users/config.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['issue_id'])) {
    header("Location: pending_issues.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$issue_id = intval($_POST['issue_id']);

// Try inserting a new vote (only one per user per issue allowed)
$stmt = $conn->prepare("INSERT IGNORE INTO votes (user_id, issue_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $issue_id);
$stmt->execute();

header("Location: user_all_pending_issues.php");
exit();