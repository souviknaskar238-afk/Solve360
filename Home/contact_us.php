<!-- contact_us.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us | Solve360</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Leaflet for OpenStreetMap -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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

    .contact-container, .map-container {
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      max-width: 1000px;
      width: 100%;
      margin: 30px auto;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
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

    #map {
      width: 100%;
      height: 400px;
      border-radius: 15px;
      margin-top: 20px;
    }

    footer {
      background-color: #212529;
      color: #aaa;
      text-align: center;
      padding: 10px;
    }
  </style>
</head>
<body>

<?php include '../users/user_header.php'; ?>

<div class="container-fluid main-container">
  <!-- Contact Us Form -->
  <div class="contact-container">
    <h3 class="text-center mb-4 text-white"><i class="bi bi-chat-dots-fill me-2"></i>Contact Us</h3>

    <form action="https://formspree.io/f/mldbpnbb" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Your Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
      </div>



      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message..." required></textarea>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-submit bg-primary text-white">Send Message</button>
      </div>
    </form>
  </div>

  <!-- NGOs Map Section -->
  <div class="map-container">
    <h4 class="text-center mb-3 text-white"><i class="bi bi-geo-alt-fill me-2"></i>Our NGOs in Kolkata</h4>
    <div id="map"></div>
  </div>
</div>

<footer>
  <?php include 'footer.php'; ?>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const map = L.map('map').setView([22.5726, 88.3639], 12); // Kolkata center

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Dummy NGO markers
  const ngos = [
    { name: "Help Crew", lat: 22.575, lng: 88.363 },
    { name: "Hope Organisation", lat: 22.572, lng: 88.370 },
    { name: "HumanEye", lat: 22.568, lng: 88.350 }
  ];

  ngos.forEach(ngo => {
    L.marker([ngo.lat, ngo.lng])
      .addTo(map)
      .bindPopup(`<strong>${ngo.name}</strong>`)
      .openPopup();
  });
</script>

</body>
</html>