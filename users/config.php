<?php
$host = "localhost"; // or your host
$username = "root"; // your DB username
$password = ""; // your DB password
$database = "project"; // your DB name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>