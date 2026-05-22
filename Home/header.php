<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
body {
  padding-top: 75px; /* Adjust for typical navbar height */
}

@media (max-width: 576px) {
  body {
    padding-top: 200px; /* More padding on small screens */
  }
}
    .nav-item:hover{
       background-color: #495057;

    }
  </style>
</head>
<body>
<header>
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">

      <!-- Logo -->
      <a class="navbar-brand fs-3 fw-bold mt-3 d-flex align-items-center" href="index.php">
        <video width="175" autoplay muted loop playsinline class="me-2">
          <source src="../images/final-logo_.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </a>

      <!-- Navigation Links -->
      <ul class="nav nav-tabs ms-auto me-3">
        <li class="nav-item">
          <a class="nav-link text-bg-dark" href="index.php">HOME</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-bg-dark dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            USER
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="../users/user_login_register.php#register">Register</a></li>
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="../users/user_login_register.php#login">Log-in</a></li>
            <hr class="dropdown-divider">
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-bg-dark dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            NGO/CLUBS
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="../clubs/ngo_login_register.php#register">Register</a></li>
            <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="../clubs/ngo_login_register.php#login">Log-in</a></li>
            <hr class="dropdown-divider">
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-bg-dark" href="faq.php#donors">DONATE</a>
        </li>
      </ul>

      <!-- Scrollbar Button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Offcanvas Menu -->
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Solve360</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" href="faq.php#issues">Issues You can post</a>
            </li>
            <hr>
            <li class="nav-item">
              <a class="nav-link active" href="contact_us.php">Contact Us</a>
            </li>
            <hr>
            <li class="nav-item">
              <a class="nav-link active" href="about_us.php">About Us</a>
            </li>
            <hr>
            <li class="nav-item dropdown">
              <a class="nav-link text-bg-dark dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Log-in
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="../users/user_op.php#login">User</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="../admins/admin_login.php">Admin</a></li>
                <hr class="dropdown-divider">
                <li><a class="dropdown-item" href="#">NGO/Clubs</a></li>
                <hr class="dropdown-divider">
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>