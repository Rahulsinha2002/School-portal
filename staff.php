<?php
include '../includes/header.php'


?>


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Our Faculty | Aryavart Academy</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      color: #333;
    }

    header {
      background-color: #007bff;
      color: white;
      padding: 60px 20px;
      text-align: center;
    }

    header h1 {
      font-size: 2.8rem;
      margin-bottom: 10px;
    }

    header p {
      font-size: 1.2rem;
    }

    .faculty-section {
      max-width: 1200px;
      margin: auto;
      padding: 40px 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 30px;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-8px);
    }

    .card img {
      width: 100%;
      height: 260px;
      object-fit: cover;
    }

    .card-body {
      padding: 20px;
      text-align: center;
    }

    .card-body h3 {
      margin-bottom: 10px;
      font-size: 1.3rem;
      color: #007bff;
    }

    .card-body p {
      font-size: 1rem;
      color: #666;
    }

    .social-icons {
      margin-top: 15px;
    }

    .social-icons a {
      margin: 0 8px;
      color: #007bff;
      font-size: 1.1rem;
      transition: 0.3s;
    }

    .social-icons a:hover {
      color: #0056b3;
    }

    footer {
      background-color: #007bff;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }


    .Topbar {
  background-color: #004080;
  color: white;
  padding: 10px 20px;
}

.scrolling-wrapper {
  width: 100%;
  overflow: hidden;
  position: relative;
  height: 28px;
}

.scrolling-text {
  position: absolute;
  white-space: nowrap;
  will-change: transform;
  animation: scroll-left 30s linear infinite;
  font-size: 1.2rem;
}

@keyframes scroll-left {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}

.topbar-right {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
  margin-top: 10px;
}

.contact-link {
  color: white;
  text-decoration: none;
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  gap: 6px;
}

.contact-link i {
  font-size: 1.2rem;
}

/* Responsive layout for phones */
@media (max-width: 768px) {
  .topbar-right {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    margin-top: 15px;
  }

  .scrolling-text {
    font-size: 0.9rem;
  }

  .contact-link {
    font-size: 0.95rem;
  }
}

  </style>
  <link rel="stylesheet" href="style.css">
</head>
<body>


<!-- TopBar -->

  


  <header>
    <h1>Meet Our Faculty</h1>
    <p>Dedicated educators shaping the future with passion and excellence</p>
  </header>

  <section class="faculty-section">
    <!-- Faculty Card 1 -->
    <div class="card">
      <img src="assest/profile.png" alt="Faculty Photo">
      <div class="card-body">
        <h3>Dr. Meena Sharma</h3>
        <p>Principal | M.Ed, PhD</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="mailto:meena@example.com"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
    </div>

    
    <!-- Card 2 -->
    <div class="card">
      <img src="https://via.placeholder.com/300x260?text=Faculty+2" alt="Faculty 2">
      <div class="card-body">
        <h3>Faculty Member 2</h3>
        <p>Math Teacher | M.Sc</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="card">
      <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
      <div class="card-body">
        <h3>Faculty Member 3</h3>
        <p>Science Teacher | B.Ed</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
    </div>

    <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>
      <div class="card">
        <img src="https://via.placeholder.com/300x260?text=Faculty+3" alt="Faculty 3">
        <div class="card-body">
          <h3>Faculty Member 3</h3>
          <p>Science Teacher | B.Ed</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
          </div>
        </div>
      </div>

    
  </section>

  
<script src="script.js"></script>
</body>
</html>
<?php
include '../includes/footer.php';

?>