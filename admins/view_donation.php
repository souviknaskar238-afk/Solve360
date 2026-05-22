<?php
session_start();

include '../users/config.php';

// Fetch all donation records with donor name
$sql = "SELECT d.id, u.name AS user_name, d.amount, d.cause, d.contact_info, d.message, d.donated_at 
        FROM donations d
        JOIN users u ON d.user_id = u.id
        ORDER BY d.donated_at DESC";
$result_donations = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Donations - Solve360</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5.3.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Font Awesome (for extra icons like donate) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
       body {
            background: linear-gradient(135deg, #1d3557, #457b9d);
            background-size: cover;
        }

        .card {
            border-radius: 1rem;
        }
        .table th, .table td {
            vertical-align: middle !important;
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
      <a href="view_ngo_feedback.php" class="nav-link text-white">
        <i class="bi bi-chat-right-text-fill me-2"></i> NGO Feedback
      </a>
    </li>
    <hr class="text-white">
     <li>
      <a href="view_donation.php" class="nav-link bg-primary text-white">
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
<div class="container mt-5 mb-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0">All Donations</h4>
        </div>
        <div class="card-body">
            <?php if ($result_donations->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Donor</th>
                                <th>Amount (₹)</th>
                                <th>Cause</th>
                                <th>Contact Info</th>
                                <th>Message</th>
                                <th>Donated On</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_donations->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                                    <td><?= number_format($row['amount'], 2) ?></td>
                                    <td><?= htmlspecialchars($row['cause']) ?></td>
                                    <td><?= htmlspecialchars($row['contact_info']) ?></td>
                                    <td><?= $row['message'] ? htmlspecialchars($row['message']) : '—' ?></td>
                                    <td><?= date('d M Y, h:i A', strtotime($row['donated_at'])) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center text-muted">
                    <p>No donations have been made yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</main>
    </div>
</div>
<?php include '../home/footer.php';?>
</body>
</html>