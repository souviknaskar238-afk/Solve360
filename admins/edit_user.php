<?php include '../users/user_header.php'; ?>
<?php
session_start();
include '../users/config.php';

if (!isset($_GET['id'])) {
    $_SESSION['user_message'] = "No user ID specified.";
    header("Location: manage_users.php");
    exit();
}

$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    $_SESSION['user_message'] = "User not found.";
    header("Location: manage_users.php");
    exit();
}

$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $update_sql = "UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $name, $email, $phone, $address, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['user_message'] = "User updated successfully.";
        header("Location: manage_users.php");
        exit();
    } else {
        $error = "Error updating user: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User - Solve360</title>
    <style>
  body {
    background: linear-gradient(to bottom,rgb(49, 110, 207), #dff1ff)!important;
  }
  .outer-card {
    background: linear-gradient(to bottom,rgb(85, 86, 87),rgb(85, 87, 88))!important;
  }
</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow-lg outer-card" style="max-width: 700px; margin: auto;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">Edit User</h4>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-white">Full Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Address</label>
                    <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($user['address']) ?></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="manage_users.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include '../home/footer.php'; ?>