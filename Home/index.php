 <!-- header -->
 <?php
  include'header.php';
  ?>
  
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solve360</title>
    
<style>
body {
  background: linear-gradient(135deg, #1d3557, #457b9d)!important;
}

/* carseoul style */
.carousel-caption h5,
.carousel-caption p {
  color: #fff;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
}

/* testimonial style */
.testimonial-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.testimonial-card:hover {
  transform: scale(1.03);
  box-shadow: 0 0 15px rgba(0,0,0,0.3);
}

/* hero section style */
.fade-in {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1s ease-out forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .hero-section {
  background-image: url('../images/hero-bg.jpeg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
}
.overlay-box {
  background-color: rgba(0, 0, 0, 0.65); /* Transparent dark background */
  padding: 3rem;
  border-radius: 16px;
  max-width: 800px;
  margin: 0 auto;
}
/* stats style */

</style>
  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous"> 
</head>
  <body>

  <!-- hero -->
  <section class="hero-section  text-light py-5" >
  <div class="container text-center fade-in overlay-box">
    <h1 class="display-4 fw-bold">Your City. Your Voice. Your Action.</h1>
    <p class="lead mt-4">Join hands in reporting local problems, supporting causes, and building a better neighborhood together.</p>
    <div class="mt-2">
      <a href="../users/user_login_register.php#login" class="btn btn-warning btn-lg me-3">Report an Issue</a>
      <a href="faq.php#how" class="btn btn-outline-light btn-lg">How It Works</a>
    </div>
  </div>
</section>
<hr>
       <!-- carseoul -->
 <!-- Carousel Start -->
<div id="homepageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000" data-aos="fade-up" data-aos-delay="100">
  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="../images/slider1.jpeg" class="d-block w-100" alt="Report Issue">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
        <h5>Spot the Problem. Be the Change.</h5>
        <p >Report local issues like potholes, garbage, broken lights — right from your phone.</p>
        <a href="../users/user_login_register.php#login" class="btn btn-warning">Report an Issue</a>
      </div>
    </div>

  

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="../images/slider2.jpeg" class="d-block w-100" alt="Volunteers">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
        <h5>Collaboration Creates Solutions</h5>
        <p>Let NGOs and volunteers solve unresolved issues with your help.</p>
        <a href="faq.php#explore" class="btn btn-warning">Explore Initiatives</a>
      </div>
    </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
      <img src="../images/slider3.jpeg" class="d-block w-100" alt="Volunteers">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
        <h5>See the Difference You made</h5>
        <p>Experience real transformations — clean streets, fixed lights, happy neighborhoods.</p>
        <a href="open_resolved_issues.php" class="btn btn-warning">See Resolved Issues</a>
      </div>
    </div>



    <!-- Add more slides as needed -->

  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Previous</span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<hr>
<!-- how-it-works -->
<section>
  <?php include 'how.php'; ?>
</section>
<hr>
<!-- Intro , cards-->

<section >
 <?php
 include'intro.php';
 ?>
</section>

<hr>
<!-- testimonials -->
<section class="container-fluid px-0 py-0"data-aos="fade-up" data-aos-delay="300">
  <div class="card bg-secondary text-white shadow-lg border-0">
    <div class="card-body px-4 py-5">
      <h2 class="text-center mb-4">What Our Users Say</h2>

      <div class="position-relative">
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner text-center">

            <!-- Testimonial 1 -->
            <div class="carousel-item active">
              <div class="card testimonial-card mx-auto text-dark p-4" style="max-width: 850px;">
                <div class="card-body">
                  <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Priya" class="rounded-circle mb-3" width="80" height="80">
                  <div class="mb-2 text-warning fs-4">★★★★★</div>
                  <p class="card-text fst-italic">"Reporting an issue was so easy! Within a week, the pothole near my house was fixed!"</p>
                  <h5 class="card-title mt-3 mb-0">— Priya S., Resident</h5>
                </div>
              </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="carousel-item">
              <div class="card testimonial-card mx-auto text-dark p-4" style="max-width: 850px;">
                <div class="card-body">
                  <img src="https://randomuser.me/api/portraits/men/34.jpg" alt="Aarav" class="rounded-circle mb-3" width="80" height="80">
                  <div class="mb-2 text-warning fs-4">★★★★☆</div>
                  <p class="card-text fst-italic">"As a volunteer, I could pick issues close to my location and help make a difference!"</p>
                  <h5 class="card-title mt-3 mb-0">— Aarav M., Volunteer</h5>
                </div>
              </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="carousel-item">
              <div class="card testimonial-card mx-auto text-dark p-4" style="max-width: 850px;">
                <div class="card-body">
                  <img src="https://randomuser.me/api/portraits/lego/2.jpg" alt="NGO" class="rounded-circle mb-3" width="80" height="80">
                  <div class="mb-2 text-warning fs-4">★★★★★</div>
                  <p class="card-text fst-italic">"This platform made it possible for our NGO to reach the right people quickly."</p>
                  <h5 class="card-title mt-3 mb-0">— GreenEarth NGO</h5>
                </div>
              </div>
            </div>

          </div>

          <!-- Left Arrow -->
          <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>

          <!-- Right Arrow -->
          <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-Re460s1NeyAhufAM5JwfIGWosokaQ7CH15ti6W5Y4wC/m4eJ5opJ2ivohxVM05Wd" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>  
</body>
</html>

<!-- footer -->
 <?php
 include'footer.php';
 ?>

