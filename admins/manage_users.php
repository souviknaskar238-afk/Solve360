<?php
session_start();
include '../users/config.php';
include '../users/user_header.php';

// Fetch all users
$sql_users = "SELECT id, name, email, phone, address, created_at FROM users";
$result_users = $conn->query($sql_users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Solve360 Admin</title>
    <style>
    body {
            background: linear-gradient(135deg, #1d3557, #457b9d);
            background-size: cover;
        }
  .outer-card {
    background: linear-gradient(to bottom,rgb(85, 86, 87),rgb(85, 87, 88))!important;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Font Awesome (for extra icons like donate) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
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
      <a href="admin_dash.php" class="nav-link text-white">
        <i class="bi bi-house-door me-2"></i> Dashboard
      </a>
    </li>
    <hr class="text-white">

    <li>
      <a href="manage_users.php" class="nav-link bg-primary text-white">
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
      <a href="manage_ngo.php" class="nav-link   text-white">
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
<div class="container my-5">
    <?php if (isset($_SESSION['user_message'])): ?>
        <div class="alert alert-success text-center">
            <?= $_SESSION['user_message']; unset($_SESSION['user_message']); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0">All Registered Users</h4>
        </div>
        <div class="card-body">
            <?php if ($result_users->num_rows > 0): ?>
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-bordered align-middle text-center table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Registered On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result_users->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['phone']) ?></td>
                                    <td><?= htmlspecialchars($row['address']) ?></td>
                                    <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile view: show each user as a card -->
                <div class="d-md-none">
                    <?php $result_users->data_seek(0); while($row = $result_users->fetch_assoc()): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                                <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
                                <p><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></p>
                                <p><strong>Registered On:</strong> <?= date('d M Y', strtotime($row['created_at'])) ?></p>
                                <div class="d-flex gap-2">
                                    <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary w-100">Edit</a>
                                    <a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger w-100" onclick="return confirm('Delete this user?')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-muted">No registered users found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<hr>
    </main>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
include '../home/footer.php';
?>