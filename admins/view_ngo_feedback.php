<?php
include '../users/config.php';
include '../users/user_header.php'; // Or any common header

$result = $conn->query("
    SELECT f.*, n.name AS ngo_name 
    FROM feedback f 
    JOIN ngos n ON f.ngo_id = n.id 
    WHERE f.from_type = 'ngo' 
    ORDER BY f.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NGO Feedback | Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Font Awesome (for extra icons like donate) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
     body {
            background: linear-gradient(135deg, #1d3557, #457b9d);
            background-size: cover;
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
<body >
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
      <a href="admin_dash.php" class="nav-link  text-white">
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
      <a href="view_ngo_feedback.php" class="nav-link bg-primary text-white">
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

  <div class="container mt-5">
    <h3 class="mb-4 text-center text-white"><u>NGO Feedback</u></h3>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>NGO</th>
            <th>Rating</th>
            <th>Feedback</th>
            <th>Submitted At</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['ngo_name']) ?></td>
              <td><?= str_repeat("★", $row['rating']) ?><?= str_repeat("☆", 5 - $row['rating']) ?></td>
              <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
              <td><?= $row['created_at'] ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  </main>
    </div>
</div>
<?php include '../home/footer.php';?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>