<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login_register.php#login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Panel - Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

   <!-- AOS CSS -->
   <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <style>
    body {
      background: url('../images/user_back.jpg') no-repeat center center/cover;
      margin: 0;
      padding: 0;
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
    .overlay {
      background-color: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 40px;
      margin-top: 50px;
      box-shadow: 0 8px 32px rgba(31, 38, 135, 0.3);
    }

    .card-box {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 15px;
      padding: 25px;
      text-align: center;
      transition: all 0.3s ease-in-out;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      height: 100%;
    }

    .card-box:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateY(-5px);
    }

    .card-box h5 {
      font-weight: bold;
      margin-top: 15px;
    }

    .card-box i {
      font-size: 35px;
      color: #0d6efd;
    }

    .main-content {
      margin-left: 250px;
      padding: 20px;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>
  <!-- header -->
  <?php include 'user_header.php';?>


    <!-- sidebar -->
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
        <a href="user_dash.php" class="nav-link  text-white">
          <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
      </li>
      <hr class="text-white">
    
      <li><a href="donate.php" class="nav-link  text-white"><i class="fas fa-donate"></i> Donate</a></li>
      <hr class="text-white">
      <li><a href="user_profile.php" class="nav-link text-white"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
      <hr class="text-white">
      <li><a href="user_panel.php" class="nav-link bg-primary text-white"><i class="bi bi-gear me-2"></i> User Panel</a></li>
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


    <!-- main content -->
    <div class="main-content container"data-aos="fade-up">
      <div class="overlay text-white">
        <h2 class="text-center mb-4">User Panel</h2>
      <!-- Top Row: Your Issues Summary -->
<div class="row g-4 mb-4">
  <div class="col-md-6 col-lg-4">
    <a href="user_pending_issues.php" class="text-decoration-none text-white">
      <div class="card-box h-100">
        <i class="bi bi-clock-history"></i>
        <h5>Your Pending Issues</h5>
        <p class="text-light">Issues you've submitted, awaiting admin approval.</p>
      </div>
    </a>
  </div>
  <div class="col-md-6 col-lg-4">
    <a href="user_approved_issues.php" class="text-decoration-none text-white">
      <div class="card-box h-100">
        <i class="bi bi-check2-square"></i>
        <h5>Your Approved Issues</h5>
        <p class="text-light">Issues approved by admin but not yet resolved.</p>
      </div>
    </a>
  </div>
  <div class="col-md-6 col-lg-4">
    <a href="user_resolved_issues.php" class="text-decoration-none text-white">
      <div class="card-box h-100">
        <i class="bi bi-check-circle-fill"></i>
        <h5>Your Resolved Issues</h5>
        <p class="text-light">Issues that have been successfully resolved.</p>
      </div>
    </a>
  </div>
</div>

<!-- Bottom Row: Actions and Feeds -->
<div class="row g-4">
  <div class="col-md-6 col-lg-4">
    <a href="../issues/post_issue.php" class="text-decoration-none text-white">
      <div class="card-box h-100">
        <i class="bi bi-exclamation-circle"></i>
        <h5>Report an Issue</h5>
        <p class="text-light">Submit a new local issue with photos and location.</p>
      </div>
    </a>
  </div>
  <div class="col-md-6 col-lg-4">
    <a href="../issues/user_all_pending_issues.php" class="text-decoration-none text-white">
      <div class="card-box h-100">
        <i class="bi bi-hourglass-split"></i>
        <h5>All Pending Issues Feed</h5>
        <p class="text-light">See what's under admin review across the platform.</p>
      </div>
    </a>
  </div>
  <div class="col-md-6 col-lg-4">
    <a href="../issues/user_all_resolved_issues.php" class="text-decoration-none text-white">
      <div class="card-box h-100">
        <i class="bi bi-patch-check-fill"></i>
        <h5>All Resolved Issues Feed</h5>
        <p class="text-light">Explore issues resolved around your area.</p>
      </div>
    </a>
  </div>
</div>
      </div>
    </div>
     </main>
    </div>
</div>

  <?php include '../home/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>