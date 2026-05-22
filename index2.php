<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "project");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin data
$admins = [
    ["Souvik Naskar", "souvik@gmail.com", "souvik%123"],
    ["Swarnava Das", "swarnava@gmail.com", "swarnava%123"],
    ["Subhrojyoti Halder", "subhro@gmail.com", "subhro%123"]
];

foreach ($admins as $admin) {
    $name = $admin[0];
    $email = $admin[1];
    $plainPassword = $admin[2];
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashedPassword);
    $stmt->execute();
}

echo "Admins inserted successfully.";

$conn->close();
?>