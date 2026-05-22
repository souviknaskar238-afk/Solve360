<?php
session_start();
include '../users/config.php';

if (!isset($_GET['id'])) {
    header("Location: manage_ngos.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM ngos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("Location: manage_ngos.php");
    exit();
}

$ngo = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $service_area = trim($_POST['service_area']);

    $update_sql = "UPDATE ngos SET name=?, email=?, phone=?, location=?, service_area=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $name, $email, $phone, $location, $service_area, $id);

    if ($update_stmt->execute()) {
        $_SESSION['message'] = "NGO updated successfully.";
        header("Location: manage_ngos.php");
        exit();
    } else {
        $error = "Failed to update NGO.";
    }
}
?>

<?php include '../users/user_header.php'; ?>
<style>
  body {
    background: linear-gradient(to bottom,rgb(49, 110, 207), #dff1ff)!important;
  }
  .outer-card {
    background: linear-gradient(to bottom,rgb(85, 86, 87),rgb(85, 87, 88))!important;
  }
</style>
<div class="container mt-5">
    <div class="card shadow-lg outer-card" style="max-width: 700px; margin: auto;">
        <div class="card-header bg-primary text-white text-center">
            <h4>Edit NGO Details</h4>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger text-center"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-white">NGO Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($ngo['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($ngo['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($ngo['phone']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Location</label>
                    <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($ngo['location']) ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="manage_ngo.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Update NGO</button>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
<?php include '../home/footer.php'; ?>