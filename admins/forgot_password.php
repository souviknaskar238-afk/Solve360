<?php
session_start();
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password | Solve360</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
      background: linear-gradient(135deg, #1d3557, #457b9d);
      font-family: 'Segoe UI', sans-serif;
    }

    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 7rem 1rem;
    }

    .glass-container {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 520px;
      color: white;
    }

    .form-label, .form-select, .form-control {
      color: #fff;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .form-control, .form-select {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      box-shadow: none;
    }

    .btn-primary {
      background-color: #00c9a7;
      border: none;
    }

    .btn-primary:hover {
      background-color: #00b28c;
    }

    .alert {
      border-radius: 10px;
    }

    .alert .btn-close {
      filter: brightness(0) invert(1);
    }
  </style>
</head>
<body>

<?php include '../users/user_header.php'; ?>

<main>
  <div class="glass-container">
    <h4 class="mb-4 text-center">Forgot Password</h4>

    <?php if ($success): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($success) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <form method="POST" action="check_forgot.php">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Account Type</label>
        <select name="account_type" class="form-select" required>
          <option value="user">User</option>
          <option value="ngo">NGO</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
    </form>
  </div>
</main>

<?php include '../home/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>