<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<?php
include '../users/config.php'; // Make sure this connects to your database

// Get total users
$userResult = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM users");
$userRow = mysqli_fetch_assoc($userResult);
$totalUsers = $userRow['total_users'];

// Get total NGOs
$ngoResult = mysqli_query($conn, "SELECT COUNT(*) AS total_ngos FROM ngos");
$ngoRow = mysqli_fetch_assoc($ngoResult);
$totalNgos = $ngoRow['total_ngos'];

// Get total reports/issues
$issueResult = mysqli_query($conn, "SELECT COUNT(*) AS total_issues FROM issues");
$issueRow = mysqli_fetch_assoc($issueResult);
$totalIssues = $issueRow['total_issues'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard - Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
   <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Font Awesome (for extra icons like donate) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background: url('../images/admin_back_final.jpg') no-repeat center center/cover;
      margin: 0;
      padding: 0;
    }
    .dashboard-container {
      backdrop-filter: blur(10px);
      background-color: rgba(0, 0, 0, 0.8);
      border-radius: 1rem;
      padding: 2rem;
      color: white;
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
<!-- header -->
<?php include '../users/user_header.php';?>
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
    <i class="bi bi-shield-lock-fill me-2"></i> Solve360-Admin
  </h4>
  <hr class="text-white">
  <ul class="nav nav-pills flex-column mb-auto">
    
    <li class="nav-item">
      <a href="admin_dash.php" class="nav-link bg-primary text-white">
        <i class="bi bi-house-door me-2"></i> Dashboard
      </a>
    </li>
    <hr class="text-white">

    <li>
      <a href="manage_users.php" class="nav-link text-white">
        <i class="bi bi-people-fill me-2"></i> Manage Users
      </a>
    </li>
    <hr class="text-white">

    <li>
      <a href="pending_issues.php" class="nav-link text-white">
        <i class="bi bi-exclamation-circle-fill me-2"></i> User Issues
      </a>
    </li>
    <hr class="text-white">

    <li>
      <a href="view_user_feedback.php" class="nav-link  text-white">
        <i class="bi bi-chat-left-dots-fill me-2"></i> User Feedback
      </a>
    </li>
    <hr class="text-white">

    <li>
      <a href="manage_ngo.php" class="nav-link text-white">
        <i class="bi bi-building me-2"></i> Manage NGOs
      </a>
    </li>
    <hr class="text-white">

    <li>
      <a href="ngo_issues.php" class="nav-link text-white">
        <i class="bi bi-geo-alt-fill me-2"></i> NGO Issues
      </a>
    </li>
    <hr class="text-white">

    <li>
      <a href="view_ngo_feedback.php" class="nav-link text-white">
        <i class="bi bi-chat-right-text-fill me-2"></i> NGO Feedback
      </a>
    </li>
    <hr class="text-white">
     <li>
      <a href="view_donation.php" class="nav-link text-white">
        <i class="fas fa-donate"></i> View Donations
      </a>
    </li>
    <hr class="text-white">

    <li>
      <a href="admin_logout.php" class="nav-link text-white">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
      </a>
    </li>
  </ul>
  <hr class="text-white">
  <div class="text-center small text-secondary">&copy; Solve360 2025</div>
</div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

    <div class="flex-grow-1 p-4">
  <div class="dashboard-container">
    <h2 class="mb-4">Welcome back, Admin!</h2>
    <p>This is your admin dashboard where you can manage users, NGOs, reports, and more.</p>
    <div class="row mt-4">
      <div class="col-md-4 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <h5 class="card-title">Total Users</h5>
            <p class="card-text display-6"><?php echo $totalUsers; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <h5 class="card-title">Total NGOs</h5>
            <p class="card-text display-6"><?php echo $totalNgos; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <h5 class="card-title">Total Reports</h5>
            <p class="card-text display-6"><?php echo $totalIssues; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </main>
    </div>
</div>
</body>
</html>
<?php include '../home/footer.php'; ?>