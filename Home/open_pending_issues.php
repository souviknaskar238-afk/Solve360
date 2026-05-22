<?php
require_once '../users/config.php';



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
  
<div class="container px-0 py-5">
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
                        <img src="../issues/uploads/<?= htmlspecialchars($row['file_path']) ?>" class="media-img mb-2">
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

        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
<?php include 'footer.php';?>