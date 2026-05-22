<?php
session_start();
require_once '../users/config.php'; // DB connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: ../users/user_login_handler.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Optional: convert lat/lng to readable location using API if needed
    $location = "Lat: $latitude, Lng: $longitude";

    // Insert issue
    $stmt = $conn->prepare("INSERT INTO issues (user_id, title, description, location, latitude, longitude, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("isssdd", $user_id, $title, $description, $location, $latitude, $longitude);
    
    if ($stmt->execute()) {
        $issue_id = $stmt->insert_id;

        // Handle media uploads
        $upload_dir = "uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['media']['tmp_name'] as $index => $tmp_name) {
            $filename = basename($_FILES['media']['name'][$index]);
            $stored_filename = time() . "_" . $filename;
            $target_file = $upload_dir . $stored_filename;
            $file_type = mime_content_type($tmp_name);

            if (move_uploaded_file($tmp_name, $target_file)) {
                $media_type = strpos($file_type, 'video') !== false ? 'video' : 'image';

                $media_stmt = $conn->prepare("INSERT INTO media (issue_id, file_path, media_type) VALUES (?, ?, ?)");
                $media_stmt->bind_param("iss", $issue_id, $stored_filename, $media_type);
                $media_stmt->execute();
            }
        }
        $_SESSION['success'] = "Issue submitted successfully and sent for admin approval.";
         header("Location: post_issue.php");
        exit;

        
    } else {
        $_SESSION['error'] = "Failed to submit issue. Please try again.";
        header("Location: post_issue.php");
    }
}
?>