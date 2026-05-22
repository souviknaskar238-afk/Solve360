<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>How It Works - Solve360</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .how-it-works-section {
      background: #343a40;
      padding: 60px 0;
      color: #ffffff;
    }
    .how-it-works-title {
      font-size: 2.5rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 50px;
      border-bottom: 3px solid #0d6efd;
      display: inline-block;
      padding-bottom: 10px;
    }
    .step-box {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      padding: 30px;
      height: 100%;
      color: #000000;
      transition: transform 0.3s;
    }
    .step-box:hover {
      transform: translateY(-5px);
    }
    .step-icon {
      font-size: 2.5rem;
      color: #0d6efd;
      margin-bottom: 20px;
    }
    .step-title {
      font-weight: 600;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<section class="how-it-works-section text-center" data-aos="fade-up">
  <div class="container">
    <h2 class="how-it-works-title">How It Works</h2>
    <div class="row g-4 mt-4 justify-content-center">

      <div class="col-md-6 col-lg-3" data-aos="fade-up">
        <div class="step-box text-center">
          <div class="step-icon"><i class="bi bi-person-plus-fill"></i></div>
          <h5 class="step-title">Sign Up / Login</h5>
          <p>Create an account or log in as a user or NGO/Club to get started.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="step-box text-center">
          <div class="step-icon"><i class="bi bi-megaphone-fill"></i></div>
          <h5 class="step-title">Post / Report Issues</h5>
          <p>Users can post local problems with details and images.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="step-box text-center">
          <div class="step-icon"><i class="bi bi-people-fill"></i></div>
          <h5 class="step-title">NGOs Take Action</h5>
          <p>NGOs and clubs view, pick up, and resolve issues in their service areas.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="step-box text-center">
          <div class="step-icon"><i class="bi bi-graph-up-arrow"></i></div>
          <h5 class="step-title">Track & Collaborate</h5>
          <p>Track resolution progress, connect with NGOs, and help spread awareness.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>