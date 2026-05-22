<?php include 'user_header.php'; ?>
<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

function fetch_issues($conn, $user_id, $status, $resolved = null) {
    $query = "SELECT i.*, n.name AS ngo_name 
              FROM issues i
              LEFT JOIN ngos n ON i.resolved_by_ngo_id = n.id
              WHERE i.user_id = ? AND i.status = ?";

    if ($resolved === 'unresolved') {
        $query .= " AND i.resolved_by_ngo_id IS NULL";
    } elseif ($resolved === 'resolved') {
        $query .= " AND i.resolved_by_ngo_id IS NOT NULL";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $status);
    $stmt->execute();
    return $stmt->get_result();
}

function get_image_for_issue($conn, $issue_id) {
    $stmt = $conn->prepare("SELECT file_path FROM media WHERE issue_id = ? AND media_type = 'image' LIMIT 1");
    $stmt->bind_param("i", $issue_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

$pending_issues = fetch_issues($conn, $user_id, 'pending');
$approved_unresolved_issues = fetch_issues($conn, $user_id, 'approved', 'unresolved');
$resolved_issues = fetch_issues($conn, $user_id, 'approved', 'resolved');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Issues - Solve360</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
        .card-header {
            font-weight: bold;
        }
        .issue-block {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 4px rgba(0,0,0,0.1);
        }
        .card:hover {
            transform: scale(1.02);
        }
        .issue-img {
            width: 220px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            background-color: #ddd;
        }
        .issue-content {
            flex-grow: 1;
            min-width: 250px;
        }
        .issue-map {
            width: 250px;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
        }
        .issue-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #23418e;
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
    <i class="bi bi-person-circle"></i> User Panel
  </h4>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link text-white" href="../issues/post_issue.php">
        <i class="bi bi-plus-circle"></i> Report New Issue
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="user_pending_issues.php">
        <i class="bi bi-hourglass-top"></i> Pending Issues
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link active text-white" href="user_approved_issues.php">
        <i class="bi bi-check2-square"></i> Approved Issues
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link  text-white" href="user_resolved_issues.php">
        <i class="bi bi-check-circle"></i> Resolved Issues
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="../issues/user_all_pending_issues.php">
        <i class="bi bi-hourglass-split"></i> All Pending Issues
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="../issues/user_all_resolved_issues.php">
        <i class="bi bi-patch-check"></i> All Resolved Issues
      </a>
    </li>
    <hr class="text-white">
    <li class="nav-item">
      <a class="nav-link text-white" href="user_panel.php">
        <i class="bi bi-arrow-left-circle me-2"></i> Back to User Panel
      </a>
    </li>
  </ul>
</div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

            <div class="section-heading mb-4">
                <u>My Approved Issues</u>
            </div>

<?php if ($approved_unresolved_issues->num_rows > 0): ?>
    <?php while ($issue = $approved_unresolved_issues->fetch_assoc()):
        $image = get_image_for_issue($conn, $issue['id']);
    ?>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-start">
                    <!-- Left: Image -->
                    <div class="col-md-3">
                        <img src="../issues/uploads/<?= $image ? htmlspecialchars($image['file_path']) : 'placeholder.jpg' ?>" 
                             class="img-fluid rounded" style="max-height: 200px; object-fit: cover;" alt="Issue image">
                    </div>

                    <!-- Middle: Content -->
                    <div class="col-md-6">
                        <h5 class="mb-2"><?= htmlspecialchars($issue['title']) ?></h5>
                        <p style="max-height: 200px; overflow-y: auto;"><?= nl2br(htmlspecialchars($issue['description'])) ?></p>
                        <small class="text-muted">
                            Location: <?= htmlspecialchars($issue['location']) ?> | Approved on <?= $issue['updated_at'] ?>
                        </small>
                    </div>

                    <!-- Right: Map -->
                    <?php if (!empty($issue['latitude']) && !empty($issue['longitude'])): ?>
                        <div class="col-md-3">
                            <div class="issue-map" style="height: 200px; border: 1px solid #ddd;">
                                <iframe width="100%" height="100%" frameborder="0" scrolling="no" 
                                    src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $issue['longitude']-0.01 ?>,<?= $issue['latitude']-0.01 ?>,<?= $issue['longitude']+0.01 ?>,<?= $issue['latitude']+0.01 ?>&layer=mapnik&marker=<?= $issue['latitude'] ?>,<?= $issue['longitude'] ?>">
                                </iframe>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div class="card mb-4">
        <div class="card-body">
            <p class="fs-4">No unresolved approved issues.</p>
        </div>
    </div>
<?php endif; ?>

          

           
            

        
        </main>
    </div>
</div>

<?php include '../home/footer.php'; ?>