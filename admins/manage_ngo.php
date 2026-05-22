<?php
session_start();
include '../users/config.php';
include '../users/user_header.php';

// Fetch NGOs
$sql_pending = "SELECT id, name, email, phone, location, service_area FROM ngos WHERE is_verified = 0";
$result_pending = $conn->query($sql_pending);

$sql_all = "SELECT id, name, email, phone, location, service_area FROM ngos WHERE is_verified = 1";
$result_all = $conn->query($sql_all);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage NGOs - Solve360 Admin</title>
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
      <a href="manage_ngo.php" class="nav-link  bg-primary text-white">
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
<div class="container mt-5">
    <?php if (isset($_SESSION['verification_message'])): ?>
        <div class="alert alert-success text-center">
            <?= $_SESSION['verification_message']; unset($_SESSION['verification_message']); ?>
        </div>
    <?php endif; ?>

    <!-- Pending NGOs -->
    <div class="card mb-5 shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">Pending NGO/Club Verifications</h4>
        </div>
        <div class="card-body outer-card">
            <?php if ($result_pending->num_rows > 0): ?>

                <!-- Desktop table -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Location</th>
                                <th>Service Area</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result_pending->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['phone']) ?></td>
                                    <td><?= htmlspecialchars($row['location']) ?></td>
                                    <td><?= htmlspecialchars($row['service_area']) ?></td>
                                    <td>
                                        <form method="post" action="handle_approval_ngo.php" class="d-inline">
                                            <input type="hidden" name="ngo_id" value="<?= $row['id'] ?>">
                                            <button type="submit" name="action" value="verify" class="btn btn-success btn-sm">Verify</button>
                                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm" onclick="return confirm('Reject this NGO?')">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile cards -->
                <div class="d-md-none">
                    <?php $result_pending->data_seek(0); while($row = $result_pending->fetch_assoc()): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                                <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
                                <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                                <p><strong>Service Area:</strong> <?= htmlspecialchars($row['service_area']) ?></p>
                                <form method="post" action="handle_approval_ngo.php" class="d-flex gap-2">
                                    <input type="hidden" name="ngo_id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="action" value="verify" class="btn btn-success btn-sm w-50">Verify</button>
                                    <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm w-50" onclick="return confirm('Reject this NGO?')">Reject</button>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

            <?php else: ?>
                <p class="text-center">No NGOs pending verification.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Verified NGOs -->
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-center">All Verified NGOs/Clubs</h4>
        </div>
        <div class="card-body outer-card">
            <?php if ($result_all->num_rows > 0): ?>

                <!-- Desktop table -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Location</th>
                                <th>Service Area</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result_all->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['phone']) ?></td>
                                    <td><?= htmlspecialchars($row['location']) ?></td>
                                    <td><?= htmlspecialchars($row['service_area']) ?></td>
                                    <td>
                                        <a href="edit_ngo.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="delete_ngo.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this NGO?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile cards -->
                <div class="d-md-none">
                    <?php $result_all->data_seek(0); while($row = $result_all->fetch_assoc()): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                                <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
                                <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                                <p><strong>Service Area:</strong> <?= htmlspecialchars($row['service_area']) ?></p>
                                <div class="d-flex gap-2">
                                    <a href="edit_ngo.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm w-50">Edit</a>
                                    <a href="delete_ngo.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm w-50" onclick="return confirm('Delete this NGO?')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

            <?php else: ?>
                <p class="text-center">No registered NGOs found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
    </main>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
include '../home/footer.php';
?>