<?php
session_start();
require_once '../users/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../users/user_login_register.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch issues: approved & unresolved, ordered by votes
$sql = "
    SELECT i.*, u.name AS user_name, u.profile_picture AS user_pic,
           m.file_path, m.media_type,
           (SELECT COUNT(*) FROM votes WHERE issue_id = i.id) AS vote_count,
           EXISTS (
               SELECT 1 FROM votes WHERE user_id = ? AND issue_id = i.id
           ) AS has_voted
    FROM issues i
    JOIN users u ON i.user_id = u.id
    LEFT JOIN media m ON i.id = m.issue_id AND m.media_type = 'image'
    WHERE i.status = 'approved' AND i.resolution_status = 'unresolved'
    ORDER BY vote_count DESC, i.updated_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pending Issues Feed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
         body {
            background: linear-gradient(135deg, #1d3557, #457b9d)!important;
            background-size: cover;
            
        }
        .feed-card {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
        .profile-pic {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }
        .media-img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 10px;
        }
        .map-frame {
            border: 0;
            width: 100%;
            height: 200px;
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
        .feed-card:hover {
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
<body >
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
    <i class="bi bi-person-circle"></i> User Panel
  </h4>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link text-white" href="post_issue.php">
        <i class="bi bi-plus-circle"></i> Report New Issue
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="../users/user_pending_issues.php">
        <i class="bi bi-hourglass-top"></i> Pending Issues
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="../users/user_approved_issues.php">
        <i class="bi bi-check2-square"></i> Approved Issues
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link  text-white" href="../users/user_resolved_issues.php">
        <i class="bi bi-check-circle"></i> Resolved Issues
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link active text-white" href="user_all_pending_issues.php">
        <i class="bi bi-hourglass-split"></i> All Pending Issues
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="user_all_resolved_issues.php">
        <i class="bi bi-patch-check"></i> All Resolved Issues
      </a>
    </li>
    <hr class="text-white">
    <li class="nav-item">
      <a class="nav-link text-white" href="../users/user_panel.php">
        <i class="bi bi-arrow-left-circle me-2"></i> Back to User Panel
      </a>
    </li>
  </ul>
</div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">   
<div class="container py-5">
<div class="section-heading mb-4">Pending Issues Feed</div>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="feed-card">
            <div class="d-flex align-items-center mb-2">
                <img src="../users/<?= htmlspecialchars($row['user_pic'] ?? 'assets/default_user.png') ?>" class="profile-pic me-2">
                <strong><?= htmlspecialchars($row['user_name']) ?></strong>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <?php if ($row['file_path']): ?>
                        <img src="uploads/<?= htmlspecialchars($row['file_path']) ?>" class="media-img mb-2">
                    <?php else: ?>
                        <div class="text-muted">No image available</div>
                    <?php endif; ?>
                </div>

                <div class="col-md-4">
                    <h5><?= htmlspecialchars($row['title']) ?></h5>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                    <p><strong>Votes:</strong> <?= $row['vote_count'] ?></p>
                </div>

                <div class="col-md-4">
                    <iframe class="map-frame"
                        src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $row['longitude'] - 0.005 ?>,<?= $row['latitude'] - 0.005 ?>,<?= $row['longitude'] + 0.005 ?>,<?= $row['latitude'] + 0.005 ?>&layer=mapnik&marker=<?= $row['latitude'] ?>,<?= $row['longitude'] ?>">
                    </iframe>
                </div>
            </div>

            <hr>

            <form action="vote_issue.php" method="post">
                <input type="hidden" name="issue_id" value="<?= $row['id'] ?>">
                <?php if ($row['has_voted']): ?>
                    <button class="btn btn-outline-success" disabled>Voted</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-success">Vote</button>
                <?php endif; ?>
            </form>
        </div>
    <?php endwhile; ?>
</div>
</main>
                </div>
            </div>
</body>
</html>
<?php include '../home/footer.php';?>