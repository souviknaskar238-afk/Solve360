<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../users/user_login_handler.php");
    exit;
}
include '../users/user_header.php';
?>

<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show m-3" role="alert">'
        . htmlspecialchars($_SESSION['success']) .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

    // Redirect after 3 seconds
    echo '<script>
        setTimeout(function() {
            window.location.href = "../users/user_pending_issues.php";
        }, 1000); // 1 second delay
    </script>';

    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report an Issue | Solve360</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        body {
            background: linear-gradient(135deg, #1d3557, #457b9d)!important;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            
        }
        #map {
            height: 300px;
            border-radius: 10px;
            margin-top: 10px;
        }
        .btn-theme {
            background-color: #007BFF;
            color: white;
            border-radius: 30px;
        }
        .btn-theme:hover {
            background-color: #0056b3;
        }
        .preview-media img, .preview-media video {
            max-width: 250px;
            margin: 5px;
            border-radius: 10px;
        }
        .form-label {
            font-weight: 600;
        }
        .outer-card {
            background: linear-gradient(to bottom, rgb(103, 124, 145), rgb(204, 213, 223)) !important;
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
      <a class="nav-link active text-white" href="post_issue.php">
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
      <a class="nav-link  text-white" href="user_all_pending_issues.php">
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

        <!-- Main Form -->
        <div class="col-md-9 col-lg-10">
            <div class="container-fluid mt-5">
                <div class="card p-4 mx-auto outer-card" style="max-width: 900px;">
                    <h3 class="mb-4 text-center text-white bg-dark p-2 rounded">Report an Issue</h3>
                    <form action="submit_issue_handler.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Issue Title</label>
                            <input type="text" class="form-control rounded-pill px-3" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Issue Description</label>
                            <textarea class="form-control rounded-4 px-3" name="description" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Image/Video</label>
                            <input type="file" class="form-control" name="media[]" id="media" multiple accept="image/*,video/*">
                            <div class="preview-media mt-2" id="mediaPreview"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Set Location</label><br>
                            <button type="button" class="btn btn-outline-primary rounded-pill" onclick="setLocation()">Set My Location</button>
                            <p id="location-msg" class="mt-2 fw-medium" style="display:none;"></p>
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <div id="map"></div>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 py-2 mt-4">Submit Issue</button>
                    </form>
                 
                </div>
                <hr>
            </div>
        </div>
    </div>
    
</div>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let map, marker;

    function setLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;

                const msg = document.getElementById("location-msg");
                msg.textContent = "Location set successfully!";
                msg.style.display = "block";
                msg.className = "text-success";

                if (!map) {
                    map = L.map('map').setView([lat, lng], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: 'Map data © OpenStreetMap contributors'
                    }).addTo(map);
                } else {
                    map.setView([lat, lng], 15);
                    if (marker) marker.remove();
                }

                marker = L.marker([lat, lng]).addTo(map).bindPopup("Your Location").openPopup();
            }, function() {
                const msg = document.getElementById("location-msg");
                msg.textContent = "Could not fetch location. Please allow location access.";
                msg.style.display = "block";
                msg.className = "text-danger";
            });
        } else {
            alert("Geolocation not supported by your browser.");
        }
    }

    // Media preview
    document.getElementById('media').addEventListener('change', function() {
        const preview = document.getElementById('mediaPreview');
        preview.innerHTML = '';
        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const el = document.createElement(file.type.startsWith('video') ? 'video' : 'img');
                el.src = e.target.result;
                if (file.type.startsWith('video')) el.controls = true;
                preview.appendChild(el);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
</body>
</html>
<?php include '../home/footer.php'; ?>