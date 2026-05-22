<?php
session_start();
require_once '../users/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['issue_id'], $_POST['action'])) {
    $issue_id = (int) $_POST['issue_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $status = 'approved';
        $stmt = $conn->prepare("UPDATE issues SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $issue_id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action === 'reject') {
        $mediaQuery = $conn->prepare("SELECT file_path FROM media WHERE issue_id = ?");
        $mediaQuery->bind_param("i", $issue_id);
        $mediaQuery->execute();
        $mediaResult = $mediaQuery->get_result();

        while ($media = $mediaResult->fetch_assoc()) {
            $file = '../issues/uploads/' . $media['file_path'];
            if (file_exists($file)) unlink($file);
        }
        $mediaQuery->close();

        $mediaDelete = $conn->prepare("DELETE FROM media WHERE issue_id = ?");
        $mediaDelete->bind_param("i", $issue_id);
        $mediaDelete->execute();
        $mediaDelete->close();

        $issueDelete = $conn->prepare("DELETE FROM issues WHERE id = ?");
        $issueDelete->bind_param("i", $issue_id);
        $issueDelete->execute();
        $issueDelete->close();
    }

    header("Location: pending_issues.php");
    exit;
}

$query = "SELECT issues.*, users.name AS user_name FROM issues 
          JOIN users ON issues.user_id = users.id 
          WHERE issues.status = 'pending' 
          ORDER BY issues.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pending Issues - Solve360 Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
      <!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Font Awesome (for extra icons like donate) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .media-item img,
        .media-item video {
            max-width: 100%;
            max-height: 200px;
            border-radius: 10px;
            box-shadow: 0 0 5px #ccc;
        }
        .map-container {
            height: 200px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 5px #ccc;
        }
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
      <a href="pending_issues.php" class="nav-link bg-primary text-white">
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
<div class="container mt-5 mb-5">
     <div class="section-heading mb-4"><u>Pending Issues for Approval</u></div>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="card mb-4 shadow-sm">
                <div class="row g-0">
                    <!-- Left: Media -->
                    <div class="col-md-3 p-3 d-flex flex-wrap gap-2">
                        <?php
                        $mediaQuery = "SELECT * FROM media WHERE issue_id = " . $row['id'];
                        $mediaResult = mysqli_query($conn, $mediaQuery);
                        while ($media = mysqli_fetch_assoc($mediaResult)) {
                            $mediaPath = '../issues/uploads/' . $media['file_path'];
                            echo '<div class="media-item">';
                            if ($media['media_type'] === 'image') {
                                echo "<img src='$mediaPath' alt='Media'>";
                            } else {
                                echo "<video src='$mediaPath' controls></video>";
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <!-- Center: Info -->
                    <div class="col-md-6 p-3">
                        <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                        <h6 class="text-muted">By: <?php echo htmlspecialchars($row['user_name']); ?></h6>
                        <p><br><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                        <p><strong>Posted on:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>
                        <form method="post" class="d-flex gap-2">
                            <input type="hidden" name="issue_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                        </form>
                    </div>

                    <!-- Right: Map -->
                    <div class="col-md-3 p-3">
                        <div id="map-<?php echo $row['id']; ?>" class="map-container"></div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-info">No pending issues found.</div>
    <?php endif; ?>
</div>
    </main>
    </div>
</div>
<?php include '../home/footer.php';?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    <?php
    mysqli_data_seek($result, 0); // Reset result pointer
    while ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['latitude']) && !empty($row['longitude'])) {
            $lat = htmlspecialchars($row['latitude']);
            $lng = htmlspecialchars($row['longitude']);
            $mapId = "map-" . $row['id'];
            echo "
                var map = L.map('$mapId').setView([$lat, $lng], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map);
                L.marker([$lat, $lng]).addTo(map)
                    .bindPopup('Issue Location').openPopup();
            ";
        }
    }
    ?>
</script>
</body>
</html>