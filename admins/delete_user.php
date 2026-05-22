<?php
include '../users/config.php';

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$id = intval($_GET['id']);

$delete = "DELETE FROM users WHERE id = $id";
if (mysqli_query($conn, $delete)) {
    header("Location: manage_users.php");
    exit;
} else {
    echo "Failed to delete user.";
}
?>