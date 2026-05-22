<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Admin | Solve360 NGO</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1d3557, #457b9d) !important;
      color: white;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .main-container {
      flex: 1;
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
    .contact-container {
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 30px;
      max-width: 800px;
      width: 100%;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
      margin: auto;
    }
    .form-label {
      color: #ddd;
    }
    .form-control, .form-select {
      background-color: rgba(255, 255, 255, 0.1);
      border: none;
      color: white;
    }
    .form-control::placeholder {
      color: #ccc;
    }
    .btn-submit {
      background-color: #0d6efd;
      border: none;
      transition: 0.3s;
    }
    .btn-submit:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>
<body>

<?php include '../users/user_header.php'; ?>

<div class="container-fluid main-container">
  <div class="row">
    <!-- Sidebar -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
      <div class="container-fluid">
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#userSidebar" aria-controls="userSidebar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <div class="collapse d-md-block col-md-3 col-lg-2 sidebar p-3" id="userSidebar">
      <h4 class="text-white mb-4">
        <i class="bi bi-building fs-4 me-2"></i> NGO Panel
      </h4>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="assigned_issues.php"><i class="bi bi-clipboard-check"></i> Assigned Issues</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="resolved_issues.php"><i class="bi bi-award-fill"></i> Resolved Issues</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="contact_admin.php"><i class="bi bi-person-lines-fill"></i> Contact Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../issues/ngo_all_resolved_issues.php"><i class="bi bi-check-circle"></i> All Resolved Issues</a>
        </li>
        <hr class="text-white">
        <li class="nav-item">
          <a class="nav-link" href="ngo_panel.php"><i class="bi bi-arrow-left-circle me-2"></i>Back to NGO Panel</a>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <main class="col-md-9 col-lg-10 py-4">
      <div class="contact-container">
        <h3 class="text-center mb-4 text-white"><i class="bi bi-envelope-paper-fill me-2"></i>Contact Admin</h3>
        <form action="https://formspree.io/f/mldbpnbb" method="post">
          <div class="mb-3">
            <label for="ngoName" class="form-label">NGO Name</label>
            <input type="text" class="form-control" id="ngoName" name="ngoName" placeholder="Your NGO's Name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.org" required>
          </div>
          <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Query regarding..." required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Type your message..." required></textarea>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-submit bg-primary text-white">Send Message</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>

<?php include '../home/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>