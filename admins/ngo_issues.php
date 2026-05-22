<?php
session_start();
include '../users/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Approve
if (isset($_POST['approve'])) {
    $issue_id = $_POST['issue_id'];
    $stmt = $conn->prepare("SELECT pending_ngo_id FROM issues WHERE id = ?");
    $stmt->bind_param("i", $issue_id);
    $stmt->execute();
    $stmt->bind_result($ngo_id);
    $stmt->fetch();
    $stmt->close();
    $update = $conn->prepare("UPDATE issues SET resolution_status = 'resolved', resolved_by_ngo_id = ?, pending_ngo_id = NULL WHERE id = ?");
    $update->bind_param("ii", $ngo_id, $issue_id);
    $update->execute();
}

// Reject
if (isset($_POST['reject'])) {
    $issue_id = $_POST['issue_id'];
    $update = $conn->prepare("UPDATE issues SET resolution_status = 'unresolved', pending_ngo_id = NULL WHERE id = ?");
    $update->bind_param("i", $issue_id);
    $update->execute();
}

// Fetch pending issues
$sql = "
SELECT i.*, u.name AS user_name, n.name AS ngo_name
FROM issues i
JOIN users u ON i.user_id = u.id
JOIN ngos n ON i.pending_ngo_id = n.id
WHERE i.resolution_status = 'pending'
ORDER BY i.created_at DESC
";
$issues = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Pending Issue Resolutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Font Awesome (for extra icons like donate) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
         body {
            background: linear-gradient(135deg, #1d3557, #457b9d);
            background-size: cover;
        }
        .issue-card {
            display: flex;
            flex-direction: row;
            gap: 15px;
            padding: 15px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .issue-image {
            width: 180px;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
        }
        .issue-info {
            flex-grow: 1;
        }
        .issue-map {
            width: 200px;
            height: 140px;
            border-radius: 10px;
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
                .section-heading {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            color: white;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 10px;
            border-radius: 10px;
        }
             .card:hover {
            transform: scale(1.02);
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
      <a href="pending_issues.php" class="nav-link  text-white">
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
      <a href="ngo_issues.php" class="nav-link bg-primary text-white">
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
<div class="container mt-4">
     <div class="section-heading mb-4"><u>Pending NGO Issue Resolutions</u></div>
    <?php if ($issues->num_rows > 0): ?>
        <div class="d-flex flex-column gap-3">
<?php while ($issue = $issues->fetch_assoc()): ?>
    <?php
    // Fetch the first image for this issue from the media table
    $media_stmt = $conn->prepare("SELECT file_path FROM media WHERE issue_id = ? AND media_type = 'image' LIMIT 1");
    $media_stmt->bind_param("i", $issue['id']);
    $media_stmt->execute();
    $media_stmt->bind_result($image_path);
    $media_stmt->fetch();
    $media_stmt->close();
    ?>
    
    <div class="col-md-12 mb-4">
        <div class="card shadow">
            <div class="row g-0">
                <!-- Left: Image -->
                <div class="col-md-4 d-flex align-items-center justify-content-center p-2">
                    <?php if (!empty($image_path)): ?>
                        <img src="../issues/uploads/<?= htmlspecialchars($image_path) ?>" class="img-fluid rounded" style="max-height: 250px;">
                    <?php else: ?>
                        <div class="text-muted">No image available</div>
                    <?php endif; ?>
                </div>

                <!-- Middle: Details -->
                <div class="col-md-5">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($issue['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($issue['description']) ?></p>
                        <p><strong>Reported by:</strong> <?= htmlspecialchars($issue['user_name']) ?></p>
                        <p><strong>Requested by NGO:</strong> <?= htmlspecialchars($issue['ngo_name']) ?></p>
                        <p><strong>Date:</strong> <?= date("d M Y", strtotime($issue['created_at'])) ?></p>
                        <form method="post" class="d-flex gap-2">
                            <input type="hidden" name="issue_id" value="<?= $issue['id'] ?>">
                            <button type="submit" name="approve" class="btn btn-success">Approve</button>
                            <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                </div>

                <!-- Right: Map -->
                <div class="col-md-3 p-2">
                    <div id="map-<?= $issue['id'] ?>" style="height: 250px; width: 100%; border-radius: 8px;"></div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No pending resolutions for approval.</div>
    <?php endif; ?>
</div>
    </main>
    </div>
</div>
<?php include '../home/footer.php';?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    <?php
    mysqli_data_seek($issues, 0);
    while ($issue = $issues->fetch_assoc()):
        $lat = $issue['latitude'] ?? null;
        $lng = $issue['longitude'] ?? null;
        if ($lat && $lng):
    ?>
        var map<?= $issue['id'] ?> = L.map('map-<?= $issue['id'] ?>').setView([<?= $lat ?>, <?= $lng ?>], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map<?= $issue['id'] ?>);
        L.marker([<?= $lat ?>, <?= $lng ?>]).addTo(map<?= $issue['id'] ?>)
            .bindPopup("Issue Location")
            .openPopup();
    <?php endif; endwhile; ?>
</script>

</body>
</html>