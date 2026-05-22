<?php
session_start();
require_once '../users/config.php'; // update path if needed

$query = "
    SELECT i.*, 
           u.name AS user_name, u.profile_picture AS user_pic, 
           n.name AS ngo_name, n.profile_picture AS ngo_pic,
           m.file_path, m.media_type 
    FROM issues i
    JOIN users u ON i.user_id = u.id
    LEFT JOIN ngos n ON i.resolved_by_ngo_id = n.id
    LEFT JOIN media m ON i.id = m.issue_id AND m.media_type = 'image'
    WHERE i.status = 'approved' AND i.resolution_status = 'resolved'
    ORDER BY i.updated_at DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resolved Issues Feed - Solve360</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
          body {
            background: linear-gradient(135deg, #1d3557, #457b9d)!important;
            background-size: cover;
            
        }
        .media-img {
    width: 100%;
    height: auto;
    object-fit: cover;
}
        .feed-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #fff;
            box-shadow: 0 0 12px rgba(0,0,0,0.05);
        }
        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .map-container {
            height: 200px;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
        }
        .media-img {
            max-width: 200%;
            max-height: 200px;
            border-radius: 8px;
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
<body>
    <?php include '../users/user_header.php';?>
 
<div class="container py-5 ">
<div class="section-heading mb-4">Resolved Issues Feed</div>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="feed-card">
            <!-- User Info -->
            <div class="d-flex align-items-center mb-2">
                <img src="../users/<?= htmlspecialchars($row['user_pic'] ?? 'assets/default_user.png') ?>" class="profile-pic me-2">
                <strong><?= htmlspecialchars($row['user_name']) ?></strong>
            </div>

            <hr>

            <!-- Issue Content -->
            <div class="row">
                <!-- Issue Media -->
                <div class="col-md-4">
                    <?php if (!empty($row['file_path'])): ?>
                        <img src="../issues/uploads/<?= htmlspecialchars($row['file_path']) ?>" class="media-img mb-2">
                    <?php else: ?>
                        <div class="text-muted">No image available</div>
                    <?php endif; ?>
                </div>

                <!-- Issue Info -->
                <div class="col-md-4">
                    <h5><?= htmlspecialchars($row['title']) ?></h5>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                    <p><strong>Resolved At:</strong> <?= date('F j, Y', strtotime($row['updated_at'])) ?></p>
                </div>

                <!-- Map -->
                <div class="col-md-4">
                    <div class="map-container">
                        <iframe 
                            width="100%" height="100%" 
                            src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $row['longitude'] - 0.005 ?>,<?= $row['latitude'] - 0.005 ?>,<?= $row['longitude'] + 0.005 ?>,<?= $row['latitude'] + 0.005 ?>&layer=mapnik&marker=<?= $row['latitude'] ?>,<?= $row['longitude'] ?>" 
                            style="border: 0">
                        </iframe>
                    </div>
                </div>
            </div>

            <hr>

            <!-- NGO Info -->
            <div class="d-flex align-items-center mt-3 bg-success text-light ">
                <img src="../clubs/<?= htmlspecialchars($row['ngo_pic'] ?? 'assets/default_ngo.png') ?>" class="profile-pic me-2">
                <h5><strong>Resolved by: <?= htmlspecialchars($row['ngo_name']) ?></strong></h5>
            </div>
        </div>
    <?php endwhile; ?>

            </div>
     
</body>
</html>
<?php include'footer.php';?>