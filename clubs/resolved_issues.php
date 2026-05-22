<?php
session_start();
include '../users/config.php';

if (!isset($_SESSION['ngo_id'])) {
    header("Location: ngo_login_register.php");
    exit();
}

$ngo_id = $_SESSION['ngo_id'];

// Fetch resolved issues by this NGO
$sql = "
SELECT 
    i.*, 
    u.name AS user_name,
    m.file_path AS media_path
FROM issues i
JOIN users u ON i.user_id = u.id
LEFT JOIN (
    SELECT issue_id, file_path 
    FROM media 
    WHERE media_type = 'image' 
    GROUP BY issue_id
) m ON i.id = m.issue_id
WHERE i.resolution_status = 'resolved' 
  AND i.resolved_by_ngo_id = ?
ORDER BY i.updated_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ngo_id);
$stmt->execute();
$results = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resolved Issues </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      body {
           background: linear-gradient(135deg, #1d3557, #457b9d)!important;
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


        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.07);
        }

        .card-body {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .media-column {
            flex: 1 1 28%;
            max-width: 250px;
        }

        .media-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
        }

        .info-column {
            flex: 1 1 42%;
        }

        .map-column {
            flex: 1 1 30%;
        }

        .map-container {
            height: 160px;
            width: 100%;
            border-radius: 8px;
        }

        .card-title {
            margin-bottom: 8px;
        }

        .text-small {
            font-size: 0.875rem;
            color: #666;
        }

 
        .card-header {
            font-weight: bold;
        }
        .card:hover {
            transform: scale(1.02);
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
    </style>
</head>
<body>

<?php include'../users/user_header.php';?>
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
            <i class="bi bi-building fs-4 me-2"></i> NGO Panel
            </h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link  " href="assigned_issues.php">
                    <i class="bi bi-clipboard-check"></i> Assigned Issues
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active  " href="resolved_issues.php">
                    <i class="bi bi-award-fill"></i> Resolved Issues
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact_admin.php">
                    <i class="bi bi-person-lines-fill"></i>Contact Admin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../issues/ngo_all_resolved_issues.php">
                    <i class="bi bi-check-circle"></i> All Resolved Issues
                    </a>
                </li>
                 <hr class="text-white">

                <li class="nav-item">
                    <a class="nav-link" href="ngo_panel.php">
                    <i class="bi bi-arrow-left-circle me-2"></i>Back to NGO Panel
                    </a>
                </li>
            </ul>
</div>


        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <div class="section-heading mb-4">Your Resolved Issues</div>

    <?php if ($results->num_rows > 0): ?>
        <div class="row">
        <?php while ($row = $results->fetch_assoc()): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Left: Image -->
                    <div class="media-column">
                        <?php if (!empty($row['media_path'])): ?>
                            <img src="../issues/uploads/<?= htmlspecialchars($row['media_path']) ?>" alt="Issue Media" class="media-img">
                        <?php else: ?>
                            <div class="text-muted">No image available</div>
                        <?php endif; ?>
                    </div>

                    <!-- Center: Info -->
                    <div class="info-column">
                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                        <p class="text-small"><strong>Reported by:</strong> <?= htmlspecialchars($row['user_name']) ?></p>
                        <p class="text-small"><strong>Resolved At:</strong> <?= date('M d, Y h:i A', strtotime($row['updated_at'])) ?></p>
                    </div>

                    <!-- Right: Map -->
                    <div class="map-column">
                        <div id="map<?= $row['id'] ?>" class="map-container"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                var map = L.map("map<?= $row['id'] ?>").setView([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>], 14);
                                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                    maxZoom: 19,
                                    attribution: '&copy; OpenStreetMap contributors'
                                }).addTo(map);
                                L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).addTo(map);
                            });
                        </script>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>    
    <?php else: ?>
        <div class="alert alert-info">No issues resolved yet.</div>
    <?php endif; ?>
</div>
    </main>
    </div>
    
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</body>
</html>
<?php include'../home/footer.php';?>
