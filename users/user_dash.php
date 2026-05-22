<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login_register.php#login");
    exit();
}
?>

<?php
include 'config.php'; // your DB connection file

$user_id = $_SESSION['user_id'];

// Get Total Reports
$total_sql = "SELECT COUNT(*) AS total FROM issues WHERE user_id = ?";
$stmt = $conn->prepare($total_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total_result = $stmt->get_result()->fetch_assoc()['total'];

// Get Pending Issues
$pending_sql = "SELECT COUNT(*) AS pending FROM issues WHERE user_id = ? AND status = 'approved' AND resolution_status = 'unresolved'";
$stmt = $conn->prepare($pending_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$pending_result = $stmt->get_result()->fetch_assoc()['pending'];

// Get Resolved Issues
$resolved_sql = "SELECT COUNT(*) AS resolved FROM issues WHERE user_id = ? AND resolution_status = 'resolved'";
$stmt = $conn->prepare($resolved_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$resolved_result = $stmt->get_result()->fetch_assoc()['resolved'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Dashboard - Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background: url('../images/user_back.jpg') no-repeat center center/cover;
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
<?php include 'user_header.php';?>
  
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
    <i class="bi bi-person-circle"></i> Solve360-User
  </h4>
  <hr class="text-white">
  <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="user_dash.php" class="nav-link bg-primary text-white">
          <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
      </li>
      <hr class="text-white">
    
      <li><a href="donate.php" class="nav-link  text-white"><i class="fas fa-donate"></i> Donate</a></li>
      <hr class="text-white">
      <li><a href="user_profile.php" class="nav-link text-white"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
      <hr class="text-white">
      <li><a href="user_panel.php" class="nav-link  text-white"><i class="bi bi-gear me-2"></i> User Panel</a></li>
      <hr class="text-white">
      <li><a href="user_feedback.php" class="nav-link text-white"><i class="fas fa-comment-dots"></i>  Feedback</a></li>
      <hr class="text-white">
      <li><a href="logout.php" class="nav-link text-white"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
      

    </ul>
    <hr class="text-white">
    <div class="text-center small text-secondary">&copy; Solve360 2025</div>
</div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

  <div class="flex-grow-1 p-4">
  <div class="dashboard-container" data-aos="fade-left">
    <h2 class="mb-4">Welcome back, User!</h2>
    <p>This is your dashboard where you can see a quick overview and access your reports, profile, and more.</p>
    <div class="row mt-4">
      <div class="col-md-4 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <h5 class="card-title">Total Reports</h5>
            <p class="card-text display-6"><?php echo $total_result; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <h5 class="card-title">Approved By Admin</h5>
            <p class="card-text display-6"><?php echo $pending_result; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card bg-dark text-light">
          <div class="card-body">
            <h5 class="card-title">Resolved By NGOs</h5>
            <p class="card-text display-6"><?php echo $resolved_result; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  </main>
    </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>
<?php include '../home/footer.php'; ?>