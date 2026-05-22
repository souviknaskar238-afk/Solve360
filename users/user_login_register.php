<!-- header -->
<?php include 'user_header.php'; ?>
<?php
session_start();

// Handle success and error messages
$success_message = '';
$error_message = '';

if (isset($_SESSION['register_success'])) {
    $success_message = $_SESSION['register_success'];
    unset($_SESSION['register_success']);
}

if (isset($_SESSION['login_error'])) {
    $error_message = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login/Register | Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      background: url('../images/user_back.jpg') no-repeat center center/cover;
      min-height: 100vh;
    }

    .auth-container {
      max-width: 500px;
      padding: 1.5rem;
      backdrop-filter: blur(15px);
      background-color: rgba(0,0,0,0.7);
      border-radius: 1rem;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .form-control, textarea.form-control {
      background-color: rgba(255, 255, 255, 0.9);
    }

    .auth-title {
      font-weight: 700;
    }

    .logo-text {
      font-size: 1.2rem;
      font-weight: 600;
      color: #ffc107;
    }

    .auth-section {
      display: none;
    }

    .auth-section.active {
      display: block;
    }

    a.text-warning:hover {
      text-decoration: underline;
    }

    .input-group-text {
      cursor: pointer;
    }

    @media (max-width: 576px) {
      .auth-container {
        padding: 2rem 1rem;
      }

      .logo-text {
        font-size: 1rem;
      }
    }
    .form-label {
  margin-bottom: 0.3rem;
}

.mb-3 {
  margin-bottom: 0.8rem !important;
}
  </style>
</head>
<body>
  <!-- Alerts -->
  <?php if (!empty($success_message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo $success_message; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if (!empty($error_message)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo $error_message; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-11 col-sm-10 col-md-8 col-lg-6 p-4 auth-container text-light">
          <div class="text-center mb-4">
            <i class="bi bi-person-circle display-4 text-warning"></i>
            <div class="logo-text mt-2">Solve360</div>
          </div>

          <!-- Login Section -->
          <section id="loginSection" class="auth-section">
            <h4 class="text-center auth-title mb-4">Login to Continue</h4>
            <form action="user_login_handler.php" method="POST">
              <div class="mb-3">
                <label for="loginEmail" class="form-label">Email address</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                  <input type="email" class="form-control" id="loginEmail" name="email" placeholder="name@example.com" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                  <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter password" required>
                  <span class="input-group-text toggle-password" data-target="loginPassword">
                    <i class="bi bi-eye-slash" id="loginToggle"></i>
                  </span>
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="../admins/forgot_password.php" class="text-warning">Forgot password?</a>
              </div>

              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <div class="text-center mt-4">
              <p class="mb-0">New here? <a href="#register" class="text-warning">Create an account</a></p>
            </div>
          </section>

          <!-- Register Section -->
          <section id="registerSection" class="auth-section">
            <h4 class="text-center auth-title mb-4">Create Your Account</h4>
            <form action="user_register_handler.php" method="POST">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="name" class="form-label">Full Name</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="registerEmail" class="form-label">Email</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control" id="registerEmail" name="email" placeholder="name@example.com" required>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="phone" class="form-label">Phone Number</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="e.g. 9876543210" required>
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="registerPassword" class="form-label">Password</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Enter password" required>
                    <span class="input-group-text toggle-password" data-target="registerPassword">
                      <i class="bi bi-eye-slash" id="registerToggle"></i>
                    </span>
                  </div>
                </div>

                <div class="col-12 mb-3">
                  <label for="address" class="form-label">Address</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                    <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your address" required></textarea>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-success w-100">Register</button>
            </form>

            <div class="text-center mt-4">
              <p class="mb-0">Already have an account? <a href="#login" class="text-warning">Login here</a></p>
            </div>
          </section>

        </div>
      </div>
    </div>
  </div>

  <script>
    function showSectionFromHash() {
      const hash = window.location.hash || "#login";
      document.getElementById("loginSection").classList.remove("active");
      document.getElementById("registerSection").classList.remove("active");
      if (hash === "#register") {
        document.getElementById("registerSection").classList.add("active");
      } else {
        document.getElementById("loginSection").classList.add("active");
      }
    }

    window.addEventListener("load", showSectionFromHash);
    window.addEventListener("hashchange", showSectionFromHash);

    document.querySelectorAll('.toggle-password').forEach(toggle => {
      toggle.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        const icon = this.querySelector('i');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
      });
    });
  </script>
</body>
</html>
<!-- footer -->
<?php include '../home/footer.php'; ?>