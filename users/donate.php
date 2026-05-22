<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login_register.php");
    exit();
}

// Handle success message after donation
$donation_success = false;
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $donation_success = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Donate | Solve360</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #1d3557, #457b9d);
      color: white;
      min-height: 100vh;
    }

    .donation-card {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(12px);
      border-radius: 16px;
      padding: 35px;
      max-width: 600px;
      margin: 60px auto;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .form-control, .form-select {
      background-color: rgba(255, 255, 255, 0.15);
      border: none;
      color: white;
    }

    .form-control::placeholder {
      color: #ddd;
    }

    .btn-donate {
      background-color: #2ecc71;
      border: none;
    }

    .btn-donate:hover {
      background-color: #27ae60;
    }

    .alert-custom {
      max-width: 600px;
      margin: 20px auto;
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

<?php include 'user_header.php'; ?>
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
    
      <li><a href="donate.php" class="nav-link bg-primary text-white"><i class="fas fa-donate"></i> Donate</a></li>
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

<?php if (isset($_GET['status'])): ?>
    <div style="margin-top:20px; padding:15px; border-radius:10px; background-color: <?= $_GET['status'] === 'success' ? '#d4edda' : '#f8d7da' ?>; color: <?= $_GET['status'] === 'success' ? '#155724' : '#721c24' ?>; position: relative;">
        <?= $_GET['status'] === 'success' ? 'Thank you! Your donation was successful.' : htmlspecialchars($_GET['message']) ?>
        <button onclick="this.parentElement.style.display='none'" style="position: absolute; top: 5px; right: 10px; background: transparent; border: none; font-size: 20px; color: inherit;">&times;</button>
    </div>
<?php endif; ?>

<div class="donation-card">
  <h3 class="text-center mb-4 text-white"><i class="fas fa-donate"></i>  Support a Cause</h3>
  <form action="process_donation.php" method="POST">
    <div class="mb-3">
      <label class="form-label text-white">Donation Amount (INR)</label>
      <input type="number" name="amount" class="form-control" placeholder="Enter amount (e.g., 500)" min="1" required>
    </div>

    <div class="mb-3">
      <label class="form-label text-white">Choose a Cause</label>
      <select name="cause" class="form-select" required>
        <option value="">-- Select --</option>
        <option>Child Education</option>
        <option>Health & Sanitation</option>
        <option>Food & Shelter</option>
        <option>Disaster Relief</option>
        <option>General Fund</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label text-white">Your UPI ID / Email </label>
      <input type="text" name="contact_info" class="form-control" placeholder="example@upi / your@email.com" required>
    </div>

    <div class="mb-3">
      <label class="form-label text-white">Message (Optional)</label>
      <textarea name="message" rows="3" class="form-control" placeholder="Any note you'd like to add..."></textarea>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-donate bg-primary text-white">Donate Now</button>
    </div>
  </form>
</div>

<!-- donations history table -->
 <hr class="text-white mt-5 mb-4">
<h4 class="text-center text-white"><i class="fas fa-history"></i> Your Donation History</h4>

<?php
include '../users/config.php'; // Make sure connection is established

$user_id = $_SESSION['user_id'];
$query = "SELECT amount, cause, contact_info, message, donated_at FROM donations WHERE user_id = ? ORDER BY donated_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0): ?>
    <div class="table-responsive mt-3">
      <table class="table table-bordered table-dark table-striped">
        <thead>
          <tr>
            <th>Amount (INR)</th>
            <th>Cause</th>
            <th>Contact</th>
            <th>Message</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['amount']) ?></td>
              <td><?= htmlspecialchars($row['cause']) ?></td>
              <td><?= htmlspecialchars($row['contact_info']) ?></td>
              <td><?= htmlspecialchars($row['message']) ?: '—' ?></td>
              <td><?= date("d M Y, h:i A", strtotime($row['donated_at'])) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
<?php else: ?>
    <p class="text-center text-light mt-3">No donations yet.</p>
<?php endif; ?>
</main>
    </div>
</div>
<?php include '../home/footer.php'; ?>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

</body>
</html>