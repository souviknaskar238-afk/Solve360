<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login_register.php");
    exit();
}
?>
<?php if (isset($_SESSION['feedback_success'])): ?>
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <?= $_SESSION['feedback_success']; unset($_SESSION['feedback_success']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['feedback_error'])): ?>
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <?= $_SESSION['feedback_error']; unset($_SESSION['feedback_error']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Feedback | Solve360</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #1d3557, #457b9d);
      color: white;
      min-height: 100vh;
    }

    .feedback-container {
      max-width: 800px;
      margin: 80px auto;
      background: rgba(0, 0, 0, 0.55);
      backdrop-filter: blur(12px);
      padding: 35px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .star-rating i {
      font-size: 1.5rem;
      color: #ccc;
      cursor: pointer;
    }

    .star-rating i.selected {
      color: #f1c40f;
    }

    .form-control, .form-select {
      background-color: rgba(255, 255, 255, 0.15);
      color: white;
      border: none;
    }

    .form-control::placeholder {
      color: #ddd;
    }

    .btn-submit {
      background-color: #2ecc71;
      border: none;
    }

    .btn-submit:hover {
      background-color: #27ae60;
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
    
      <li><a href="donate.php" class="nav-link  text-white"><i class="fas fa-donate"></i> Donate</a></li>
      <hr class="text-white">
      <li><a href="user_profile.php" class="nav-link text-white"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
      <hr class="text-white">
      <li><a href="user_panel.php" class="nav-link  text-white"><i class="bi bi-gear me-2"></i> User Panel</a></li>
      <hr class="text-white">
      <li><a href="user_feedback.php" class="nav-link bg-primary text-white"><i class="fas fa-comment-dots"></i>  Feedback</a></li>
      <hr class="text-white">
      <li><a href="logout.php" class="nav-link text-white"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
      

    </ul>
    <hr class="text-white">
    <div class="text-center small text-secondary">&copy; Solve360 2025</div>
</div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
<div class="feedback-container">
  <h3 class="text-center mb-4 text-white"><i class="fas fa-comment-dots"></i> Share Your Feedback</h3>
  <form action="../admins/submit_feedback.php" method="POST">
    <input type="hidden" name="from" value="user">
    <div class="mb-3">
      <label class="form-label text-white">How would you rate your experience?</label>
      <div class="star-rating" id="userStars">
        <input type="hidden" name="rating" id="rating" required>
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <i class="fas fa-star" data-value="<?= $i ?>"></i>
        <?php endfor; ?>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label text-white">Your Feedback</label>
      <textarea class="form-control" name="feedback" rows="4" placeholder="We’d love to hear your thoughts..." required></textarea>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-submit text-white bg-primary">Submit Feedback</button>
    </div>
  </form>
</div>
  </main>
    </div>
</div>
<?php include '../home/footer.php';?>
<script>
  document.querySelectorAll('#userStars i').forEach((star, idx) => {
    star.addEventListener('click', function () {
      document.querySelectorAll('#userStars i').forEach(s => s.classList.remove('selected'));
      for (let i = 0; i <= idx; i++) {
        document.querySelectorAll('#userStars i')[i].classList.add('selected');
      }
      document.getElementById('rating').value = idx + 1;
    });
  });
</script>

</body>
</html>