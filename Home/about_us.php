
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #1d3557, #457b9d) !important;
      font-family: 'Segoe UI', sans-serif;
      color: #f1f1f1 !important;
      padding-top: 100px; /* Adjust if navbar height changes */
    }

    .glass-container {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      padding: 50px;
      margin: 40px auto;
      max-width: 1200px;
    }

    .section-title {
      color: #00e6ac;
      text-align: center;
      margin-bottom: 40px;
    }

    .about-text, .mission-text {
      text-align: justify;
      font-size: 1.1rem;
      line-height: 1.7;
    }

    .team-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      margin-top: 30px;
    }

    .team-member {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
      padding: 20px;
      width: 280px;
      text-align: center;
    }

    .team-member img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
    }

    .team-member h5 {
      color: #00e6ac;
      margin-bottom: 5px;
    }

    .resolved-container {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
      padding: 30px;
      margin-top: 40px;
    }

    .resolved-gallery {
      display: flex;
      gap: 20px;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .resolved-gallery img {
      width: 100%;
      max-width: 300px;
      border-radius: 8px;
      object-fit: cover;
    }

    .resolved-text {
      text-align: center;
      margin-top: 10px;
      color: #cccccc;
    }

    .view-all-btn {
      display: block;
      margin: 0 auto;
      padding: 10px 20px;
      border: none;
      background-color: #00e6ac;
      color: #000;
      font-weight: 600;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .view-all-btn:hover {
      background-color: #00bfa5;
      color: #fff;
    }
     .team-member:hover {
            transform: scale(1.05);
        }
            .card:hover {
            transform: scale(1.05);
        }
  </style>
</head>
<body>
<!-- Header -->
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
    <a class="nav-link text-bg-dark" aria-current="page" href="../home/index.php"><i class="bi bi-house-fill display-4 text-warning"></i></a>
    </li>
</ul>
    </div>
  </nav>
</header>
  <div class="glass-container" data-aos="fade-up">
    <h1 class="section-title">About Solve360</h1>
    <p class="about-text">
      Solve360 is a community-driven platform focused on bridging the gap between people and problem-solving agencies. Our platform empowers citizens to report local issues — like potholes, garbage disposal, streetlight failures, or waterlogging — and connects them directly with the relevant NGOs and authorities to ensure swift action. We harness the power of geolocation and crowdsourced data to prioritize and escalate critical issues in your area.
    </p>

    <h2 class="section-title mt-5">Our Mission</h2>
    <p class="mission-text">
      Our mission is to create an inclusive, transparent, and efficient ecosystem for issue reporting and resolution. We believe that small actions can lead to big change. By connecting everyday citizens with those capable of creating impact, Solve360 aims to build smarter cities, cleaner communities, and a stronger sense of civic responsibility. Together, we can transform complaints into action, and challenges into change.
    </p>

    <h2 class="section-title mt-5">Meet Our Team</h2>
    <div class="team-container" data-aos="zoom-in-up">
      <div class="team-member">
        <img src="../other_imgs/souvik.jpeg" alt="Team member 1">
        <h5>Souvik Naskar</h5>
        <p class="text-white fs-5">Frontend & Backend Designer</p>
      </div>
      <div class="team-member">
        <img src="../other_imgs/swarnava.jpeg" alt="Team member 2">
        <h5>Swarnava Das</h5>
        <p class="text-white fs-5">Founder and Admin lead</p>
      </div>
      <div class="team-member">
        <img src="../other_imgs/subhro.jpeg" alt="Team member 3">
        <h5>Subhrojyoti Halder</h5>
        <p class="text-white fs-5">NGO supervisor and Issue inspector</p>
      </div>
    </div>

   <h2 class="section-title mt-5">Our Resolved Issues</h2>
<div class="resolved-container" data-aos="fade-up">
  <div class="row g-4">
    <div class="col-md-4" data-aos="fade-up">
      <div class="card bg-dark text-light h-100 border-0 shadow" style="background: rgba(255,255,255,0.05);">
        <img src="../images/reported_img/rep5.jpeg" class="card-img-top rounded-3" alt="Issue 1">
        <div class="card-body">
          <h5 class="card-title text-info">Broken Streetlight fixed at Park Entrance</h5>
          <p class="card-text text-white small">April 23, 2025</p>
          <p class="card-text">A long-standing street-light in Park entrance was promptly repaired thanks to user reports and NGO intervention.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
      <div class="card bg-dark text-light h-100 border-0 shadow" style="background: rgba(255,255,255,0.05);">
        <img src="../images/reported_img/rep6.jpg" class="card-img-top rounded-3" alt="Issue 2">
        <div class="card-body">
          <h5 class="card-title text-info">Garbage Cleared</h5>
          <p class="card-text text-white small">April 19, 2025</p>
          <p class="card-text">Garbage bins near St. Mary\'s School which are overflowing , are cleared. </p>
        </div>
      </div>
    </div>
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
      <div class="card bg-dark text-light h-100 border-0 shadow" style="background: rgba(255,255,255,0.05);">
        <img src="../images/reported_img/rep2.jpeg" class="card-img-top rounded-3" alt="Issue 3">
        <div class="card-body">
          <h5 class="card-title text-info">Bad Road Fixed</h5>
          <p class="card-text text-white small">April 10, 2025</p>
          <p class="card-text">Thanks to community reports through Solve360, a severely damaged stretch of road in Green Park Avenue has been successfully repaired.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center mt-4">
    <a href="open_resolved_issues.php" class="view-all-btn">View All Resolved Issues</a>
  </div>
</div>
</div>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
<?php include'footer.php';?>