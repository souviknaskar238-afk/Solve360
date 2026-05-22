<?php
session_start();
require '../users/config.php';

if (!isset($_SESSION['ngo_id'])) {
    header("Location: ngo_login_register.php#login");
    exit();
}

$ngo_id = $_SESSION['ngo_id'];
$msg = "";

// Fetch NGO data
$stmt = $conn->prepare("SELECT * FROM ngos WHERE id = ?");
$stmt->bind_param("i", $ngo_id);
$stmt->execute();
$ngo = $stmt->get_result()->fetch_assoc();
$current_pic = $ngo['profile_picture'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'ngos/profile_pictures/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = time() . '_' . basename($_FILES['profile_picture']['name']);
        $file_path = $upload_dir . $file_name;

        move_uploaded_file($file_tmp, $file_path);

        if (!empty($current_pic) && file_exists($current_pic)) {
            unlink($current_pic);
        }

        $stmt = $conn->prepare("UPDATE ngos SET name = ?, phone = ?, location = ?, profile_picture = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $name, $phone, $location, $file_path, $ngo_id);
    } else {
        $stmt = $conn->prepare("UPDATE ngos SET name = ?, phone = ?, location = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $phone, $location, $ngo_id);
    }

    if ($stmt->execute()) {
        $msg = "Profile updated successfully!";
        $stmt = $conn->prepare("SELECT * FROM ngos WHERE id = ?");
        $stmt->bind_param("i", $ngo_id);
        $stmt->execute();
        $ngo = $stmt->get_result()->fetch_assoc();
    } else {
        $msg = "Error updating profile.";
    }
}
?><!DOCTYPE html><html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NGO Profile - Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
        background: url('../images/ngo_back.jpeg') no-repeat center center/cover;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
    }
    .profile-wrapper {
      flex-grow: 1;
      padding: 40px;
    }
    .transparent-box {
      background-color: rgba(0, 0, 0, 0.8);
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      max-width: 850px;
      margin: auto;
      color: white;
    }
    .profile-picture {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #fff;
    }
    .camera-upload {
      position: relative;
      display: inline-block;
    }
    .camera-icon {
      font-size: 1.5rem;
      color: #ccc;
      cursor: pointer;
      display: inline-block;
      margin-top: 8px;
    }
    .camera-upload input[type="file"] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
 .sidebar {
            background-color: #343a40;
            min-height: 100vh;
        }
        .sidebar .nav-link {
            color: #ffffff;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: #495057;
            border-radius: 4px;
        }
        .sidebar h4 {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
  </style>
</head>
<body>
<?php include '../users/user_header.php'; ?>
      <div class="container-fluid">
    <div class="row">
             <!-- Sidebar -->
<!-- Toggle Button (Hamburger) -->
<nav class="navbar navbar-dark bg-dark d-md-none">
  <div class="container-fluid">
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#userSidebar" aria-controls="userSidebar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Sidebar -->
<div class="collapse d-md-block col-md-3 col-lg-2  sidebar p-3" id="userSidebar">
  <h4 class="text-white mb-4">
   <i class="bi bi-building fs-4 me-2"></i> Solve360-NGO
  </h4>
  <hr class="text-white">
 <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="ngo_dash.php" class="nav-link  text-white">
          <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
      </li>
      <hr class="text-white">
      <li><a href="ngo_profile.php" class="nav-link bg-primary text-white"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
     <hr class="text-white">
      <li>
      <a href="ngo_panel.php" class="nav-link text-white">
        <i class="bi bi-gear me-2"></i>
        NGO Panel
      </a>
    </li>
    <hr class="text-white">
    <li>
      <a href="ngo_feedback.php" class="nav-link text-white">
       <i class="fas fa-comment-dots"></i>
        Feedback
      </a>
    </li>
    <hr class="text-white">
      <li><a href="ngo_logout.php" class="nav-link text-white"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
    </ul>
    <hr class="text-white">
    <div class="text-center small text-secondary">&copy; Solve360 2025</div>
</div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
  <div class="profile-wrapper">
    <div class="transparent-box" data-aos="fade-left">
      <h3 class="text-center mb-4"><u>NGO Profile</u></h3>
      <?php if ($msg): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <?= htmlspecialchars($msg) ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <form method="POST" enctype="multipart/form-data">
        <div class="text-center mb-3">
          <img id="profilePreview" src="<?= htmlspecialchars($ngo['profile_picture'] ?: 'default.png') ?>" class="profile-picture mb-2" alt="Profile Picture">
          <hr>
          <div class="camera-upload">
            <span class="camera-icon"><i class="bi bi-camera-fill"></i></span>
            <input type="file" name="profile_picture" accept="image/*">
          </div>
        </div>
        <div class="mb-3">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($ngo['name']) ?>" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" class="form-control" value="<?= htmlspecialchars($ngo['email']) ?>" disabled>
        </div>
        <div class="mb-3">
          <label>Phone</label>
          <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($ngo['phone']) ?>" required>
        </div>
        <div class="mb-3">
          <label>Location</label>
          <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($ngo['location']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Update Profile</button>
      </form>
    </div>
  </div>
</div>
     </main>
    </div>
</div>
<script>
  document.querySelector('input[name="profile_picture"]').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('profilePreview');
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script> AOS.init(); </script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
<?php include '../home/footer.php'; ?>
</body>
</html>