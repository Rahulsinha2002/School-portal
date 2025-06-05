<?php

?>


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Aryavart Academy School - Home</title>
  <link rel="stylesheet" href="School/style.css" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
<!-- AOS Animate on Scroll CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>
<body>
  <!-- Custom Preloader -->
  <div id="preloader">
    <img src="School/assest/logo.jpg" alt="Loading..." class="preloader-logo" />
  </div>

<!-- TopBar -->
  <div class="Topbar">
    <div class="scrolling-wrapper">
      <p class="scrolling-text">🎓 Education is the key to success. | 📚 Learn Today, Lead Tomorrow. | 🏫 Aryavart Academy Welcomes You!</p>
    </div>

    <div class="topbar-right">
      <div class="number">
        <a href="users/form.php" target="_blank" class="contact-link">
          <i class="fas fa-user-graduate"></i><span>Admission-Open</span>
        </a>
      </div>

      <div class="number">
        <a href="mailto:school@example.com" target="_blank" class="contact-link">
          <i class="fas fa-envelope"></i><span>Mail-Us</span>
        </a>
      </div>
    </div>
  </div>


  <nav>
  <div class="logo">Aryavart Academy</div>

  <div class="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
  </div>

  <div class="nav-links" id="navLinks">
    <div class="nav-item">
      <a href="index.php">Home</a>
    </div>

    <div class="nav-item">
      <a href="studentdashboard.php" target="_blank">Student Portal</a>
    </div>

    <div class="nav-item">
      <a onclick="toggleDropdown(event, 0)">About Us ▼</a>
      <div class="dropdown-content">
        <a href="School/mission.html">Mission</a>
        <a href="School/staff.php">Faculty</a>
      </div>
    </div>

    <div class="nav-item">
      <a onclick="toggleDropdown(event, 1)">Achievement ▼</a>
      <div class="dropdown-content">
        <a href="Awards/award.php">Awards</a>
        <a href="results.html">Results</a>
        <a href="necessary.html">Necessary</a>
      </div>
    </div>

    <div class="nav-item">
      <a onclick="toggleDropdown(event, 2)">Schooling ▼</a>
      <div class="dropdown-content">
        <a href="School/feeStructure.html">Fee Structure</a>
        <a href="secondary.html">Secondary</a>
      </div>
    </div>

    <div class="nav-item">
      <a onclick="toggleDropdown(event, 3)">Contact ▼</a>
      <div class="dropdown-content">
        <a href="School/Supportcontact.html">Support</a>
        <a href="map.html">Map</a>
      </div>
    </div>

    <!-- 👨‍💻 Admin Login Icon -->
    <div class="nav-item">
      <a href="admin/login.php" title="Admin Login">
        <i class="fas fa-user-shield"></i>
      </a>
    </div>
  </div>
</nav>
  
<!-- Hero Section -->
<section class="hero">
  <div class="slider-image image1"></div>
  <div class="slider-image image2"></div>
  <div class="overlay">
    <div class="hero-content">
      <h1>Aryavart Academy School</h1>
      <p>"Education is not the learning of facts, but the training of the mind to think." – Albert Einstein</p>
    </div>
  </div>
</section>


  
  <!-- Sticky Contact Bar -->
  <div class="contact-bar">
    <!-- Phone -->
    <a href="tel:+918920648291" class="contact-item">
      <i class="fas fa-phone"></i><span>Call us</span>
    </a>

    <!-- WhatsApp -->
    <a href="https://wa.me/918527332335" target="_blank" class="contact-item">
      <i class="fab fa-whatsapp"></i><span>Chat on WhatsApp</span>
    </a>

    <!-- Email -->
    <a href="mailto:email@example.com" class="contact-item">
      <i class="fas fa-envelope"></i><span>Mail us</span>
    </a>

    <!-- Facebook -->
    <a href="https://www.facebook.com/aryavartacademy/" target="_blank" class="contact-item">
      <i class="fab fa-facebook-f"></i><span>Our Facebook Page</span>
    </a>

    <a href="users/form.php" target="_blank" class="contact-item">
      <i class="fas fa-user-graduate" style="color: white; font-size: 24px;"></i><span > Admission</span> 
    </a>
  </div>
  
  <!-- Facilities Section -->
<section class="facilities">
    <h2>Our School Facilities</h2>
    <div class="facility-container">
      <div class="facility">
        <h3>Smart Classrooms</h3>
        <p>Interactive boards and digital tools enhance the learning experience and student engagement.</p>
      </div>
      <div class="facility">
        <h3>Science Labs</h3>
        <p>Fully equipped labs for physics, chemistry, and biology to promote practical learning and discovery.</p>
      </div>
      <div class="facility">
        <h3>Library</h3>
        <p>A vast collection of books, magazines, and digital resources to encourage reading and research.</p>
      </div>
      <div class="facility">
        <h3>Playground</h3>
        <p>Spacious playground with sports facilities to support physical health and team spirit.</p>
      </div>
      <div class="facility">
        <h3>Computer Lab</h3>
        <p>Modern computer labs with high-speed internet and software for learning and coding skills.</p>
      </div>
      <div class="facility">
        <h3>Computer Lab</h3>
        <p>Modern computer labs with high-speed internet and software for learning and coding skills.</p>
      </div>
    </div>
  </section>
  
<!-- Rotating Sanskrit Thought Section -->
<section class="sanskrit-quote-section" data-aos="fade-in">
    <div class="quote-box" id="quote-carousel">
      <p class="sanskrit-text" id="sanskrit-text">"सा विद्या या विमुक्तये।"</p>
      <p class="quote-meaning" id="quote-meaning">"That is true education which liberates."</p>
      <p class="quote-source" id="quote-source">– विष्णु पुराण (Vishnu Purana)</p>
    </div>
  </section>
  
  
  <section class="principal-section">
    <div class="principal-container">
  
      <!-- First Card -->
      <div class="principal-card" data-aos="fade-up">
        <div class="principal-photo">
          <img src="School/assest/men.jpg" alt="Principal Photo">
        </div>
        <div class="principal-message">
          <h2>Message from the Principal</h2>
          <p>
            At Aryavart Academy, we believe in nurturing young minds through discipline, dedication, and dynamic learning.
          </p>
          <p><strong>- Er. Piyush Singh</strong></p>
          <div class="social-icons">
            <a href="mailto:principal@example.com"><i class="fas fa-envelope"></i></a>
            <a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
          </div>
        </div>
      </div>
  
      <!-- Second Card -->
      <div class="principal-card" data-aos="fade-up" data-aos-delay="200">
        <div class="principal-photo">
          <img src="School/assest/men.jpg" alt="Vice Principal Photo">
        </div>
        <div class="principal-message">
          <h2>Message from the Director</h2>
          <p>
            Our mission is to guide every child to reach their full potential with values, vision, and a vibrant education.
          </p>
          <p><strong>- Mr. Sonu Yadav</strong></p>
          <div class="social-icons">
            <a href="mailto:viceprincipal@example.com"><i class="fas fa-envelope"></i></a>
            <a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
          </div>
        </div>
      </div>
  
    </div>
  </section>
  
    
  <div class="header">
  <div class="announcement-wrapper">
    <div class="announcement">
      📢 School Admissions Open | Last Date to Apply: 30th April | Call Now: 9876543210
    </div>
  </div>
</div>
  
    <!-- 📽️ Video Section -->
    <div class="video-section">
      <div class="toggle-wrapper">
        <div class="toggle-switch" onclick="toggleVideo()">
          <div class="slider" id="slider"></div>
          <span class="left">English</span>
          <span class="right">Hindi</span>
        </div>
      </div>
  
      <div class="videos">
        <div class="video-box">
          <video id="video1" controls>
            <source src="School/assest/videoEnglish.mp4" type="video/mp4">
            Your browser does not support video.
          </video>
        </div>
        <div class="video-box">
          <video id="video2" controls>
            <source src="School/assest/videoHinid.mp4" type="video/mp4">
            Your browser does not support video.
          </video>
        </div>
      </div>
    </div>


    <div class="notification-wrapper">
  <div class="notification-header">
    <h2>📣 Announcements & Updates</h2>
  </div>
  <div class="notification-frame-container">
    <iframe src="notification.php" loading="lazy"></iframe>
  </div>
</div>


  <!-- Statistics Section -->
<section class="stats-section">
    <div class="stats-container">
  
      <div class="stat-box" data-aos="zoom-in">
        <h3><span class="counter" data-count="450">0</span>+</h3>
        <p>Students</p>
      </div>
  
      <div class="stat-box" data-aos="zoom-in" data-aos-delay="200">
        <h3><span class="counter" data-count="32">0</span>+</h3>
        <p>Teachers</p>
      </div>
  
      <div class="stat-box" data-aos="zoom-in" data-aos-delay="400">
        <h3><span class="counter" data-count="45">0</span>+</h3>
        <p>Courses</p>
      </div>
      <div class="stat-box" data-aos="zoom-in" data-aos-delay="400">
        <h3><span class="counter" data-count="2">0</span></h3>
        <p>Branch</p>
      </div>
    </div>
  </section>
  
  <section class="location-section" data-aos="fade-up">
    <div class="location-container">
  
      <!-- Info Card -->
      <div class="location-info">
        <h2>📍 Our Location</h2>
        <p>Aryavart Academy School is located in a peaceful and well-connected area, ideal for a focused learning environment.</p>
        <ul>
          <li><i class="fas fa-map-marker-alt"></i>Bhangel, Salarpur Khadar, Noida, Uttar Pradesh 201304</li>
          <li><i class="fas fa-phone-alt"></i><a href="tel:+918527332335">+91 8527332335</a></li>
          <li><i class="fas fa-envelope"></i><a href="mailto:info@aryavartacademy.edu.in">info@aryavartacademy.edu.in</a></li>
        </ul>
      </div>
  
      <!-- Map Embed -->
      <div class="location-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3504.8872479342162!2d77.38464157533214!3d28.54310857571381!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce8adcbbb2857%3A0x769327a39c3a06b1!2sAryavart%20Academy!5e0!3m2!1sen!2sin!4v1744647235734!5m2!1sen!2sin" loading="lazy" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
  
    </div>
  </section>
  


  <!-- ========== FOOTER START ========== -->
<footer class="footer">
  <div class="footer-container">
    <!-- Column 1: Branding -->
    <div class="footer-col brand">
      <img src="School/assest/logo.jpg" alt="Aryavart Academy Logo" class="logoo">
      <h3>Aryavart Academy</h3>
      <p>Empowering future leaders through quality education and innovation.</p>
    </div>

    <!-- Column 2: Quick Links -->
    <div class="footer-col links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="users/form.php" target="_blank">Admissions</a></li>
        <li><a href="#" target="_blank"> Academics</a></li>
        <li><a href="School/staff.html" target="_blank">Faculty</a></li>
        <li><a href="studentdashboard.php" target="_blank">Student Portal</a></li>
      </ul>
    </div>

    <!-- Column 3: Contact Info -->
    <div class="footer-col contact">
      <h4>Contact Us</h4>
      <p>Email: contact@aryavartacademy.edu</p>
      <p>Phone: +91 98765 43210</p>
      <p>Address: NH-27, Lucknow Road, Barabanki, UP, India</p>
      <p><strong>Office Hours:</strong> Mon–Fri, 9 AM – 5 PM</p>
    </div>

    <!-- Column 4: Newsletter -->
    <!-- <div class="footer-col newsletter">
      <h4>Subscribe to Newsletter</h4>
      <form id="newsletterForm">
        <input type="email" id="emailInput" placeholder="Your email" required>
        <button type="submit">Subscribe</button>
      </form> -->
      <p id="message" class="success-message"></p>
      <div class="social-icons">
        <!-- Facebook Icon -->
        <a href="#" target="_blank">
          <i class="fab fa-facebook-f" style="font-size: 30px;"></i>
        </a>
        <a href="#" target="_blank">
          <i class="fab fa-youtube" style="font-size: 30px;"></i>
        </a>
        <a href="#" target="_blank">
          <i class="fab fa-instagram" style="font-size: 30px;"></i>
        </a>
        
        

        
      </div>
    </div>
  </?>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="policy-links">
      <a href="#" id="openTerms">Terms of Service</a> |
      <a href="#" id="openPrivacy">Privacy Policy</a>
    </div>
    
    <p>&copy; 2025 Aryavart Academy. All rights reserved.</p>
    <a href="#" class="back-to-top">↑ Back to Top</a>
  </div>
  <footer class="w-full bg-gray-100 py-4 mt-10">
  <div class="max-w-screen-xl mx-auto px-4 text-center">
    <p class="text-sm text-gray-600" style="font-size:8px">
      Designed and Developed by 
      <a href="https://rahulkumar2004.netlify.app/" target="_blank" class="text-blue-600 hover:underline">
        Rahul Kumar
      </a>
    </p>
  </div>
</footer>

</footer>


<!-- Terms Modal -->
<div id="termsModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" id="closeTerms">&times;</span>
    <h2>Terms of Service</h2>
    <p>
      By accessing Aryavart Academy's portal, you agree to comply with the school’s academic and behavioral policies.
      The website is intended for educational purposes only. Unauthorized use of student or faculty data is prohibited.
    </p>
  </div>
</div>

<!-- Privacy Modal -->
<div id="privacyModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" id="closePrivacy">&times;</span>
    <h2>Privacy Policy</h2>
    <p>
      Aryavart Academy respects your privacy. We collect minimal data such as name, email, and usage statistics to improve our services.
      Data is never sold or shared with third parties. For inquiries, contact privacy@aryavartacademy.edu.
    </p>
  </div>
</div>
<script>
    window.addEventListener("load", () => {
      const preloader = document.getElementById("preloader");
      preloader.style.opacity = "0";
      setTimeout(() => {
        preloader.style.display = "none";
      }, 500); // Matches CSS transition
    });
  </script>
  
   
  <script>(function() {
  const images = [
    "School/assest/main1.jpg",
    "School/assest/main22.jpg",
    "School/assest/main3.jpg"
  ];

  const image1 = document.querySelector(".image1");
  const image2 = document.querySelector(".image2");

  let currentIndex = 0;
  let showingImage1 = true;

  image1.style.backgroundImage = `url('${images[currentIndex]}')`;
  image1.classList.add("active");

  setInterval(() => {
    currentIndex = (currentIndex + 1) % images.length;
    const nextImage = images[currentIndex];

    if (showingImage1) {
      image2.style.backgroundImage = `url('${nextImage}')`;
      image2.classList.add("active");
      image1.classList.remove("active");
    } else {
      image1.style.backgroundImage = `url('${nextImage}')`;
      image1.classList.add("active");
      image2.classList.remove("active");
    }

    showingImage1 = !showingImage1;
  }, 6000);
})();</script>
  <!-- JavaScript -->
  
  <!-- AOS Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="School/script.js"></script>

</body>
</html>
