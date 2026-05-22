<!DOCTYPE html><html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Faq Page-Solve360</title>
  <!-- Bootstrap CSS --> 
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">  <!-- AOS CSS -->  <link  href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">  <style>
    body {
      background-color: #fcfcf5;
      scroll-behavior: smooth;
    }

    .sidebar {
      background-color: #333 !important;
      border-right: 1px solid #ddd;
      height: 100vh;
      position: sticky;
      top: 0;
    }

    .sidebar a {
      display: block;
      padding: 12px 16px;
      color: #fff;
      text-decoration: none;
      border-left: 4px solid transparent;
      cursor: pointer;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #444;
      border-left: 4px solid #000;
      font-weight: 500;
    }

    .content {
      padding: 2rem;
      background-color: rgba(255, 255, 255, 0.85);
      border-radius: 8px;
      margin-top: 1rem;
    }

    .content h2 {
      font-size: 1.8rem;
      margin-bottom: 1rem;
      border-bottom: 1px solid #ddd;
      padding-bottom: 0.5rem;
    }

    .faq-section {
      display: none;
      opacity: 0;
      transform: translateX(30px);
      transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .faq-section.active {
      display: block;
      opacity: 1;
      transform: translateX(0);
    }

    @media (max-width: 767.98px) {
      .sidebar {
        height: auto;
        position: relative;
      }
      .sidebar a {
        display: inline-block;
        width: 100%;
      }
      .content {
        margin-top: 1rem;
        padding: 1rem;
      }
    }
  </style></head>
<body>
<header>
    <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
  <!-- Logo -->
<a class="navbar-brand fs-3 fw-bold mt-3 d-flex align-items-center" href="index.php">
  <video width="175" autoplay muted loop playsinline class="me-2">
    <source src="../images/final-logo_.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</a>  <!-- Navigation Links -->  <ul class="nav nav-tabs">
  <li class="nav-item">
  <a class="nav-link text-bg-dark" aria-current="page" href="index.php"><i class="bi bi-house-fill display-4 text-warning"></i></a>
  </li>

</ul>
</header>
<div class="container-fluid">
  
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 sidebar py-4">
      <a class="nav-link active" data-target="users">Information for Users</a>
      <a class="nav-link" data-target="clubs">Information for NGOs/clubs</a>
      <a class="nav-link" data-target="donors">Information for donors</a>
      <a class="nav-link" data-target="issues">Category Of Issues</a>
      <a class="nav-link" data-target="how">How It Works</a>
      <a class="nav-link" data-target="explore">Explore Initiatives</a>
    </div><!-- Main Content -->
<div class="col-md-9 content">
  <div id="users" class="faq-section active" data-aos="fade-up">
     <h2 class="mb-4 text-primary fw-bold fs-2">Information for Users</h2>

    <p class="fs-5">
      As a user of <strong>Solve360</strong>, you play a vital role in making your community a better place. Here's how you can actively participate on the platform:
    </p>

    <hr>

    <h4 class="text-dark mt-4">1. Post Local Issues with Images and Location</h4>
    <p class="fs-5">
      You can report any genuine local issue you observe—like potholes, streetlight outages, overflowing garbage, broken public benches, and more.
    </p>
    <ul>
      <li>Upload clear pictures to support your complaint.</li>
      <li>Enable location access or mark the issue on the map.</li>
      <li>Provide a short but clear description of the issue.</li>
    </ul>
    <p>This helps NGOs quickly identify where help is needed.</p>

    <h4 class="text-dark mt-4">2. Vote on Pending Issues</h4>
    <p class="fs-5">
      Apart from posting, users can also <strong>vote</strong> on issues reported by others. This helps highlight the most urgent problems.
    </p>
    <ul>
      <li>More votes mean higher visibility for that issue.</li>
      <li>NGOs prioritize tasks based on the number of votes.</li>
    </ul>
    <p>So if you see something important, make sure to support it!</p>

    <h4 class="text-dark mt-4">3. Track the Status of Your Reported Issues</h4>
    <p class="fs-5">
      Once you've submitted an issue, you can easily monitor its progress:
    </p>
    <ul>
      <li>Check if it's approved by the admin.</li>
      <li>See which NGO has accepted it.</li>
      <li>View when it's resolved.</li>
    </ul>
    <p>You'll always be in the loop about what’s happening.</p>

    <h4 class="text-dark mt-4">4. Use the Platform Responsibly</h4>
    <p class="fs-5">
      Please use Solve360 sincerely and respectfully.
    </p>
    <ul>
      <li><strong>Do not post fake or misleading issues.</strong></li>
      <li><strong>Avoid submitting emergencies like accidents or crimes.</strong> Use local emergency services for those.</li>
    </ul>

    <hr>

    <h5 class="text-success fw-bold mt-4">Together, We Can Solve More</h5>
    <p class="fs-5">
      Your voice and action matter. Report honestly, vote actively, and help build a better community—<strong>together with Solve360</strong>.
    </p>
          <div class="text-center mt-4">
  <a href="../users/user_login_register.php#register" class="btn btn-success btn-lg px-4 py-2 shadow-sm">
    Register Now
  </a>
</div>
  </div>
  <div id="clubs" class="faq-section" data-aos="fade-up">
        <h2 class="mb-4 text-primary fw-bold fs-2">Information for NGOs/Clubs</h2>

    <p class="fs-5">
      NGOs and Clubs are the backbone of <strong>Solve360</strong>. Your active participation ensures timely resolutions of community issues. Here's what you can do through the platform:
    </p>

    <hr>

    <h4 class="text-dark mt-4">1. View Assigned Local Issues</h4>
    <p class="fs-5">
      As soon as an issue is approved by the admin and matched with your service area, it becomes visible to your NGO dashboard.
    </p>
    <ul>
      <li>Issues are prioritized based on votes and proximity.</li>
      <li>You can view the details, images, and exact location.</li>
    </ul>

    <h4 class="text-dark mt-4">2. Take Prompt Action On-Site</h4>
    <p class="fs-5">
      Once an issue is assigned to your NGO, please try to visit the location at the earliest and begin the resolution process.
    </p>
    <ul>
      <li>Timely response builds trust in your organization.</li>
      <li>Make sure to verify the issue before resolving it.</li>
    </ul>

    <h4 class="text-dark mt-4">3. Mark Issues as Resolved</h4>
    <p class="fs-5">
      After addressing an issue, update its status directly from your dashboard by clicking the <strong>"Resolve Issue"</strong> button.
    </p>
    <ul>
      <li>You may be prompted to add a completion note or image.</li>
      <li>This helps admins and users confirm the work is done.</li>
    </ul>

    <h4 class="text-dark mt-4">4. Monitor Resolved Work</h4>
    <p class="fs-5">
      All successfully completed issues will be shown in the <strong>"Resolved Issues"</strong> section.
    </p>
    <ul>
      <li>Review your past contributions and maintain records.</li>
      <li>Also, explore the impact made by other NGOs on the platform.</li>
    </ul>

    <h4 class="text-dark mt-4">5. Use the Platform Honestly</h4>
    <p class="fs-5">
      Please maintain transparency and integrity in your actions.
    </p>
    <ul>
      <li><strong>Do not click "Resolve" without genuinely solving the issue.</strong></li>
      <li>Uploading fake evidence or skipping actual field work violates the purpose of Solve360.</li>
      <li>Misuse may result in permanent account suspension.</li>
    </ul>

    <hr>

    <h5 class="text-success fw-bold mt-4">Be the Change</h5>
    <p class="fs-5">
      Your dedication helps communities flourish. Solve360 is here to support your mission—let's collaborate and build better, safer neighborhoods together.
    </p>
       <div class="text-center mt-4">
  <a href="../clubs/ngo_login_register.php#register" class="btn btn-success btn-lg px-4 py-2 shadow-sm">
    Register Now
  </a>
</div>
      </div>

      <div id="donors" class="faq-section" data-aos="fade-up">
         <h2 class="mb-4 text-success fw-bold fs-2">Information for Donors</h2>

    <p class="fs-5">
      At <strong>Solve360</strong>, your donations go a long way in supporting verified NGOs and Clubs who are actively solving community issues. Every contribution—big or small—helps accelerate grassroots impact.
    </p>

    <hr>

    <h4 class="text-dark mt-4">1. Why Your Donation Matters</h4>
    <p class="fs-5">
      Your funds help:
    </p>
    <ul>
      <li>Provide necessary materials for issue resolution (clean-up drives, basic repairs, community support).</li>
      <li>Support operational costs of NGOs working in underserved areas.</li>
      <li>Scale timely response to emergencies and pressing issues in localities.</li>
    </ul>

    <h4 class="text-dark mt-4">2. How to Donate</h4>
    <p class="fs-5">
      Donating through Solve360 is simple and secure. Just follow these steps:
    </p>
    <ol>
      <li><strong>Login or Register</strong> as a user on the platform.</li>
      <li>Navigate to the <strong>"Donate"</strong> section.</li>
      <li>Select the amount and cause, then proceed with payment.</li>
      <li>You’ll receive a confirmation message after successful donation.</li>
    </ol>


    <h4 class="text-dark mt-4">3. Your Trust Is Our Responsibility</h4>
    <p class="fs-5">
      We ensure that donations are routed only to verified, impactful NGOs working actively on the ground. Misuse or misreporting by organizations is strictly monitored and dealt with appropriately.
    </p>

    <hr>

    <h5 class="text-primary fw-bold mt-4">Thank You for Empowering Change</h5>
    <p class="fs-5">
      Your support transforms lives and helps build cleaner, safer, and more responsible communities. Together, we make a difference—one issue at a time.
    </p>
   <div class="text-center mt-4">
  <a href="../users/donate.php" class="btn btn-success btn-lg px-4 py-2 shadow-sm">
    Donate Now
  </a>
</div>
      </div>

      <div id="issues" class="faq-section" data-aos="fade-up">
        <h2 class="mb-4 text-primary fw-bold fs-2">Category of Issues</h2>

    <p class="fs-5">
      On <strong>Solve360</strong>, users are encouraged to raise awareness about local civic and community issues that require attention from NGOs and clubs. This platform is built to solve problems collaboratively, not to report emergencies.
    </p>

    <hr>

    <h4 class="text-success mt-4">Issues You Can Post</h4>
    <p class="fs-5">Here are some valid categories of issues you are encouraged to post:</p>
    <ul>
      <li><strong>Sanitation Problems</strong> – Overflowing garbage, open drains, unclean areas.</li>
      <li><strong>Public Infrastructure</strong> – Broken streetlights, damaged benches, potholes, leaking water lines.</li>
      <li><strong>Environmental Concerns</strong> – Illegal dumping, deforestation, polluted water bodies.</li>
      <li><strong>Community Development</strong> – Lack of community centers, broken park equipment, missing signage.</li>
      <li><strong>Animal Welfare</strong> – Stray animals in need of care, injured animals, abandoned pets.</li>
      <li><strong>Water and Electricity Issues</strong> – Water scarcity in public taps, broken electric poles (non-hazardous).</li>
    </ul>

    <h4 class="text-danger mt-4">Issues You Should Avoid Posting</h4>
    <p class="fs-5">Certain issues are outside the scope of this platform and should <strong>not</strong> be posted:</p>
    <ul>
      <li><strong>Medical Emergencies</strong> – Accidents, heart attacks, or other health crises. Please contact local emergency services instead.</li>
      <li><strong>Fire or Natural Disasters</strong> – Fire outbreaks, floods, earthquakes. These require immediate government or fire department action.</li>
      <li><strong>Law and Order</strong> – Criminal activity, theft, violence, or harassment should be reported to the police immediately.</li>
      <li><strong>False or Exaggerated Reports</strong> – Avoid posting fake issues just to gain attention. Repeated misuse may result in account suspension.</li>
    </ul>

    <hr>

    <p class="text-muted mt-4 fs-5">
      Solve360 is a civic support platform—not an emergency response system. Let’s keep it meaningful, authentic, and focused on community improvement.
    </p>
      </div>


      <div id="how" class="faq-section" data-aos="fade-up">
         <h2 class="mb-4 text-primary fw-bold fs-2">How It Works</h2>

    <p class="fs-5">
      <strong>Solve360</strong> is a collaborative platform where users, NGOs, and administrators come together to report, manage, and resolve local community issues effectively. Here’s a step-by-step breakdown of how the platform functions:
    </p>

    <hr>

    <h4 class="text-success mt-4">1. User Submits an Issue</h4>
    <p class="fs-5">
      A registered user can report a local problem by submitting a detailed description, uploading relevant images or videos, and marking the exact location using GPS. This ensures issues are geographically accurate and verifiable.
    </p>

    <h4 class="text-success mt-4">2. Admin Reviews & Approves</h4>
    <p class="fs-5">
      Every submitted issue goes to the admin for verification. The admin checks the content for authenticity and appropriateness. Once approved, the issue gets listed under the <strong>“Pending Issues”</strong> section.
    </p>

    <h4 class="text-success mt-4">3. Community Voting</h4>
    <p class="fs-5">
      Users can view and vote on pending issues. The more an issue is voted on, the more visibility it gets for NGOs in the affected region. Voting helps prioritize problems that impact more people.
    </p>

    <h4 class="text-success mt-4">4. NGOs Get Notified & Take Action</h4>
    <p class="fs-5">
      Based on issue location and vote count, nearby NGOs/clubs are notified. They can view assigned issues, plan visits to the location, and take necessary action to resolve the problem as soon as possible.
    </p>

    <h4 class="text-success mt-4">5. NGOs Update Resolution</h4>
    <p class="fs-5">
      Once the issue is resolved, the NGO clicks on the <strong>"Resolve Issue"</strong> button with proof or updates. This moves the issue from the pending list to the resolved feed.
    </p>

    <h4 class="text-success mt-4">6. Users Can Track and View Resolved Issues</h4>
    <p class="fs-5">
      Users can track the status of their submitted issues in real-time. They can also browse through the resolved issues feed to see the positive changes brought by the community and NGOs together.
    </p>

    <hr>

    <p class="text-muted mt-4 fs-5">
      With transparency, collaboration, and accountability at its core, Solve360 empowers citizens and organizations to make meaningful changes, one issue at a time.
    </p>
      </div>

   <div id="explore" class="faq-section" data-aos="fade-up">
        <h2 class="mb-4 text-primary fw-bold">Explore Our Initiatives</h2>

    <p class="fs-5">
      <strong>Solve360</strong> is more than just an issue-reporting platform — it's a social initiative to build a better, more responsive community. Here's how we’re driving impactful change through our key initiatives:
    </p>

    <hr>

    <h4 class="text-success mt-4">1. Bridging the Gap Between Citizens and NGOs</h4>
    <p class="fs-5">
      We connect socially responsible NGOs and clubs with real-world problems reported by users. By doing this, we ensure that every reported issue finds its way to the right organization that can act on it swiftly and effectively.
    </p>

    <h4 class="text-success mt-4">2. Location-Based Issue Allocation</h4>
    <p class="fs-5">
      Using geolocation data, our system intelligently routes issues to NGOs that are closest to the affected area. This minimizes response time and ensures efficient local action.
    </p>

    <h4 class="text-success mt-4">3. Transparent Workflow & Progress Tracking</h4>
    <p class="fs-5">
      From submission to resolution, every issue is tracked transparently. Users can monitor the progress of their issues, while NGOs can maintain a record of the tasks they have completed, fostering trust and accountability.
    </p>

    <h4 class="text-success mt-4">4. Empowering Grassroots Activism</h4>
    <p class="fs-5">
      Our platform empowers everyday citizens to become changemakers by allowing them to raise their voice, report concerns, and directly contribute to solving community problems.
    </p>

    <h4 class="text-success mt-4">5. A Unified Mission for Change</h4>
    <p class="fs-5">
      Whether you're a user reporting a pothole, an NGO resolving an issue, or a donor supporting the system — you're all part of a collective mission to create cleaner, safer, and more livable neighborhoods.
    </p>

    <hr>

    <p class="text-muted mt-4 fs-5">
      Join us in turning everyday problems into community-driven solutions. Explore initiatives. Get involved. Be the change.
    </p>
      </div>    




  <!-- Other content sections remain unchanged -->
</div>

  </div>
</div><!-- Bootstrap JS --><script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script><!-- AOS JS --><script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script><script>
  AOS.init({ duration: 800, once: true });

  function showSection(id) {
    document.querySelectorAll(".sidebar .nav-link").forEach(link => {
      link.classList.toggle("active", link.getAttribute("data-target") === id);
    });
    document.querySelectorAll(".faq-section").forEach(section => {
      section.classList.remove("active");
    });
    const target = document.getElementById(id);
    if (target) {
      target.classList.add("active");
      AOS.refresh();
    }
  }
  document.querySelectorAll(".sidebar .nav-link").forEach(link => {
    link.addEventListener("click", function () {
      const id = this.getAttribute("data-target");
      history.replaceState(null, null, "#" + id);
      showSection(id);
    });
  });
  window.addEventListener("DOMContentLoaded", () => {
    const hash = window.location.hash.substring(1);
    if (hash) {
      showSection(hash);
      const target = document.getElementById(hash);
      if (target) {
        target.scrollIntoView({ behavior: "smooth" });
      }
    } else {
      showSection("users");
    }
  });
</script><!-- footers --><?php include 'footer.php'; ?>