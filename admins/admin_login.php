<!-- header -->
<?php include '../users/user_header.php'; ?>
<?php
session_start();

// Handle error message if any
$error_message = '';

if (isset($_SESSION['admin_login_error'])) {
    $error_message = $_SESSION['admin_login_error'];
    unset($_SESSION['admin_login_error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login | Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      background: url('../images/admin_back_final.jpg') no-repeat center center/cover;
      min-height: 100vh;
    }

    .auth-container {
      max-width: 450px;
      padding: 2rem;
      backdrop-filter: blur(12px);
      background-color: rgba(0,0,0,0.7);
      border-radius: 1rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.9);
    }

    .auth-title {
      font-weight: bold;
    }

    .logo-text {
      font-size: 1.5rem;
      font-weight: bold;
      color: #ffc107;
    }

    @media (max-width: 576px) {
      .auth-container {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

<?php if (!empty($error_message)): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo $error_message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-11 col-sm-10 col-md-8 col-lg-6 auth-container text-light">
        <div class="text-center mb-4">
          <i class="bi bi-shield-lock-fill display-4 text-warning"></i>
          <div class="logo-text mt-2">Solve360 Admin</div>
        </div>

        <h4 class="text-center auth-title mb-4">Admin Login</h4>
        <form action="admin_login_handler.php" method="POST">
          <div class="mb-3">
            <label for="adminEmail" class="form-label">Email address</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
              <input type="email" class="form-control" id="adminEmail" name="email" placeholder="admin@example.com" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="adminPassword" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
              <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Enter password" required>
            </div>
          </div>

          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>
<!-- footer -->
<?php include '../home/footer.php'; ?>