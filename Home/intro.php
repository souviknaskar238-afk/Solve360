<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Problem - Solve360</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .section-container {
      padding: 2rem 1rem;
    }

    .main-card {
      background-color: #343a40;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      color: #fff;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .main-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 40px rgba(0, 0, 0, 0.2);
    }

    .inner-card {
      background-color: #f8f9fa;
      color: #212529;
      padding: 2rem;
      border-radius: 20px;
      transition: all 0.3s ease;
      height: 100%;
    }

    .inner-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .stats-box {
      display: flex;
      justify-content: space-around;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .stat {
      text-align: center;
    }

    .stat h5 {
      font-size: 2rem;
      color: #007bff;
      font-weight: bold;
    }

    .report-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem;
      border-bottom: 1px solid #dee2e6;
      transition: background-color 0.3s;
    }

    .report-item:hover {
      background-color:rgb(139, 138, 138);
      border-radius: 10px;
    }

    .report-item img {
      width: 80px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
    }

    .section-title {
      font-weight: 600;
      margin-bottom: 1.25rem;
      font-size: 1.5rem;
      position: relative;
      padding-bottom: 0.5rem;
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      height: 3px;
      width: 40px;
      background-color: #3182ce;
      border-radius: 10px;
    }
    .instructions {
      padding-left: 1.2rem;
      margin-bottom: 1.25rem;
    }
    .instructions li {
      margin-bottom: 0.5rem;
      position: relative;
    }
    .outer-card {
      background-color: rgb(83, 83, 83);
      padding: 2.5rem;
      border-radius: 15px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      /* margin: 2rem auto; */
      /* height: 350px; */
    }
    .outer-card:hover {
      transform: scale(1.02);
      box-shadow: 0 12px 20px rgba(0,0,0,0.2);
    }

    .hover-card {
      position: relative;
      overflow: hidden;
      border-radius: 10px;
      transition: transform 0.3s ease, box-shadow 0.1s ease;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      height: 500px;
    }

    .hover-card:hover {
      transform: scale(1.03);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    }

    .hover-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .hover-card:hover img {
      transform: scale(1.1);
    }

    .hover-content {
      position: absolute;
      bottom: 0;
      width: 100%;
      padding: 1rem;
      background: rgba(0, 0, 0, 0.75);
      color: white;
      transform: translateY(100%);
      opacity: 0;
      transition: all 0.4s ease-in-out;
    }

    .hover-card:hover .hover-content {
      transform: translateY(0%);
      opacity: 1;
    }

    .hover-title {
      font-size: 1.2rem;
      font-weight: 600;
    }

    .hover-text {
      font-size: 0.95rem;
    }


  </style>
</head>
<body>

<section class="container-fluid px-4 py-0 section-container">
  <div class="main-card p-4">
    <div class="row g-4">
      <!-- Left: Instructions and Stats -->
      <div class="col-lg-6" data-aos="fade-right">
        <div class="inner-card h-100">
        <h3 class="section-title">Issues You can Post</h3>
          <ol class="instructions">
          <li><strong>Road & Infrastructure:</strong> Potholes, broken footpaths, damaged street signs</li>
          <li><strong>Sanitation & Waste:</strong> Garbage overflow, blocked drains, lack of public bins</li>
          <li><strong>Street Lighting:</strong> Broken or non-functional streetlights</li>
          <li><strong>Water Supply:</strong> Leakages, water scarcity, pipeline damage</li>
          <li><strong>Public Safety:</strong> Open manholes, illegal parking, unsafe construction</li>
  </ol>
  <a href="faq.php#issues" class="btn btn-dark">View More</a>
          <hr>
          <div class="stats-box mt-4">
            <div class="stat">
              <h5 class="count" data-target="624">0</h5>
              <p class="fs-5">Reports this Week</p>
            </div>
            <div class="stat">
              <h5 class="count" data-target="1542">0</h5>
              <p class="fs-5">Last Month</p>
            </div>
            <div class="stat">
              <h5 class="count" data-target="6785">0</h5>
              <p class="fs-5">Total Updates</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Recent Reports -->
      <div class="col-lg-6" data-aos="fade-left">
        <div class="inner-card h-100">
          <h3 class=" section-title">Recent Problems</h3>

          <div class="report-item">
            <div>
              <strong>Broken Streetlight at Park Entrance</strong><br>
              <small>10 mins ago</small>
            </div>
            <img src="../images/reported_img/rep5.jpeg" alt="Report Image">
          </div>

          <div class="report-item">
            <div>
              <strong>Dead Tree Blocking Sidewalk</strong><br>
              <small>30 mins ago</small>
            </div>
            <img src="../images/reported_img/rep9.jpg" alt="Report Image">
          </div>

          <div class="report-item">
            <div>
              <strong>Street light not working</strong><br>
              <small>1 hour ago</small>
            </div>
            <img src="../images/reported_img/rep3.jpeg" alt="Report Image">
          </div>

          <div class="report-item">
            <div>
              <strong>Open Manhole on Main Road</strong><br>
              <small>Today</small>
            </div>
            <img src="../images/reported_img/rep7.jpg" alt="Report Image">
          </div>

          <div class="text-end mt-3">
            <a href="open_pending_issues.php" class="btn btn-dark">View All Reports</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<hr>

<!-- cards -->
<div class="container-fluid px-4 py-0"data-aos="fade-up">
  <div class="outer-card">
    <div class="row g-4">
      
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card hover-card">
          <img src="../images/user_cards.jpeg" alt="Nature Image">
          <div class="hover-content text-center">
            <div class="hover-title ">For Users</div>
            <div class="hover-text ">Report local issues with photos and location. Vote on others' concerns and track progress—your voice drives community change.</div>
            <br>
            <a href="faq.php#users"><button type="button" class="btn btn-light ">Learn more &rarr;</button></a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card hover-card">
          <img src="../images/ngo_card.jpeg" alt="Adventure Image">
          <div class="hover-content text-center">
            <div class="hover-title ">For Clubs/NGOs</div>
            <div class="hover-text ">View assigned issues in your area, act swiftly, and update status. Help build a responsive and cleaner community, one step at a time.</div>
            <br>
          <a href="faq.php#clubs"><button type="button" class="btn btn-light">Learn more &rarr;</button></a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card hover-card">
          <img src="../images/donate_card2.jpeg" alt="City Image">
          <div class="hover-content text-center">
            <div class="hover-title">For Donations</div>
            <div class="hover-text">Your donations fuel action. Log in, contribute, and track your impact—every bit of support helps resolve real issues on the ground.</div>
            <br>
            <a href="faq.php#donors"><button type="button" class="btn btn-light">Learn more &rarr;</button></a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- AOS and Counter Scripts -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();

  const counters = document.querySelectorAll('.count');
  const animateCount = (counter) => {
    counter.innerText = '0';
    const updateCount = () => {
      const target = +counter.getAttribute('data-target');
      const count = +counter.innerText;
      const increment = target / 200;
      if (count < target) {
        counter.innerText = Math.ceil(count + increment);
        setTimeout(updateCount, 10);
      } else {
        counter.innerText = target.toLocaleString();
      }
    };
    updateCount();
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        counters.forEach(counter => animateCount(counter));
      }
    });
  }, { threshold: 0.5 });

  const statsSection = document.querySelector('.stats-box');
  observer.observe(statsSection);
</script>

</body>
</html>